<?php

namespace FootBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FootBundle\Entity\Team;
use FootBundle\Form\TeamType;

/**
 * Team controller.
 *
 */
class TeamController extends Controller
{
    /**
     * Lists all Team entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teams = $em->getRepository('FootBundle:Team')->findAll();

        return $this->render('FootBundle:team:index.html.twig', array(
            'teams' => $teams,
        ));
    }

    /**
     * Creates a new Team entity.
     *
     */
    public function newAction(Request $request)
    {
        $team = new Team();
        $form = $this->createForm('FootBundle\Form\TeamType', $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();

            return $this->redirectToRoute('team_index');
        }

        return $this->render('FootBundle:team:new.html.twig', array(
            'team' => $team,
            'form' => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing Team entity.
     *
     */
    public function editAction(Request $request, Team $team)
    {
        $deleteForm = $this->createDeleteForm($team);
        $editForm = $this->createForm('FootBundle\Form\TeamType', $team);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $team->preUpload();
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();

            return $this->redirectToRoute('team_index');
        }

        return $this->render('@Foot/team/edit.html.twig', array(
            'team' => $team,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Team entity.
     *
     */
    public function deleteAction(Request $request, Team $team)
    {
        $form = $this->createDeleteForm($team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($team);
            $em->flush();
        }

        return $this->redirectToRoute('team_index');
    }

    /**
     * Creates a form to delete a Team entity.
     *
     * @param Team $team The Team entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Team $team)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('team_delete', array('id' => $team->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
