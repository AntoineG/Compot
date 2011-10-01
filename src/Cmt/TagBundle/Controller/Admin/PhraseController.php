<?php

namespace Cmt\TagBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cmt\TagBundle\Entity\Phrase;
use Cmt\TagBundle\Entity\Tag;
use Cmt\TagBundle\Entity\TagRandom;

/**
 * Phrase controller.
 *
 */
class PhraseController extends Controller
{
    /**
     * Lists all Phrase entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CmtTagBundle:Phrase')->findAll();

        return $this->render('CmtTagBundle:Phrase:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Phrase entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CmtTagBundle:Phrase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phrase entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CmtTagBundle:Phrase:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Phrase entity.
     *
     */
    public function newAction()
    {
        $entity = new Phrase();

        return $this->render('CmtTagBundle:Phrase:new.html.twig', array(
            'entity' => $entity,
        ));
    }

    /**
     * Creates a new Phrase entity.
     *
     */
    public function createAction()
    {
		if($_POST){
			
			//Get Entity Manager
			$em = $this->getDoctrine()->getEntityManager();
			
			//Entity
			$phraseEntity = new Phrase();
			
			//Get phrase from form;
			$phrase = $_POST['phrase'];
			
			$tags = array();
			
			//Get the tags from the phrase; delimiters: []
			preg_match_all("/(?<=\[)(.*?)(?=\])/", $phrase, $tags);
			
			//Set the phrase (get rid of square brackets)
			$phraseEntity->setContent(str_replace(array('[', ']'), '', $phrase));
			
			//Add tags
			foreach($tags[0] as $tag)
			{
				$tagEntity = new Tag();
				$tagEntity->setContent($tag);
				$tagEntity->setPhrase($phraseEntity);
				$em->persist($tagEntity);
			}
			
            $em->persist($phraseEntity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_phrase_create_2', array('id' => $phraseEntity->getId())));
		}

        return $this->render('CmtTagBundle:Phrase:new.html.twig', array(
            'entity' => $phraseEntity,
        ));
    }

	/**
     * Creates a new Phrase entity.
     *
     */
    public function create2Action($id)
    {
		$em = $this->getDoctrine()->getEntityManager();

		$phraseEntity = $em->getRepository('CmtTagBundle:Phrase')->find($id);
	
		if($_POST)
		{
			foreach($_POST['randoms'] as $id => $strRandoms)
			{
				foreach($phraseEntity->getTags() as $tag)
				{
					if($tag->getId() == $id)
					{
						$arrRandoms = explode("\n", $strRandoms);
						foreach($arrRandoms as $random)
						{
							$randomEntity = new TagRandom();
							$randomEntity->setContent($random);
							$randomEntity->setTag($tag);
							$em->persist($randomEntity);
						}
					}
				}
			}
			
			$em->persist($phraseEntity);
            $em->flush();

			return $this->redirect($this->generateUrl('admin_phrase'));
		}
		
        return $this->render('CmtTagBundle:Phrase:new2.html.twig', array(
            'phrase' => $phraseEntity,
        ));
    }

    /**
     * Displays a form to edit an existing Phrase entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CmtTagBundle:Phrase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phrase entity.');
        }

        $editForm = $this->createForm(new PhraseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CmtTagBundle:Phrase:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Phrase entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CmtTagBundle:Phrase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phrase entity.');
        }

        $editForm   = $this->createForm(new PhraseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_phrase_edit', array('id' => $id)));
        }

        return $this->render('CmtTagBundle:Phrase:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Phrase entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CmtTagBundle:Phrase')->find($id);
			
			//Remove tags
			foreach($entity->getTags() as $tag){
				$tagEntity = $em->getRepository('CmtTagBundle:Tag')->find($tag->getId());
				$em->remove($tagEntity);
				
				//Remove random tags
				foreach($tag->getRandoms() as $random){
					$randomEntity = $em->getRepository('CmtTagBundle:TagRandom')->find($random->getId());
					$em->remove($randomEntity);
				}
			}
			
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Phrase entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_phrase'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
