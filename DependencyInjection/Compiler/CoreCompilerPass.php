<?php

namespace Oni\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class CoreCompilerPass implements CompilerPassInterface {


	/**
	 * You can modify the container here before it is dumped to PHP code.
	 *
	 * @param ContainerBuilder $container
	 */
	public function process( ContainerBuilder $container ) {

		if (!$container->has('oni_event_dispatcher')) {
			return;
		}

		$eventDispatcherDefinition = $container->findDefinition(
			'oni_event_dispatcher'
		);

		$taggedServices = $container->findtaggedserviceids(
			'oni.event_subscriber'
		);

		foreach ($taggedServices as $id => $tags) {
			$eventDispatcherDefinition->addMethodCall(
				'addSubscriber',
				array(new Reference($id))
			);
		}

	}


}