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
trait TimestampableEntity
{
    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * Sets createdAt.
     *
     * @param  \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Returns createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }

    /**
     * Sets updatedAt.
     *
     * @param  \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Returns updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt->format('Y-m-d H:i:s');
    }
}
