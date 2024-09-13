<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DeclarationDocument
 *
 * @property int $id
 * @property int $registration_info_id
 * @property int $type
 * @property string $file_name
 * @property string $file_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property RegistrationInfo $registrationInfo
 *
 * @package App\Models
 */
class DeclarationDocument extends Model
{
    protected $table = 'declaration_documents';
    public static $snakeAttributes = false;

    protected $casts = [
        'registration_info_id' => 'int',
        'type' => 'int'
    ];

    protected $fillable = [
        'registration_info_id',
        'type',
        'file_name',
        'file_path'
    ];

    public function registrationInfo()
    {
        return $this->belongsTo(RegistrationInfo::class);
    }
}
