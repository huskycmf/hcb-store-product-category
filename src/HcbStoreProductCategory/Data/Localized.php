<?php
namespace HcbStoreProductCategory\Data;

use HcCore\Data\DataMessagesInterface;
use HcCore\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use HcCore\InputFilter\InputFilter;

class Localized extends InputFilter implements LocalizedInterface, DataMessagesInterface
{
    /**
     * @param Request $request
     * @param Extractor $dataExtractor
     * @param Di $di
     */
    public function __construct(Request $request,
                                Extractor $dataExtractor,
                                Di $di) {
        /* @var $input \HcBackend\InputFilter\Input\Locale */
        $input = $di->get( 'HcBackend\InputFilter\Input\Locale',
            array( 'name' => 'lang' ) )
                    ->setRequired( true );
        $this->add( $input );

        $this->add(array( 'name' => 'title', 'required' => true, 'allowEmpty' => false,
                          'validators' => array(array( 'name' => 'string_length',
                                                       'options' => array(
                                                           'min' => 1,
                                                           'max' => 300
                                                       ))),
                          'filters' => array(array('name' => 'StringTrim'))));

        $this->add(array('type'=>'HcbStoreProductCategory\InputFilter\Page'), 'page');

        $this->add( array(
            'name'       => 'alias',
            'required'   => true,
            'allowEmpty' => false,
            'filters'    => array( array( 'name' => 'StringTrim' ) )
        ) );

        $this->add( array(
            'name'       => 'prio',
            'required'   => false,
            'allowEmpty' => true
        ) );

        $this->setData( $dataExtractor->extract( $request ) );
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->getValue('lang');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getValue('title');
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->getValue('alias');
    }

    /**
     * @return number
     */
    public function getPrio()
    {
        return $this->getValue('prio');
    }

    /**
     * @return string
     */
    public function getMetaContent()
    {
        return $this->getValue('page')['pageContent'];
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->getValue('page')['pageDescription'];
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->getValue('page')['pageKeywords'];
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->getValue('page')['pageTitle'];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return '';
    }
}
