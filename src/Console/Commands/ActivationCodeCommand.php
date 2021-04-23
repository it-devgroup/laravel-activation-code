<?php

namespace ItDevgroup\LaravelActivationCode\Console\Commands;

use ItDevgroup\LaravelActivationCode\Providers\ActivationCodeServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

/**
 * Class ActivationCodeCommand
 * @package ItDevgroup\LaravelActivationCode\Console\Commands
 */
class ActivationCodeCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'activation:code:publish {--tag=* : Tag for published}';
    /**
     * @var string
     */
    protected $description = 'Publish files from activation code';
    /**
     * @var array
     */
    private array $files = [];
    /**
     * @var array
     */
    private array $fileTags = [
        'config',
        'migration',
    ];

    /**
     * @return void
     */
    public function handle()
    {
        $option = is_array($this->option('tag')) && !empty($this->option('tag')) ? $this->option('tag')[0] : '';

        $this->parsePublishedFiles();

        switch ($option) {
            case 'config':
                $this->copyConfig();
                break;
            case 'migration':
                $this->copyMigration();
                break;
            default:
                $this->error('Not selected tag');
                break;
        }
    }

    /**
     * @return void
     */
    private function parsePublishedFiles(): void
    {
        $index = 0;
        foreach (ActivationCodeServiceProvider::pathsToPublish(ActivationCodeServiceProvider::class) as $k => $v) {
            $this->files[$this->fileTags[$index]] = [
                'from' => $k,
                'to' => $v,
            ];
            $index++;
        }
    }

    /**
     * @return void
     */
    private function copyConfig(): void
    {
        $this->copyFiles($this->files['config']['from'], $this->files['config']['to']);
    }

    /**
     * @return void
     */
    private function copyMigration(): void
    {
        $this->copyFiles($this->files['migration']['from'], $this->files['migration']['to']);
    }

    /**
     * @param string $from
     * @param string $to
     */
    private function copyFiles(string $from, string $to): void
    {
        if (!file_exists($to)) {
            mkdir($to, 0755, true);
        }
        $from = rtrim($from, '/') . '/';
        $to = rtrim($to, '/') . '/';
        foreach (scandir($from) as $file) {
            if (!is_file($from . $file)) {
                continue;
            }

            $path = strtr(
                $to . $file,
                [
                    base_path() => ''
                ]
            );

            if (file_exists($to . $file)) {
                $this->info(
                    sprintf(
                        'File "%s" skipped',
                        $path
                    )
                );
                continue;
            }

            copy(
                $from . $file,
                $to . $file
            );

            $content = file_get_contents($to . $file);
            $content = strtr($content, ['{{TABLE_NAME}}' => Config::get('activation_code.table')]);
            file_put_contents($to . $file, $content);

            $this->info(
                sprintf(
                    'File "%s" copied',
                    $path
                )
            );
        }
    }
}
