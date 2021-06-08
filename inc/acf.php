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
            $html .= "<div class='col-md-4'><div class='intro-block'><h2>{$block_title}</h2><div class='intro-description'>{$block_description}</div></div></div>";
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
        $slug = $element->post_name;
        $link = get_permalink($element->ID);
        $content = get_the_content('','',$element->ID);
        $html .= "<div class='home-element {$slug} '><h3><a href='{$link}'>{$title}</a></h3><div class='element-content'>{$content}</div></div>";
    }
    return $html;
}

function pbl_teaching_practices(){
    $html = '';
    $elements = get_field('teaching_practices');
    foreach ($elements as $key => $element) {
        // code...
        $title = $element->post_title;
        $slug = $element->post_name;
        $link = get_permalink($element->ID);
        $content = get_the_content('','',$element->ID);
        $html .= "<div class='home-element {$slug}'><h3><a href='{$link}'>{$title}</a></h3><div class='element-content'>{$content}</div></div>";
    }
    return $html;
}


/*TOPIC PAGES*/

//pbl_topic_resources()

function pbl_topic_resources_repeater(){
    global $post;
    $post_slug = $post->post_name;//get post slug to match either design or teaching practice taxonomy
    if(get_term_by('slug', $post_slug, 'Design elements')){
        $term_type = 'Design elements';
        $term_id = get_term_by('slug', $post_slug, 'Design elements')->term_id;
    }
    if(get_term_by('slug', $post_slug, 'Teaching practices')){
        $term_type = 'Teaching practices';
        $term_id = get_term_by('slug', $post_slug, 'Teaching practices')->term_id;
    }
   
    $html = '';
    if( have_rows('display_categories') ):
        // Loop through rows.
        $html = '';
        while( have_rows('display_categories') ) : the_row();
            
            // Load sub field value.
            $section_title = get_sub_field('title');
            $cats = get_sub_field('category');
            // Do something...
            $count = count(get_field("display_categories"));
            $div_class = bs_div_maker($count);
            $html .= "<div class='{$div_class}'><h2>{$section_title}</h2>";
            // WP QUERY LOOP
             $args = array(
                  'posts_per_page' => 15,
                  'post_type'   => 'resource', 
                  'post_status' => 'publish', 
                  'nopaging' => false,
                  'tax_query' => array(
                      'relation' => 'AND',
                        array(
                                'taxonomy' => 'type',
                                'field'    => 'id',
                                'terms'    => $cats,
                            ),                       
                           array(
                                    'taxonomy' => $term_type,//get from page title
                                    'field'    => 'id',
                                    'terms'    => array($term_id),//get from page title
                            ),
                        ),
                    );
              $the_query = new WP_Query( $args );
                    if( $the_query->have_posts() ): 
                      while ( $the_query->have_posts() ) : $the_query->the_post();
                       //DO YOUR THING
                        $id = get_the_id();
                        $title = get_the_title();
                        $link = get_field('link', $id);
                        $description = get_field('description', $id);
                        $html .= "<div><h3><a href='{$link}'>{$title}</a></h3>{$description}</div>";
                         endwhile;
                  endif;
                wp_reset_query();  // Restore global post data stomped by the_post().
                    
                $html .= '</div>';
        // End loop.
        endwhile;
        return $html;
        // No value.
        else :
            // Do something...
        endif;
    }

function bs_div_maker($count){
    if($count === 1){
        return 'col-md-12';
    }
    if($count === 2){
        return 'col-md-6';
    }
    if($count > 2){
        return 'col-md-4';
    }
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