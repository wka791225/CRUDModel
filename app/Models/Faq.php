<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Faq
 *
 * @property int $id
 * @property string $title
 * @property string|null $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Faq extends Model
{
    protected $table = 'faqs';
    public static $snakeAttributes = false;

    protected $fillable = [
        'title',
        'content'
    ];
}
