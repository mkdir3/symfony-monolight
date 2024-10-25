# Symfony Monolight Bundle Setup

This guide walks you through the setup process for the Symfony Monolight bundle in your Symfony project.

## Step 1: Installation

First, install the bundle using Composer:

```bash
composer require tenderpanini/symfony-monolight
```

## Step 2: Bundle Registration

```php
// config/bundles.php

return [
    // ...
    TenderPanini\SymfonyMonolight\SymfonyMonolight::class => ['all' => true],
];
```
## Step 3: Configuration

Create a configuration file for the bundle:

1. **Create a New Configuration File**:
   Create a new file named `symfony_monolight.yaml` in the `config/packages` directory of your Symfony project.

2. **Default Configuration**:
   Add the following default configuration to the file:

   ```yaml
   # config/packages/symfony_monolight.yaml

   symfony_monolight:
     default:
       key: 'default'
       log_directory: '%kernel.logs_dir%'
       log_pattern: 'dev.log'
     custom:
       - key: 'custom1'
         log_directory: '%kernel.logs_dir%/custom1'
         log_pattern: 'custom1.log'
       - key: 'custom2'
         log_directory: '%kernel.logs_dir%/custom2'
         log_pattern: 'custom2.log'
     in_use: 'default'
     ```

3. **Customize as needed**
    Customize the `custom` configurations as needed for your project and set the `in_use` value to the desired configuration key.

## Step 4: Clear the Cache
    After setting up the configuration, clear the Symfony cache:

    ```bash
    php bin/console cache:clear
    ```

## Step 5: Usage
    Now you can use the Symfony Monolight bundle in your project. For example, to read logs:

    ```bash
    php bin/console monolight logs
    ```
