# Changelog

All notable changes to the FREE Opening Hours module are documented in this file.

## TODO
- Layout default optie ziet er anders uit.
- Addition: Basic JSON-LD structured data (OpeningHoursSpecification) for the regular weekly hours; rich LocalBusiness data and special/exceptional hours stay PRO teasers

## [6.2.0] - UNRELEASED
- Change: Rebuilt the installer script to the Joomill standard (InstallerScriptInterface, typed signatures, install language safety net and error logging)
- Change: Helper now resolved through the module HelperFactory with instance methods instead of static calls; layout data prepared in the dispatcher

## [6.1.0] - 06-06-2026
- Addition: Module help button now links to the Joomill documentation page instead of the generic Joomla help
- Addition: Rebuilt on the modern namespaced module structure (Joomla 5/6) with DI service provider, dispatcher and helper
- Addition: Highlight colour picker (now available in the free version)
- Addition: Upgrade-to-PRO call to action and PRO feature teasers in the module options
- Security: Escape admin-provided parameter values in the module output
- Language: Added upgrade and teaser strings in all 7 languages (de, en, es, fi, fr, it, nl)
- Language: Added the missing Font and Font Size labels and descriptions in all 7 languages
- Change: Manifest rebuilt to the Joomill standard and styling loaded through the WebAssetManager
- Change: Moved the "Show Footer?" option to the Advanced tab (on by default, can be turned off)
- Fix: Hide the template's external-link icon on the credit link and PRO upgrade badges
- Fix: Removed the obsolete JInstaller call that crashed on Joomla 5/6
- Remove: Legacy flat entry point, in-template stylesheet and elements/ field

## [4.0.1] - 11-04-2023
- Fix: Issue with PHP errors/warnings on PHP 8.1
- Fix: Changelog and update URLs

## [4.0.0] - 09-08-2021
- Change: Release for Joomla 4
- Change: Configuration fields optimised for Joomla 4
- Addition: Uninstall installer plugin on update
- Addition: Joomla 4 download key feature
- Remove: Installer plugin

## [3.6.0] - 01-06-2020
- Change: Compatible with Joomla 4 BETA
