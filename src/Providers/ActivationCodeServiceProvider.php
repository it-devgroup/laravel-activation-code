<?php

namespace ItDevgroup\LaravelActivationCode\Providers;

use ItDevgroup\LaravelActivationCode\ActivationCodeService;
use ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface;
use ItDevgroup\LaravelActivationCode\Console\Commands\ActivationCodeCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Class ActivationCodeServiceProvider
 * @package ItDevgroup\LaravelActivationCode\Providers
 */
class ActivationCodeServiceProvider extends ServiceProvider
{
    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadCustomCommands();
        $this->loadCustomConfig();
        $this->loadCustomPublished();
        $this->loadCustomClasses();
        $this->loadCustomLexicon();
    }

    /**
     * @return void
     */
    private function loadCustomCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                ActivationCodeCommand::class
            );
        }
    }

    /**
     * @return void
     */
    private function loadCustomConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/activation_code.php', 'activation_code');
    }

    /**
     * @return void
     */
    private function loadCustomPublished()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../../config' => base_path('config')
                ],
                'config'
            );
        }
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../../migration' => database_path('migrations')
                ],
                'migration'
            );
        }
    }

    /**
     * @return void
     */
    private function loadCustomClasses()
    {
        $this->app->singleton(ActivationCodeServiceInterface::class, ActivationCodeService::class);
    }

    /**
     * @return void
     */
    private function loadCustomLexicon()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'activationCode');
    }
}
