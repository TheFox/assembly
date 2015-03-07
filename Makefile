
RM = rm -rf
CHMOD = chmod
MKDIR = mkdir -p
VENDOR = vendor
PHPCS = vendor/bin/phpcs
PHPCS_STANDARD = vendor/thefox/phpcsrs/Standards/TheFox
PHPCS_REPORT = --report=full --report-width=160
PHPCS_SOURCE = src tests
PHPUNIT = vendor/bin/phpunit
COMPOSER = ./composer.phar
COMPOSER_DEV ?= 


.PHONY: all install update test test_phpcs test_phpunit test_phpunit_cc phpcbf_run clean clean_all

all: install test

install: $(VENDOR)

update: $(COMPOSER)
	$(COMPOSER) selfupdate
	$(COMPOSER) update

test: test_phpcs test_phpunit

test_phpcs: $(PHPCS) $(PHPCS_STANDARD)
	$(PHPCS) -v -s -p $(PHPCS_REPORT) --standard=$(PHPCS_STANDARD) $(PHPCS_SOURCE)

test_phpunit: $(PHPUNIT) phpunit.xml
	TEST=true $(PHPUNIT) $(PHPUNIT_COVERAGE_HTML) $(PHPUNIT_COVERAGE_XML) $(PHPUNIT_COVERAGE_CLOVER)

test_phpunit_cc: build
	$(MAKE) test_phpunit PHPUNIT_COVERAGE_HTML="--coverage-html build/report"

phpcbf_run:
	$(PHPCBF) --standard=$(PHPCS_STANDARD) $(PHPCS_SOURCE)

clean:
	$(RM) composer.lock $(COMPOSER)
	$(RM) vendor/*
	$(RM) vendor

clean_all: clean

$(VENDOR): $(COMPOSER)
	$(COMPOSER) install $(COMPOSER_PREFER_SOURCE) --no-interaction $(COMPOSER_DEV)

$(COMPOSER):
	curl -sS https://getcomposer.org/installer | php
	$(CHMOD) a+rx-w,u+w $(COMPOSER)

$(PHPCS): $(VENDOR)

$(PHPUNIT): $(VENDOR)

build:
	$(MKDIR) build
	$(MKDIR) build/logs
	$(CHMOD) a-rwx,u+rwx build
