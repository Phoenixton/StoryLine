<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * INVENTORY
 *
 * @ORM\Table(name="i_n_v_e_n_t_o_r_y")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\INVENTORYRepository")
 */
class INVENTORY
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
     * @var array
     *
     * @ORM\Column(name="objects", type="array")
     */
    private $objects;


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
     * Set objects
     *
     * @param array $objects
     *
     * @return INVENTORY
     */
    public function setObjects($objects)
    {
        $this->objects = $objects;

        return $this;
    }

    /**
     * Get objects
     *
     * @return array
     */
    public function getObjects()
    {
        return $this->objects;
    }
}

