<?php

namespace Oni\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zones
 *
 * @ORM\Table(name="oni_zone")
 * @ORM\Entity
 */
class Zone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="zoneName", type="string", length=100)
     */
    private $zoneName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Oni\CoreBundle\Entity\Country", mappedBy="zones")
     */
    private $countries;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set zoneName
     *
     * @param string $zoneName
     *
     * @return Zone
     */
    public function setZoneName($zoneName)
    {
        $this->zoneName = $zoneName;

        return $this;
    }

    /**
     * Get zoneName
     *
     * @return string
     */
    public function getZoneName()
    {
        return $this->zoneName;
    }

    /**
     * Set zoneType
     *
     * @param string $zoneType
     *
     * @return Zone
     */
    public function setZoneType($zoneType)
    {
        $this->zoneType = $zoneType;

        return $this;
    }

    /**
     * Get zoneType
     *
     * @return string
     */
    public function getZoneType()
    {
        return $this->zoneType;
    }

    /**
     * Add country
     *
     * @param \Oni\CoreBundle\Entity\Country $country
     *
     * @return Zone
     */
    public function addCountry(\Oni\CoreBundle\Entity\Country $country)
    {
        $this->countries[] = $country;

        return $this;
    }

    /**
     * Remove country
     *
     * @param \Oni\CoreBundle\Entity\Country $country
     */
    public function removeCountry(\Oni\CoreBundle\Entity\Country $country)
    {
        $this->countries->removeElement($country);
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountries()
    {
        return $this->countries;
    }
}
