<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Judge
 *
 * @property int $id
 * @property int $user_id
 * @property int $judge_invited_record_id
 * @property int $judge_status
 * @property int $account_status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $id_number
 * @property string $bank_account
 * @property string $agreement_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Judge extends Model
{
    protected $table = 'judges';
    public static $snakeAttributes = false;

    protected $casts = [
        'user_id' => 'int',
        'judge_invited_record_id' => 'int',
        'judge_status' => 'int',
        'account_status' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'judge_invited_record_id',
        'judge_status',
        'account_status',
        'name',
        'email',
        'phone',
        'id_number',
        'bank_account',
        'agreement_path',
        'judge_like',
        'secrecy_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
