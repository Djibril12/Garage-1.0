<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;




class UserType extends AbstractType
{


    private $requestStack;

    public function __construct(\Symfony\Component\HttpFoundation\RequestStack $requestStack) {

        $this->requestStack = $requestStack;
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('username')
                ->add('password', PasswordType::class)
                ->add('email')
                ->add('isActive',  CheckboxType::class, array(
                    'label'    => 'Actif',
                    'required' => false,
                ))
                ->add('address')
                ->add('phone')
                ->add('city')
                ->add('country')
                ->add('zipcode')
                //->add('save', SubmitType::class);
                ->add('roles' , EntityType::class, array(
                    'class'            => 'AppBundle:Role',
                    'choice_label' => 'name',
                    'multiple'     => true,
                ));
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event){
            $user = $event->getData();
            $formUser = $event->getForm();


            //dump($user ,$user->getRoles());
            $request = $this->requestStack->getCurrentRequest();

            // completer son profil
            if($user->getId()){

                $formUser
                    ->remove('username')
                    ->remove('password')
                    ->remove('isActive')
                    ->remove('roles')
                    ->remove('email');
            }
            elseif($request->attributes->get('_route')=='app.admin.user.add')
            {
                $formUser->all();

            }
            else
            {
                $formUser
                    ->remove('address')
                    ->remove('phone')
                    ->remove('city')
                    ->remove('country')
                    ->remove('isActive')
                    ->remove('roles')
                    ->remove('zipcode');
            }


        });
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
