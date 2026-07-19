<?php

/**
 * Opening Hours
 *
 * @copyright   Copyright (c) 2026 Jeroen Moolenschot | Joomill
 * @license     GNU General Public License version 3 or later; see LICENSE
 * @link        https://www.joomill-extensions.com
 */

namespace Joomill\Module\Openinghours\Site\Helper;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Helper for mod_openinghours (FREE)
 *
 * Provides the calculations used by the FREE Opening Hours module: building the
 * week order, formatting regular opening hours and resolving the current time
 * for the configured time zone. Exceptional hours, current open/closed status
 * and related features live in the PRO version only.
 *
 * @since  6.0.0
 */
class OpeninghoursHelper
{
	/**
	 * Gets the week structure based on the configuration parameters.
	 *
	 * @param   \Joomla\Registry\Registry  $params  The module parameters
	 *
	 * @return  array  Array of weekday names
	 *
	 * @since   6.0.0
	 */
	public function getWeek($params)
	{
		$week = [];

		if ($params->get('Weekstart') == 1) {
			$week = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
		}
		if ($params->get('Weekstart') == 3) {
			$week = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
		}
		if ($params->get('Weekstart') == 2 || empty($week)) {
			$week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
		}

		return $week;
	}

	/**
	 * Determines the weekday offset based on the configuration parameters.
	 *
	 * @param   \Joomla\Registry\Registry  $params  The module parameters
	 * @param   \DateTime                  $now     Current date and time
	 *
	 * @return  integer  The weekday offset
	 *
	 * @since   6.0.0
	 */
	public function getWeekday($params, $now)
	{
		$weekday = (int) $now->format('w');

		if ($params->get('Weekstart') == 1) {
			return 0 - $weekday;
		}

		if ($params->get('Weekstart') == 3) {
			return $weekday == 6 ? -6 + $weekday : -$weekday - 1;
		}

		// Week starts on Monday (default)
		return $weekday == 0 ? -6 + $weekday : 1 - $weekday;
	}

	/**
	 * Formats an opening hours time string according to the time format.
	 *
	 * Handles ranges in the format "HH:MM-HH:MM" and converts them to the time
	 * format configured for the module. Plain text values (e.g. "CLOSED") are
	 * passed through the translator so they can be localised.
	 *
	 * @param   string                     $openinghours  The opening hours string to format
	 * @param   string                     $day           The day name (used in error messages)
	 * @param   \Joomla\Registry\Registry  $params        The module parameters
	 *
	 * @return  string  The formatted opening hours string
	 *
	 * @since   6.0.0
	 */
	public function formatTime($openinghours, $day, $params)
	{
		if (empty($openinghours) || strpos($openinghours, '-') === false) {
			return Text::_($openinghours);
		}

		$openinghours = str_replace(' ', '', $openinghours);
		[$open, $close] = explode('-', $openinghours, 2);

		if (preg_match('/^\d{2}:\d{2}$/', $open) && preg_match('/^\d{2}:\d{2}$/', $close)) {
			$open  = date_create_from_format('H:i', $open);
			$close = date_create_from_format('H:i', $close);

			if ($open && $close) {
				return $open->format($params->get('Timeformat')) . ' - ' . $close->format($params->get('Timeformat'));
			}
		}

		Factory::getApplication()->enqueueMessage(
			Text::_('MOD_OPENINGHOURS') . ': ' . Text::sprintf('MOD_OPENINGHOURS_INVALID_TIME_FORMAT', Text::_($day)),
			'warning'
		);

		return Text::_('ERROR');
	}

	/**
	 * Gets the formatted regular opening times for a specific day.
	 *
	 * @param   string                     $day     The day name (e.g. 'Monday')
	 * @param   \Joomla\Registry\Registry  $params  The module parameters
	 *
	 * @return  array  Array containing the formatted opening times
	 *
	 * @since   6.0.0
	 */
	public function getDayTimes($day, $params)
	{
		return [
			'time1' => $this->formatTime($params->get($day . 'times1', ''), $day, $params),
		];
	}

	/**
	 * Gets the current date time object for the configured time zone.
	 *
	 * @param   \Joomla\Registry\Registry  $params  The module parameters
	 *
	 * @return  \DateTime  Current date time object
	 *
	 * @since   6.0.0
	 */
	public function getCurrentDateTime($params)
	{
		return new \DateTime('now', new \DateTimeZone($params->get('Timezone')));
	}
}
