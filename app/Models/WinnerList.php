<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WinnerList
 *
 * @property int $id
 * @property int|null $ranking
 * @property string|null $title
 * @property string|null $author
 * @property string|null $creative_concept
 * @property string|null $logo_path
 * @property string|null $logo_name
 * @property string|null $logo_a_three_path
 * @property string|null $logo_a_three_name
 * @property string|null $logo_a_three_path_part_two
 * @property string|null $logo_a_three_name_part_two
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class WinnerList extends Model
{
    protected $table = 'winner_lists';
    public static $snakeAttributes = false;

    protected $casts = [
        'ranking' => 'int'
    ];

    protected $fillable = [
        'ranking',
        'title',
        'author',
        'creative_concept',
        'logo_path',
        'logo_name',
        'logo_a_three_path',
        'logo_a_three_name',
        'logo_a_three_path_part_two',
        'logo_a_three_name_part_two',
        'logo_a_three_path_part_three',
        'logo_a_three_name_part_three',
        'votes'
    ];
}
