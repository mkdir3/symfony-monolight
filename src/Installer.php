<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight;

class Installer
{
    public static function postInstall(): void
    {
        echo "Remember to register the Symfony Monolight bundle in your config/bundles.php:\n";
        echo "TenderPanini\\SymfonyMonolight\\SymfonyMonolight::class => ['all' => true],\n";
    }
}