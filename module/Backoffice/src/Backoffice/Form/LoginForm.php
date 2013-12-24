<?php
namespace Backoffice\Form;

use Zend\Form\Form;

/**
 * LoginForm
 *
 * @uses     Form
 *
 * @category Form
 * @package  Backoffice
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class LoginForm extends Form
{
	/**
	 * __construct
	 *
	 * @param string $name.
	 * @param array  $options.
	 *
	 * @access public
	 *
	 * @return mixed Value.
	 */
	function __construct($name = '', $options = array())
	{
		parent::__construct($name, $options);
		$this->setAttribute('method', 'post');

		$this->add(array(
				'name' => 'usermail',
				'attributes' => array(
					'type' => 'Email',
					'placeholder' => 'Indirizzo e-mail',
					'required' => 'required',
					'class' => 'form-control input-lg'
				)
			));

		$this->add(array(
				'name' => 'pwd',
				'attributes' => array(
					'type' => 'Password',
					'placeholder' => 'Password',
					'required' => 'required',
					'class' => 'form-control input-lg'
				)
			));

		$this->add(array(
				'type' => 'Zend\Form\Element\Csrf',
				'name' => 'token',
				'options' => array(
					'csrf_options' => array(
						'timeout' => 600
					)
				)
			));

		$this->add(array(
				'name' => 'submit',
				'attributes' => array(
					'type' => 'Submit',
					'value' => 'Login',
					'class' => 'btn btn-info btn-lg'
				)
			));
	}
}
