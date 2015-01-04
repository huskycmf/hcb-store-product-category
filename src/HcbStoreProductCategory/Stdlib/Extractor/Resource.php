<?php
namespace HcbStoreProductCategory\Stdlib\Extractor;

use Doctrine\ORM\EntityManager;
use HcBackend\Service\Alias\DetectAlias;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;

use HcbStoreProductCategory\Entity\Category as CategoryEntity;
use HcbStoreProductCategory\Entity\Category\Localized as CategoryLocalizedEntity;

class Resource implements ExtractorInterface
{
    /**
     * @var DetectAlias
     */
    protected $detectAlias;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param DetectAlias $detectAlias
     * @param EntityManager $entityManager
     */
    public function __construct(DetectAlias $detectAlias,
                                EntityManager $entityManager)
    {
        $this->detectAlias = $detectAlias;
        $this->entityManager = $entityManager;
    }

    /**
     * Extract values from an object
     *
     * @param  CategoryEntity $category
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($category)
    {
        if (!$category instanceof CategoryEntity) {
            throw new InvalidArgumentException("Expected HcbStoreProductCategory\\Entity\\Category object, invalid object given");
        }

        /* @var $localizedEntity CategoryLocalizedEntity */
        $localizedEntity = $category->getLocalized()->current();
        $title = '__EMPTY__';

        if (!empty($localizedEntity)) {
            $title = $localizedEntity->getTitle();
        }

        return array('id'=>$category->getId(),
                     'title'=>$title,
                     'timestamp'=>$category->getCreatedTimestamp());
    }
}
