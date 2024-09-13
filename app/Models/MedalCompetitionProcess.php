<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MedalCompetitionProcess
 *
 * @property int $id
 * @property string $step
 * @property string $title
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MedalCompetitionProcess extends Model
{
    protected $table = 'medal_competition_processes';
    public static $snakeAttributes = false;

    protected $fillable = [
        'step',
        'title',
        'content'
    ];
}
