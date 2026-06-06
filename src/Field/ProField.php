<?php
/*
 *  package: Joomla Opening Hours module - FREE Version
 *  copyright: Copyright (c) 2026. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

namespace Joomill\Module\Openinghours\Site\Field;

use Joomla\CMS\Form\FormField;
use Joomla\CMS\Language\Text;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Form field that teases a PRO-only feature.
 *
 * Renders a disabled "PRO only" badge with an upgrade link instead of a real
 * input, so the FREE configuration screen advertises the features available in
 * the PRO version.
 *
 * @since  6.0.0
 */
class ProField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  6.0.0
	 */
	protected $type = 'Pro';

	/**
	 * Returns the field input markup: a badge linking to the PRO upgrade page.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   6.0.0
	 */
	protected function getInput()
	{
		return '<a class="btn btn-success btn-sm" href="https://www.joomill-extensions.com/extensions/opening-hours-days-week-closings"'
			. ' target="_blank" rel="noopener noreferrer">'
			. '<span class="icon-star icon-white" aria-hidden="true"></span> '
			. Text::_('MOD_OPENINGHOURS_PRO_ONLY')
			. '</a>';
	}
}
