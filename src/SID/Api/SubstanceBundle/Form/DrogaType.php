<?php

namespace SID\Api\SubstanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DrogaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('desechos')->add('fichaSeguridad')->add('tipoMedida')->add('cid')->add('nombre')->add('formulaMolecular')->add('fechaIngreso')->add('densidad')->add('accionesEmergencia')->add('cas')->add('smiles')->add('recAlm')->add('clases')->add('ghs')->add('entidades')->add('sinonimos');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SID\Api\SubstanceBundle\Entity\Droga'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sid_api_substancebundle_droga';
    }


}
