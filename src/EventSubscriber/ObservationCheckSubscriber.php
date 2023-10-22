<?php

namespace App\EventSubscriber;

use App\Entity\Observation;
use App\Service\IslandVerificationService;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;
use Doctrine\Common\EventSubscriber;

class ObservationCheckSubscriber implements EventSubscriber
{
    private IslandVerificationService $islandVerificationService;
    private LoggerInterface $logger;

    public function __construct(
        IslandVerificationService $islandVerificationService,
        LoggerInterface $logger
    )
    {
        $this->islandVerificationService = $islandVerificationService;
        $this->logger = $logger;
    }

    public function prePersist(LifecycleEventArgs $event): void
    {
        $entity = $event->getObject();
        $this->logger->info('Creation of a current observation sheet');

        if ($entity instanceof Observation) {
            $island = $entity->getIsland();
            $result = $this->islandVerificationService->verifyIslandId($island);

            if ($result === null) {
                throw new \Exception("The island was not found.");
            }
        }
    }

    public function getSubscribedEvents(): array
    {
        return [Events::prePersist];
    }
}
