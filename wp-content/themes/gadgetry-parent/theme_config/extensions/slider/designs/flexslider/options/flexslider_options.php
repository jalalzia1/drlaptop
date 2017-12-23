<?php
/**
 * Play slider's configurations
 *
 * @since  Gadgetry 1.0
 */

$options = array(
    'tabs' => array(
        array(
            'name' => __('Slider Settings', 'tfuse'),
            'id' => 'slider_settings', #do no t change this ID
            'headings' => array(
                array(
                    'name' => __('Slider Settings', 'tfuse'),
                    'options' => array(
                        array('name' => __('Slider Title', 'tfuse'),
                            'desc' => __('Change the title of your slider. Only for internal use (Ex: Homepage)', 'tfuse'),
                            'id' => 'slider_title',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Slides Interval','tfuse'),
                            'desc' => __('Enter the slides interval','tfuse'),
                            'id' => 'slider_interval',
                            'value' => '7000',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array('name' => __('Resize images?', 'tfuse'),
                            'desc' => __('Want to let our script to resize the images for you? Or do you want to have total control and upload images with the exact slider image size?', 'tfuse'),
                            'id' => 'slider_image_resize',
                            'value' => 'false',
                            'type' => 'checkbox')
                    )
                )
            )
        ),
        array(
            'name' => __('Add/Edit Slides', 'tfuse'),
            'id' => 'slider_setup', #do not change ID
            'headings' => array(
                array(
                    'name' => __('Add New Slide', 'tfuse'), #do not change
                    'options' => array(
                        array('name' => __('Title', 'tfuse'),
                            'desc' => ' The Title is displayed on the image and will be visible by the users',
                            'id' => 'slide_title',
                            'value' => '',
                            'type' => 'text',
                            'required' => TRUE,
                            'divider' => true),
                        array('name' => __('URL', 'tfuse'),
                            'desc' => __('When a user will click the image, the browser will load this URL.', 'tfuse'),
                            'id' => 'slide_url',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Title position', 'tfuse'),
                            'desc' => __('Choose your preferred title position.', 'tfuse'),
                            'id' => 'slide_position',
                            'value' => 'left-mid',
                            'options' => array('left-mid' => 'Left-Middle', 'left-top' => 'Left-Top','left-bot' => 'Left-Bottom','center-mid' => 'Center-Middle','center-top' => 'Center-Top'
                                                ,'center-bot' => 'Center-Bottom','right-mid' => 'Right-Middle','right-top' => 'Right-Top','right-bot' => 'Right-Bottom'),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => __('Title color', 'tfuse'),
                            'desc' => __('Choose your preferred title color.', 'tfuse'),
                            'id' => 'slide_title_color',
                            'value' => '',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        // Custom Favicon Option
                        array('name' => __('Image <br />(948px × 372px)', 'tfuse'),
                            'desc' => __('You can upload an image from your hard drive or use one that was already uploaded by pressing  "Insert into Post" button from the image uploader plugin.', 'tfuse'),
                            'id' => 'slide_src',
                            'value' => '',
                            'type' => 'upload',
                            'media' => 'image',
                            'required' => TRUE)
                    )
                )
            )
        ),
        array(
            'name' => __('Category Setup', 'tfuse'),
            'id' => 'slider_type_categories',
            'headings' => array(
                array(
                    'name' => __('Category options', 'tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Select specific categories', 'tfuse'),
                            'desc' => __('Pick one or more
categories by starting to type the category name. If you leave blank the slider will fetch images
from all <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit-tags.php?taxonomy=category">Categories</a>.',
                            'id' => 'categories_select',
                            'type' => 'multi',
                            'subtype' => 'category'
                        ),
                         array('name' => __('Title position', 'tfuse'),
                            'desc' => __('Choose your preferred title position.', 'tfuse'),
                            'id' => 'sliders_position',
                            'value' => 'left-mid',
                            'options' => array('random' => __('Random', 'tfuse'),'left-mid' => 'Left-Middle', 'left-top' => 'Left-Top','left-bot' => 'Left-Bottom','center-mid' => 'Center-Middle','center-top' => 'Center-Top'
                                                ,'center-bot' => 'Center-Bottom','right-mid' => 'Right-Middle','right-top' => 'Right-Top','right-bot' => 'Right-Bottom'),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => __('Title color', 'tfuse'),
                            'desc' => __('Choose your preferred title color.', 'tfuse'),
                            'id' => 'sliders_title_color',
                            'value' => 'post_yellow',
                            'options' => array('random' => __('Random', 'tfuse'),'post_yellow' => __('Yellow', 'tfuse'), 'post_green' => __('Green', 'tfuse'),'post_purple' => 'Purple','post_red' => __('Red', 'tfuse'),'post_blue' => 'Blue'),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Number of images in the slider', 'tfuse'),
                            'desc' => __('How many images do you want in the slider?', 'tfuse'),
                            'id' => 'sliders_posts_number',
                            'value' => 6,
                            'type' => 'text'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Posts Setup', 'tfuse'),
            'id' => 'slider_type_posts',
            'headings' => array(
                array(
                    'name' => __('Posts options', 'tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Select specific Posts', 'tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit.php">posts</a> by starting to type the Post name. The slider will be populated with images from the posts
                                        you selected.',
                            'id' => 'posts_select',
                            'type' => 'multi',
                            'subtype' => 'post'
                        ),
                         array('name' => __('Title position', 'tfuse'),
                            'desc' => __('Choose your preferred title position.', 'tfuse'),
                            'id' => 'sliders_position',
                            'value' => 'left-mid',
                            'options' => array('random' => __('Random', 'tfuse'),'left-mid' => 'Left-Middle', 'left-top' => 'Left-Top','left-bot' => 'Left-Bottom','center-mid' => 'Center-Middle','center-top' => 'Center-Top'
                                                ,'center-bot' => 'Center-Bottom','right-mid' => 'Right-Middle','right-top' => 'Right-Top','right-bot' => 'Right-Bottom'),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => __('Title color', 'tfuse'),
                            'desc' => __('Choose your preferred title color.', 'tfuse'),
                            'id' => 'sliders_title_color',
                            'value' => 'post_yellow',
                            'options' => array('random' => __('Random', 'tfuse'),'post_yellow' => __('Yellow', 'tfuse'), 'post_green' => __('Green', 'tfuse'),'post_purple' => 'Purple','post_red' => __('Red', 'tfuse'),'post_blue' => 'Blue'),
                            'type' => 'select'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Tags Setup', 'tfuse'),
            'id' => 'slider_type_tags',
            'headings' => array(
                array(
                    'name' => __('Tags options', 'tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Select specific tags', 'tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit-tags.php?taxonomy=post_tag">tags</a> by starting to type the tag name. The slider will be populated with images from posts
that have the selected tags.',
                            'id' => 'tags_select',
                            'type' => 'multi',
                            'subtype' => 'post_tag'
                        ),
                        array('name' => __('Title position', 'tfuse'),
                            'desc' => __('Choose your preferred title position.', 'tfuse'),
                            'id' => 'sliders_position',
                            'value' => 'left-mid',
                            'options' => array('random' => __('Random', 'tfuse'),'left-mid' => 'Left-Middle', 'left-top' => 'Left-Top','left-bot' => 'Left-Bottom','center-mid' => 'Center-Middle','center-top' => 'Center-Top'
                                                ,'center-bot' => 'Center-Bottom','right-mid' => 'Right-Middle','right-top' => 'Right-Top','right-bot' => 'Right-Bottom'),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => __('Title color', 'tfuse'),
                            'desc' => __('Choose your preferred title color.', 'tfuse'),
                            'id' => 'sliders_title_color',
                            'value' => 'post_yellow',
                            'options' => array('random' => __('Random', 'tfuse'),'post_yellow' => __('Yellow', 'tfuse'), 'post_green' => __('Green', 'tfuse'),'post_purple' => 'Purple','post_red' => __('Red', 'tfuse'),'post_blue' => 'Blue'),
                            'type' => 'select',
                            'divider' => true
                        )
                    )
                )
            )
        )
    )
);

$options['extra_options'] = array();
?>