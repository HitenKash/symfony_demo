<?php

namespace DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManager;

class EmployeeType extends AbstractType
{
    private $entityManager;
 
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dql = "SELECT c.id, c.name from DemoBundle:Department c ORDER BY c.name ASC";
        $results = $this->entityManager->createQuery($dql)->getArrayResult();
        $choices = array();
        foreach($results as $result) {
            if(isset($result['id']) && $result['id'] != ''){
                $choices[] = $result['name'];
            }
        }

        $builder->add('firstName','text',array(
        'attr' => array('class' => 'form-control'),
    ))
                ->add('lastName','text',array('attr' => array('class'=>'form-control')))
                ->add('address','text',array('attr' => array('class'=>'form-control')))
                ->add('dateOfJoining','date',array('attr' => array('class'=>'form-control')))
                ->add('department','choice',array(
                    'choices' => $choices,
                    'required' => false,
                    'label' => 'department',
                    'attr' => array('class'=>'form-control')
                ));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DemoBundle\Entity\Employee'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'demobundle_employee';
    }


}
