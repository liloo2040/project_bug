<?php

namespace FootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 */
class Team
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $city;

    /**
     * @var \FootBundle\Entity\FootballPlayer
     */
    private $footballplayer;


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
     * Set name
     *
     * @param string $name
     * @return Team
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
     * Set city
     *
     * @param string $city
     * @return Team
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set footballplayer
     *
     * @param \FootBundle\Entity\FootballPlayer $footballplayer
     * @return Team
     */
    public function setFootballplayer(\FootBundle\Entity\FootballPlayer $footballplayer = null)
    {
        $this->footballplayer = $footballplayer;

        return $this;
    }

    /**
     * Get footballplayer
     *
     * @return \FootBundle\Entity\FootballPlayer 
     */
    public function getFootballplayer()
    {
        return $this->footballplayer;
    }
}
