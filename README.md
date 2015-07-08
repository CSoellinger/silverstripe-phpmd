# PHPMD rules for SilverStripe

[![Build Status](https://travis-ci.org/chillu/phpmd-silverstripe.svg)](https://travis-ci.org/chillu/phpmd-silverstripe)

Extended mess detection rules from phpmd for [SilverStripe](http://silverstripe.org) applications.
The rules make it easier for developers to comply with the
[SilverStripe Coding Conventions](http://docs.silverstripe.org/en/3.3/getting_started/coding_conventions/).
It uses mostly standard PHPMD rules, with a few notable changes:

 * Replaced `UnusedPrivateField` with `UnusedInstancePrivateField` rule, to check to instance fields only.
   Unused private statics are by design in SilverStripe.
 * Replaced `CamelCasePropertyName` with `CamelCaseInstancePropertyName` rule.
   Static properties in SilverStripe are snake cased.
 * Removed inflexible checks around camelCase naming conventions

## Installation

Global installation for usage across projects:

	composer global require --prefer-dist chillu/phpmd-silverstripe

Local installation on an existing project:

	composer require chillu/phpmd-silverstripe

## Usage

For global installations:

	~/.composer/vendor/bin/phpmd <my-project> text ~/.composer/vendor/chillu/phpmd-silverstripe/Rulesets/all.xml

For local installations:

	vendor/bin/phpmd <my-project> text vendor/chillu/phpmd-silverstripe/Rulesets/all.xml

For more details, refer to the [command line usage](http://phpmd.org/documentation/index.html) guides on phpmd.org.