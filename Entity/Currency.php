<?php

namespace Oni\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 *
 * @ORM\Table(name="oni_currency")
 * @ORM\Entity(repositoryClass="Oni\CoreBundle\Entity\Repository\CurrencyRepository")
 */
class Currency
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="currencyCode", type="string", length=3)
     */
    private $currencyCode;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="currencySymbol", type="string", length=100)
     */
    private $currencySymbol;

    /**
     * @var integer
     *
     * @ORM\Column(name="isDefault", type="integer", length=11)
     */
    private $isDefault;

    /**
     * @var
     *
     * @ORM\Column(name="currencyName", type="string", length=120)
     */
    private $currencyName;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set currencyCode
     *
     * @param string $currencyCode
     *
     * @return Currency
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * Get currencyCode
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Currency
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set currecnySymbol
     *
     * @param string $currecnySymbol
     *
     * @return Currency
     */
    public function setCurrencySymbol($currencySymbol)
    {
        $this->currencySymbol = $currencySymbol;

        return $this;
    }

    /**
     * Get currecnySymbol
     *
     * @return string
     */
    public function getCurrencySymbol()
    {
        return $this->currencySymbol;
    }

    /**
     * Set isDefault
     *
     * @param integer $isDefault
     *
     * @return Currency
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return integer
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set currencyName
     *
     * @param string $currencyName
     *
     * @return Currency
     */
    public function setCurrencyName($currencyName)
    {
        $this->currencyName = $currencyName;

        return $this;
    }

    /**
     * Get currencyName
     *
     * @return string
     */
    public function getCurrencyName()
    {
        return $this->currencyName;
    }
}
