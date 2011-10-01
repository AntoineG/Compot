<?php

namespace Cmt\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cmt\CoreBundle\Entity\User;
use Cmt\CoreBundle\Entity\Prospect;

use Cmt\CoreBundle\Form\Type\UserType;


class ProspectController extends Controller
{
    
    public function indexAction()
    {	
		$request = $this->getRequest();
		
		$user = new User();

		$form = $this->createForm(new UserType(), $user);
		
		 if ('POST' === $request->getMethod()) {
	     	$form->bindRequest($request);

	     	if ($form->isValid()) {
				$data = $form->getData();
				$em = $this->getDoctrine()->getEntityManager();
				
				#Set role to PROSPECT
				$user->setRoles(array('ROLE_PROSPECT'));
				
				#Get prospect
				$prospect = $user->getProspect();
				
				#Set requestDate
				$prospect->setRequestDate(new \DateTime(date('Y-m-d H:i:s', time())));
				
				#Send welcome email
				$this->sendProspectRegistrationEmail($data->getEmail());
				
				$em->persist($user);
				$em->flush();
			}
		}
		
        return $this->render('CmtCoreBundle:Prospect:index.html.twig', array(
			'form' => $form->createView(),
		));
    }

	private function sendProspectRegistrationEmail($emailTo)
	{
		$message = \Swift_Message::newInstance()
	        ->setSubject('Bienvenue chez Compot!')
	        ->setFrom('contact@compot.fr')
	        ->setTo($emailTo)
			->setContentType('text/html')
	        ->setBody($this->renderView('CmtCoreBundle:Mailing:register-prospect.txt.twig'))
	    ;
	    $this->get('mailer')->send($message);
	}

}
