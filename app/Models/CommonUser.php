<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommonUser
 *
 * @property int $id
 * @property int $user_id
 * @property string $id_number
 * @property Carbon $birthday
 * @property int $type
 * @property string $phone
 * @property string $city
 * @property string $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class CommonUser extends Model
{
    protected $table = 'common_users';
    public static $snakeAttributes = false;

    protected $casts = [
        'user_id' => 'int',
        'birthday' => 'datetime',
        'type' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'id_number',
        'birthday',
        'type',
        'phone',
        'city',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
