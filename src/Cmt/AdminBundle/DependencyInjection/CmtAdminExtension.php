<?php

namespace Cmt\AdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CmtAdminExtension extends Extension
{
	
	protected $configNamespaces = array(
	        			'templates' => array(
	            			'layout',
	   						'ajax'
							)
						);
	
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
		
		$Yamlloader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
		$Yamlloader->load('services.yml');
		
        $Xmlloader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $Xmlloader->load('templates.xml');

		foreach ($this->configNamespaces as $ns => $params) 
		{
            if (!isset($config[$ns])) {
                continue;
            }

            foreach ($config[$ns] as $type => $template) {
                if (!isset($config[$ns][$type])) {
                    continue;
                }

                $container->setParameter(sprintf('cmt.admin.templates.%s', $type), $template);
            }
		}
    }
}
