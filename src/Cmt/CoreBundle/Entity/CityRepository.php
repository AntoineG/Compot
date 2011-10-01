<?php

namespace Cmt\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CityRepository extends EntityRepository
{
	public function findAllLiveSearch($search)
	{
		return $this->getEntityManager()
		            ->createQuery("SELECT c FROM CmtCoreBundle:City c WHERE c.name LIKE '$search%' ORDER BY c.name ASC")
					->setMaxResults(10)
		            ->getResult();
	}
}