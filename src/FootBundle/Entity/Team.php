<?php

namespace FootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 */
class Team
{

    public function __toString() {
        return $this->name;
    }
    
    public $file;

    protected function getUploadDir()
    {
        return 'uploads/photos_team';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return null === $this->photo ? null : $this->getUploadDir().'/'.$this->photo;
    }

    public function getAbsolutePath()
    {
        return null === $this->photo ? null : $this->getUploadRootDir().'/'.$this->photo;
    }

    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $this->photo = uniqid().'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->file->move($this->getUploadRootDir(), $this->photo);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
    
        // Generated Code
 
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
     * @var string
     */
    private $photo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $footballplayer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->footballplayer = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set photo
     *
     * @param string $photo
     * @return Team
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Add footballplayer
     *
     * @param \FootBundle\Entity\FootballPlayer $footballplayer
     * @return Team
     */
    public function addFootballplayer(\FootBundle\Entity\FootballPlayer $footballplayer)
    {
        $this->footballplayer[] = $footballplayer;

        return $this;
    }

    /**
     * Remove footballplayer
     *
     * @param \FootBundle\Entity\FootballPlayer $footballplayer
     */
    public function removeFootballplayer(\FootBundle\Entity\FootballPlayer $footballplayer)
    {
        $this->footballplayer->removeElement($footballplayer);
    }

    /**
     * Get footballplayer
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFootballplayer()
    {
        return $this->footballplayer;
    }
}
