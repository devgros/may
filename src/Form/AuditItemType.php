<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\AuditItem;

class AuditItemType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
        $builder
            ->add('non_conformite')
            ->add('action_corrective')
            ->add('delai')
            ->add('reccurrence')
        ;
	    /*$builder->add('rayon', EntityType::class, array('class' => Rayon::class, 'label'=>'magasin.rayon', 'attr' => ['data-widget' => 'select2']));
	    $builder->add('zones', EntityType::class, array('class' => Zone::class, 'label'=>'magasin.zones', 'multiple'=>true, 'attr' => ['data-widget' => 'select2']));
	    $builder->setAttribute('group_field', $options['group_field']);
	    $builder->setAttribute('child_half_size', $options['child_half_size']);*/
	}

	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AuditItem::class,
        ));
    }
}