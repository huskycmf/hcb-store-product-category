<?php
namespace HcbStoreProductCategory\Stdlib\Extractor\Localized;

use HcBackend\Service\Alias\DetectAlias;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbStoreProductCategory\Entity\Category\Localized as LocalizedEntity;
use HcBackend\Stdlib\Extractor\Page\Extractor as PageExtractor;

class Resource implements ExtractorInterface
{
    /**
     * @var PageExtractor
     */
    protected  $pageExtractor;

    /**
     * @var DetectAlias
     */
    protected $detectAlias;

    /**
     * @param PageExtractor $pageExtractor
     */
    public function __construct(PageExtractor $pageExtractor,
                                DetectAlias $detectAlias)
    {
        $this->pageExtractor = $pageExtractor;
        $this->detectAlias = $detectAlias;
    }

    /**
     * Extract values from an object
     *
     * @param  LocalizedEntity $localizedEntity
     *
     * @throws InvalidArgumentException
     * @return array
     */
    public function extract( $localizedEntity)
    {
        if ( ! $localizedEntity instanceof LocalizedEntity) {
            throw new InvalidArgumentException
                        ("Expected HcbStoreProductCategory\\Entity\\Category\\Localized object,
                          invalid object given");
        }

        $aliasWireEntity = $this->detectAlias
                                ->detect( $localizedEntity->getCategory());


        $localData = array('id'=> $localizedEntity->getId(),
                           'locale'=> ($localizedEntity->getLocale() ? $localizedEntity->getLocale()->getLocale() : ''),
                           'alias'=>(is_null($aliasWireEntity) ? '' :
                                     $aliasWireEntity->getAlias()->getName()),
                           'title'=> $localizedEntity->getTitle(),
                           'prio'=> $localizedEntity->getCategory()->getPriority());

        if (($pageEntity = $localizedEntity->getPage())) {
            $localData = array_merge($localData, $this->pageExtractor->extract($pageEntity));
            $localData['pageContent'] = $pageEntity->getContent();
        }

        return $localData;
    }
}
