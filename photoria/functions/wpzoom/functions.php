<?php
/**
 * General WP and WPZOOM functions.
 *
 * @package WPZOOM
 */

/**
 * Function for sending AJAX responses, present since WP 3.5.0, loaded only
 * for older versions for backward compatibility.
 */
if ( ! function_exists( 'wp_send_json' ) ) {
    /**
     * Send a JSON response back to an Ajax request.
     *
     * @since WP 3.5.0
     *
     * @param mixed $response Variable (usually an array or object) to encode as JSON, then print and die.
     */
    function wp_send_json( $response ) {
        @header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
        echo json_encode( $response );
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
            wp_die();
        else
            die;
    }
}

/**
 * Function for sending AJAX responses, present since WP 3.5.0, loaded only
 * for older versions for backward compatibility.
 */
if ( ! function_exists( 'wp_send_json_success' ) ) {
    /**
     * Send a JSON response back to an Ajax request, indicating success.
     *
     * @since WP 3.5.0
     *
     * @param mixed $data Data to encode as JSON, then print and die.
     */
    function wp_send_json_success( $data = null ) {
        $response = array( 'success' => true );

        if ( isset( $data ) )
            $response['data'] = $data;

        wp_send_json( $response );
    }
}

/**
 * Function for sending AJAX responses, present since WP 3.5.0, loaded only
 * for older versions for backward compatibility.
 */
if ( ! function_exists( 'wp_send_json_error' ) ) {
    /**
     * Send a JSON response back to an Ajax request, indicating failure.
     *
     * @since WP 3.5.0
     *
     * @param mixed $data Data to encode as JSON, then print and die.
     */
    function wp_send_json_error( $data = null ) {
        $response = array( 'success' => false );

        if ( isset( $data ) )
            $response['data'] = $data;

        wp_send_json( $response );
    }
}
