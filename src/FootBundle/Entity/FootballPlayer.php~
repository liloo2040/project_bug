<?php

namespace FootBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * FootballPlayer
 */
class FootballPlayer
{
    public function __toString() {
        return $this->name;
    }
    
    public $file;
    
    protected function getUploadDir()
    {
        return 'uploads/photos_joueur';
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
    private $prenom;

    /**
     * @var string
     */
    private $size;

    /**
     * @var integer
     */
    private $age;

    /**
     * @var string
     */
    private $photo;

    /**
     * @var \FootBundle\Entity\Post
     */
    private $post;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $team;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return FootballPlayer
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
     * Set prenom
     *
     * @param string $prenom
     * @return FootballPlayer
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return FootballPlayer
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return FootballPlayer
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return FootballPlayer
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
     * Set post
     *
     * @param \FootBundle\Entity\Post $post
     * @return FootballPlayer
     */
    public function setPost(\FootBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \FootBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Add team
     *
     * @param \FootBundle\Entity\Team $team
     * @return FootballPlayer
     */
    public function addTeam(\FootBundle\Entity\Team $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \FootBundle\Entity\Team $team
     */
    public function removeTeam(\FootBundle\Entity\Team $team)
    {
        $this->team->removeElement($team);
    }

    /**
     * Get team
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeam()
    {
        return $this->team;
    }
}
