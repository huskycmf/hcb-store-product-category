<?php
namespace HcbStoreProductCategory\Entity\Category;

use HcBackend\Entity\AliasWiredInterface;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Alias
 *
 * @ORM\Table(name="store_product_category_has_alias")
 * @ORM\Entity
 */
class Alias implements EntityInterface, AliasWiredInterface
{
    /**
     * @var \HcbStoreProduct\Entity\Product\Alias
     *
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="\HcBackend\Entity\Alias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alias_id", referencedColumnName="id")
     * })
     */
    private $alias;

    /**
     * @var \HcbStoreProductCategory\Entity\Category
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="\HcbStoreProductCategory\Entity\Category", inversedBy="alias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_product_category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_primary", type="boolean", nullable=true)
     */
    private $isPrimary;

    /**
     * Set isPrimary
     *
     * @param boolean $isPrimary
     * @return Alias
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;

        return $this;
    }

    /**
     * Get isPrimary
     *
     * @return boolean 
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * Set alias
     *
     * @param \HcBackend\Entity\Alias $alias
     * @return Alias
     */
    public function setAlias(\HcBackend\Entity\Alias $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return \HcBackend\Entity\Alias 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set category
     *
     * @param \HcbStoreProductCategory\Entity\Category $category
     * @return Alias
     */
    public function setCategory(\HcbStoreProductCategory\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \HcbStoreProductCategory\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
