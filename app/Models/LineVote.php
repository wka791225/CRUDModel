<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LineVote
 *
 * @property int $id
 * @property string $line_id
 * @property string $email
 * @property string $name
 * @property int $vote_work_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class LineVote extends Model
{
    protected $table = 'line_votes';
    public static $snakeAttributes = false;

    protected $casts = [
        'vote_work_id' => 'int'
    ];

    protected $fillable = [
        'line_id',
        'email',
        'name',
        'vote_work_id'
    ];
    /**
     * 創建新的會員帳號
     *
     * @param object $data 要創建的資料
     * @param string $type 要串見的類型(從註冊介面註冊 => member, Google第三方註冊 => google, Facebook第三方註冊 => facebook, Line第三方註冊 => line)
     * @return object 回傳新創建的User資料
     */
    public static function createMemberUser($data, $type, $workId = 0)
    {
        $typeRule = ['member', 'line'];
        if (!in_array($type, $typeRule)) return;
        // 如果有workId，就將該workId的票數+1
        if ($workId !== 0) {
            $winnerList = WinnerList::find($workId);
            if (!$winnerList) return;
            $votes = $winnerList->votes + 1;
            $winnerList->update(['votes' => $votes]);
        }
        // 創建新的LineVote，因為是投票
        $line = LineVote::create([
            'name' => $data->name,
            'email' => $data->email,
            'line_id' => $data->id,
            'vote_work_id' => $workId,
        ]);

        return $line;
    }
}
