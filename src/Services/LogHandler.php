<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\Services;

use TenderPanini\SymfonyMonolight\Services\LogParser;
use TenderPanini\SymfonyMonolight\Model\Log;

class LogHandler
{
    private string $logDirectory;
    private string $logPattern;

    public function __construct(
        ConfigHandler $configHandler,
        private readonly LogParser $logParser,
    )
    {
        $this->logDirectory = $configHandler->getLogDirectory();
        $this->logPattern   = $configHandler->getLogPattern();
    }

    /**
     * @return Log[]
    */
    public function readAndParseLog(): array
    {
        $logFilePath = $this->logDirectory . '/' . $this->logPattern;

        if (!\file_exists($logFilePath)) {
            throw new \RuntimeException("Log file does not exist: {$logFilePath}");
        }

        return $this->logParser->parseLogFile($logFilePath);
    }
}
