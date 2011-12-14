<?php
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
        $builder->add('name','text');
        $builder->add('mail','email');
        $builder->add('subject','text');
        $builder->add('body','textarea');
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
