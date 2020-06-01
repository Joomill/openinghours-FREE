<?php
/**
 *  package: Joomla Opening Hours module
 *  copyright: Copyright (c) 2020. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

/**
 * Load the Joomill Opening Hours installer
 */
class mod_openinghoursInstallerScript {

	/**
	 * Method to run before an install/update/uninstall method
	 *
	 * @param   string  $type    The type of change (install, update or discover_install).
	 * @param   object  $parent  The class calling this method.
	 *
	 * @return  bool  True on success | False on failure
	 */
	public function preflight($type, $parent)
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)

		// Check if the Joomla version is correct
		$version = new JVersion;

		if (version_compare($version->getShortVersion(), '3.0', '<') == '-1')
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(Text::sprintf('You are running Joomla version %s, This version requires at least Joomla version 3.0. Installation cannot continue. Go to our website and download the latest Joomla 2.5 release.', $version->getShortVersion()), 'error');

			return false;
		}

		// Check if the PHP version is correct
		if (version_compare(phpversion(), '5.3', '<') == '-1')
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(Text::sprintf('You are running PHP version %s, The Opening Hours module requires at least PHP version 5.3. Installation cannot continue. You can still use Opening Hours v3.2.1 on this server.', phpversion()), 'error');

			return false;
		}

		return true;
	}

}

