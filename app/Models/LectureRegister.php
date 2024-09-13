<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LectureRegister
 *
 * @property int $id
 * @property string $join_lectures
 * @property string $name
 * @property string $id_number
 * @property Carbon $birthday
 * @property int $type
 * @property string $phone
 * @property string $email
 * @property string $dept_title
 * @property string $hope
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class LectureRegister extends Model
{
    protected $table = 'lecture_registers';
    public static $snakeAttributes = false;

    protected $casts = [
        'birthday' => 'datetime',
        'type' => 'int'
    ];

    protected $fillable = [
        'join_lectures',
        'name',
        'id_number',
        'birthday',
        'type',
        'phone',
        'email',
        'dept_title',
        'hope',
        'child_number',
        'adult_number',
    ];
}
