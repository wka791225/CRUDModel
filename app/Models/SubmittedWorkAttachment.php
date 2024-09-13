<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubmittedWorkAttachment
 *
 * @property int $id
 * @property int $submitted_work_id
 * @property int $type
 * @property string $file_name
 * @property string $file_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SubmittedWork $submittedWork
 *
 * @package App\Models
 */
class SubmittedWorkAttachment extends Model
{
    protected $table = 'submitted_work_attachments';
    public static $snakeAttributes = false;

    protected $casts = [
        'submitted_work_id' => 'int',
        'type' => 'int'
    ];

    protected $fillable = [
        'submitted_work_id',
        'type',
        'file_name',
        'file_path'
    ];

    public function submittedWork()
    {
        return $this->belongsTo(SubmittedWork::class);
    }
}
