<?php

namespace Oni\CoreBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Nationality
 *
 * @ORM\Table(name="oni_nationality")
 * @ORM\Entity(repositoryClass="Oni\CoreBundle\Entity\Repository\NationalityRepository")
 */
class Nationality
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
     *
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Oni\CoreBundle\Entity\Country", inversedBy="nationalities")
     * @ORM\JoinColumn(name="countryId", referencedColumnName="id")
     *
     */
    private $country;


    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=150)
     */
    private $nationality;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;



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
     * Set nationality
     *
     * @param string $nationality
     *
     * @return Nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Nationality
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
     * Set country
     *
     * @param \Oni\CoreBundle\Entity\Country $country
     *
     * @return Nationality
     */
    public function setCountry(\Oni\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Oni\CoreBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function __toString() {
        return $this->getNationality();
    }


}
