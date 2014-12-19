<?php
/*
Title: Testing Demo
Post Type: oc-tools
*/
piklist('field', array(
    'type' => 'text'
, 'scope' => 'post_meta'
, 'field' => 'demo_text'
, 'label' => 'Text box'
, 'description' => 'Company for this'
, 'value' => 'Default text'
, 'attributes' => array(
        'class' => 'text'
    )
, 'position' => 'wrap'
));

piklist('field', array(
    'type' => 'select'
, 'scope' => 'post_meta'
, 'field' => 'demo_select'
, 'label' => 'Select box'
, 'description' => 'Choose from the dropdown.'

, 'attributes' => array(
        'class' => 'text'
    )

, 'choices' => array(
        'option1' => 'Option 1'
    , 'option2' => 'Option 2'
    , 'option3' => 'Option 3'
    )

, 'position' => 'wrap'
));

piklist('field', array(
    'type' => 'colorpicker'
, 'scope' => 'post_meta'
, 'field' => 'demo_colorpicker'
, 'label' => 'Choose a color'
, 'value' => '#aee029'
, 'description' => 'Click in the box to select a color.'
, 'attributes' => array(
        'class' => 'text'
    )
, 'position' => 'wrap'
));


?>