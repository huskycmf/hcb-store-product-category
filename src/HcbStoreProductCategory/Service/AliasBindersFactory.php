<?php
namespace HcbStoreProductCategory\Service;

use HcBackend\Entity\AliasBindInterface;
use HcBackend\Service\Alias\AliasBindersFactoryInterface;
use HcbStoreProductCategory\Entity\Category\Alias;

class AliasBindersFactory implements AliasBindersFactoryInterface
{
    /**
     * @return AliasBindInterface
     */
    public function create()
    {
        return new Alias();
    }

}
