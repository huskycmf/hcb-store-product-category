<?php
namespace HcbStoreProductCategory\Service\Localized;

use HcbStoreProductCategory\Service\LocaleBinderService;
use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProductCategory\Data\LocalizedInterface;
use HcbStoreProductCategory\Entity\Category as CategoryEntity;
use HcbStoreProductCategory\Stdlib\Service\Response\CreateResponse;

class CreateService
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
     * @var LocaleBinderService
     */
    protected $localeBinderService;

    /**
     * @var UpdateService
     */
    protected $updateService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param LocaleBinderService $localeService
     * @param UpdateService $updateService
     * @param CreateResponse $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                LocaleBinderService $localeBinderService,
                                UpdateService $updateService,
                                CreateResponse $saveResponse)
    {
        $this->localeBinderService = $localeBinderService;
        $this->updateService = $updateService;
        $this->entityManager = $entityManager;
        $this->createResponse = $saveResponse;
    }

    /**
     * @param CategoryEntity $categoryEntity
     * @param LocalizedInterface $localizedData
     *
     * @return CreateResponse
     */
    public function save(CategoryEntity $categoryEntity, LocalizedInterface $localizedData)
    {
        try {
            $this->entityManager->beginTransaction();

            $localizedEntity = new CategoryEntity\Localized();
            $localizedEntity->setCategory($categoryEntity);

            $response = $this->localeBinderService
                             ->bind($localizedData, $localizedEntity);

            if ($response->isFailed()) {
                return $response;
            }

            $response = $this->updateService->update($localizedEntity, $localizedData);

            if ($response->isFailed()) {
                return $response;
            }

            $this->entityManager->flush();

            $this->createResponse->setResource($localizedEntity->getId());
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
