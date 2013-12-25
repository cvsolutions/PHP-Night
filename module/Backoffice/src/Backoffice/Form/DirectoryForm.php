<?php
namespace Backoffice\Form;

use Zend\Form\Form;

/**
 * Class DirectoryForm
 * @package Backoffice\Form
 */
class DirectoryForm extends Form
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
                'placeholder' => 'Titolo dell\'articolo',
                'required' => 'required',
                'class' => 'form-control input-lg'
            )
        ));

        $this->add(array(
            'name' => 'slug',
            'attributes' => array(
                'type' => 'Text',
                'placeholder' => 'URL Slugs',
                'required' => 'required',
                'class' => 'form-control input-lg'
            )
        ));

        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type' => 'Textarea',
                'rows' => 10,
                'required' => 'required',
                'class' => 'form-control input-lg'
            )
        ));

        $this->add(array(
            'name' => 'website',
            'attributes' => array(
                'type' => 'Url',
                'placeholder' => 'http://',
                'required' => 'required',
                'class' => 'form-control input-lg'
            )
        ));

        $this->add(array(
            'name' => 'tags',
            'attributes' => array(
                'type' => 'Text',
                'placeholder' => '',
                'required' => 'required',
                'class' => 'form-control input-lg'
            )
        ));

        $this->add(array(
            'name' => 'category_id',
            'type' => 'Select',
            'attributes' => array(
                'required' => 'required',
                'class' => 'form-control input-lg'
            ),
            'options' => array(
                'empty_option' => '- Seleziona -',
                'value_options' => $options['categories']
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'active',
            'options' => array(
                'use_hidden_element' => true,
                'checked_value' => 1,
                'unchecked_value' => 0
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'auth_id',
            'attributes' => array(
                'value' => $options['auth']
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
