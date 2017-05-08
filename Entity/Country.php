<?php

namespace Oni\CoreBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Country
 *
 * @ORM\Table(name="oni_country", indexes={@ORM\Index(name="iso_idx", columns={"iso"})})
 * @ORM\Entity(repositoryClass="Oni\CoreBundle\Entity\Repository\CountryRepository")
 *
 */
class Country 
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
     * @ORM\Column(name="iso", type="string", length=2)
     */
    private $iso;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80)
     */
    private $name;



    /**
     * @var string
     *
     * @ORM\Column(name="niceName", type="string", length=80)
     */
    private $niceName;

    /**
     * @var string
     *
     * @ORM\Column(name="iso3", type="string", length=3)
     */
    private $iso3;

    /**
     * @var integer
     *
     * @ORM\Column(name="numCode", type="smallint")
     */
    private $numCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="phoneCode", type="integer")
     */
    private $phoneCode;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=5)
     */
    private $locale;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Oni\CoreBundle\Entity\City", mappedBy="country")
     *
     */
    private $cities;

    /**
     *
     * @ORM\OneToMany(targetEntity="Oni\CoreBundle\Entity\Nationality", mappedBy="country")
     *
     */
    private $nationalities;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Oni\CoreBundle\Entity\Zone", inversedBy="countries")
     * @ORM\JoinTable(name="oni_zone_country_relations",
     *   joinColumns={
     *     @ORM\JoinColumn(name="zoneId", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="countryId", referencedColumnName="id")
     *   }
     * )
     */
    private $zones;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->zones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set iso
     *
     * @param string $iso
     *
     * @return Country
     */
    public function setIso($iso)
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get iso
     *
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set niceName
     *
     * @param string $niceName
     *
     * @return Country
     */
    public function setNiceName($niceName)
    {
        $this->niceName = $niceName;

        return $this;
    }

    /**
     * Get niceName
     *
     * @return string
     */
    public function getNiceName()
    {
        return $this->niceName;
    }

    /**
     * Set iso3
     *
     * @param string $iso3
     *
     * @return Country
     */
    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;

        return $this;
    }

    /**
     * Get iso3
     *
     * @return string
     */
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * Set numCode
     *
     * @param integer $numCode
     *
     * @return Country
     */
    public function setNumCode($numCode)
    {
        $this->numCode = $numCode;

        return $this;
    }

    /**
     * Get numCode
     *
     * @return integer
     */
    public function getNumCode()
    {
        return $this->numCode;
    }

    /**
     * Set phoneCode
     *
     * @param integer $phoneCode
     *
     * @return Country
     */
    public function setPhoneCode($phoneCode)
    {
        $this->phoneCode = $phoneCode;

        return $this;
    }

    /**
     * Get phoneCode
     *
     * @return integer
     */
    public function getPhoneCode()
    {
        return $this->phoneCode;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return Country
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Add zone
     *
     * @param \Oni\CoreBundle\Entity\Zone $zone
     *
     * @return Country
     */
    public function addZone(\Oni\CoreBundle\Entity\Zone $zone)
    {
        $this->zones[] = $zone;

        return $this;
    }

    /**
     * Remove zone
     *
     * @param \Oni\CoreBundle\Entity\Zone $zone
     */
    public function removeZone(\Oni\CoreBundle\Entity\Zone $zone)
    {
        $this->zones->removeElement($zone);
    }

    /**
     * Get zones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZones()
    {
        return $this->zones;
    }

    /**
     * Add city
     *
     * @param \Oni\CoreBundle\Entity\City $city
     *
     * @return Country
     */
    public function addCity(\Oni\CoreBundle\Entity\City $city)
    {
        $this->cities[] = $city;

        return $this;
    }

    /**
     * Remove city
     *
     * @param \Oni\CoreBundle\Entity\City $city
     */
    public function removeCity(\Oni\CoreBundle\Entity\City $city)
    {
        $this->cities->removeElement($city);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Set countryName
     *
     * @param string $countryName
     *
     * @return Country
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Add nationality
     *
     * @param \Oni\CoreBundle\Entity\Nationality $nationality
     *
     * @return Country
     */
    public function addNationality(\Oni\CoreBundle\Entity\Nationality $nationality)
    {
        $this->nationalities[] = $nationality;

        return $this;
    }

    /**
     * Remove nationality
     *
     * @param \Oni\CoreBundle\Entity\Nationality $nationality
     */
    public function removeNationality(\Oni\CoreBundle\Entity\Nationality $nationality)
    {
        $this->nationalities->removeElement($nationality);
    }

    /**
     * Get nationalities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNationalities()
    {
        return $this->nationalities;
    }

}
