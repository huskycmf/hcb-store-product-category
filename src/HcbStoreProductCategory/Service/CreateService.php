<?php
namespace HcbStoreProductCategory\Service;

use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProductCategory\Entity\Category as CategoryEntity;
use HcCore\Service\CommandInterface;
use HcbStoreProductCategory\Stdlib\Service\Response\CreateResponse;

class CreateService implements CommandInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var CreateResponse
     */
    protected $createResponse;

    /**
     * @param EntityManagerInterface $entityManager
     * @param CreateResponse $createResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                CreateResponse $createResponse)
    {
        $this->entityManager = $entityManager;
        $this->createResponse = $createResponse;
    }

    /**
     * @return CreateResponse
     */
    public function execute()
    {
        try {
            $this->entityManager->beginTransaction();

            $categoryEntity = new CategoryEntity();
            $categoryEntity->setCreatedTimestamp(new \DateTime());

            $this->entityManager->persist($categoryEntity);

            $this->entityManager->flush();

            $this->createResponse->setResource($categoryEntity->getId());
            
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->createResponse->error($e->getMessage())->failed();
            return $this->createResponse;
        }

        $this->createResponse->success();
        return $this->createResponse;
    }
}
