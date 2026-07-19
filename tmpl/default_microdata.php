<?php

/**
 * Opening Hours
 *
 * @copyright   Copyright (c) 2026 Jeroen Moolenschot | Joomill
 * @license     GNU General Public License version 3 or later; see LICENSE
 * @link        https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

?>

<div itemscope itemtype="https://schema.org/LocalBusiness" class="openinghours-microdata">
	<?php foreach ($week as $day) :
		$microdayname = substr($day, 0, 2);
		$microtime1 = str_replace(' ', '', $params->get($day . 'times1', '') ?? '');
		?>
		<?php if (strpos($microtime1, '-') !== false) : ?>
            <meta itemprop="openingHours" content="<?php echo htmlspecialchars($microdayname . ' ' . $microtime1, ENT_QUOTES); ?>">
		<?php endif; ?>
	<?php endforeach; ?>
</div>
