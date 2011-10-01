<?php

namespace Cmt\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * 
 * @author Tobias Hourst <tobias@strawberrydigital.com.au>
 *
 */
class SecurityController extends CoreController
{
	
	/**
	 * Show login form.
	 * The form is validated against FOSUserBundle.
	 */
	public function showLoginFormAction()
	{
		return $this->render('CmtAdminBundle:Security:login.html.twig');
	}
}
