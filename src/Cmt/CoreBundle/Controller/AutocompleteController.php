<?php

namespace Cmt\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

class AutocompleteController extends Controller
{
	
	public function searchCitiesAction()
	{
		#Get city (few characters typed)
		$city = $_GET['city'];
		
		#Get entity manager
		$em = $this->getDoctrine()->getEntityManager();
		
		#Get city repository
		$cityRepository = $em->getRepository('CmtCoreBundle:City');
		
		#Get result
		$citiesResult = $cityRepository->findAllLiveSearch($city);
		
		/* 
		* Build response
		*/
		#Initialise return array
		$result = array();
		
		//Initialise counter
		$i = 0;
		#Loop results
		foreach($citiesResult as $city)
		{
			//Assign values
			$result[$i]['id'] = $city->getId();
			$result[$i]['slug'] = $city->getSlug();
			$result[$i]['name'] = $city->getName();
			
			$i++;
		}
		
		//Count
		$result['count'] = count($result);
		
		#Return response
		return new Response(json_encode($result));
	}
	
	public function postalCodeAction()
	{
		#Get postal code
		$postalCode = $_GET['postalCode'];
		
		#Get entity manager
		$em = $this->getDoctrine()->getEntityManager();
		
		#Get city repository
		$cityRepository = $em->getRepository('CmtCoreBundle:City');
		
		#Get city
		$cityResult = $cityRepository->findOneByPostalCode($postalCode);
		
		/*
		* Get a random keyword
		*/
		#Get keyword repository
		$keywordRepository = $em->getRepository('CmtCoreBundle:Keyword');
		
		#Get keywords
		$keywordsResult = $keywordRepository->findAll();
		
		#Initilise and write to array
		$ids = array();
		foreach($keywordsResult as $keyword)
			$ids[] = $keyword->getId();
			
		#Random ID
		$id = $ids[rand(0, count($ids) - 1)];
	
		#Get keyword
		$keywordResult = $keywordRepository->findOneById($id);
		
		#If postal code exists
		if( $cityResult ){
			#Build response array
			$result = array(
				'id' => $cityResult->getId(),
				'city' => $cityResult->getName(),
				'slug' => $cityResult->getSlug(),
				'postalCode' => $cityResult->getPostalCode(),
				'keyword' => $keywordResult->getSlug(),
				'success' => TRUE
			);
		} else {
			$result = array('success' => FALSE);
		}
		
		#Send response
		return new Response(json_encode($result));  
	}
	
	public function cityAction()
	{
		#Get city
		$city = $_GET['city'];
		
		#Get entity manager
		$em = $this->getDoctrine()->getEntityManager();
		
		#Get city repository
		$cityRepository = $em->getRepository('CmtCoreBundle:City');
		
		#Get city (by slug or by name)
		if( ! $cityResult = $cityRepository->findOneByName($city))
			$cityResult = $cityRepository->findOneBySlug($city);
		
		/*
		* Get a random keyword
		*/
		#Get keyword repository
		$keywordRepository = $em->getRepository('CmtCoreBundle:Keyword');
		
		#Get keywords
		$keywordsResult = $keywordRepository->findAll();
		
		#Initilise and write to array
		$ids = array();
		foreach($keywordsResult as $keyword)
			$ids[] = $keyword->getId();
			
		#Random ID
		$id = $ids[rand(0, count($ids) - 1)];
	
		#Get keyword
		$keywordResult = $keywordRepository->findOneById($id);
		
		#If city exists
		if( $cityResult ){
			#Build response array
			$result = array(
				'id' => $cityResult->getId(),
				'postalCode' => $cityResult->getPostalCode(),
				'city' => $cityResult->getName(),
				'slug' => $cityResult->getSlug(),
				'keyword' => $keywordResult->getSlug(),
				'success' => TRUE
			);
		} else {
			$result = array('success' => FALSE);
		}
		
		#Send response
		return new Response(json_encode($result));  
	}
}