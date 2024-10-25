<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TenderPanini\SymfonyMonolight\Services\RenderService;
use TenderPanini\SymfonyMonolight\Traits\OptionTrait;


#[AsCommand(
    name: 'monolight:logs',
    description: 'Displays the application logs.',
    hidden: false,
)]
class ShowLogsCommand extends Command
{
    use OptionTrait;

    public function __construct(
        private readonly RenderService $renderService,
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->configureOptions();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->renderService->renderWelcomeMessage($output);
        // TODO: Instead of print logs:
        // TODO: - First LogHandler should read the logs
        // TODO: - Then for each logs pass by the printlog function
        $this->renderService->printLogs($output);
        
        // pcntl_signal(SIGINT, function() use ($output) {
        //     $output->writeln('Exiting...');
        //     //TODO: maybe perform cleanup here
        // });

        // TODO: Treat options
        // TODO: If Tail option is set, set a process
        return Command::SUCCESS;
    }
}
