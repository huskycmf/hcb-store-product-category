<?php
namespace HcbStoreProductCategory\Data;

use HcBackend\Data\AliasInterface;
use HcBackend\Data\PageInterface;
use HcCore\Data\LocaleInterface;

interface LocalizedInterface extends LocaleInterface, PageInterface, AliasInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getAlias();

    /**
     * @return string
     */
    public function getMetaContent();

    /**
     * @return number
     */
    public function getPrio();
}
