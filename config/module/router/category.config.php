<?php
return array(
    'type' => 'literal',
    'options' => array(
        'route' => '/category'
    ),
    'may_terminate' => false,
    'child_routes' => array(
        'list' => array(
            'type' => 'method',
            'options' => array(
                'verb' => 'get'
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'show' => array(
                    'type' => 'XRequestedWith',
                    'options' => array(
                        'with' => 'XMLHttpRequest',
                        'defaults' => array(
                            'controller' =>
                                'HcbStoreProductCategory-Controller-Collection-List'
                        )
                    )
                )
            )
        ),
        'resource' => array(
            'type' => 'segment',
            'options' => array(
                'route' => '/:id',
                'constraints' => array( 'id' => '[0-9]+' )
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'locale' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/localized'
                    ),
                    'may_terminate' => false,
                    'child_routes' => array(
                        'list' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'get',
                                'defaults' => array(
                                    'controller' => 'HcbStoreProductCategory-Controller-Localized-Collection-List'
                                )
                            )
                        ),
                        'create' => array(
                            'type' => 'method',
                            'options' => array(
                                'verb' => 'post',
                                'defaults' => array(
                                    'controller' => 'HcbStoreProductCategory-Controller-Localized-Create'
                                )
                            )
                        ),
                        'resource' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '/:id',
                                'constraints' => array( 'id' => '[0-9]+' )
                            ),
                            'may_terminate' => false,
                            'child_routes' => array(
                                'update' => array(
                                    'type' => 'method',
                                    'options' => array(
                                        'verb' => 'put',
                                        'defaults' => array(
                                            'controller' => 'HcbStoreProductCategory-Controller-Localized-Update'
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            )
        ),
        'delete' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/delete'
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'delete' => array(
                    'type' => 'method',
                    'options' => array(
                        'verb' => 'post',
                        'defaults' => array(
                            'controller' => 'HcbStoreProductCategory-Controller-Collection-Delete'
                        )
                    )
                )
            )
        ),
        'create' => array(
            'type' => 'method',
            'options' => array(
                'verb' => 'post',
                'defaults' => array(
                    'controller' => 'HcbStoreProductCategory-Controller-Create'
                )
            )
        )
    )
);
