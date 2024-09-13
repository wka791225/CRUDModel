<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Right
 *
 * @property int $id
 * @property int $user_id
 * @property string $right
 * @property int $group
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class Right extends Model
{
    protected $table = 'rights';
    public static $snakeAttributes = false;

    protected $casts = [
        'user_id' => 'int',
        'group' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'right',
        'group'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
