<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\Services;

class ConfigHandler
{
    private string $logDirectory;
    private string $logPattern;

    /**
     * @param array{
     *     default: array{log_directory: string, log_pattern: string},
     *     custom?: array<array{key: string, log_directory: string, log_pattern: string}>,
     *     in_use: string
     * } $config
     */
    public function __construct(array $config)
    {
        if (!isset($config['default']['log_directory'], $config['default']['log_pattern'])) {
            throw new \InvalidArgumentException('Default log configuration is required.');
        }

        if (isset($config['in_use']) && $config['in_use'] !== 'default' && !empty($config['custom'])) {
            foreach ($config['custom'] as $customConfig) {
                if ($customConfig['key'] === $config['in_use']) {
                    $this->logDirectory = $customConfig['log_directory'] ?? $this->logDirectory;
                    $this->logPattern = $customConfig['log_pattern'] ?? $this->logPattern;
                    return;
                }
            }
            throw new \InvalidArgumentException("Custom configuration '{$config['in_use']}' not found.");
        }

        $this->logDirectory = $config['default']['log_directory'];
        $this->logPattern   = $config['default']['log_pattern'];
    }

    public function getLogDirectory(): string
    {
        return $this->logDirectory;
    }

    public function getLogPattern(): string
    {
        return $this->logPattern;
    }
}
