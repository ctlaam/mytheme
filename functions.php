<?php 

function load_css()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all' );
	wp_enqueue_style('bootstrap');

    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all' );
	wp_enqueue_style('main');
}

add_action('wp_enqueue_scripts','load_css');

function load_js()
{
    wp_enqueue_script('jquery');

    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false, true);
    wp_enqueue_script('bootstrap');
}

add_action('wp_enqueue_scripts','load_js');

// theme options
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');



// Menus
register_nav_menus(

    array(
        'top-menu' => 'Top Menu Location',
        'mobile-menu' => 'Mobile Menu Location',
    )
    );

// Custom Image
add_image_size('blog-large', 800, 400, true);
add_image_size('blog-small', 300, 150, true);



//  register sidebar

function my_sidebars(){

    register_sidebar(
            array(
                    'name'=> 'Page SideBar',
                    'id' => 'page-sidebar',
                    'before-title' => '<h4 class="widgget-title">',
                    'after-title' =>'</h4>',
            )
    );
    register_sidebar(
        array(
                'name'=> 'Blog SideBar',
                'id' => 'blog-sidebar',
                'before-title' => '<h4 class="widgget-title">',
                'after-title' =>'</h4>',
        )
    );
}
add_action('widgets_init','my_sidebars');

function test($message) {
    $api_key = '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';
    $api_url = 'https://api.openai.com/v1/engines/text-davinci-002/completions';

    $data = array(
        'prompt' => $message,
        'max_tokens' => 300,
        'temperature' => 0.65,
    );

    $args = array(
        'headers' => array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $api_key,
        ),
        'body' => json_encode( $data ),
    );

    $response = wp_remote_post( $api_url, $args );

    if ( is_wp_error( $response ) ) {
        return false;
    }

    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body, true );
    // print_r($data);
    return $data['choices'][0]['text'];
}
add_action('test','test');

?>




