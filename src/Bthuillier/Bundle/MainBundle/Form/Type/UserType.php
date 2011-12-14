<?php

namespace Bthuillier\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Description of UserTYPE
 *
 * @author bthuillier
 */
class UserType Extends AbstractType{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('fullname');
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Bthuillier\Bundle\MainBundle\Document\User'
        );
    }

    public function getName()
    {
        return 'user';
    }        
}
