<?php

namespace AppBundle\Controller;

use GameBundle\Entity\characters;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{
    public function giveHourlyStamina(){

        $em = $this->getDoctrine()->getManager();

        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d H:i:s");
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            //get current user
            if($securityContext->isGranted('ROLE_ADMIN')) {

            } else {
                $usr= $this->get('security.token_storage')->getToken()->getUser();
                if($usr->getLastconnect() == null) {

                    $usr->setStamina($usr->getStamina() + 10);
                    $em->flush();
                    //?
                } else if(new \DateTime($usr->getLastconnect()->format('Y-m-d H:i')) < new \DateTime((new \DateTime("now"))->format('Y-m-d H:i'))){

                    $usr->setStamina($usr->getStamina() + 10);
                    $em->flush();

                } else {

                }
                /**
                 * else (if new \DateTime($usr->getLastconnect()->format('Y-m-d')< new \DateTime((new \DateTime("now"))->format('Y-m-d'))
                 */

                $usr->setLastconnect(new \DateTime((new \DateTime("now"))->format('Y-m-d H:i:s')));
                $em->flush();
                //persists the changes
            }
        }
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $this->giveHourlyStamina();

        return $this->render('AppBundle:HomePage:home.html.twig');

    }



    /**
     * @Route("/listofusers", name="listofusers")
     */
    public function showAllUserAction(){

        $em = $this->getDoctrine()->getManager();

        $this->giveHourlyStamina();

        $users = $em->getRepository('UserBundle:user')->findAll();

        return $this->render('user/userlist.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @Route("/createCharacter", name="characterCration")
     */
    public function createCharacterAction(Request $request){

        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $characters = $this->getDoctrine()
            ->getManager()
            ->createQuery('SELECT e FROM GameBundle:characters e WHERE e.user='.($usr->getId()))
            ->getResult();


        if(count($characters) == 3) {
            $this->addFlash(
                'error',
                'You already have 3 characters, you have to delete one first !'
            );

            return $this->redirectToRoute('characterReview');

        } else {

            $this->giveHourlyStamina();

            $usr= $this->get('security.token_storage')->getToken()->getUser();

            $newcharac = new characters;

            $form = $this->createFormBuilder($newcharac)
                ->add('name', TextType::class, array('attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px')))
                ->add('race', ChoiceType::class, array('choices' => array('Human' => 'Human', 'Troll' => 'Troll', 'Dwarf' => 'Dwarf', 'Elf' => 'Elf'), 'attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px')))
                ->add('class', ChoiceType::class, array('choices' => array('Thief' => 'Thief', 'Warrior' => 'Warrior', 'Mage' => 'Mage', 'Merchant' => 'Merchant'), 'attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px')))
                ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                //Get the data from the form
                $name = $form['name']->getData();
                $race = $form['race']->getData();
                $class = $form['class']->getData();
                //$now = new\DateTime('now');

                $newcharac->setUser($usr);
                $newcharac->setName($name);
                $newcharac->setRace($race);
                $newcharac->setClass($class);
                $newcharac->setLevel(1);
                $newcharac->setStory(10);

                $attack = 0;
                $life = 0;

                if($race == 'Human') {
                    $attack = 30;
                    $life = 10;
                } else if($race == 'Troll') {
                    $attack = 25;
                    $life = 15;
                } else if($race == 'Dwarf') {
                    $attack = 32;
                    $life = 11;
                } else if($race == 'Elf') {
                    $attack = 20;
                    $life = 12;
                } else {

                }

                if($class == 'Thief') {
                    $life += 2;
                } else if($class == 'Warrior') {
                    $attack += 5;
                } else if($class == 'Magician') {
                    $life -= 3;
                } else if($class == 'Merchant') {
                    $attack -= 3;
                } else {

                }

                $newcharac->setLife($life);
                $newcharac->setAttack($attack);

                $em = $this->getDoctrine()->getManager();
                $em->persist($newcharac);

                $em->flush();

                $this->addFlash(
                    'notice',
                    'Character Created !'
                );

                return $this->redirectToRoute('characterReview');

            }

            return $this->render('GameBundle:Characters:create.html.twig', array(
                'form' => $form->createView()
            ));

        }
    }

    /**
     * @Route("/seeCharacter", name="characterReview")
     */
    public function seeCharacterAction(Request $request)
    {

        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $characters = $this->getDoctrine()
            ->getManager()
            ->createQuery('SELECT e FROM GameBundle:characters e WHERE e.user='.($usr->getId()))
            ->getResult();

        return $this->render('GameBundle:Characters:displayCharacters.html.twig', array(
            'characters' => $characters,
            'user' => $usr
        ));
    }

    /**
     * @Route("/chooseChar/{id}", name="choose_character")
     */
    public function chooseCharacterAction($id, Request $request)
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $charac = $em->getRepository('GameBundle:characters')
            ->find($id);
        $usr->setCurrentCharacter($id);

        $em->persist($usr);
        $em->flush();

        $this->addFlash(
            'notice',
            'Character Selected as Primary'
        );
        return $this->redirectToRoute('characterReview');
    }

    /**
     * @Route("/deleteChar/{id}", name="delete_character")
     */
    public function deleteCharacterAction($id, Request $request)
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();


        $em = $this->getDoctrine()->getManager();
        $charac = $em->getRepository('GameBundle:characters')
            ->find($id);

        if($usr->getCurrentCharacter() == $id) {
            $usr->setCurrentCharacter(0);
        }

        $em->remove($charac);
        $em->flush();

        $this->addFlash(
            'notice',
            'Character deleted'
        );

        return $this->redirectToRoute('characterReview');
    }
}
