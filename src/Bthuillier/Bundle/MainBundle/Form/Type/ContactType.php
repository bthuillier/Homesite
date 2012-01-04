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
 * Description of ContactType
 *
 * @author bthuillier
 */
class ContactType extends AbstractType {
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name','text',array('label'=> 'Votre Nom'));
        $builder->add('mail','email',array('label'=> 'Votre Adresse Email'));
        $builder->add('subject','text',array('label'=> 'Le Sujet De Votre Mail'));
        $builder->add('body','textarea',array('label'=> 'Votre message'));
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Bthuillier\Bundle\MainBundle\Contact\Contact'
        );
    }

    public function getName()
    {
        return 'contact';
    }        
}
