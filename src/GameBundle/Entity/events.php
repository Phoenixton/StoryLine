<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\eventsRepository")
 */
class events
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begindate", type="datetime")
     */
    private $begindate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="datetime")
     */
    private $enddate;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="GameBundle\Entity\enemy")
     */
    private $monster;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="GameBundle\Entity\objects")
     */
    private $object;


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
     * Set name
     *
     * @param string $name
     *
     * @return events
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
     * Set begindate
     *
     * @param \DateTime $begindate
     *
     * @return events
     */
    public function setBegindate($begindate)
    {
        $this->begindate = $begindate;

        return $this;
    }

    /**
     * Get begindate
     *
     * @return \DateTime
     */
    public function getBegindate()
    {
        return $this->begindate;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return events
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * Set monster
     *
     * @param integer $monster
     *
     * @return events
     */
    public function setMonster($monster)
    {
        $this->monster = $monster;

        return $this;
    }

    /**
     * Get monster
     *
     * @return int
     */
    public function getMonster()
    {
        return $this->monster;
    }

    /**
     * Set object
     *
     * @param integer $object
     *
     * @return events
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return int
     */
    public function getObject()
    {
        return $this->object;
    }
}

