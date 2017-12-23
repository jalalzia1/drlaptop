<?php

/**
 * Quotes
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * author: e.g. MARISSA DOE
 * profession: e.g. MARKETING MANAGER
 */

function tfuse_quote_box($atts, $content = null) {
    extract(shortcode_atts(array('author' => '', 'profession' => ''), $atts));

    $return_html = '<div class="quoteBox-big"><div class="inner"><div class="quote-text">' . do_shortcode($content) . '</div>';

    if (!empty($author) || !empty($profession)) {
        $return_html .= '<div class="quote-author">';
        if (!empty($author))
            $return_html .= '<span class="black">' . $author . '</span> ';
        $return_html .= $profession . '</div>';
    }
    $return_html .= '</div></div>';

    return $return_html;
}

$atts = array(
    'name' => __('Quote Box', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Author', 'tfuse'),
            'desc' => __('Specifies the author', 'tfuse'),
            'id' => 'tf_shc_quote_box_author',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Profession', 'tfuse'),
            'desc' => __('Specifies the profession', 'tfuse'),
            'id' => 'tf_shc_quote_box_profession',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => __('Enter Quotes Content', 'tfuse'),
            'id' => 'tf_shc_quote_box_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_box', 'tfuse_quote_box', $atts);

function tfuse_quote_right($atts, $content = null) {
    return '<span class="quote_right">' . do_shortcode($content) . '</span>';
}

$atts = array(
    'name' => __('Quote Right', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => __('Enter Quotes Content', 'tfuse'),
            'id' => 'tf_shc_quote_right_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_right', 'tfuse_quote_right', $atts);

function tfuse_quote_left($atts, $content = null) {
    return '<span class="quote_left">' . do_shortcode($content) . '</span>';
}

$atts = array(
    'name' => __('Quote Left', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => __('Enter Quotes Content', 'tfuse'),
            'id' => 'tf_shc_quote_left_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_left', 'tfuse_quote_left', $atts);

function tfuse_quote_center($atts, $content = null) {
    return '<span class="quote_center">' . do_shortcode($content) . '</span>';
}

$atts = array(
    'name' => __('Quote Center', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => __('Enter Quotes Content', 'tfuse'),
            'id' => 'tf_shc_quote_center_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_center', 'tfuse_quote_center', $atts);

function tfuse_blockquote($atts, $content = null)
{
    return '<blockquote>' . do_shortcode($content) . '</blockquote>';
}

$atts = array(
    'name' => __('BlockQuote', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => __('Enter Quotes Content', 'tfuse'),
            'id' => 'tf_shc_blockquote_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('blockquote', 'tfuse_blockquote', $atts);

function tfuse_quote_simple($atts, $content = null)
{
    return '<div class="quoteBox"><div class="quote-text">' . do_shortcode($content) . '</div></div>';
}

$atts = array(
    'name' => __('Quote Simple', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content', 'tfuse'),
            'desc' => __('Enter Quotes Content', 'tfuse'),
            'id' => 'tf_shc_quote_simple_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_simple', 'tfuse_quote_simple', $atts);
