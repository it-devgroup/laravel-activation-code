<?php

namespace ItDevgroup\LaravelActivationCode\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ActivationCode
 * @package App\Domain\ActivationCode
 * @property-read int $id
 * @property string $receiver
 * @property string $code
 * @property string $type
 * @property int $record_id
 * @property int $attempt
 * @property Carbon $expires_at
 * @property Carbon $created_at
 */
class ActivationCode extends Model
{
    /**
     * @type string
     */
    public const UPDATED_AT = null;

    /**
     * @var string
     */
    protected $table = 'activation_codes';
    /**
     * @var array
     */
    protected $dates = [
        'expires_at',
        'created_at',
    ];
    /**
     * @var array
     */
    protected $casts = [
        'record_id' => 'integer',
        'attempt' => 'integer',
    ];
}
