<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
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
                } else if(new \DateTime($usr->getLastconnect()->format('Y-m-d H:i:s')) < new \DateTime((new \DateTime("now"))->format('Y-m-d H:i:s'))){

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

        return $this->render('AppBundle:HomePage:home.html.twig');

    }

}
