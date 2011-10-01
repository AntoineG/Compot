<?php

namespace Cmt\TagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($city = NULL)
    {
		#Get Entitiy Manager
		$em = $this->getDoctrine()->getEntityManager();
		
		#Get City repository
		$cityRepo = $em->getRepository('CmtCoreBundle:City');
		
		#Get Phrase repository
		$phraseRepo = $em->getRepository('CmtTagBundle:Phrase');
		
		#Get TagRandom repository
		$tagRandomRepo = $em->getRepository('CmtTagBundle:TagRandom');
		
		#Get entries
		if($city !== NULL)
			$phrases = $cityRepo->findBySlug($city);
		else
			$phrases = $phraseRepo->findAll();
		
		#Initilise and write to array
		$ids = array();
		foreach($phrases as $phrase)
			$ids[] = $phrase->getId();
		
		#Size of the array.
		$count = count($ids);
		
		#Initialise phrase
		$phrase = NULL;
		
		if($count > 0){
		
			#Random ID
			$id = $ids[rand(0, $count - 1)];
		
			#Get phrase
			$phrase = $phraseRepo->findOneById($id);
			
			if($phrase)
			{
				#Get tags
				$tags = $phrase->getTags();
		
				foreach($tags as $tag)
				{
					#Get random tags
					$randomTags = $tag->getRandoms();
			
					#Initilise and write to array
					$ids = array();
					foreach($randomTags as $randomTag)
						$ids[] = $randomTag->getId();

					#Size of the array.
					$count = count($ids);
			
					if($count > 0){
				
						#Random ID
						$id = $ids[rand(0, $count - 1)];
			
						#Get random tag
						$tagRandom = $tagRandomRepo->findOneById($id);
					}
					else
						$tagRandom = $tag;
					
					#Replace tags
					$phrase->setContent(str_replace($tag->getContent(), $tagRandom->getContent(), $phrase->getContent()));
				}
			}
		}
		
        return $this->render('CmtTagBundle:Default:index.html.twig', array(
			'phrase' => $phrase
		));
    }
}
