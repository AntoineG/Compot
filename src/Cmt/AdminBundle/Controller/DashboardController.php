<?php

namespace Cmt\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * 
 * @author Tobias Hourst <tobias@strawberrydigital.com.au>
 *
 */
class DashboardController extends CoreController
{
	
	/**
	 * Show default dashboard page
	 */
    public function indexAction()
    {
		return $this->render('CmtAdminBundle:Dashboard:index.html.twig');
    }
}
