<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RegistrationInfo
 *
 * @property int $id
 * @property int $user_id
 * @property int $kind
 * @property string $name
 * @property string $id_number
 * @property Carbon $birthday
 * @property int $type
 * @property string $phone
 * @property string $city
 * @property string $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|DeclarationDocument[] $declarationDocuments
 *
 * @package App\Models
 */
class RegistrationInfo extends Model
{
    protected $table = 'registration_infos';
    public static $snakeAttributes = false;

    protected $casts = [
        'user_id' => 'int',
        'kind' => 'int',
        'birthday' => 'datetime',
        'type' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'kind',
        'name',
        'id_number',
        'birthday',
        'type',
        'phone',
        'city',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function declarationDocument()
    {
        return $this->hasMany(DeclarationDocument::class);
    }
}
