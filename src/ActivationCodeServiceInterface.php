<?php

namespace ItDevgroup\LaravelActivationCode;

use ItDevgroup\LaravelActivationCode\Model\ActivationCode;

/**
 * Interface ActivationCodeServiceInterface
 * @package ItDevgroup\LaravelActivationCode
 */
interface ActivationCodeServiceInterface
{
    /**
     * Default ttl for activation codes
     * @type string
     */
    public const DEFAULT_DATE_VARIABLE = '1h';
    /**
     * @type string
     */
    public const DATE_VARIABLE_SIMILAR = [
        '' => 'addSeconds',
        'm' => 'addMinutes',
        'h' => 'addHours',
        'd' => 'addDays',
    ];
    /**
     * Default max attempt get code before remove this code
     * @type int
     */
    public const DEFAULT_MAX_ATTEMPT = 5;
    /**
     * @type int
     */
    public const DEFAULT_CODE_LENGTH = 20;
    /**
     * @type int
     */
    public const GENERATE_CODE_MODE_ALPHABET = 1;
    /**
     * @type int
     */
    public const GENERATE_CODE_MODE_ALPHABET_LOWER = 2;
    /**
     * @type int
     */
    public const GENERATE_CODE_MODE_ALPHABET_UPPER = 3;
    /**
     * @type int
     */
    public const GENERATE_CODE_MODE_NUMBER = 4;
    /**
     * @type int
     */
    public const GENERATE_CODE_MODE_ALL = 5;
    /**
     * @type int
     */
    public const MODE_SMS = 'sms';

    /**
     * @param int|null $generateCodeMode
     * @return ActivationCodeServiceInterface
     */
    public function setGenerateCodeMode(?int $generateCodeMode = null): ActivationCodeServiceInterface;

    /**
     * @param string|null $mode
     * @return ActivationCodeServiceInterface
     */
    public function setMode(?string $mode = null): ActivationCodeServiceInterface;

    /**
     * @param int|null $codeLength
     * @return ActivationCodeServiceInterface
     */
    public function setCodeLength(?int $codeLength): ActivationCodeServiceInterface;

    /**
     * @param int|null $maxAttempt
     * @return ActivationCodeServiceInterface
     */
    public function setMaxAttempt(?int $maxAttempt): ActivationCodeServiceInterface;

    /**
     * @param string|null $codeTTL
     * @return ActivationCodeServiceInterface
     */
    public function setCodeTTL(?string $codeTTL): ActivationCodeServiceInterface;

    /**
     * @param string|null $receiver
     * @param string|null $type
     * @param int|null $id
     * @return ActivationCode
     */
    public function make(?string $receiver, ?string $type, ?int $id = null): ActivationCode;

    /**
     * @return string
     */
    public function generateCode(): string;

    /**
     * @param string|null $receiver
     * @param string|null $code
     * @param string|null $type
     * @param bool $exception
     * @param bool $notCheckAttempt
     * @return ActivationCode|null
     */
    public function get(
        ?string $receiver,
        ?string $code,
        ?string $type,
        bool $exception = true,
        bool $notCheckAttempt = false
    ): ?ActivationCode;

    /**
     * @param string $code
     * @param string $type
     * @param bool $exception
     * @return ActivationCode|null
     * @throws ActivationCodeServiceException
     */
    public function getByCode(
        string $code,
        string $type,
        bool $exception = true
    ): ?ActivationCode;

    /**
     * @param ActivationCode $activationCode
     */
    public function delete(ActivationCode $activationCode): void;

    /**
     * @return void
     */
    public function reset(): void;
}
