<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 27/08/2017
 * Time: 21:48
 */

namespace AppBundle\Event;


use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ComptePasswordForgotEvent extends Event
{
    private $email;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}