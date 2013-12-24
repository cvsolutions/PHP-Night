<?php
return array (
	// ==================================================================
	//
	// [ Backoffice factories ... ]
	//
	// ------------------------------------------------------------------
	'controllers' => array (
		'factories' => array (
			'Backoffice\Factory\Login' => 'Backoffice\Factory\LoginFactory',
			'Backoffice\Factory\Directory' => 'Backoffice\Factory\DirectoryFactory',
			'Backoffice\Factory\Dashboard' => 'Backoffice\Factory\DashboardFactory',
			'Backoffice\Factory\Categories' => 'Backoffice\Factory\CategoriesFactory'
		)
	),
	// ==================================================================
	//
	// [ Backoffice router ... ]
	//
	// ------------------------------------------------------------------
	'router' => array (
		'routes' => array (
			'backoffice' => array (
				'type' => 'Zend\Mvc\Router\Http\Hostname',
				'options' => array (
					'route' => 'admin.php-night.it',
					'defaults' => array (
						'controller' => 'Backoffice\Factory\Login',
						'action' => 'index'
					)
				),
				'may_terminate' => true,
				'child_routes' => array (
					'default' => array (
						'type' => 'Zend\Mvc\Router\Http\Segment',
						'options' => array (
							'route' => '/[:controller[/:action]]',
							'constraints' => array (
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
							),
							'defaults' => array ()
						)
					),
					'dashboard' => array (
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array (
							'route' => '/dashboard',
							'defaults' => array (
								'controller' => 'Backoffice\Factory\Dashboard',
								'action' => 'index'
							)
						)
					),
					'categories' => array (
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array (
							'route' => '/categories',
							'defaults' => array (
								'controller' => 'Backoffice\Factory\Categories',
								'action' => 'index'
							)
						),
						'may_terminate' => true,
						'child_routes' => array (
							'child-categories' => array (
								'type' => 'Zend\Mvc\Router\Http\Segment',
								'options' => array (
									'route' => '[/:action][/:id]',
									'defaults' => array (
										'controller' => 'Backoffice\Factory\Categories',
										'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
										'id' => '[0-9]+'
									)
								)
							)
						)
					),
					'directory' => array (
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array (
							'route' => '/directory',
							'defaults' => array (
								'controller' => 'Backoffice\Factory\Directory',
								'action' => 'index'
							)
						),
						'may_terminate' => true,
						'child_routes' => array (
							'child-directory' => array (
								'type' => 'Zend\Mvc\Router\Http\Segment',
								'options' => array (
									'route' => '[/:action][/:id]',
									'defaults' => array (
										'controller' => 'Backoffice\Factory\Directory',
										'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
										'id' => '[0-9]+'
									)
								)
							)
						)
					),
					'logout' => array (
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array (
							'route' => '/logout',
							'defaults' => array (
								'controller' => 'Backoffice\Factory\Login',
								'action' => 'logout'
							)
						)
					)
				)
			)
		)
	),
	// ==================================================================
	//
	// [ module layouts ... ]
	//
	// ------------------------------------------------------------------
	'module_layouts' => array(
		'Backoffice' => 'layout/backoffice',
	),
	// ==================================================================
	//
	// [ service manager ... ]
	//
	// ------------------------------------------------------------------
	'service_manager' => array(
		'invokables' => array(
			'Backoffice\Service\ConvertResultSetSQLtoArray' => 'Backoffice\Service\ConvertResultSetSQLtoArray',
		),
	),
	// ==================================================================
	//
	// [ view manager ... ]
	//
	// ------------------------------------------------------------------
	'view_manager' => array (
		'template_path_stack' => array (
			'backoffice' => __DIR__ . '/../view'
		)
	)
);
