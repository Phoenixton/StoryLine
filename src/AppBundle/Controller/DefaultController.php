<?php

namespace AppBundle\Controller;

use GameBundle\Entity\characters;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use UserBundle\Entity\messages;
use UserBundle\Entity\user;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{
    public function giveDailyStamina(){

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
                } else if(new \DateTime($usr->getLastconnect()->format('Y-m-d')) < new \DateTime((new \DateTime("now"))->format('Y-m-d'))){

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

    public function performStaminaAction() {
        $em = $this->getDoctrine()->getManager();
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $usr->setStamina($usr->getStamina() - 10);
        $em->flush();
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $this->giveDailyStamina();

        return $this->render('AppBundle:HomePage:home.html.twig');

    }



    /**
     * @Route("/listofusers", name="listofusers")
     */
    public function showAllUserAction(){

        $em = $this->getDoctrine()->getManager();

        $this->giveDailyStamina();

        $users = $em->getRepository('UserBundle:user')->findAll();
        $currentUser = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('user/userlist.html.twig', array(
            'users' => $users,
            'currentUser' => $currentUser
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

            $this->giveDailyStamina();

            $usr= $this->get('security.token_storage')->getToken()->getUser();

            $newcharac = new characters;

            $form = $this->createFormBuilder($newcharac)
                ->add('name', TextType::class, array('attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px')))
                ->add('gender', ChoiceType::class, array('choices' => array('Male' => 'Male', 'Female' => 'Female'), 'attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px; height: auto;')))
                ->add('race', ChoiceType::class, array('choices' => array('Human' => 'Human', 'Troll' => 'Troll', 'Dwarf' => 'Dwarf', 'Elf' => 'Elf'), 'attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px; height: auto;')))
                ->add('class', ChoiceType::class, array('choices' => array('Thief' => 'Thief', 'Warrior' => 'Warrior', 'Mage' => 'Mage', 'Merchant' => 'Merchant'), 'attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px; height: auto;')))
                ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                //Get the data from the form
                $name = $form['name']->getData();
                $gender = $form['gender']->getData();
                $race = $form['race']->getData();
                $class = $form['class']->getData();
                //$now = new\DateTime('now');

                $newcharac->setUser($usr);
                $newcharac->setName($name);
                $newcharac->setGender($gender);
                $newcharac->setRace($race);
                $newcharac->setClass($class);
                $newcharac->setLevel(1);
                $newcharac->setStory(10);

                $attack = 0;
                $defense =0;
                $life = 0;

                if($race == 'Human') {
                    $attack = 30;
                    $defense = 15;
                    $life = 10;
                } else if($race == 'Troll') {
                    $attack = 25;
                    $defense = 18;
                    $life = 15;
                } else if($race == 'Dwarf') {
                    $attack = 32;
                    $defense = 20;
                    $life = 11;
                } else if($race == 'Elf') {
                    $attack = 20;
                    $defense = 11;
                    $life = 12;
                } else {

                }

                if($class == 'Thief') {
                    $life += 2;
                } else if($class == 'Warrior') {
                    $attack += 5;
                    $defense += 2;
                } else if($class == 'Magician') {
                    $life -= 3;
                } else if($class == 'Merchant') {
                    $attack -= 3;
                } else {

                }

                $newcharac->setLife($life);
                $newcharac->setAttack($attack);
                $newcharac->setDefense($defense);
                $newcharac->setRoomscompleted(0);
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

        $belongings = $this->getDoctrine()
            ->getManager()
            ->createQuery("SELECT b FROM GameBundle:belongs b JOIN GameBundle:objects e WITH e.id = b.object")
            ->getResult();


        $em = $this->getDoctrine()->getManager();

        $belongings = $em->getRepository('GameBundle:belongs')->findAll();
        $objects = $em->getRepository('GameBundle:objects')->findAll();

        return $this->render('GameBundle:Characters:displayCharacters.html.twig', array(
            'characters' => $characters,
            'belongings' => $belongings,
            'objects' => $objects,
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



        $query = $this->getDoctrine()->getManager()->createQuery("DELETE FROM GameBundle:belongs e WHERE e.character = '$id'");
        $query->execute();


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

    /**
     * @Route("/resetChar/{id}", name="reset_character")
     */
    public function resetCharacterAction($id, Request $request)
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $charac = $em->getRepository('GameBundle:characters')
            ->find($id);

        //deletes the character's belongings
        $query = $this->getDoctrine()->getManager()->createQuery("DELETE FROM GameBundle:belongs e WHERE e.character = '$id'");
        $query->execute();

        $attack = 0;
        $defense =0;
        $life = 0;

        if($charac->getRace() == 'Human') {
            $attack = 30;
            $defense = 15;
            $life = 10;
        } else if($charac->getRace() == 'Troll') {
            $attack = 25;
            $defense = 18;
            $life = 15;
        } else if($charac->getRace() == 'Dwarf') {
            $attack = 32;
            $defense = 20;
            $life = 11;
        } else if($charac->getRace() == 'Elf') {
            $attack = 20;
            $defense = 11;
            $life = 12;
        } else {

        }

        if($charac->getClass() == 'Thief') {
            $life += 2;
        } else if($charac->getClass() == 'Warrior') {
            $attack += 5;
            $defense += 2;
        } else if($charac->getClass() == 'Magician') {
            $life -= 3;
        } else if($charac->getClass() == 'Merchant') {
            $attack -= 3;
        } else {

        }

        $charac->setLife($life);
        $charac->setAttack($attack);
        $charac->setDefense($defense);
        $charac->setRoomscompleted(0);

        $em->persist($charac);
        $em->flush();

        $this->addFlash(
            'notice',
            'Reset of the character completed'
        );
        return $this->redirectToRoute('characterReview');


    }

    /**
     * Sends a message to another player
     *
     * @Route("/sendMessage/{id}", name="user_message")
     */
    public function messageAction($id, Request $request)
    {
        $this->giveDailyStamina();

        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $newmessage = new messages;

        $form = $this->createFormBuilder($newmessage)
            ->add('subject', TextType::class, array('attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('content', TextAreaType::class, array('attr' => array('autocomplete' => 'off', 'class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subject = $form['subject']->getData();
            $content = $form['content']->getData();
            $date = new\DateTime('now');

            $em = $this->getDoctrine()->getManager();
            $receiver = $em->getRepository('UserBundle:user')
                ->find($id);

            $newmessage->setSender($usr);
            $newmessage->setReceiver($receiver);
            $newmessage->setContent($content);
            $newmessage->setSubject($subject);
            $newmessage->setDate($date);

            $em->persist($newmessage);

            $em->flush();

            $this->addFlash(
                'notice',
                'Message Sent !'
            );

            return $this->redirectToRoute('listofusers');

        }

        return $this->render('user/createmessage.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/messagesReceived", name="displayMessagesReceived")
     */
    public function displayMessagesReceivedAction(Request $request)
    {

        $this->giveDailyStamina();
        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $messages = $this->getDoctrine()
            ->getManager()
            ->createQuery('SELECT e FROM UserBundle:messages e WHERE e.receiver='.($usr->getId()).' ORDER BY e.date')
            ->getResult();

        return $this->render('UserBundle:Messages:displayMessagesReceived.html.twig', array(
            'messages' => $messages,
            'user' => $usr
        ));
    }

    /**
     * @Route("/messagesSent", name="displayMessagesSent")
     */
    public function displayMessagesSentAction(Request $request)
    {

        $this->giveDailyStamina();
        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $messages = $this->getDoctrine()
            ->getManager()
            ->createQuery('SELECT e FROM UserBundle:messages e WHERE e.sender='.($usr->getId()).' ORDER BY e.date')
            ->getResult();

        return $this->render('UserBundle:Messages:displayMessagesSent.html.twig', array(
            'messages' => $messages,
            'user' => $usr
        ));
    }


    /**
     * @Route("/play", name="play")
     */
    public function playAction(Request $request) {

        $this->giveDailyStamina();
        $usr= $this->get('security.token_storage')->getToken()->getUser();


        if($usr->getCurrentCharacter() == 0) {

            $this->addFlash(
                'error',
                'You have to select a character !'
            );

            return $this->redirectToRoute('characterReview');
        }

        $em = $this->getDoctrine()->getManager();
        $charac = $em->getRepository('GameBundle:characters')
            ->find($usr->getCurrentCharacter());

        if($charac->getLife() <= 0) {
            $this->addFlash(
                'error',
                'You can\'t play with this character, leave the dead alone!'
            );

            return $this->redirectToRoute('characterReview');
        } else {


            $enemy_id = rand(1,2);
            $em = $this->getDoctrine()->getManager();
            $enemy = $em->getRepository('GameBundle:enemy')
                ->find($enemy_id);


            return $this->render('GameBundle:Default:play.html.twig', array(
                        'enemy' => $enemy,
                        'charac' => $charac
            ));
        }


    }

    /**
     * @Route("/fight/{id}", name="fight")
     */
    public function fightAction($id, Request $request) {


        $usr= $this->get('security.token_storage')->getToken()->getUser();

        if($usr->getStamina() < 10) {
            $this->addFlash(
                'error',
                'You don\'t have enough Stamina to fight !'
            );
            return $this->redirectToRoute('play');

        } else {

            $em = $this->getDoctrine()->getManager();
            $this->performStaminaAction();
            $enemy = $em->getRepository('GameBundle:enemy')
                ->find($id);
            $charac = $em->getRepository('GameBundle:characters')
                ->find($usr->getCurrentCharacter());

            $damagesTaken = 0;
            $lifeToDefeat = $enemy->getLife();
            $log = "";

            while(($charac->getLife() - $damagesTaken) > 0) {

                $lifeToDefeat -= ($charac->getAttack() - $enemy->getDefense());
                $log .= "Le perso a tape pour ".($charac->getAttack() - $enemy->getDefense()).", ";
                if($lifeToDefeat <= 0) {
                    break;
                }
                $damagesTaken += $enemy->getAttack();
                $log .= "L'enemy a tape pour ".($enemy->getAttack()).", ";

            }

            if($damagesTaken >= $charac->getLife()) {

                $charac->setLife(0);
                $em->persist($charac);
                $em->flush();

                $this->addFlash(
                    'error',
                    'You died! Better luck next time! \n '. $log
                );

                return $this->redirectToRoute('characterReview');

            } else if ($lifeToDefeat <=0){

                $charac->setLife($charac->getLife() - $damagesTaken);
                $charac->setRoomscompleted($charac->getRoomscompleted() + 1);

                $em->persist($charac);

                $em->flush();
                //objets


            }

            $this->addFlash(
                'notice',
                'You Succeeded! Well Played!'.$log
            );
            return $this->redirectToRoute('play');

        }

    }

    /**
     * @Route("/inventory/{id}", name="inventory")
     */
    public function displayInventoryOfCharacterAction($id, Request $request)
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $charac = $em->getRepository('GameBundle:characters')
            ->find($usr->getCurrentCharacter());

        $id = $charac->getId();
//
//        $inventory = $this->getDoctrine()
//            ->getManager()
//            ->createQuery("SELECT e FROM GameBundle:belongs b JOIN GameBundle:objects e WITH e.id = b.object WHERE b.character='$id'")
//            ->getResult();

        $belongings = $em->getRepository('GameBundle:belongs')->findAll();

        $list = $em->getRepository('GameBundle:objects')->findAll();
        $number = count($belongings);

        return $this->render('GameBundle:Characters:inventory.html.twig', array(
            'charac' => $charac,
            'belongings' => $belongings,
            'list' => $list,
            'number' => $number
        ));
    }


    /**
     *
     * @Route("/useObject/{id}", name="useObject")
     */
    public function useObjectAction($id, Request $request) {


        $em = $this->getDoctrine()->getManager();
        //remove the object from inventory
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $characId = $usr->getCurrentCharacter();

        $query = $this->getDoctrine()
            ->getManager()
            ->createQuery("SELECT e FROM GameBundle:belongs e WHERE e.character = '$characId' AND e.object='$id'")
            ->getResult();


        //use the object
        $charac = $em->getRepository('GameBundle:characters')
            ->find($usr->getCurrentCharacter());

        $object = $em->getRepository('GameBundle:objects')
            ->find($query[0]->getObject());


        $newLife = $charac->getLife() + $object->getLifeBonus();
        $newAttack = $charac->getAttack() + $object->getAttackBonus();
        $newDefense = $charac->getDefense() + $object->getDefenseBonus();
        $charac->setLife($newLife);
        $charac->setAttack($newAttack);
        $charac->setDefense($newDefense);

        $em->persist($charac);

        //remove it from the inventory
        $em->remove($query[0]);
        $em->flush();




        $this->addFlash(
            'notice',
            'You used the object'
        );
        return $this->redirectToRoute('inventory', array('id' => $characId));

    }

    /**
     *
     * @Route("/deleteObject/{id}", name="deleteObject")
     */
    public function deleteObjectAction($id, Request $request) {


        $em = $this->getDoctrine()->getManager();
        //remove the object from inventory
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        $characId = $usr->getCurrentCharacter();

        $query = $this->getDoctrine()
            ->getManager()
            ->createQuery("SELECT e FROM GameBundle:belongs e WHERE e.character = '$characId' AND e.object='$id'")
            ->getResult();

        //remove it from the inventory
        $em->remove($query[0]);
        $em->flush();


        $this->addFlash(
            'notice',
            'You deleted the object'
        );
        return $this->redirectToRoute('inventory', array('id' => $characId));

    }

}
