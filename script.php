<?php
/*
 *  package: Joomla Opening Hours module - FREE Version
 *  copyright: Copyright (c) 2023. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Table\Table;

// No direct access.
defined('_JEXEC') or die;

/**
 * Load the Joomill Opening Hours installer
 */
class mod_openinghoursInstallerScript
{
    /**
     * Minimum Joomla version to check
     *
     * @var    string
     * @since  4.0.0
     */
    private $minimumJoomlaVersion = '4.0';

    /**
     * Minimum PHP version to check
     *
     * @var    string
     * @since  4.0.0
     */
    private $minimumPHPVersion = JOOMLA_MINIMUM_PHP;


    /**
     * Function called before extension installation/update/removal procedure commences
     *
     * @param string $type The type of change (install, update or discover_install, not uninstall)
     * @param InstallerAdapter $parent The class calling this method
     * @return  boolean  True on success
     * @throws Exception
     * @since  4.0.0
     */
    public function preflight($type, $parent): bool
    {
        if ($type !== 'uninstall') {
            // Check for the minimum PHP version before continuing
            if (!empty($this->minimumPHPVersion) && version_compare(PHP_VERSION, $this->minimumPHPVersion, '<')) {
                Log::add(
                    Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPHPVersion),
                    Log::WARNING,
                    'jerror'
                );
                return false;
            }
            // Check for the minimum Joomla version before continuing
            if (!empty($this->minimumJoomlaVersion) && version_compare(JVERSION, $this->minimumJoomlaVersion, '<')) {
                Log::add(
                    Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomlaVersion),
                    Log::WARNING,
                    'jerror'
                );
                return false;
            }
        }
        return true;
    }

    public function postflight($type, $parent)
    {
        $this->installUpdatePlugin($parent);
    }

    private function installUpdatePlugin($parent)
    {
        $extension = Table::getInstance('extension');
        $plugin = PluginHelper::getPlugin('installer', 'openinghours');
        if ($plugin) {
            $inst = new JInstaller();
            $inst->uninstall('plugin', $plugin->id);
        }
    }

}




