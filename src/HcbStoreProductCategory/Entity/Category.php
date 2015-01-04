<?php
namespace HcbStoreProductCategory\Entity;

use HcBackend\Entity\AliasBindAwareInterface;
use HcBackend\Entity\AliasBindInterface;
use HcBackend\Entity\AliasWiredAwareInterface;
use HcBackend\Entity\LocalizedInterface;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="store_product_category")
 * @ORM\Entity
 */
class Category implements EntityInterface, LocalizedInterface,
                          AliasWiredAwareInterface, AliasBindAwareInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    protected $enabled = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    protected $priority = 0;

    /**
     * @var Category\Localized
     *
     * @ORM\OneToMany(targetEntity="HcbStoreProductCategory\Entity\Category\Localized", mappedBy="category")
     */
    protected $localized = null;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="HcbStoreProduct\Entity\Product", cascade={"persist"})
     * @ORM\JoinTable(name="store_product_category_has_product",
     *   joinColumns={
     *     @ORM\JoinColumn(name="store_product_category_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="store_product_id", referencedColumnName="id")
     *   }
     * )
     */
    protected $product;

    /**
     * @var \HcbStoreProductCategory\Entity\Category\Alias
     *
     * @ORM\OneToMany(targetEntity="HcbStoreProductCategory\Entity\Category\Alias", mappedBy="category")
     */
    private $alias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    protected $createdTimestamp;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Category
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return Category
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set createdTimestamp
     *
     * @param \DateTime $createdTimestamp
     * @return Category
     */
    public function setCreatedTimestamp($createdTimestamp)
    {
        $this->createdTimestamp = $createdTimestamp;

        return $this;
    }

    /**
     * Get createdTimestamp
     *
     * @return \DateTime 
     */
    public function getCreatedTimestamp()
    {
        return $this->createdTimestamp;
    }

    /**
     * Add localized
     *
     * @param \HcbStoreProductCategory\Entity\Category\Localized $localized
     * @return Category
     */
    public function addLocalized(\HcbStoreProductCategory\Entity\Category\Localized $localized)
    {
        $this->localized[] = $localized;

        return $this;
    }

    /**
     * Remove localized
     *
     * @param \HcbStoreProductCategory\Entity\Category\Localized $localized
     */
    public function removeLocalized(\HcbStoreProductCategory\Entity\Category\Localized $localized)
    {
        $this->localized->removeElement($localized);
    }

    /**
     * Get localized
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocalized()
    {
        return $this->localized;
    }

    /**
     * Add product
     *
     * @param \HcbStoreProduct\Entity\Product $product
     * @return Category
     */
    public function addProduct(\HcbStoreProduct\Entity\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \HcbStoreProduct\Entity\Product $product
     */
    public function removeProduct(\HcbStoreProduct\Entity\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Add alias
     *
     * @param AliasBindInterface $alias
     * @return Category
     */
    public function addAlias(AliasBindInterface $alias)
    {
        $this->alias[] = $alias;

        return $this;
    }

    /**
     * Remove alias
     *
     * @param \HcbStoreProductCategory\Entity\Category\Alias $alias
     */
    public function removeAlias(\HcbStoreProductCategory\Entity\Category\Alias $alias)
    {
        $this->alias->removeElement($alias);
    }

    /**
     * Get alias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlias()
    {
        return $this->alias;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->localized = new \Doctrine\Common\Collections\ArrayCollection();
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
        $this->alias = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
