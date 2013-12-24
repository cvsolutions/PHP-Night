<?php
return array(
	'MarAcl' => array(
		'authorize_provider' => 'Zend\Authentication\AuthenticationService',
		'default_role' => 'guest',
		'field_role' => 'role',
		'data' => array(
			'roles' => array(
				array('name' => 'guest'),
				array('name' => 'admin', 'parents' => array('guest')),
			),
			// ==================================================================
			//
			// [ resources ... ]
			//
			// ------------------------------------------------------------------
			'resources' => array(
				array(
					'controller' => 'Backoffice\Factory\Login',
					'actions'=> array('index', 'logout'),
				),
				array(
					'controller' => 'Backoffice\Factory\Dashboard',
					'actions'=> array('index'),
				),
				array(
					'controller' => 'Backoffice\Factory\Categories',
					'actions'=> array('index', 'add', 'edit', 'delete'),
				),
				array(
					'controller' => 'Backoffice\Factory\Directory',
					'actions'=> array('index', 'add', 'edit', 'delete'),
				),
				array(
					'controller' => 'Application\Factory\Index',
					'actions'=> array('index'),
				),
				array(
					'controller' => 'Application\Factory\Directory',
					'actions'=> array('index', 'category', 'tag', 'detail'),
				),
			),
			// ==================================================================
			//
			// [ rules ... ]
			//
			// ------------------------------------------------------------------
			'rules' => array(
				'allow' => array(
					array(
						'role' => 'guest',
						'controller' => 'Backoffice\Factory\Login',
						'actions' => array('index', 'logout'),
						'privilege' => array('GET', 'POST'),
						'active' => 1,
					),
					array(
						'role' => 'admin',
						'controller' => 'Backoffice\Factory\Dashboard',
						'actions' => array('index'),
						'privilege' => array('GET'),
						'active' => 1,
					),
					array(
						'role' => 'admin',
						'controller' => 'Backoffice\Factory\Categories',
						'actions' => array('index', 'add', 'edit', 'delete'),
						'privilege' => array('GET', 'POST'),
						'active' => 1,
					),
					array(
						'role' => 'admin',
						'controller' => 'Backoffice\Factory\Directory',
						'actions' => array('index', 'add', 'edit', 'delete'),
						'privilege' => array('GET', 'POST'),
						'active' => 1,
					),
					array(
						'role' => 'guest',
						'controller' => 'Application\Factory\Index',
						'actions' => array('index'),
						'privilege' => array('GET'),
						'active' => 1,
					),
					array(
						'role' => 'guest',
						'controller' => 'Application\Factory\Directory',
						'actions' => array('index', 'category', 'tag', 'detail'),
						'privilege' => array('GET'),
						'active' => 1,
					),
				),
				'deny' => array(),
			),
		),
	),
);
