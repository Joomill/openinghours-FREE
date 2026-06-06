# Changelog

All notable changes to the FREE Opening Hours module are documented in this file.

## [6.1.0] - 06-06-2026
- Addition: Rebuilt on the modern namespaced module structure (Joomla 4/5/6) with DI service provider, dispatcher and helper
- Addition: Highlight colour picker (now available in the free version)
- Addition: Upgrade-to-PRO call to action and PRO feature teasers in the module options
- Security: Escape admin-provided parameter values in the module output
- Language: Added upgrade and teaser strings in all 7 languages (de, en, es, fi, fr, it, nl)
- Change: Manifest rebuilt to the Joomill standard and styling loaded through the WebAssetManager
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
