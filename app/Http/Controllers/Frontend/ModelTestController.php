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
}
