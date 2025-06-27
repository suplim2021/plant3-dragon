<?php
add_action('rest_api_init', 'sp_register_webhook_routes');
function sp_register_webhook_routes()
{
    register_rest_route('sp/v1', '/test-webhook', array(
        'methods' => 'POST',
        'callback' => 'sp_test_webhook',
        'permission_callback' => '__return_true'
    ));
}

function sp_test_webhook($request)
{
    // Get webhook URL from request
    $webhook_url = $request->get_param('webhook_url');

    // Create test data
    $test_data = array(
        'textarea-1' => 'Test textarea 1',
        'radio-1' => 'Test radio 1',
        'name-1' => 'Test name 1',
        'email-1' => 'test@example.com',
        'number-2' => '1234567890',
        'upload-1' => 'https://example.com/test-upload.jpg',
        'textarea-2' => 'Test textarea 2'
    );


    // Standard webhook payload
    $payload = array(
        'event' => 'payment-confirmation',
        'timestamp' => time(),
        'confirmation_id' => 'Test-' . time(),
        'data' => $test_data
    );

    // Prepare headers
    $headers = array(
        'Content-Type' => 'application/json'
    );

    // Send webhook request
    $response = wp_remote_post($webhook_url, array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => $headers,
        'body' => json_encode($payload),
        'cookies' => array(),
        'sslverify' => false
    ));

    // Check for errors
    if (is_wp_error($response)) {
        return new WP_REST_Response([
            'success' => false,
            'message' => $response->get_error_message(),
            'error_code' => $response->get_error_code()
        ], 200);
    }

    // Get response code
    $response_code = wp_remote_retrieve_response_code($response);
    $response_body = wp_remote_retrieve_body($response);

    // Return response
    if ($response_code >= 200 && $response_code < 300) {
        return new WP_REST_Response([
            'success' => true,
            'message' => __('Webhook test sent successfully.', 'seed-confirm'),
            'response_code' => $response_code
        ], 200);
    } else {
        return new WP_REST_Response([
            'success' => false,
            'message' => sprintf(__('Webhook test failed with status code: %d', 'seed-confirm'), $response_code),
            'response_body' => $response_body,
            'response_code' => $response_code
        ], 200);
    }
}

function sp_trigger_webhook($entry_id, $data, $webhook_url)
{

    if (empty($webhook_url)) {
        return;
    }

    // Prepare webhook payload
    $payload = array(
        'event' => 'payment-confirmation',
        'timestamp' => time(),
        'confirmation_id' => 'Log-' . $entry_id,
        'data' => $data
    );

    // Generate signature if secret is set
    $headers = array(
        'Content-Type' => 'application/json',
    );

    // Send webhook
    $response = wp_remote_post($webhook_url, array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => false,
        'headers' => $headers,
        'body' => wp_json_encode($payload),
        'cookies' => array(),
        'sslverify' => true,
    ));
}