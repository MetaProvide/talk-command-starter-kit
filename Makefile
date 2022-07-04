# This file is licensed under the Affero General Public License version 3 or
# later. See the LICENSE file.

base_directory=$(CURDIR)
app_name=talk_command_starter_kit
build_directory=$(CURDIR)/build
temp_build_directory=$(build_directory)/temp

all: dev-setup lint

release: build-tarball

dev-setup: composer

lint: php-cs

lint-fix: php-cs-fix

# Dependencies
composer:
	composer install --prefer-dist

composer-update:
	composer update --prefer-dist

# PHP CS Fixer
php-cs:
	vendor/bin/php-cs-fixer fix -v --dry-run

php-cs-fix:
	vendor/bin/php-cs-fixer fix -v

build-tarball:
	rm -rf $(build_directory)
	mkdir -p $(temp_build_directory)
	rsync -a \
	--exclude=".git" \
	--exclude=".vscode" \
	--exclude="build" \
	--exclude="vendor" \
	--exclude=".editorconfig" \
	--exclude=".gitignore" \
	--exclude=".php_cs.cache" \
	--exclude=".php-cs-fixer.dist.php" \
	--exclude="composer.json" \
	--exclude="composer.lock" \
	--exclude="Makefile" \
	../$(base_directory)/ $(temp_build_directory)/$(app_name)
	tar czf $(build_directory)/$(app_name).tar.gz \
		-C $(temp_build_directory) $(app_name)
