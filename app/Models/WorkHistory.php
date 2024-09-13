<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkHistory
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property int $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class WorkHistory extends Model
{
    protected $table = 'work_histories';
    public static $snakeAttributes = false;

    protected $casts = [
        'user_id' => 'int',
        'type' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'title',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
