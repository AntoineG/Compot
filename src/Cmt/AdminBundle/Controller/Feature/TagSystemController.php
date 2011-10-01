<?php

namespace Cmt\AdminBundle\Controller\Feature;

use Doctrine\ORM\EntityManager,
	Cmt\AdminBundle\Controller\CoreController;

use Cmt\TagBundle\Entity\Phrase;

use Cmt\TagBundle\Form\Type\PhraseType;


/**
 * 
 * @author Tobias Hourst <tobias@strawberrydigital.com.au>
 *
 */
class TagSystemController extends CoreController
{
	/**
	 * 
	 * @var EntityManager
	 */
	private $em;
	
	/**
	 * 
	 * @var Repository
	 */
	private $phraseRepository;
	
	/**
	 * (non-PHPdoc)
	 * @see Cmt\AdminBundle\Controller.CoreController::initialize()
	 */
	public function initialize(){
		parent::initialize();
		
		$this->em = $this->getDoctrine()->getEntityManager();
		
		$this->phraseRepository = $this->em->getRepository('CmtTagBundle:Phrase');
	}
	
	/**
	 * Lists all phrases
	 */
	public function getPhrasesAction()
	{	
		// get all phrases
		$phrasesResult = $this->phraseRepository->findAll();
		
		// return view
		return $this->render('CmtAdminBundle:TagSystem:index.html.twig', array(
			'phrases' => $phrasesResult,
	    ));
	}
	
	/**
	 * Add a phrase
	 */
	public function addPhraseAction()
	{	
		// get request
		$request = $this->getRequest();
		
		// create new phrase entity
		$phraseEntity = new Phrase();
		
		// create form
		$addForm = $this->createForm(new PhraseType());
		
		// check validation
		if('POST' === $request->getMethod()){
			// bind request to form
			$addForm->bindRequest($request);
			
			// if form is valid
			if($addForm->isValid()){
			
				// -- temp --
				//$content = $phraseEntity->getContent();
				
				// persist entity
				$this->em->persist($phraseEntity);
				
				// flush
	            $this->em->flush();
			}
		}
		
		// return view
		return $this->render('CmtAdminBundle:TagSystem:add.html.twig', array(
			'form' => $addForm->createView(),
	    ));

	}
	
	/**
	 * Edit a phrase
	 * 
	 * @param Integer $id
	 */
	public function editPhraseAction($id)
	{
		// load phrase
		$phraseResult = $this->phraseRepository->find($id);
		
		// check if loaded
		if (! $phraseResult) {
			throw $this->createNotFoundException('Unable to find Phrase entity.');
		}
		
		/*
		 * build an array of the words in the phrase
		 */ 
		$words = array();
		
		//Explode phrase
		$words = explode(' ', $phraseResult->getContent());
		
		// return view
		return $this->render('CmtAdminBundle:TagSystem:edit.html.twig', array(
			'phrase' => $phraseResult,
			'words' => $words,
	    ));
	}
}
