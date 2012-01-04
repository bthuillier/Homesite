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
        $builder->add('description','textarea');
        $builder->add('body','textarea');
        $builder->add('isActive','checkbox', array('required' => false));
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
