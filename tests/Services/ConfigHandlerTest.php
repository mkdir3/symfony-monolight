<?php

use PHPUnit\Framework\TestCase;
use TenderPanini\SymfonyMonolight\Services\ConfigHandler;

class ConfigHandlerTest extends TestCase
{
    public function testUsesDefaultConfiguration(): void
    {
        $config = [
            'default' => ['log_directory' => '/var/log', 'log_pattern' => 'app.log'],
            'in_use' => 'default',
        ];

        $handler = new ConfigHandler($config);

        $this->assertSame('/var/log', $handler->getLogDirectory());
        $this->assertSame('app.log', $handler->getLogPattern());
    }

    public function testUsesCustomConfiguration(): void
    {
        $config = [
            'default' => ['log_directory' => '/var/log', 'log_pattern' => 'app.log'],
            'custom' => [
                ['key' => 'custom', 'log_directory' => '/tmp', 'log_pattern' => 'custom.log'],
            ],
            'in_use' => 'custom',
        ];

        $handler = new ConfigHandler($config);

        $this->assertSame('/tmp', $handler->getLogDirectory());
        $this->assertSame('custom.log', $handler->getLogPattern());
    }

    public function testThrowsWhenCustomConfigurationNotFound(): void
    {
        $config = [
            'default' => ['log_directory' => '/var/log', 'log_pattern' => 'app.log'],
            'custom' => [],
            'in_use' => 'missing',
        ];

        $this->expectException(InvalidArgumentException::class);
        new ConfigHandler($config);
    }

    public function testThrowsWhenDefaultMissing(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ConfigHandler([]);
    }
}
