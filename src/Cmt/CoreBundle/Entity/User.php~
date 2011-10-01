<?php
namespace Cmt\CoreBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
	 * @ORM\OneToOne(targetEntity="Cmt\CoreBundle\Entity\Prospect", cascade={"persist"})
     */
	protected $prospect;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Set prospect
     *
     * @param Cmt\CoreBundle\Entity\Prospect $prospect
     */
    public function setProspect(\Cmt\CoreBundle\Entity\Prospect $prospect)
    {
        $this->prospect = $prospect;
    }

    /**
     * Get prospect
     *
     * @return Cmt\CoreBundle\Entity\Prospect 
     */
    public function getProspect()
    {
        return $this->prospect;
    }
}