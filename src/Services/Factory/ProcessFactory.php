<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\Services\Factory;

use Symfony\Component\Process\Process;
use Symfony\Component\Console\Output\OutputInterface;
use TenderPanini\SymfonyMonolight\Services\RenderService;

class ProcessFactory
{
    public function run(string $basePath, OutputInterface $output): void
    {
        $renderer        = new RenderService(output: $output, basePath: $basePath);
        $remainingBuffer = '';
        
        
        
        $process = new Process(['tail', '-F', $basePath]);
        $process->setTimeout(3600);

        $process->run(function ($type, $buffer) use ($output) {
            // Handle the buffer output, e.g., print to the console
            $output->write($buffer);
        });

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
    }
}