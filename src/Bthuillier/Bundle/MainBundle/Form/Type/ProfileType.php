<?php

namespace Bthuillier\Bundle\MainBundle\Form\Type;
use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

/**
 * Description of RegistrationType
 *
 * @author bthuillier
 */
class ProfileType extends BaseType{
     public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);
        // add your custom field
        $builder->add('firstname');
    }

    public function getName()
    {
        return 'main_user_profile';
    }   
}
