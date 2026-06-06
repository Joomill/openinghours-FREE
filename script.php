<?php
/*
 *  package: Joomla Opening Hours module - FREE Version
 *  copyright: Copyright (c) 2026. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;

/**
 * Joomill Opening Hours (FREE) installer script
 *
 * Handles the installation, update and uninstallation of the FREE Opening Hours
 * module. It checks the minimum requirements and shows an upgrade-to-PRO call to
 * action after installation.
 *
 * @since  6.0.0
 */
class mod_openinghoursInstallerScript
{
	/**
	 * Minimum Joomla version to check.
	 *
	 * @var    string
	 * @since  6.0.0
	 */
	private $minimumJoomlaVersion = '4.0';

	/**
	 * Minimum PHP version to check.
	 *
	 * @var    string
	 * @since  6.0.0
	 */
	private $minimumPHPVersion = JOOMLA_MINIMUM_PHP;

	/**
	 * Function called before extension installation/update/removal procedure commences.
	 *
	 * @param   string            $type    The type of change (install, update or discover_install, not uninstall)
	 * @param   InstallerAdapter  $parent  The class calling this method
	 *
	 * @return  boolean  True on success, false if requirements are not met
	 *
	 * @throws  Exception
	 * @since   6.0.0
	 */
	public function preflight($type, $parent): bool
	{
		if ($type !== 'uninstall') {
			// Check for the minimum PHP version before continuing
			if (!empty($this->minimumPHPVersion) && version_compare(PHP_VERSION, $this->minimumPHPVersion, '<')) {
				Log::add(Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPHPVersion), Log::WARNING, 'jerror');

				return false;
			}

			// Check for the minimum Joomla version before continuing
			if (!empty($this->minimumJoomlaVersion) && version_compare(JVERSION, $this->minimumJoomlaVersion, '<')) {
				Log::add(Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomlaVersion), Log::WARNING, 'jerror');

				return false;
			}
		}

		return true;
	}

	/**
	 * Function called after extension installation/update/removal procedure commences.
	 *
	 * @param   string            $type    The type of change (install, update or discover_install, not uninstall)
	 * @param   InstallerAdapter  $parent  The class calling this method
	 *
	 * @return  boolean  True on success
	 *
	 * @since   6.0.0
	 */
	public function postflight($type, $parent)
	{
		if ($type === 'install' || $type === 'update') {
			echo '<style>a[target="_blank"]::before {display: none;}</style>';
			echo '<div class="mb-3 text-center"><img src="https://www.joomill-extensions.com/images/joomill-logo.png" alt="Joomill Extensions" /></div>';
			echo '<div class="mb-3 text-center"><strong>' . Text::_('MOD_OPENINGHOURS_XML_DESCRIPTION') . '</strong></div>';
			echo '<div class="mb-3 text-center">' . Text::_('MOD_OPENINGHOURS_THANKYOU') . '</div>';

			echo '<h3>' . Text::_('MOD_OPENINGHOURS_INSTALL_QUICKSTART') . ':</h3>';
			echo '<ul>';
			echo '<li><a style="text-decoration: underline;" href="index.php?option=com_modules&view=modules&client_id=0&filter[module]=mod_openinghours" target="_blank">' . Text::_('MOD_OPENINGHOURS_INSTALL_CONFIGURATION') . '</a></li>';
			echo '<li><a style="text-decoration: underline;" href="https://www.joomill-extensions.com/extensions/opening-hours-days-week-closings" target="_blank">' . Text::_('MOD_OPENINGHOURS_INSTALL_NEEDHELP') . '</a></li>';
			echo '</ul>';
			echo '<hr>';
			echo $this->getSocialLinks();
		}

		if ($type === 'uninstall') {
			echo '<style>a[target="_blank"]::before {display: none;}</style>';
			echo '<div class="mb-3 text-center"><img src="https://www.joomill-extensions.com/images/joomill-logo.png" alt="Joomill Extensions" /></div>';
			echo '<br>';
			echo '<h3 class="text-center">' . Text::_('MOD_OPENINGHOURS_THANKYOU') . '</h3>';
			echo '<br>';
			echo $this->getSocialLinks();
		}

		return true;
	}

	/**
	 * Returns the Joomill social media links block.
	 *
	 * @return  string  The social links markup.
	 *
	 * @since   6.0.0
	 */
	private function getSocialLinks(): string
	{
		$html  = '<div class="text-center">' . Text::_('MOD_OPENINGHOURS_FOLLOWME') . ':</div>';
		$html .= '<div class="text-center">';
		$html .= '<a class="m-2" href="https://www.linkedin.com/in/jeroenmoolenschot/" target="_blank"><i class="fa-brands fa-linkedin"></i></a>';
		$html .= '<a class="m-2" href="https://www.facebook.com/Joomill" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>';
		$html .= '<a class="m-2" href="https://www.instagram.com/Joomill" target="_blank"><i class="fa-brands fa-instagram"></i></a>';
		$html .= '<a class="m-2" href="https://bsky.app/profile/joomill.bsky.social" target="_blank"><i class="fa-brands fa-bluesky"></i></a>';
		$html .= '<a class="m-2" href="https://joomla.social/@joomill" target="_blank"><i class="fa-brands fa-mastodon"></i></a>';
		$html .= '<a class="m-2" href="https://www.threads.net/@joomill" target="_blank"><i class="fa-brands fa-threads"></i></a>';
		$html .= '<a class="m-2" href="https://www.twitter.com/Joomill" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>';
		$html .= '<a class="m-2" href="https://community.joomla.org/service-providers-directory/listings/67:joomill.html" target="_blank"><i class="fa-brands fa-joomla"></i></a>';
		$html .= '</div>';

		return $html;
	}
}
