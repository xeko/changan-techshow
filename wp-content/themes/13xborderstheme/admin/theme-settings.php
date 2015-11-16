<?php

add_action('init', 'propanel_of_options');

if (!function_exists('propanel_of_options')) {

    function propanel_of_options() {

//Theme Shortname
        $shortname = "13xborders";


//Populate the options array
        global $tt_options;
        $tt_options = get_option('of_options');


//Access the WordPress Pages via an Array
        $tt_pages = array();
        $tt_pages_obj = get_pages('sort_column=post_parent,menu_order');
        foreach ($tt_pages_obj as $tt_page) {
            $tt_pages[$tt_page->ID] = $tt_page->post_name;
        }
        $tt_pages_tmp = array_unshift($tt_pages, "Select a page:");


//Access the WordPress Categories via an Array
        $tt_categories = array();
        $tt_categories_obj = get_categories('hide_empty=0');
        foreach ($tt_categories_obj as $tt_cat) {
            $tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;
        }
        $categories_tmp = array_unshift($tt_categories, "Select a category:");


//Sample Array for demo purposes
        $sample_array = array("1", "2", "3", "4", "5");


//Sample Advanced Array - The actual value differs from what the user sees
        $sample_advanced_array = array("image" => "The Image", "post" => "The Post");


//Folder Paths for "type" => "images"
        $sampleurl = get_template_directory_uri() . '/admin/images/sample-layouts/';










        /* ----------------------------------------------------------------------------------- */
        /* Create The Custom Site Options Panel
          /*----------------------------------------------------------------------------------- */
        $options = array(); // do not delete this line - sky will fall




        /* Option Page 1 - All Options */
        $options[] = array("name" => __('All Options', 'framework_localize'),
            "type" => "heading");


        $options[] = array("name" => __('Attention', 'framework_localize'),
            "desc" => "",
            "id" => $shortname . "_sample_callout",
            "std" => "This is a callout box. This can be used to inform your clients about something important.",
            "type" => "info");


        $options[] = array("name" => __('Text Field', 'framework_localize'),
            "desc" => "This is a text field.",
            "id" => $shortname . "_sample_text_field",
            "std" => "",
            "type" => "text");


        $options[] = array("name" => __('Textarea', 'framework_localize'),
            "desc" => "This is a textarea.",
            "id" => $shortname . "_sample_text_area",
            "std" => "",
            "type" => "textarea");


        $options[] = array("name" => __('Image Upload', 'framework_localize'),
            "desc" => __('This is an image upload field.', 'framework_localize'),
            "id" => $shortname . "_sample_image_upload",
            "std" => "",
            "type" => "upload");


        $options[] = array("name" => __('Checkbox', 'framework_localize'),
            "desc" => __('This is a checkbox.', 'framework_localize'),
            "id" => $shortname . "_sample_checkbox",
            "std" => "true",
            "type" => "checkbox");


        $options[] = array("name" => __('Dropdown List', 'framework_localize'),
            "desc" => __('This is a dropdown list.', 'framework_localize'),
            "id" => $shortname . "_sample_dropdown",
            "std" => "1",
            "type" => "select",
            "options" => $sample_array);


        $options[] = array("name" => __('Radio Buttons', 'framework_localize'),
            "desc" => __('These are radio buttons.', 'framework_localize'),
            "id" => $shortname . "_sample_radio",
            "std" => "1",
            "type" => "radio",
            "options" => array(
                'Red Radio' => 'Red',
                'Green Radio' => 'Green',
                'Blue Radio' => 'Blue'
        ));


        $options[] = array("name" => __('Image Radio Buttons', 'framework_localize'),
            "desc" => __('Spice up your radio buttons by using custom images.', 'framework_localize'),
            "id" => $shortname . "_sample_image_radio",
            "std" => "option1",
            "type" => "images",
            "options" => array(
                'option1' => $sampleurl . 'sample-layout-1.png',
                'option2' => $sampleurl . 'sample-layout-2.png',
                'option3' => $sampleurl . 'sample-layout-3.png'
        ));


        $options[] = array("name" => __('Color Picker', 'framework_localize'),
            "desc" => __('This is a color picker.', 'framework_localize'),
            "id" => $shortname . "_sample_color_picker",
            "std" => "",
            "type" => "color");


        $options[] = array("name" => __('Wordpress Page', 'framework_localize'),
            "desc" => __('This displays a list of every page on your website.', 'framework_localize'),
            "id" => $shortname . "_sample_wp_pages",
            "std" => "1",
            "type" => "select",
            "options" => $tt_pages);


        $options[] = array("name" => __('Wordpress Category', 'framework_localize'),
            "desc" => __('This displays a list of every category on your website.', 'framework_localize'),
            "id" => $shortname . "_sample_wp_category",
            "std" => "1",
            "type" => "select",
            "options" => $tt_categories);
        
        $options[] = array("name" => __('Form 1', 'framework_localize'),
            "desc" => "参加申し込みフォーム.",
            "id" => $shortname . "_form1_field",
            "std" => "",
            "type" => "textarea");
        
        $options[] = array("name" => __('Form 2', 'framework_localize'),
            "desc" => "グループ参加申し込みフォーム",
            "id" => $shortname . "_form2_field",
            "std" => "",
            "type" => "textarea");

        $options[] = array("name" => __('Form 3', 'framework_localize'),
            "desc" => "問い合わせ",
            "id" => $shortname . "_form3_field",
            "std" => "",
            "type" => "textarea");


        $options[] = array("name" => __('Form 4', 'framework_localize'),
            "desc" => "グループ参加ロースター登録",
            "id" => $shortname . "_form4_field",
            "std" => "",
            "type" => "textarea");

        $options[] = array("name" => __('Form 5', 'framework_localize'),
            "desc" => "東日本大震災被災企業の方はこちらへ",
            "id" => $shortname . "_form5_field",
            "std" => "",
            "type" => "textarea");


$options[] = array("name" => __('Facebook', 'framework_localize'),
            "desc" => "Facebook address.",
            "id" => $shortname . "_facebook_field",
            "std" => "",
            "type" => "text");
$options[] = array("name" => __('Twitter', 'framework_localize'),
            "desc" => "Twitter....",
            "id" => $shortname . "_twitter_field",
            "std" => "",
            "type" => "text");

        /* Option Page 2 - Sample Page */
        $options[] = array("name" => __('Sample Page', 'framework_localize'),
            "type" => "heading");


        $options[] = array("name" => __('Website Logo', 'framework_localize'),
            "desc" => __('Upload a custom logo for your Website.', 'framework_localize'),
            "id" => $shortname . "_sitelogo",
            "std" => "",
            "type" => "upload");

        $options[] = array("name" => __('Header Logo', 'framework_localize'),
            "desc" => __('Upload header logo for your Website.', 'framework_localize'),
            "id" => $shortname . "_header_logo",
            "std" => "",
            "type" => "upload");


        $options[] = array("name" => __('Favicon', 'framework_localize'),
            "desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. </em>', 'framework_localize'),
            "id" => $shortname . "_favicon",
            "std" => "",
            "type" => "upload");


        $options[] = array("name" => __('Tracking Code', 'framework_localize'),
            "desc" => __('Paste Google Analytics (or other) tracking code here.', 'framework_localize'),
            "id" => $shortname . "_google_analytics",
            "std" => "",
            "type" => "textarea");

        $options[] = array("name" => __('Contact', 'framework_localize'),
            "desc" => __('Enter contact information.', 'framework_localize'),
            "id" => $shortname . "_contact_info",
            "std" => "",
            "type" => "textarea");


        $options[] = array("name" => __('Email', 'framework_localize'),
            "desc" => "Email contact.",
            "id" => $shortname . "_contact_email",
            "std" => "",
            "type" => "text");




        update_option('of_template', $options);
        update_option('of_shortname', $shortname);
    }

}
?>