<?php
namespace Backoffice\Form;

use Zend\Form\Form;

/**
 * CategoryForm
 *
 * @uses     Form
 *
 * @category Form
 * @package  Backoffice
 * @author   Concetto Vecchio <info@cvsolutions.it>
 * @license  http://framework.zend.com/license/new-bsd New BSD License
 * @link     http://www.php-night.it
 */
class CategoryForm extends Form
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
				'name' => 'fullname',
				'attributes' => array(
					'type' => 'Text',
					'placeholder' => 'Titolo della categoria',
					'required' => 'required',
					'class' => 'form-control input-lg'
				)
			));

		$this->add(array(
				'name' => 'slug',
				'attributes' => array(
					'type' => 'Text',
					'placeholder' => 'URL della categoria',
					'class' => 'form-control input-lg'
				)
			));

        $this->add(array(
            'name' => 'menu',
            'type' => 'Select',
            'attributes' => array(
                'required' => 'required',
                'class' => 'form-control input-lg'
            ),
            'options' => array(
                'empty_option' => '- Seleziona -',
                'value_options' => array(
                    1 => 'Top',
                    2 => 'Right'
                )
            )
        ));

        $this->add(array(
				'name' => 'submit',
				'attributes' => array(
					'type' => 'Submit',
					'value' => 'Salva',
					'class' => 'btn btn-info btn-lg'
				)
			));
	}
}
