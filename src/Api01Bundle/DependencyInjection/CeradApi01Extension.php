<?php

namespace Cerad\Bundle\Api01Bundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
/* ==========================================
 * By default, this extension does not know anything about the bundle
 * The configs are empty
 */
class CeradApi01Extension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        if ($config);
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        // Need to test throughly n production
        // C:\home\ahundiak\zayso2016\cerad3\src\Api01Bundle
        $bundleDir = dirname(dirname(__FILE__));
        $container->setParameter('cerad_api01__bundle_dir',$bundleDir);
        
        
        // This does not work, need a pass
        // $twigFilesystemLoaderDefinition = $container->getDefinition('twig.loader.filesystem');
        
    }
}
