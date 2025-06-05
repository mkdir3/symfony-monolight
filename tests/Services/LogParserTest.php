<?php

use PHPUnit\Framework\TestCase;
use TenderPanini\SymfonyMonolight\Services\LogParser;
use TenderPanini\SymfonyMonolight\Model\Log;

class LogParserTest extends TestCase
{
    public function testParseLogFileReturnsLogs(): void
    {
        $logContent = "[2023-10-05T21:34:18+00:00] app.INFO: Starting [] []\n";
        $logContent .= "[2023-10-05T21:34:19+00:00] app.ERROR: Failed {\"foo\":\"bar\"} []\n";
        $file = tempnam(sys_get_temp_dir(), 'log_');
        file_put_contents($file, $logContent);

        $parser = new LogParser();
        $logs = $parser->parseLogFile($file);

        $this->assertCount(2, $logs);
        $this->assertContainsOnlyInstancesOf(Log::class, $logs);

        $first = $logs[0];
        $this->assertSame('2023-10-05T21:34:18+00:00', $first->getTimestamp());
        $this->assertSame('INFO', $first->getLevel());
        $this->assertSame('app', $first->getCategory());
        $this->assertSame('Starting', $first->getMessage());

        $second = $logs[1];
        $this->assertSame(['foo' => 'bar'], $second->getContext());

        unlink($file);
    }

    public function testParseLogFileThrowsWhenFileUnreadable(): void
    {
        $this->expectException(RuntimeException::class);
        $parser = new LogParser();
        $parser->parseLogFile('/non/existent/file.log');
    }
}
