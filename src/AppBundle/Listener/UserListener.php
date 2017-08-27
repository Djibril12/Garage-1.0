<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 22/08/2017
 * Time: 20:39
 */

namespace AppBundle\Listener;



use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserListener
{

    private $doctrine;
    private $encoderUserPasswordService;

    public function  __construct(UserPasswordEncoderInterface $encoderUserPasswordService, ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->encoderUserPasswordService = $encoderUserPasswordService;
    }

    public function prePersist(User $user, LifecycleEventArgs $event)
    {
        // encodage du password
        $encodedPassword = $this->encoderUserPasswordService->encodePassword($user, $user->getPassword());
        //
        $user->setPassword($encodedPassword);

        // récupération d'un rôle
        $role = $this->doctrine->getRepository(Role::class)->findOneBy(['name' => 'ROLE_USER']);

        // attribution du rôle utilisateur
        $user->addRole($role);

    }

}