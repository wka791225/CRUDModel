<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailVerificationRecord
 *
 * @property int $id
 * @property string $email
 * @property string $email_verification_code
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class EmailVerificationRecord extends Model
{
    protected $table = 'email_verification_records';
    public static $snakeAttributes = false;

    protected $casts = [
        'status' => 'bool'
    ];

    protected $fillable = [
        'email',
        'email_verification_code',
        'status'
    ];
}
