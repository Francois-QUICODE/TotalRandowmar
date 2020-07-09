<?php

namespace App\Form;

use App\Entity\Dlc;
use App\Entity\Lord;
use App\Entity\Race;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('faction')
            ->add('portrait')
            ->add('dlc', EntityType::class, [
                'class' => Dlc::class,
                'multiple' => false,
                'group_by' => function (Dlc $dlc)
                {
                    return $dlc->getGame();
                }

            ])
            ->add('race', EntityType::class, [
                'class' => Race::class,
                'multiple' => false,
                'group_by' => function (Race $race)
                {
                    return $race->getDlc()->getGame() ." - ". $race->getDlc();
                }

            ])
            ->add('campaign', null, [
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('effects')
            ->add('startingUnits');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lord::class,
        ]);
    }
}
