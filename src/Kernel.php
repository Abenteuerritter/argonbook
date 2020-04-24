<?php

namespace Argon;

use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle;
use FOS\UserBundle\FOSUserBundle;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;

use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;

class Kernel extends SymfonyKernel
{
    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new SecurityBundle(),
            new TwigBundle(),
            new MonologBundle(),
            new SwiftmailerBundle(),
            new DoctrineBundle(),
            new StofDoctrineExtensionsBundle(),
            new FOSUserBundle(),
            new KnpPaginatorBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new DebugBundle();
            $bundles[] = new WebProfilerBundle();
            $bundles[] = new DoctrineFixturesBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getProjectDir() . '/config/{packages,services}/*.php', 'glob');
        $loader->load($this->getProjectDir() . '/config/{packages,services}/' . $this->getEnvironment() . '/*.php', 'glob');
    }

    /**
     * @internal
     */
    public function loadRoutes(RoutingConfigurator $routes)
    {
        $routes->import($this->getProjectDir() . '/config/routes/', 'directory');
        $routes->import($this->getProjectDir() . '/config/routes/admin/', 'directory')->prefix('/admin');

        if ($this->getEnvironment() === 'dev') {
            $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml')->prefix('/_wdt');
            $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml')->prefix('/_profiler');
            $routes->import('@TwigBundle/Resources/config/routing/errors.xml')->prefix('/_error');
        }

        $routes->import('@FOSUserBundle/Resources/config/routing/all.xml');
    }
}