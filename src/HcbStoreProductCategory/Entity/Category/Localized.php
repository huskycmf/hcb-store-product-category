<?php
namespace HcbStoreProductCategory\Entity\Category;

use HcBackend\Entity\PageBindInterface;
use HcBackend\Entity\PageInterface;
use HcbStoreProductCategory\Entity\Category;
use HcCore\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;
use HcCore\Entity\LocaleBindInterface;

/**
 * Localized
 *
 * @ORM\Table(name="store_product_category_localized")
 * @ORM\Entity
 */
class Localized implements EntityInterface, PageBindInterface, LocaleBindInterface
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
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="HcbStoreProductCategory\Entity\Category", inversedBy="localized")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_product_category_id", referencedColumnName="id")
     * })
     */
    protected $category;

    /**
     * @var Page
     *
     * @ORM\OneToOne(targetEntity="HcbStoreProductCategory\Entity\Category\Localized\Page",
     *               mappedBy="localized",
     *               cascade={"persist"})
     */
    protected $page;

    /**
     * @var Locale
     *
     * @ORM\OneToOne(targetEntity="HcCore\Entity\Locale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
     * })
     */
    protected $locale;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=200, nullable=false)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    protected $description = '';

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
     * Set category
     *
     * @param \HcbStoreProductCategory\Entity\Category $category
     * @return Localized
     */
    public function setCategory(\HcbStoreProductCategory\Entity\Category $category = null)
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

    /**
     * Set page
     *
     * @param PageInterface $page
     * @return Localized
     */
    public function setPage(PageInterface $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \HcbStoreProductCategory\Entity\Category\Localized\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set locale
     *
     * @param \HcCore\Entity\Locale $locale
     * @return Localized
     */
    public function setLocale(\HcCore\Entity\Locale $locale = null)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return \HcCore\Entity\Locale 
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Localized
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Localized
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
