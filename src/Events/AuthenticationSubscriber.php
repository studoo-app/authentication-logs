<?php

namespace App\Events;

use App\Service\LogAuditService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class AuthenticationSubscriber implements EventSubscriberInterface
{


    public function __construct(
        private readonly LogAuditService $service
    )
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            LoginSuccessEvent::class =>"onLoginSuccess",
            LoginFailureEvent::class =>"onLoginFailure"
        ];
    }

    public function onLoginSuccess(LoginSuccessEvent $event): void
    {
        $this->service->logSuccess($event->getUser()->getUserIdentifier(),$event->getRequest()->getClientIp());
    }

    public function onLoginFailure(LoginFailureEvent $event): void
    {

        $identifier = $event->getException()->getPrevious() instanceof UserNotFoundException
            ? "Unregistered User"
            : $event->getPassport()->getUser()->getUserIdentifier() ;

        $this->service->logFailure(
            $identifier,
            $event->getException()->getMessage(),
            $event->getRequest()->getClientIp(),
        );

    }




}