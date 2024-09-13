<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MoveLog
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $move_log
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class MoveLog extends Model
{
    protected $table = 'move_logs';
    public static $snakeAttributes = false;

    protected $casts = [
        'user_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'move_log',
        'ip_address',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
