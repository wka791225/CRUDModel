<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Smm
 *
 * @property int $id
 * @property string $live_stream_link
 * @property string $fb_link
 * @property string $ig_link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Smm extends Model
{
    protected $table = 'smms';
    public static $snakeAttributes = false;

    protected $fillable = [
        'live_stream_link',
        'fb_link',
        'ig_link'
    ];
}
