<?php

namespace App\Controller;

use App\Service\LogAuditService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\TooManyLoginAttemptsAuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{


    public function __construct(
        private readonly LogAuditService $auditService
    )
    {
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(Request $request,AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('target_path');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

//        if($error){
//            $message = $error instanceof TooManyLoginAttemptsAuthenticationException
//                ? "Too many login attempts"
//                : $error->getMessage();
//
//           $this->auditService->logFailure($lastUsername,$message,$request->getClientIp());
//        }

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
