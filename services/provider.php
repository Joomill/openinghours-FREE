<?php

/**
 * Opening Hours
 *
 * @copyright   Copyright (c) 2026 Jeroen Moolenschot | Joomill
 * @license     GNU General Public License version 3 or later; see LICENSE
 * @link        https://www.joomill-extensions.com
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\HelperFactory;
use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

/**
 * The opening hours module service provider
 *
 * Registers the module dispatcher factory, helper factory and module service
 * with the Joomla Dependency Injection container.
 *
 * @since  6.0.0
 */
return new class () implements ServiceProviderInterface {
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   6.0.0
     */
    public function register(Container $container)
    {
        $container->registerServiceProvider(new ModuleDispatcherFactory('\\Joomill\\Module\\Openinghours'));
        $container->registerServiceProvider(new HelperFactory('\\Joomill\\Module\\Openinghours\\Site\\Helper'));

        $container->registerServiceProvider(new Module());
    }
};
