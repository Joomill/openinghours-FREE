<?php

/**
 * Opening Hours
 *
 * @copyright   Copyright (c) 2026 Jeroen Moolenschot | Joomill
 * @license     GNU General Public License version 3 or later; see LICENSE
 * @link        https://www.joomill-extensions.com
 */

namespace Joomill\Module\Openinghours\Site\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Dispatcher class for mod_openinghours (FREE)
 *
 * Prepares the layout data for the Opening Hours module. The FREE version only
 * renders regular weekly hours, so no content-plugin processing is required.
 *
 * @since  6.0.0
 */
class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    /**
     * Returns the layout data for the module.
     *
     * Resolves the helper from the module's HelperFactory and adds the current
     * date/time, the day name and the ordered week so the layouts can render
     * without calling the helper directly.
     *
     * @return  array  The layout data
     *
     * @since   6.2.0
     */
    protected function getLayoutData(): array
    {
        $data = parent::getLayoutData();

        /** @var \Joomill\Module\Openinghours\Site\Helper\OpeninghoursHelper $helper */
        $helper = $this->getHelperFactory()->getHelper('OpeninghoursHelper');
        $params = $data['params'];

        $now = $helper->getCurrentDateTime($params);

        $data['helper'] = $helper;
        $data['now']    = $now;
        $data['today']  = $now->format('l');
        $data['week']   = $helper->getWeek($params);

        return $data;
    }
}
