<?php
/*
 * This file is part of the Homesite project.
 *
 * (c) Benjamin Thuillier <http://blog.bthuillier.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
        $builder->add('fullname');
    }

    public function getName()
    {
        return 'main_user_profile';
    }   
}
