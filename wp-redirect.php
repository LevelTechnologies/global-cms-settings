add_action('template_redirect', function() {
    if (is_front_page() && isset($_COOKIE['SquashlevelsJWT'])) {
        $jwt = $_COOKIE['SquashlevelsJWT'];
        $parts = explode('.', $jwt);
        if (count($parts) === 3) {
            $payload = json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true);
            if (isset($payload['iss']) && $payload['iss'] === $_SERVER['HTTP_HOST']) {
                wp_redirect('https://app.' . $_SERVER['HTTP_HOST']);
                exit;
            }
        }
    }
});