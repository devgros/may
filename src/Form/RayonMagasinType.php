<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Rayon;
use App\Entity\Zone;

class RayonMagasinType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
	    $builder->add('rayon', EntityType::class, array('class' => Rayon::class, 'label'=>'magasin.rayon', 'attr' => ['data-widget' => 'select2']));
	    $builder->add('zones', EntityType::class, array('class' => Zone::class, 'label'=>'magasin.zones', 'multiple'=>true, 'attr' => ['data-widget' => 'select2']));
	    $builder->setAttribute('group_field', $options['group_field']);
	    $builder->setAttribute('child_half_size', $options['child_half_size']);
	}

	public function buildView(FormView $view, FormInterface $form, array $options) {

        $view->vars['group_field'] = $options['group_field'];
        $view->vars['child_half_size'] = $options['child_half_size'];
    }

	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\RayonsMagasin',
            'group_field' => true,
            'child_half_size' => true,
        ));
    }
}