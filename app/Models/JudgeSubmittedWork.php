<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JudgeSubmittedWork
 *
 * @property int $id
 * @property int $judge_id
 * @property int $submitted_work_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class JudgeSubmittedWork extends Model
{
    protected $table = 'judge_submitted_works';
    public static $snakeAttributes = false;

    protected $casts = [
        'judge_id' => 'int',
        'submitted_work_id' => 'int'
    ];

    protected $fillable = [
        'judge_id',
        'submitted_work_id'
    ];
}
