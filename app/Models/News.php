<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 *
 * @property int $id
 * @property string $title
 * @property Carbon $start_date
 * @property string $content
 * @property string|null $photo_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class News extends Model
{
    protected $table = 'news';
    public static $snakeAttributes = false;

    protected $casts = [
        'start_date' => 'datetime'
    ];

    protected $fillable = [
        'title',
        'start_date',
        'content',
        'photo_path'
    ];
}
