<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Notifications\RestPassWordMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $role
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property bool $status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|CommonUser[] $commonUsers
 * @property Collection|Judge[] $judges
 * @property Collection|RegistrationInfo[] $registrationInfos
 * @property Collection|Right[] $rights
 * @property Collection|SubmittedWork[] $submittedWorks
 * @property Collection|TempWork[] $tempWorks
 * @property Collection|WorkHistory[] $workHistories
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $table = 'users';
    public static $snakeAttributes = false;

    protected $casts = [
        'role' => 'int',
        'email_verified_at' => 'datetime',
        'status' => 'bool'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'name',
        'email',
        'role',
        'email_verified_at',
        'password',
        'status',
        'remember_token',
        'line_id'
    ];

    public function commonUser()
    {
        return $this->hasOne(CommonUser::class);
    }

    public function judge()
    {
        return $this->hasOne(Judge::class);
    }

    public function registrationInfo()
    {
        return $this->hasMany(RegistrationInfo::class);
    }

    public function right()
    {
        return $this->hasMany(Right::class);
    }

    public function submittedWork()
    {
        return $this->hasMany(SubmittedWork::class);
    }

    public function tempWork()
    {
        return $this->hasMany(TempWork::class);
    }

    public function workHistory()
    {
        return $this->hasMany(WorkHistory::class);
    }
        /**
     * 創建新的會員帳號
     *
     * @param object $data 要創建的資料
     * @param string $type 要串見的類型(從註冊介面註冊 => member, Google第三方註冊 => google, Facebook第三方註冊 => facebook, Line第三方註冊 => line)
     * @return object 回傳新創建的User資料
     */
    public static function createMemberUser($data, $type)
    {
        $typeRule = ['member', 'line'];
        if (!in_array($type, $typeRule)) return;

            $now = time();
            $password = "{$type}{$now}";

        // 創建新的user，因為是投票，所以讓他為7
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
            'role' => 7,
            'status' => 1,
        ]);

        // 第三方主註冊時更新user的第三方認證欄位
        if ($type !== 'member') {
            $thirdPartyColumn = [
                'line' => 'line_id',
            ][$type];

            $user->update([$thirdPartyColumn => $data->id]);
        }
        Auth::login($user);
        return $user;
    }
}
