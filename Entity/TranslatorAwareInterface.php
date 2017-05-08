<?php

/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 17/04/2016
 * Time: 13:25
 */

namespace Oni\CoreBundle\Entity;

use Symfony\Component\Translation\TranslatorInterface;


interface TranslatorAwareInterface {

	/**
	 *
	 * Set Translator
	 *
	 * @param \Symfony\Component\Translation\TranslatorInterface $translator
	 *
	 * @return mixed
	 */
	public function setTranslator(TranslatorInterface $translator);

}