<?php
namespace HcbStoreProductCategory\InputFilter;

class Page extends \HcBackend\InputFilter\Page
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'pageContent',
            'allow_empty' => true
        ));
    }
}
