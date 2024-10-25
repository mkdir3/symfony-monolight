<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\Services;

use Symfony\Component\Console\Output\OutputInterface;
use function Termwind\render;
use function Termwind\renderUsing;

class RenderService
{
    public function __construct(
        private readonly LogHandler $logHandler,
        protected OutputInterface $output,
        protected string $basePath,
    ) {}

    public function renderWelcomeMessage(OutputInterface $output): void
    {
        renderUsing(renderer: $output);
        render(<<<HTML
            <div class="my-1">
                <hr class="mx-2">
                <div class="mx-2 w-full text-center">
                    <span class="text-gray">Welcome to Symfony Monolight 🌟</span>
                </div>
                <div class="w-full text-center">
                    <span class="">Enhancing your Symfony logging experience.</span>
                </div>
                <div class="max-w-150 mx-2 mt-1 flex justify-between">
                    <span class="text-gray">
                        <span class="text-gray">Efficient log management and display</span>
                    </span>
                    <span class="text-gray">
                        <span class="text-gray">Customizable log paths and patterns</span>
                    </span>
                </div>
            </div>
        HTML,);
    }

    public function printLogs(): void
    {
        $logs = $this->logHandler->readAndParseLog();
        
        foreach ($logs as $log) {
            $level = $log->getLevel();
            $color = $log->getColor();
            $context = $log->getContext();
            $category = $log->getCategory();
            // $message = $this->truncateMessage($messageLogged->message());
            $date = $log->getReadableDate();

            // $fileHtml = $this->fileHtml($messageLogged->file(), $classOrType);
            $message = $log->getMessage();
            // $optionsHtml = $this->optionsHtml($messageLogged);
            // $traceHtml = $this->traceHtml($messageLogged);

            $messageClasses = $this->output->isVerbose() ? '' : 'truncate';

            $endingTopRight = $this->output->isVerbose() ? '' : '┐';
            $endingMiddle = $this->output->isVerbose() ? '' : '│';
            $endingBottomRight = $this->output->isVerbose() ? '' : '┘';

            renderUsing(renderer: $this->output);
            render(html: <<<HTML
                <div class="max-w-150">
                    <div class="flex">
                        <div>
                            <span class="mr-1 text-gray">┌</span>
                            <span class="text-green font-bold">$date</span>
                            <span class="px-1 text-$color font-bold">$level</span>
                        </div>
                        <span class="flex-1 content-repeat-[─] text-gray"></span>
                        <span class="text-gray">
                            <!-- fileHtml -->$category
                            <span class="text-gray">$endingTopRight</span>
                        </span>
                    </div>
                    <div class="flex $messageClasses">
                        <span>
                            <span class="mr-1 text-gray">│</span>
                            $message
                        </span>
                        <span class="flex-1"></span>
                        <span class="flex-1 text-gray text-right">$endingMiddle</span>
                    </div>
                    <!-- traceHtml -->
                    <div class="flex text-gray">
                        <span>└</span>
                        <span class="mr-1 flex-1 content-repeat-[─]"></span>
                        <!-- optionsHtml or context -->
                        <span class="ml-1">$endingBottomRight</span>
                    </div>
                </div>
            HTML);
        }
    }
}
