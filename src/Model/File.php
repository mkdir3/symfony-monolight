<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\Model;

class File
{
    protected const TTL = 3600;

    public function __construct(protected string $file) {}

    public function create(): void
    {
        if (!$this->exists()) {
            $directory = dirname($this->file);

            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            touch($this->file);
        }
    }

    public function exists(): bool
    {
        return file_exists($this->file);
    }

    public function destroy(): void
    {
        if ($this->exists()) {
            unlink($this->file);
        }
    }

    public function isStale(): bool
    {
        return time() - filemtime($this->file) > static::TTL;
    }

    public function __toString(): string
    {
        return $this->file;
    }
}