<?php

namespace UserBundle\Controller;


use UserBundle\Entity\user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        try {
            $em = $this->getDoctrine()->getManager();

            $users = $em->getRepository('UserBundle:user')->findAll();

            return $this->render('user/index.html.twig', array(
                'users' => $users,
            ));
        } catch(AccessDeniedException $e){

            throw $this->createAccessDeniedException('You cannot access this page!');
            $this->addFlash(
                'error',
                'ACCESS DENIED!'
            );

            return $this->redirectToRoute('homepage');
        }

    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('UserBundle\Form\userType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/show/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(user $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/edit/{id}", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, user $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('UserBundle\Form\userType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/delete/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, user $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        $id = $user->getId();

        $em = $this->getDoctrine()->getManager();


        $characs = $em->getRepository('GameBundle:characters')->findBy(array(
            'user' => $id
        ));

        foreach ($characs as $value) {
            //deletes the inventory of his characters
            $id_charac = $value->getId();
            $query = $this->getDoctrine()->getManager()->createQuery("DELETE FROM GameBundle:belongs e WHERE e.character = '$id_charac'");
            $query->execute();
        }


        //deletes his characters
        $query = $this->getDoctrine()->getManager()->createQuery("DELETE FROM GameBundle:characters e WHERE e.user = '$id'");
        $query->execute();


        //deletes his messages
        $query = $this->getDoctrine()->getManager()->createQuery("DELETE FROM UserBundle:messages e WHERE e.sender = '$id' OR e.receiver = '$id'");
        $query->execute();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }



    /**
     * Creates a form to delete a user entity.
     *
     * @param user $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(user $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
