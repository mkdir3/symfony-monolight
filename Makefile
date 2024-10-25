.PHONY: stan

stan:
	@echo "Running PHPStan"
	php vendor/bin/phpstan analyse -c phpstan.neon

