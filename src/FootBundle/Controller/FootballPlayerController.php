<?php

namespace FootBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FootBundle\Entity\FootballPlayer;
use FootBundle\Form\FootballPlayerType;

/**
 * FootballPlayer controller.
 *
 */
class FootballPlayerController extends Controller
{
    /**
     * Lists all FootballPlayer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $footballPlayers = $em->getRepository('FootBundle:FootballPlayer')->findAll();

        return $this->render('footballplayer/index.html.twig', array(
            'footballPlayers' => $footballPlayers,
        ));
    }

    /**
     * Creates a new FootballPlayer entity.
     *
     */
    public function newAction(Request $request)
    {
        $footballPlayer = new FootballPlayer();
        $form = $this->createForm('FootBundle\Form\FootballPlayerType', $footballPlayer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($footballPlayer);
            $em->flush();

            return $this->redirectToRoute('footballplayer_show', array('id' => $footballPlayer->getId()));
        }

        return $this->render('footballplayer/new.html.twig', array(
            'footballPlayer' => $footballPlayer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FootballPlayer entity.
     *
     */
    public function showAction(FootballPlayer $footballPlayer)
    {
        $deleteForm = $this->createDeleteForm($footballPlayer);

        return $this->render('footballplayer/show.html.twig', array(
            'footballPlayer' => $footballPlayer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FootballPlayer entity.
     *
     */
    public function editAction(Request $request, FootballPlayer $footballPlayer)
    {
        $deleteForm = $this->createDeleteForm($footballPlayer);
        $editForm = $this->createForm('FootBundle\Form\FootballPlayerType', $footballPlayer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($footballPlayer);
            $em->flush();

            return $this->redirectToRoute('footballplayer_edit', array('id' => $footballPlayer->getId()));
        }

        return $this->render('footballplayer/edit.html.twig', array(
            'footballPlayer' => $footballPlayer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a FootballPlayer entity.
     *
     */
    public function deleteAction(Request $request, FootballPlayer $footballPlayer)
    {
        $form = $this->createDeleteForm($footballPlayer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($footballPlayer);
            $em->flush();
        }

        return $this->redirectToRoute('footballplayer_index');
    }

    /**
     * Creates a form to delete a FootballPlayer entity.
     *
     * @param FootballPlayer $footballPlayer The FootballPlayer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FootballPlayer $footballPlayer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('footballplayer_delete', array('id' => $footballPlayer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
