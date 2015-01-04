<?php
return array(
    // Product
    'HcbStoreProductCategory-Controller-Collection-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' =>
                'HcbStoreProductCategory-Service-Collection-FetchQbBuilder',
            'viewModel' => 'HcbStoreProductCategory-Paginator-ViewModel-JsonModel'
        )
    ),

    'HcbStoreProductCategory-Controller-View' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProductCategory-Service-FetchService',
            'extractor' => 'HcbStoreProductCategory-Stdlib-Extractor-Resource'
        )
    ),

    'HcbStoreProductCategory-Controller-Create' => array(
        'parameters' => array(
            'serviceCommand' => 'HcbStoreProductCategory-Service-Create',
            'jsonResponseModelFactory' =>
                'HcbStoreProductCategory-Json-View-StatusMessageDataModelFactory'
        )
    ),

    'HcbStoreProductCategory-Controller-Collection-Delete' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProductCategory-Data-Collection-Entities-ByIds',
            'serviceCommand' => 'HcbStoreProductCategory-Service-Collection-Delete',
            'jsonResponseModelFactory' =>
                'HcbStoreProductCategory-Json-View-StatusMessageDataModelFactory'
        )
    ),

    // Localized
    'HcbStoreProductCategory-Controller-Localized-Collection-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbStoreProductCategory-Service-FetchService',
            'paginatorDataFetchService' =>
                'HcbStoreProductCategory-Service-Localized-Collection-FetchArrayCollection',
            'viewModel' => 'HcbStoreProductCategory-Paginator-ViewModel-JsonModel-Localized'
        )
    ),

    'HcbStoreProductCategory-Controller-Localized-Update' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProductCategory-Data-Localized',
            'fetchService' => 'HcbStoreProductCategory-Service-FetchService-Localized',
            'serviceCommand' => 'HcbStoreProductCategory-Service-Localized-UpdateCommand',
            'jsonResponseModelFactory' =>
                'HcbStoreProductCategory-Json-View-StatusMessageDataModelFactory'
        )
    ),

    'HcbStoreProductCategory-Controller-Localized-Create' => array(
        'parameters' => array(
            'inputData' => 'HcbStoreProductCategory-Data-Localized',
            'fetchService' => 'HcbStoreProductCategory-Service-FetchService',
            'serviceCommand' => 'HcbStoreProductCategory-Service-Localized-CreateCommand',
            'jsonResponseModelFactory' =>
                'HcbStoreProductCategory-Json-View-StatusMessageDataModelFactory'
        )
    )
);
