<?php
namespace Backoffice\Form;

use Zend\Form\Form;

/**
 * Class CategoryForm
 * @package Backoffice\Form
 */
class CategoryForm extends Form
{
    /**
     * @param string $name
     * @param array $options
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
