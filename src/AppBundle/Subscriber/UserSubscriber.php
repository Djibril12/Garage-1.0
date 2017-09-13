<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 27/08/2017
 * Time: 22:00
 */

namespace AppBundle\Subscriber;


use AppBundle\Event\CompteEvents;
use AppBundle\Event\ComptePasswordForgotEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
{

    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
       $this->mailer = $mailer;
       $this->twig = $twig;
    }


    public static function getSubscribedEvents()
    {
        return [
             CompteEvents::PASSWORD_FORGOT => 'passwordForgot',
             CompteEvents::PASSWORD_CHANGE => 'passwordChange'
        ];
    }


    public function passwordForgot(ComptePasswordForgotEvent $event)
    {

        $message = (new \Swift_Message('Oubli de mot de passe'))
            ->setFrom('admin@garage.com')
            ->setTo($event->getEmail())
            ->setBody($this->twig->render(
            // app/Resources/views/Emails/registration.html.twig
                'emails/oubli-mot-passe.html.twig'
            ),
                'text/html');

        // envoi du mail
        $this->mailer->send($message);

    }


    public function passwordChange()
    {

    }

}