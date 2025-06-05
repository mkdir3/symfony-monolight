# Symfony Monolight Bundle

Symfony Monolight is a Symfony bundle that simplifies the management and display of application logs. It provides a console command to view logs from different directories configured in your project.

## Installation

Follow these steps to add the bundle to your project:

1. **Install with Composer**

   ```bash
   composer require tenderpanini/symfony-monolight
   ```

2. **Register the Bundle**

   Add the bundle class to your `config/bundles.php` file:

   ```php
   // config/bundles.php
   return [
       // ...
       TenderPanini\SymfonyMonolight\SymfonyMonolight::class => ['all' => true],
   ];
   ```

3. **Configure**

   Create a new file named `symfony_monolight.yaml` inside `config/packages` and add the default configuration:

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

   Adjust the `custom` entries as needed and set `in_use` to the configuration key you wish to use.

4. **Clear the Cache**

   ```bash
   php bin/console cache:clear
   ```

## Usage

Once installed and configured, you can read your logs using the provided command:

```bash
php bin/console monolight:logs
```

The command prints a formatted list of log entries from the directory configured in `symfony_monolight.yaml`.

## License

This project is released under the MIT License. See the [LICENSE](LICENSE) file for details.
