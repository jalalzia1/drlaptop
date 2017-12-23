<?php

/**
 * Columns
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * type: 1, 1_2, 1_3, 1_4, 2_3 etc.
 * class:

 */

function tfuse_col($atts, $content = null)
{
    extract(shortcode_atts(array('type' => '1', 'class' => ''), $atts));
    return '<div class="col col_' . $type . ' ' . $class . '"><div class="inner">' . do_shortcode($content) . '</div></div>';
}

$atts = array(
    'name' => __('Columns', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the button shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array(
        array(
            'name' => __('Type', 'tfuse'),
            'desc' => __('Select column type', 'tfuse'),
            'id' => 'tf_shc_col_type',
            'value' => '_self',
            'options' => array(
                '1' => __('One column', 'tfuse'),
                '1_2' => __('One half column (1/2)', 'tfuse'),
                '1_3' => __('One third column (1/3)', 'tfuse'),
                '1_4' => __('A fourth column (1/4)', 'tfuse'),
                '2_3' => __('Two thirds column (2/3)', 'tfuse'),
                '3_4' => __('Three fourths column (3/4)', 'tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Class', 'tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode:box box_border box_green,box box_border box_yellow,box box_border box_pink,box box_border box_blue...', 'tfuse'),
            'id' => 'tf_shc_col_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => __('Enter shortcode content', 'tfuse'),
            'id' => 'tf_shc_col_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('col', 'tfuse_col', $atts);
