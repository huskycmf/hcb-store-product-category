<?php
namespace HcbStoreProductCategory\Service\Localized;

use HcCore\Entity\EntityInterface;
use HcCore\Service\ResourceCommandInterface;
use HcbStoreProductCategory\Data\LocalizedInterface;
use HcbStoreProductCategory\Entity\Category as CategoryEntity;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class CreateCommand implements ResourceCommandInterface
{
    /**
     * @var LocalizedInterface
     */
    protected $localizedData;

    /**
     * @var CreateService
     */
    protected $service;

    /**
     * @param LocalizedInterface $localizedData
     * @param CreateService $service
     */
    public function __construct(LocalizedInterface $localizedData,
                                CreateService $service)
    {
        $this->localizedData = $localizedData;
        $this->service = $service;
    }

    /**
     * @param CategoryEntity $categoryEntity
     *
     * @return Response
     */
    public function execute(EntityInterface $categoryEntity)
    {
        return $this->service->save($categoryEntity, $this->localizedData);
    }
}
