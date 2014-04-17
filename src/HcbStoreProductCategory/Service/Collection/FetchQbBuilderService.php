<?php
namespace HcbStoreProductCategory\Service\Collection;

use HcCore\Service\Fetch\Paginator\QueryBuilder\DataServiceInterface;
use HcCore\Service\Filtration\Query\FiltrationServiceInterface;
use HcCore\Service\Sorting\SortingServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Zend\Stdlib\Parameters;

class FetchQbBuilderService implements DataServiceInterface
{
    /**
     * @var SortingServiceInterface
     */
    protected $sortingService;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var FiltrationServiceInterface
     */
    protected $filtrationService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param SortingServiceInterface $sortingService
     */
    public function __construct(EntityManagerInterface $entityManager,
                                SortingServiceInterface $sortingService,
                                FiltrationServiceInterface $filtrationService)
    {
        $this->entityManager = $entityManager;
        $this->sortingService = $sortingService;
        $this->filtrationService = $filtrationService;
    }

    /**
     * @param Parameters $params
     * @return QueryBuilder
     */
    public function fetch(Parameters $params = null)
    {
        /* @var $qb QueryBuilder */
        $qb = $this->entityManager
                   ->getRepository('HcbStoreProductCategory\Entity\Category')
                   ->createQueryBuilder('c');

        $qb->select(array('c'))
           ->where('c.enabled = 1');

        if (is_null($params)) return $qb;

        return $this->filtrationService->apply($params,
                                               $this->sortingService->apply($params, $qb, 'c'),
                                               'c');
    }
}
