<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\Services;

use TenderPanini\SymfonyMonolight\Model\Log;

class LogParser
{
    /** @return Log[] $logs */
    public function parseLogFile(string $filePath): array
    {
        $logs   = [];
        $lines  = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines === false) {
            throw new \RuntimeException("Could not read log file: {$filePath}");
        }

        foreach ($lines as $line) {
            $pattern = '/^\[(?P<timestamp>.*)\] (?P<category>.*)\.(?P<level>\w+): (?P<message>[^\[]+)( \[(?P<context>[^\]].*)\])? \[\]$/';

            if (preg_match($pattern, $line, $matches)) {
                $context = isset($matches['context']) ? json_decode($matches['context'], true, JSON_THROW_ON_ERROR) ?? [] : [];

                $logs[] = new Log(
                    timestamp: $matches['timestamp'],
                    level: $matches['level'],
                    category: $matches['category'],
                    message: $matches['message'],
                    context: $context
                );
            }
        }

        return $logs;
    }
}
