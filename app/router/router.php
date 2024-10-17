<?php

function routes()
{
    return require 'routes.php';
}

function exactMatchUriInArrayRoutes($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        return [$uri => $routes[$uri]];
    }

    return [];
}

function regularExpressionMatchArrayRoutes($uri, $routes)
{
    return array_filter($routes, function ($value) use ($uri) {
        $regex = str_replace('/', '\/', ltrim($value, '/'));
        return preg_match("/^$regex$/", ltrim($uri, '/'));
    }, ARRAY_FILTER_USE_KEY);
}

function params($uri, $macthedUri)
{
    if (!empty($macthedUri)) {
        $machedToGetParams = array_keys($macthedUri)[0];
        return array_diff(
            explode('/', ltrim($uri, '/')),
            explode('/', ltrim($machedToGetParams, '/'))
        );
    }

    return [];
}

function router()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $routes = routes();

    $macthedUri = exactMatchUriInArrayRoutes($uri, $routes);

    if (empty($macthedUri)) {
        $macthedUri = regularExpressionMatchArrayRoutes($uri, $routes);

        $params = params($uri, $macthedUri);
        var_dump($params);
    }
}
