<?php
namespace Cmt\TagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cmt\TagBundle\Entity\TagRandomRepository")
 * @ORM\Table(name="tags_rnd")
 */
class TagRandom
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
	protected $content;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Tag", inversedBy="randoms")
     */
	protected $tag;


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
     * Set content
     *
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set tag
     *
     * @param Cmt\TagBundle\Entity\Tag $tag
     */
    public function setTag(\Cmt\TagBundle\Entity\Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Get tag
     *
     * @return Cmt\TagBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }
}