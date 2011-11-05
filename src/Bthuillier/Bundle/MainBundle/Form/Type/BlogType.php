<?php

namespace Bthuillier\Bundle\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
/**
 * Description of BlogType
 *
 * @author bthuillier
 */
class BlogType extends AbstractType{
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('title');
        $builder->add('body');
        $builder->add('isActive');
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Bthuillier\Bundle\MainBundle\Document\Blog'
        );
    }

    public function getName()
    {
        return 'blog';
    }    
}
