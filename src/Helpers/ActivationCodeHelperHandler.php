<?php

namespace ItDevgroup\LaravelActivationCode\Helpers;

use ItDevgroup\LaravelActivationCode\ActivationCodeServiceException;
use ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface;
use ItDevgroup\LaravelActivationCode\Model\ActivationCode;

/**
 * Class ActivationCodeHelperHandler
 * @package ItDevgroup\LaravelActivationCode\Helpers
 */
class ActivationCodeHelperHandler
{
    /**
     * @var ActivationCodeServiceInterface
     */
    private ActivationCodeServiceInterface $activationCodeService;

    /**
     * @param ActivationCodeServiceInterface $activationCodeService
     */
    public function __construct(
        ActivationCodeServiceInterface $activationCodeService
    ) {
        $this->activationCodeService = $activationCodeService;
    }

    /**
     * @param int|null $generateCodeMode
     * @return ActivationCodeServiceInterface
     */
    public function setGenerateCodeMode(?int $generateCodeMode = null): ActivationCodeServiceInterface
    {
        return $this->activationCodeService->setGenerateCodeMode($generateCodeMode);
    }

    /**
     * @param string|null $mode
     * @return ActivationCodeServiceInterface
     */
    public function setMode(?string $mode = null): ActivationCodeServiceInterface
    {
        return $this->activationCodeService->setMode($mode);
    }

    /**
     * @param int|null $codeLength
     * @return ActivationCodeServiceInterface
     */
    public function setCodeLength(?int $codeLength): ActivationCodeServiceInterface
    {
        return $this->activationCodeService->setCodeLength($codeLength);
    }

    /**
     * @param int|null $maxAttempt
     * @return ActivationCodeServiceInterface
     */
    public function setMaxAttempt(?int $maxAttempt): ActivationCodeServiceInterface
    {
        return $this->activationCodeService->setMaxAttempt($maxAttempt);
    }

    /**
     * @param string|null $codeTTL
     * @return ActivationCodeServiceInterface
     */
    public function setCodeTTL(?string $codeTTL): ActivationCodeServiceInterface
    {
        return $this->activationCodeService->setCodeTTL($codeTTL);
    }

    /**
     * @param string|null $receiver
     * @param string|null $type
     * @param int|null $id
     * @return ActivationCode
     */
    public function make(?string $receiver, ?string $type, ?int $id = null): ActivationCode
    {
        return $this->activationCodeService->make($receiver, $type, $id);
    }

    /**
     * @return string
     */
    public function generateCode(): string
    {
        return $this->activationCodeService->generateCode();
    }

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
    ): ?ActivationCode {
        return $this->activationCodeService->get($receiver, $code, $type, $exception, $notCheckAttempt);
    }

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
    ): ?ActivationCode {
        return $this->activationCodeService->getByCode($code, $type, $exception);
    }

    /**
     * @param ActivationCode $activationCode
     */
    public function delete(ActivationCode $activationCode): void
    {
        $this->activationCodeService->delete($activationCode);
    }

    /**
     * @return void
     */
    public function reset(): void
    {
        $this->activationCodeService->reset();
    }
}
