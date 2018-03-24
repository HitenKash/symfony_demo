<?php
namespace DemoBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use DemoBundle\Entity\Employee;

class PostEmployee
{
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Employee) {
            return;
        }
        $entityManager = $args->getEntityManager();
        $dql = "Update employee set modified_date = NOW() where id =".$entity->getId();;
        $stmt = $entityManager->getConnection()->prepare($dql);
        $stmt->execute();
    }
}

