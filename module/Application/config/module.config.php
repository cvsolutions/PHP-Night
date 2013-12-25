<?php
return array(

    // ==================================================================
    //
    // [ Application Router ... ]
    //
    // ------------------------------------------------------------------
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Factory\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'application' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        'controller' => 'Application\Factory\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
            'articoli' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/articoli/[:slug]',
                    'defaults' => array(
                        'controller' => 'Application\Factory\Directory',
                        'action' => 'category',
                        'slug' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                ),
            ),
            'link' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/link/[:slug]',
                    'defaults' => array(
                        'controller' => 'Application\Factory\Directory',
                        'action' => 'detail',
                        'slug' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                ),
            ),
            'search' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/search/',
                    'defaults' => array(
                        'controller' => 'Application\Factory\Directory',
                        'action' => 'index'
                    ),
                ),
            ),
            'tag' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/tag/[:key]',
                    'defaults' => array(
                        'controller' => 'Application\Factory\Directory',
                        'action' => 'tag',
                        'key' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                ),
            ),
        ),
    ),

    // ==================================================================
    //
    // [ service manager ... ]
    //
    // ------------------------------------------------------------------
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),

    // ==================================================================
    //
    // [ Application Factories ... ]
    //
    // ------------------------------------------------------------------
    'controllers' => array(
        'factories' => array(
            'Application\Factory\Index' => 'Application\Factory\IndexFactory',
            'Application\Factory\Directory' => 'Application\Factory\DirectoryFactory'
        ),
    ),

    // ==================================================================
    //
    // [ view manager ... ]
    //
    // ------------------------------------------------------------------
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    // ==================================================================
    //
    // [ Placeholder for console routes ... ]
    //
    // ------------------------------------------------------------------
    'console' => array(
        'router' => array(
            'routes' => array(),
        ),
    ),
);
