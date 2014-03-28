<?php
namespace HcbStoreProductCategory\Entity;

use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="store_product_category")
 * @ORM\Entity
 */
class Category implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority = 0;

    /**
     * @var Category\Localized
     *
     * @ORM\OneToMany(targetEntity="HcbStoreProductCategory\Entity\Category\Localized", mappedBy="category")
     * @ORM\OrderBy({"updatedTimestamp" = "DESC"})
     */
    private $localized = null;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcbStoreProduct\Entity\Product", cascade={"persist"})
     * @ORM\JoinTable(name="store_product_category_has_store_product",
     *   joinColumns={
     *     @ORM\JoinColumn(name="store_product_category_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     *   }
     * )
     */
    private $product;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;
}
