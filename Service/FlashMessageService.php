<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 04/05/2016
 * Time: 22:23
 */

namespace Oni\CoreBundle\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;

class FlashMessageService {

	/**
	 * @var \Symfony\Component\Translation\TranslatorInterface
	 */
	protected $translator;

	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $container;

	public function __construct(ContainerInterface $container, TranslatorInterface $translator) {
		$this->container = $container;
		$this->translator = $translator;
	}

	public function addFlash($type, $message)
	{
		if (!$this->container->has('session')) {
			throw new \LogicException('You can not use the addFlash method if sessions are disabled.');
		}

		$message = $this->translator->trans($message);

		$this->container->get('session')->getFlashBag()->add($type, $message);
	}

}