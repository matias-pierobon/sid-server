<?php

namespace SID\Api\DrugBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('marca')->add('numeroEvnase')->add('fechaVencimiento')->add('lote')->add('pesoBrutoActual')->add('imagen')->add('imageMime')->add('pesoBruto')->add('numeroProducto')->add('cantidad')->add('fechaIngreso')->add('stockActual')->add('division')->add('droga');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SID\Api\DrugBundle\Entity\Stock'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sid_api_drugbundle_stock';
    }


}
