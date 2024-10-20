<?php
function handle_410_errors() {
    if ( is_410() ) {
        status_header( 410 );
        nocache_headers();
        include( get_template_directory() . '/410.php' );
        exit;
    }
}
add_action( 'template_redirect', 'handle_410_errors' );

function is_410() {
    $gone_urls = array(
        '/old-page/',
        '/deprecated-content/',
        '/removed-article/',
    );
    $request_uri = $_SERVER['REQUEST_URI'];
    if ( in_array( $request_uri, $gone_urls ) ) {
        return true;
    }
    return false;
}

function send_410_status_header() {
    if ( is_410() ) {
        status_header( 410 );
        nocache_headers();
    }
}
add_action( 'template_redirect', 'send_410_status_header' );
