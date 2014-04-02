<?php
namespace HcbStoreProductCategory\Entity\Category\Localized;

use Doctrine\ORM\Mapping as ORM;
use HcBackend\Entity\MappedPage;
use HcbStoreProductCategory\Entity\Category\Localized;
use HcCore\Entity\EntityInterface;

/**
 * Page
 *
 * @ORM\Table(name="store_product_category_localized_page")
 * @ORM\Entity
 */
class Page extends MappedPage implements EntityInterface
{
    /**
     * @var Localized
     *
     * @ORM\OneToOne(targetEntity="HcbStoreProductCategory\Entity\Category\Localized", inversedBy="page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_product_category_localized_id", referencedColumnName="id")
     * })
     */
    protected $localized;

    /**
     * Set localized
     *
     * @param \HcbStoreProductCategory\Entity\Category\Localized $localized
     * @return Page
     */
    public function setLocalized(\HcbStoreProductCategory\Entity\Category\Localized $localized = null)
    {
        $this->localized = $localized;

        return $this;
    }

    /**
     * Get localized
     *
     * @return \HcbStoreProductCategory\Entity\Category\Localized
     */
    public function getLocalized()
    {
        return $this->localized;
    }
}
