<?php

namespace AppBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {


        $session = $request->getSession();

        //I am choosing to set a FlashBag message with my own custom message.
        //Alternatively, you could use AuthenticaionException's generic message
        //by calling $authException->getMessage()
        $session->getFlashBag()->add('warning', 'You don\'t have the rights to access this page');

//        $this->addFlash(
//            'error',
//            'You already have 3 characters, you have to delete one first !'
//        );
//
//        return new Response($content, 403);
    }
}