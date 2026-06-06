<?php
/*
 *  package: Joomla Opening Hours module - FREE Version
 *  copyright: Copyright (c) 2026. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomill\Module\Openinghours\Site\Helper\OpeninghoursHelper;

/** @var Joomla\CMS\Application\CMSApplication $app */
/** @var Joomla\Registry\Registry $params */
/** @var stdClass $module */

$wa = $app->getDocument()->getWebAssetManager();
$wa->registerAndUseStyle('mod_openinghours.style', 'modules/mod_openinghours/css/style.css');

$timezone = $params->get('Timezone');
$now = OpeninghoursHelper::getCurrentDateTime($params);
$today = $now->format('l');
$week = OpeninghoursHelper::getWeek($params);
?>

<div style="width:<?php echo htmlspecialchars($params->get('Width'), ENT_QUOTES); ?>; margin: auto;">

	<?php require ModuleHelper::getLayoutPath('mod_openinghours', $params->get('layout', 'default') . '_openinghours'); ?>

	<?php if ($params->get('Usemicro')) : ?>
		<?php require ModuleHelper::getLayoutPath('mod_openinghours', $params->get('layout', 'default') . '_microdata'); ?>
	<?php endif; ?>

	<?php if ($params->get('Footer', 1)) : ?>
        <div class="openinghours-credit" style="font-size:9px; padding: 5px 10px 5px 0; text-align:center">
            <a href="https://www.joomill-extensions.com/extensions/opening-hours-days-week-closings" rel="nofollow" target="_blank"><?php echo Text::_('MOD_OPENINGHOURS_FOOTER_CREDIT'); ?></a>
        </div>
	<?php endif; ?>

	<?php if ($params->get('Debug', 0)) : ?>
        <div class="openinghours-debug" style="font-size:11px; margin-top:10px;">
            <?php echo 'Localtime: ' . $now->format('H:i'); ?><br/>
            <?php echo 'Timezone: ' . htmlspecialchars($timezone, ENT_QUOTES); ?>
        </div>
	<?php endif; ?>
</div>
