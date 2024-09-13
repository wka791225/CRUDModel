<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TempWork
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $works_data
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class TempWork extends Model
{
    protected $table = 'temp_works';
    public static $snakeAttributes = false;

    protected $casts = [
        'user_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'works_data',
        'register_data',
        'personal_data',
        'check_personal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
