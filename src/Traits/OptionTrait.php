<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\Traits;

use Symfony\Component\Console\Input\InputOption;

trait OptionTrait
{
    protected function configureOptions(): void
    {
        $this->addOption('level', null, InputOption::VALUE_OPTIONAL, 'Filter logs by level');
        $this->addOption('date', null, InputOption::VALUE_OPTIONAL, 'Display logs of a specific date');
        $this->addOption('since', null, InputOption::VALUE_OPTIONAL, 'Display logs since a specific date');
        $this->addOption('until', null, InputOption::VALUE_OPTIONAL, 'Display logs until a specific date');
        $this->addOption('message', null, InputOption::VALUE_OPTIONAL, 'Filter logs containing a specific text pattern');
        $this->addOption('tail', null, InputOption::VALUE_NONE, 'Tail the log output in real-time');
        $this->addOption('lines', null, InputOption::VALUE_OPTIONAL, 'Number of log lines to display');
        $this->addOption('json', null, InputOption::VALUE_NONE, 'Output logs in JSON format');
    }
}