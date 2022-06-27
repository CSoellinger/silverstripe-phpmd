# PHPMD rules for SilverStripe

[![Build Status](https://app.travis-ci.com/CSoellinger/silverstripe-phpmd.svg?branch=main)](https://app.travis-ci.com/CSoellinger/silverstripe-phpmd)

This repo was heavily inspired and forked from https://github.com/helpfulrobot/chillu-phpmd-silverstripe

Extended mess detection rules from phpmd for SilverStripe (http://silverstripe.org) applications.

The rules make it easier for developers to comply with the SilverStripe Coding Conventions: https://docs.silverstripe.org/en/4/contributing/php_coding_conventions/

It uses mostly standard PHPMD rules, with a few notable changes:

* Excluded `CleanCode/StaticAccess`: Static access is a "feature" in SilverStripe
* Replaced `CamelCaseMethodName` with `CamelCaseInstanceMethodName`: Static methods with named snake case a "feature"
  in SilverStripe.
* Replaced `CamelCasePropertyName` with `CamelCaseInstancePropertyName`: Static properties with snake case are a
  "feature" in SilverStripe.
* Replaced `CamelCaseVariableName` with `CamelCaseInstanceVariableName`: Static variable calls with snake case are a
  "feature" in SilverStripe.
* Replaced `UnusedPrivateField` with `UnusedInstancePrivateField`: Check to instance fields only. Unused private
  statics are by design in SilverStripe.
* Fixed short name variable rule for $db, $id und $i
* Added class name check cause by SilverStripe design class name should match the file name

## Installation

Global installation for usage across projects:

	composer global require csoellinger/silverstripe-phpmd

Local installation on an existing project:

	composer require --dev csoellinger/silverstripe-phpmd

## Usage

For global installations:

	~/.composer/vendor/bin/phpmd <my-project> text ~/.composer/vendor/csoellinger/silverstripe-phpmd/silverstripe-ruleset.xml

For local installations:

	vendor/bin/phpmd <my-project> text vendor/csoellinger/silverstripe-phpmd/silverstripe-ruleset.xml

For more details, refer to the [command line usage](http://phpmd.org/documentation/index.html) guides on phpmd.org.
