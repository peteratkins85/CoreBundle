<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 24/11/2016
 * Time: 23:29
 */

namespace Oni\CoreBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class TimestampableEntity
 * @package Oni\ProductManagerBundle\Entity\Traits
 * @author peter.atkins85@gmail.com
 */
trait LastUserEntity
{
    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    private $updatedBy;

    /**
     * Sets updatedBy.
     *
     * @param  int $updatedBy
     * @return $this
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Returns updatedBy.
     *
     * @return int
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }
}
