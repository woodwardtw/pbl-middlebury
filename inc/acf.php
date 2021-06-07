<?php
/**
 *ACF specific 
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

//************home page

//buttons
function pbl_main_links_repeater(){
    $html = '';
    if( have_rows('main_links') ):

        // Loop through rows.
        while( have_rows('main_links') ) : the_row();

            // Load sub field value.
            $title = get_sub_field('button_title');
            $link =  get_sub_field('link');
            // Do something...
            $html .= "<a class='btn btn-primary' href='{$link}'>{$title}</a>";
        // End loop.
        endwhile;
        return "<div class='d-flex  justify-content-center buttons'>{$html}</div>";
        // No value.
        else :
            // Do something...
        endif;
    }


//repeater blocks
function pbl_intro_blocks_repeater(){
    $html = '';
    if( have_rows('intro_blocks') ):

        // Loop through rows.
        while( have_rows('intro_blocks') ) : the_row();

            // Load sub field value.
            $block_title = get_sub_field('block_title');
            $block_description = get_sub_field('block_description');
            // Do something...
            $html .= "<div class='intro-block col-md-4'><h2>{$block_title}</h2><div class='intro-description'>{$block_description}</div></div>";
        // End loop.
        endwhile;
        return "<div class='row blocks-row d-flex justify-content-between'>{$html}</div>";
        // No value.
        else :
            // Do something...
        endif;
    }


//design and teaching sections
function pbl_design_elements(){
    $html = '';
    $elements = get_field('design_elements');
    foreach ($elements as $key => $element) {
        // code...
        $title = $element->post_title;
        $link = get_permalink($element->ID);
        $content = get_the_content('','',$element->ID);
        $html .= "<h3><a href='{$link}'>{$title}</a></h3><div class='element-content'>{$content}</div>";
    }
    return $html;
}

function pbl_teaching_practices(){
    $html = '';
    $elements = get_field('teaching_practices');
    foreach ($elements as $key => $element) {
        // code...
        $title = $element->post_title;
        $link = get_permalink($element->ID);
        $content = get_the_content($element->ID);
        $html .= "<h3><a href='{$link}'>{$title}</a></h3>";
    }
    return $html;
}


//set icon image to be featured image 
function acf_set_featured_image( $value, $post_id, $field  ){
    
    if($value != ''){
        //Add the value which is the image ID to the _thumbnail_id meta data for the current post
        add_post_meta($post_id, '_thumbnail_id', $value);
    }
 
    return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=icon', 'acf_set_featured_image', 10, 3);


    //save acf json
        add_filter('acf/settings/save_json', 'pbl_json_save_point');
         
        function pbl_json_save_point( $path ) {
            
            // update path
            $path = get_stylesheet_directory()  . '/acf-json'; //replace w get_stylesheet_directory() for theme
            
            
            // return
            return $path;
            
        }


        // load acf json
        add_filter('acf/settings/load_json', 'pbl_json_load_point');

        function pbl_json_load_point( $paths ) {
            
            // remove original path (optional)
            unset($paths[0]);
            
            
            // append path
            $paths[] = get_stylesheet_directory()   . '/acf-json';//replace w get_stylesheet_directory() for theme
            
            
            // return
            return $paths;
            
        }