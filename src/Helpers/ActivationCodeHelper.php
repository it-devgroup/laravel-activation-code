<?php

namespace ItDevgroup\LaravelActivationCode\Helpers;

use Illuminate\Support\Facades\Facade;
use ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface;
use ItDevgroup\LaravelActivationCode\Model\ActivationCode;

/**
 * Class ActivationCodeHelper
 * @package ItDevgroup\LaravelActivationCode\Helpers
 * @method static ActivationCodeServiceInterface setGenerateCodeMode(?int $generateCodeMode = null)
 * @method static ActivationCodeServiceInterface setMode(?string $mode = null)
 * @method static ActivationCodeServiceInterface setCodeLength(?int $codeLength)
 * @method static ActivationCodeServiceInterface setMaxAttempt(?int $maxAttempt)
 * @method static ActivationCodeServiceInterface setCodeTTL(?string $codeTTL)
 * @method static ActivationCode make(?string $receiver, ?string $type, ?int $id = null)
 * @method static string generateCode()
 * @method static ActivationCode|null get(?string $receiver, ?string $code, ?string $type, bool $exception = true, bool $notCheckAttempt = false)
 * @method static ActivationCode|null getByCode(string $code, string $type, bool $exception = true)
 * @method static void delete(ActivationCode $activationCode)
 * @method static void reset()
 */
class ActivationCodeHelper extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ActivationCodeHelperHandler::class;
    }
}
