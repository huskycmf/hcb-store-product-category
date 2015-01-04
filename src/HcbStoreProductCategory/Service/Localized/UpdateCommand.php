<?php
namespace HcbStoreProductCategory\Service\Localized;

use HcCore\Entity\EntityInterface;
use HcCore\Service\ResourceCommandInterface;
use HcbStoreProductCategory\Data\LocalizedInterface;
use HcbStoreProductCategory\Entity\Category\Localized as LocalizedEntity;
use Zf2Libs\Stdlib\Service\Response\Messages\ResponseInterface;

class UpdateCommand implements ResourceCommandInterface
{
    /**
     * @var LocalizedInterface
     */
    protected $localizedData;

    /**
     * @var UpdateService
     */
    protected $service;

    public function __construct(LocalizedInterface $localizedData,
                                UpdateService $service)
    {
        $this->localizedData = $localizedData;
        $this->service = $service;
    }

    /**
     * @param EntityInterface|LocalizedEntity $faqLocalizedEntity
     *
     * @return ResponseInterface
     */
    public function execute(EntityInterface $faqLocalizedEntity)
    {
        return $this->service->update($faqLocalizedEntity, $this->localizedData);
    }
}
