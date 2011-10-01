<?php
namespace Cmt\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use SamJ\DoctrineSluggableBundle\SluggableInterface;

/**
 * @ORM\Entity(repositoryClass="Cmt\CoreBundle\Entity\KeywordRepository")
 * @ORM\Table(name="keywords")
 */
class Keyword implements SluggableInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
	/**
	 * @ORM\Column(type="string", length="255")
     */
	protected $name;
	
	/**
	 * @ORM\Column(type="string", length="255")
     */
	protected $slug;
	
	public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        if (!empty($this->slug)) return false;
        $this->slug = $slug;
    }

    public function getSlugFields() {
        return $this->getName();
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
     */
    public function setName($name)
    {
        $this->name = $name;
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
}