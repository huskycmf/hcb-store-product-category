<?php
namespace HcbStoreProductCategory\Service\Localized\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProductCategory\Entity\Category as CategoryEntity;
use HcCore\Service\Fetch\Paginator\ArrayCollection\ResourceDataServiceInterface;
use HcCore\Service\Filtration\Query\FiltrationServiceInterface;
use HcbStoreProduct\Service\Exception\InvalidResourceException;
use Zend\Stdlib\Parameters;

class FetchArrayCollectionService implements ResourceDataServiceInterface
{
    /**
     * @var FiltrationServiceInterface
     */
    protected $filtrationService;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @param FiltrationServiceInterface $filtrationService
     */
    public function __construct(EntityManagerInterface $entityManager,
                                FiltrationServiceInterface $filtrationService)
    {
        $this->entityManager = $entityManager;
        $this->filtrationService = $filtrationService;
    }

    /**
     * @param CategoryEntity $categoryEntity
     * @param Parameters $params
     *
     * @return ArrayCollection
     * @throws InvalidResourceException
     */
    public function fetch($categoryEntity, Parameters $params = null)
    {
        if (!$categoryEntity instanceof CategoryEntity) {
            throw new InvalidResourceException('categoryEntity must be compatible with type HcbStoreProductCategory\Entity\Category');
        }

        /* @var $localizedRepository \Doctrine\ORM\EntityRepository */
        $localizedRepository = $this->entityManager
                                    ->getRepository('HcbStoreProductCategory\Entity\Category\Localized');

        $qb = $localizedRepository->createQueryBuilder('l');

        $qb->join('l.locale', 'locale')
           ->where('l.category = :category');

        $qb->setParameter('category', $categoryEntity);

        if (is_null($params)) {
            $result = $qb->getQuery()->getResult();
        } else {
            $result = $this->filtrationService
                           ->apply($params, $qb, 'l', array('lang'=>'locale.locale'))
                           ->getQuery()->getResult();
        }

        if (!count($result)) {
            $result[0] = new CategoryEntity\Localized();
            $result[0]->setCategory($categoryEntity);
        }

        return new ArrayCollection($result);
    }
}
