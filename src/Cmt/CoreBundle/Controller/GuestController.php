<?php

namespace Cmt\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Cmt\CoreBundle\Entity\Guest;

use Cmt\CoreBundle\Form\Type\GuestType;


class GuestController extends Controller
{
    
    public function indexAction($keyword = '', $city = '')
    {
		$em = $this->getDoctrine()->getEntityManager();
		
		#Get city and keyword repository
		$cityRepo = $em->getRepository('CmtCoreBundle:City');
		$keywordRepo = $em->getRepository('CmtCoreBundle:Keyword');
		
		#Check if city exists
		$cityResult = $cityRepo->findOneBySlug($city);
		$keywordResult = $keywordRepo->findOneBySlug($keyword);
		
		if(! $cityResult && $city !== '' && ! $keywordResult && $keyword !== '')
			throw new NotFoundHttpException('La ville et le produit spécifiés n\'existent pas.');
		elseif(! $cityResult && $city !== '')
			throw new NotFoundHttpException('La ville spécifiée n\'existe pas.');
		elseif(! $keywordResult && $keyword !== '')
			throw new NotFoundHttpException('Le produit spécifié n\'existe pas.');
	
	   		$request = $this->getRequest();
	   	
	   		$guestEnt = new Guest();
	   		$form = $this->createForm(new GuestType(), $guestEnt);
	   	
	   		 if ('POST' === $request->getMethod()) {
	            $form->bindRequest($request);
       
	            if ($form->isValid()) {
	   	        	
	   	        	$guestEnt->setRequestDate(new \DateTime(date('Y-m-d H:i:s', time())));
	   	        	
	   	        	$em->persist($guestEnt);
	   	        	$em->flush();
	   	        	
	   	        }
	   		}
	   	
       	 	return $this->render('CmtCoreBundle:Guest:index.html.twig', array(
	   	        'form' => $form->createView(),
	   	        'city' => $cityResult,
				'keyword' => $keywordResult,
	   		));
    }
}
