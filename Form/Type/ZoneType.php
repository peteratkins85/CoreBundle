<?php

namespace App\Oni\CoreBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Oni\CoreBundle\Entity\Country;
use App\Oni\CoreBundle\Entity\Zone;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZoneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('zoneName', TextType::class)
            ->add('countries', EntityType::class,[
                'attr' => [],
                'class'        => Country::class,
                'choice_label' => 'name',
                'expanded'     => true,
                'multiple'     => true,
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Zone::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oni_corebundle_zone';
    }


}
