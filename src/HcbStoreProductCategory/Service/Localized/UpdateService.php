<?php
namespace HcbStoreProductCategory\Service\Localized;

use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProductCategory\Entity\Category\Alias as CategoryAliasEntity;
use HcBackend\Service\Alias\AliasBinderServiceInterface;
use HcbStoreProductCategory\Entity\Category\Localized\Page as PageEntity;
use HcBackend\Service\PageBinderServiceInterface;
use HcbStoreProductCategory\Data\LocalizedInterface;
use HcbStoreProductCategory\Entity\Category\Localized as LocalizedEntity;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class UpdateService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var Response
     */
    protected $saveResponse;

    /**
     * @var PageBinderServiceInterface
     */
    protected $pageBinderService;

    /**
     * @var AliasBinderServiceInterface
     */
    protected $aliasBinderService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param PageBinderServiceInterface $pageBinderService
     * @param AliasBinderServiceInterface $aliasBinderService
     * @param Response $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                PageBinderServiceInterface $pageBinderService,
                                AliasBinderServiceInterface $aliasBinderService,
                                Response $saveResponse)
    {
        $this->entityManager = $entityManager;
        $this->saveResponse = $saveResponse;
        $this->pageBinderService = $pageBinderService;
        $this->aliasBinderService = $aliasBinderService;
    }

    /**
     * @param LocalizedEntity $localizedEntity
     * @param LocalizedInterface $localizedData
     *
     * @return Response
     */
    public function update(LocalizedEntity $localizedEntity,
                           LocalizedInterface $localizedData)
    {
        try {
            $this->entityManager->beginTransaction();

            $categoryEntity = $localizedEntity->getCategory();

            $localizedEntity->setTitle($localizedData->getTitle());
            $categoryEntity->setPriority($localizedData->getPrio());

            $categoryAliasEntity = new CategoryAliasEntity();
            $this->aliasBinderService->bind($localizedData,
                                            $categoryEntity,
                                            $categoryAliasEntity);

            $categoryAliasEntity->setCategory($categoryEntity);
            $categoryAliasEntity->setIsPrimary(true);
            $this->entityManager->persist($categoryAliasEntity);

            $categoryEntity->setEnabled(true);

            $this->pageBinderService->bind($localizedData,
                                            $localizedEntity,
                                            'HcbStoreProductCategory\Entity\Category\Localized\Page');

            if (is_null($localizedEntity->getPage())) {
                $pageEntity = new PageEntity();
                $localizedEntity->setPage($pageEntity);
                $pageEntity->setLocalized($localizedEntity);
            } else {
                $localizedEntity->getPage()->setLocalized($localizedEntity);
            }

            $localizedEntity->getPage()->setUrl(null);
            $localizedEntity->getPage()->setContent($localizedData->getMetaContent());

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->saveResponse->error($e->getMessage())->failed();
            return $this->saveResponse;
        }

        $this->saveResponse->success();
        return $this->saveResponse;
    }
}
