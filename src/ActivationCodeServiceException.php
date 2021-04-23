<?php

namespace ItDevgroup\LaravelActivationCode;

use Exception;
use Illuminate\Support\Facades\Lang;

/**
 * Class ActivationCodeServiceException
 * @package ItDevgroup\LaravelActivationCode
 */
class ActivationCodeServiceException extends Exception
{
    /**
     * @return self
     */
    public static function notFound(): self
    {
        return new self(Lang::get('activationCode::activation_code.not_found'));
    }

    /**
     * @param int $attempt
     * @param int $maxAttempt
     * @return self
     */
    public static function notValidCode(int $attempt, int $maxAttempt): self
    {
        return new self(
            Lang::get(
                'activationCode::activation_code.not_valid_code',
                [
                    'attemp' => ($maxAttempt - $attempt)
                ]
            )
        );
    }

    /**
     * @return self
     */
    public static function notValid(): self
    {
        return new self(
            Lang::get(
                'activationCode::activation_code.not_valid'
            )
        );
    }

    /**
     * @param string $getMessage
     * @return static
     */
    public static function message(string $getMessage): self
    {
        return new self($getMessage);
    }
}
