<?php
/**
 * TinyMCE Customizations
 */

/**
 * TinyMCE Default Options
 */
function hopper_tinymce_init($options) {

    // Force-toggle the Paste-as-Text button
    global $tinymce_version;
    if ($tinymce_version[0] < 4) {
        $options['paste_text_sticky'] = true;
        $options['paste_text_sticky_default'] = true;
    } else {
        $options['paste_as_text'] = true;
    }

    // Add custom class to TinyMCE body
    $options['body_class'] = 'entry';

    return $options;
}

add_filter('tiny_mce_before_init', 'hopper_tinymce_init');

/**
 * Font families, sizes, and colors
 */
function hopper_tinymce_btn_opts($options) {

    // Font sizes
    $options['fontsize_formats'] = '0.75em 0.875em 1em 1.125em 1.25em 1.375em 1.5em 1.75em 1.875em 2em';

    // Font colors
    $options['textcolor_map'] = '['.'
        "ffffff", "White",
        "000000", "Black"
    '.']';

    // Font Families
    // The last family listed must NOT have a semicolon before the closing quote
    $options['font_formats'] = 'Helvetica=Helvetica, Arial, sans-serif;'.
                               'Georgia=Georgia, Cambria, Times New Roman, Times, serif';

    return $options;

}

// Un-comment to enable hopper_tinymce_btn_opts()
// add_filter('tiny_mce_before_init', 'hopper_tinymce_btn_opts');

/**
 * Text Formats (styles)
 */
function hopper_tinymce_styles($custom_styles) {
    $styles = array(
        array(
            'title' => 'Text',
            'items' => array(
                array(
                    'title' => 'Intro Text',
                    'selector' => 'p',
                    'classes' => 'intro-text',
                    'wrapper' => false
                ),
                array(
                    'title' => 'Pull Quote',
                    'selector' => 'p',
                    'classes' => 'pull-quote',
                    'wrapper' => false
                )
            )
        ),
        array(
            'title' => 'Buttons',
            'items' => array(
                array(
                    'title' => 'Red Button',
                    'selector' => 'a',
                    'classes' => 'red-button',
                    'wrapper' => false
                ),
                array(
                    'title' => 'Blue Button',
                    'selector' => 'a',
                    'classes' => 'blue-button',
                    'wrapper' => false
                )
            )
        ),
        array(
            'title' => 'Blocks',
            'items' => array(
                array(
                    'title' => 'Call to Action',
                    'block' => 'div',
                    'classes' => 'cta',
                    'wrapper' => true
                )
            )
        )
    );

    $custom_styles['style_formats'] = json_encode($styles);

    return $custom_styles;

}

// Un-comment to enable hopper_tinymce_styles()
// add_filter('tiny_mce_before_init', 'hopper_tinymce_styles');