<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubmittedWork
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $concept
 * @property int $votes
 * @property int $work_judge_status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|SubmittedWorkAttachment[] $submittedWorkAttachments
 *
 * @package App\Models
 */
class SubmittedWork extends Model
{
    protected $table = 'submitted_works';
    public static $snakeAttributes = false;

    protected $casts = [
        'user_id' => 'int',
        'votes' => 'int',
        'work_judge_status' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'title',
        'concept',
        'votes',
        'work_judge_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submittedWorkAttachment()
    {
        return $this->hasMany(SubmittedWorkAttachment::class);
    }
}
