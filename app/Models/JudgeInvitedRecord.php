<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JudgeInvitedRecord
 *
 * @property int $id
 * @property string $inviter_name
 * @property string $judge_invited_code
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class JudgeInvitedRecord extends Model
{
    protected $table = 'judge_invited_records';
    public static $snakeAttributes = false;

    protected $casts = [
        'status' => 'bool'
    ];

    protected $fillable = [
        'inviter_name',
        'judge_invited_code',
        'status'
    ];
}
