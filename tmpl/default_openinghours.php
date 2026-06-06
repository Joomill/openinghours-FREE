<?php
/*
 *  package: Joomla Opening Hours module - FREE Version
 *  copyright: Copyright (c) 2026. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomill\Module\Openinghours\Site\Helper\OpeninghoursHelper;
use Joomla\CMS\Language\Text;

?>

<div class="openinghours">
	<?php foreach ($week as $day) :
		$microdayname = substr($day, 0, 2);

		$todayClass = '';
		if ($params->get('Highlight') == 1 && $day == $today) {
			$highlightColor = htmlspecialchars($params->get('Highlightcolor', '#3990BD'), ENT_QUOTES);
			$todayClass = 'style="font-weight:bold; color:' . $highlightColor . ';"';
		}

		$dayTimes = OpeninghoursHelper::getDayTimes($day, $params);
		$time1 = $dayTimes['time1'];
		?>

        <div class="openinghours-eachday openinghours-<?php echo $microdayname; ?>" <?php echo $todayClass; ?>>
            <div class="openinghours-day" style="text-align:<?php echo htmlspecialchars($params->get('Dayalign'), ENT_QUOTES); ?>;">
				<?php echo Text::_(strtoupper($day)); ?>
            </div>
            <div class="openinghours-time" style="text-align:<?php echo htmlspecialchars($params->get('Timealign'), ENT_QUOTES); ?>;">
				<?php echo $time1; ?>
            </div>
        </div>
	<?php endforeach; ?>
</div>
