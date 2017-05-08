<?php

namespace UserBundle\Controller;


use UserBundle\Entity\user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class RegisterUserController extends Controller
{
    /**
     * @Route("signUp", name="signUp")
     */
    public function signUpAction(Request $request)
    {
        $newUser = new User;

        $form = $this->createFormBuilder($newUser)
            ->add('username', TextType::class, array('attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('password', TextType::class, array('attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('avatar', FileType::class, array('label' => 'Avatar (PNG file)', 'required' => false))
            ->add('save', SubmitType::class, array('label' => 'Register', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);

        try {
            if ($form->isSubmitted() && $form->isValid()) {


                if($form['avatar']->getData() != null) {

                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                    $avatar = $newUser->getAvatar();

                    // Generate a unique name for the file before saving it
                    $fileName = md5(uniqid()).'.'.$avatar->guessExtension();

                    // Move the file to the directory where brochures are stored
                    $avatar->move(
                        $this->getParameter('avatar_directory'),
                        $fileName
                    );
                    // Update the 'brochure' property to store the PDF file name
                    // instead of its contents
                    $newUser->setAvatar($fileName);

                } else {

                }
                //Get the data from the form
                $username = $form['username']->getData();
                $password = $form['password']->getData();
                $now = new\DateTime('now');

                $newUser->setUsername($username);
                $newUser->setPassword($password);
                $newUser->setStamina(500);
                $newUser->setLastconnect($now);
                $newUser->setCurrentCharacter(0);
                $em = $this->getDoctrine()->getManager();
                $em->persist($newUser);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'New User Registered !'
                );

                return $this->redirectToRoute('homepage');


            }
        } catch (UniqueConstraintViolationException $e){
            $this->addFlash(
                'error',
                'Name Already Taken !'
            );

            return $this->redirectToRoute('signUp');
        }


        return $this->render('UserBundle:RegisterPage:signUp.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
