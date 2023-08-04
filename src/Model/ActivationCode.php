<?php

namespace ItDevgroup\LaravelActivationCode\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * Class ActivationCode
 * @package ItDevgroup\LaravelActivationCode\Model
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

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = Config::get('activation_code.table');

        parent::__construct($attributes);
    }
}
