<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\Model;

class Log
{
    private const LEVEL_COLORS = [
        'DEBUG'     => 'gray',
        'INFO'      => 'blue',
        'NOTICE'    => 'yellow',
        'WARNING'   => 'yellow',
        'ERROR'     => 'red',
        'CRITICAL'  => 'red',
        'ALERT'     => 'red',
        'EMERGENCY' => 'red',
    ];

    public function __construct(
        private string $timestamp,
        private string $level,
        private string $category,
        private string $message,
        private mixed $context = [],
        protected string $logfile = '',
    ) {}

    public function getLogfile(): string
    {
        return $this->logfile;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getContext(): mixed
    {
        return $this->context;
    }

    public function getColor(): string
    {
        return self::LEVEL_COLORS[$this->level] ?? 'gray';
    }

    /**
     * @throws \Exception
     */
    public function getReadableDate(string $format = 'Y-m-d H:i:s'): string
    {
        return (new \DateTime($this->timestamp))->format($format);
    }
}
