<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Database\Eloquent\Relations\Relation;

class ModelTestController extends Controller
{
    //
    public function index()
    {
        // 获取所有模型及其字段信息
        $modelsPath = app_path('Models');
        $modelFiles = File::allFiles($modelsPath);
        $modelsData = [];

        foreach ($modelFiles as $file) {
            $modelName = pathinfo($file, PATHINFO_FILENAME);
            $modelClass = "App\\Models\\$modelName";

            if (class_exists($modelClass) && is_subclass_of($modelClass, Model::class)) {
                $modelInstance = new $modelClass;
                $tableName = $modelInstance->getTable();
                $columns = Schema::getColumnListing($tableName);

                $columnsData = [];
                foreach ($columns as $column) {
                    //  不要顯示的欄位
                    if (in_array($column, ['id', 'created_at', 'updated_at'])) {
                        continue;
                    }
                    $columnType = Schema::getColumnType($tableName, $column);
                    $columnDetails = DB::select("SHOW FULL COLUMNS FROM $tableName LIKE '$column'")[0];

                    $columnList = [
                        'name' => $column,
                        'type' => $columnType,
                        'nullable' => $columnDetails->Null === 'YES',
                        'comment' => $columnDetails->Comment,
                        'required' => false,
                        'requestName' => '',
                    ];
                    array_push($columnsData, $columnList);
                }

                $relations = $this->getModelRelations($modelInstance);
                $array = [
                    'modelName' => $modelName,
                    'columns' => $columnsData,
                    'relations' => $relations,
                ];
                array_push($modelsData, $array);
            }
        }

        $data = [
            'model' => $modelsData,
        ];
        return Inertia::render('Frontend/Index', ['response' => rtFormat($data)]);
    }
    // 取得模型關聯
    private function getModelRelations($modelInstance)
    {
        $relations = [];
        $reflection = new ReflectionClass($modelInstance);
        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->class == get_class($modelInstance) && $method->getNumberOfParameters() == 0) {
                try {
                    $result = $method->invoke($modelInstance);
                    if ($result instanceof Relation) {
                        $relationType = class_basename(get_class($result));
                        $relatedModel = $result->getRelated();
                        $relations[$method->getName()] = [
                            'type' => $relationType,
                            'model' => get_class($relatedModel),
                        ];
                    }
                } catch (\Throwable $e) {
                    // 忽略可能的异常
                }
            }
        }

        return $relations;
    }
    // 生成控制器
    public function doController(Request $request)
    {

        // 建立controller

        $pathTest = 'public function __construct(protected FilesService $filesService,)
        {
        }'."\n";
        // 寫 validate
        $data = $request->all();
        $validationString = $this->generateValidationString($data);
        // 後臺資料列，後續處理

        // 新增
        $createSql = $this->generateInsertSQL($data);
        $create = 'public function store(Request $request){'. "\n" . $validationString . "\n" . $createSql."\n" ."}";
        // 編輯 
        $editSql = $this->generateEditSQL($data);
        $edit = 'public function update(Request $request){'. "\n" . $validationString . "\n" . $editSql."\n" ."}";
        // 刪除
        $delete = $this->generateDeleteSQL($data);
        // 合併所有字串，並製作成php檔案
        $allText = $pathTest."\n" .$create."\n" .$edit."\n" .$delete;
        
        
    }
    // 驗證字串
    private function generateValidationString($data)
    {
        $rules = [];

        foreach ($data as $table) {
            foreach ($table['columns'] as $column) {
                // 只有當 $column['required'] 為 true 時才寫入驗證規則
                if ($column['required']) {
                    $rule = ['required'];

                    switch ($column['type']) {
                        case 'integer':
                            $rule[] = 'integer';
                            break;
                        case 'string':
                            $rule[] = 'string';
                            break;
                        case 'date':
                            $rule[] = 'date';
                            break;
                        case 'text':
                            $rule[] = 'string';
                            break;
                            // 根據需要添加更多類型
                    }

                    // 將規則組合成一個字串
                    $rules[$column['requestName']] = implode('|', $rule);
                }
            }
        }

        // 手動構建驗證規則字串
        $validationString = "\$request->validate([\n";
        foreach ($rules as $field => $rule) {
            $validationString .= "  '$field' => '$rule',\n";
        }
        $validationString .= "]);";

        return $validationString;
    }
    // 新增字串
    private function generateInsertSQL($data)
    {
        $createStrings = [];

        foreach ($data as $table) {
            $fields = [];
            $tableName = $table['tableName'];
            $text = '';
            foreach ($table['columns'] as $column) {
                $fieldName = $column['name'];
                $requestName = $column['requestName'];

                if ($requestName === 'filePath') {
                    $text = "\$file = \$this->filesService->fileUpload(\$request->$requestName, '$tableName');\$filePath = \$file->path;" . "\n";
                    $value = "'\$filePath'";
                } elseif ($column['type'] === 'date') {
                    $value = "date('Y-m-d', strtotime(\$request->$requestName))";
                } else {
                    $value = "\$request->$requestName";
                }
                $fields[] = "'$fieldName' => $value" ;
            }

            $createString = $text . $table['tableName'] . "::create([" . implode(', '. "\n", $fields) . "]);";
            $createStrings[] = $createString;
        }

        return implode("\n", $createStrings);
    }
    // 編輯字串
    private function generateEditSQL($data)
    {
        $editSQLStrings = [];

        $setClauses = [];
        foreach ($data as $table) {
            $tableId = '$'.strtolower($table['tableName']).'= '.$table['tableName'].'::find($request->id);';
            $tableName = $table['tableName'];
            $text = '';
            foreach ($table['columns'] as $column) {
                $fieldName = $column['name'];
                $requestName = $column['requestName'];

                if ($requestName === 'filePath') {
                    $text = "\$file = \$this->filesService->fileUpload(\$request->$requestName, '$tableName');if(\$file){\$filePath = \$file->path;}else{\$filePath = \$request->$requestName}" . "\n";
                    $value = "'\$filePath'";
                } elseif ($column['type'] === 'date') {
                    $value = "date('Y-m-d', strtotime(\$request->$requestName))";
                } elseif($requestName === 'pathName') {
                    $value = '$file->name';
                } else {
                    $value = "\$request->$requestName";
                }
                $setClauses[] = "'$fieldName' => $value" ;
            }

            $editSQL =$tableId. "\n".$text. '$'.strtolower($table['tableName']). "->update([" . implode(', '. "\n", $setClauses) . "]);";
            $editSQLStrings[] = $editSQL;
        }

        return implode("\n", $editSQLStrings);

    }
    // 刪除字串
    private function generateDeleteSQL($data)
    {        $delete = 'public function destroy($id){' . "\n";
        // 檢查是否有 filePath 字段
        foreach ($data as $table) {
            $delete .= '$' . strtolower($table['tableName']) . '= ' . $table['tableName'] . '::find($id);' . "\n";
            foreach ($table['columns'] as $column) {
                if ($column['requestName'] === 'filePath') { 
                    $delete .= '$this->filesService->fileDelete($'.strtolower($table['tableName']).'->filePath);' . "\n";
                }
            }
            $delete .= '$' . strtolower($table['tableName']) . '->delete();' . "\n";
        }
        
        $delete .= '}';

        return $delete;
    }
}
