<?php

try {
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/src/' . $className . '.php';
    });

    $route = $_GET ['route'] ?? '';
    $routes = require __DIR__ . '/src/routes/routes.php';

    $isRoutFound = null;
    foreach ($routes as $pattern => $controllerAndMethod) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRoutFound = true;
            break;
        }
    }

    if (!$isRoutFound) {
        throw new \Exceptions\NotFoundException();
    }

    unset($matches[0]);
    $controllerName = $controllerAndMethod [0];
    $method = $controllerAndMethod [1];

    $controller = new $controllerName();
    $controller->$method (...$matches);
}
catch (Exceptions\UnauthorizedException $e) {
    $view = new view\View(__DIR__ . '/tamplates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
}
catch (\Exceptions\Forbidden $e) {
    $view = new \view\View(__DIR__ . '/tamplates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage()], 403);
}
catch (\Exceptions\NotFoundException $e) {
    $view = new \view\View(__DIR__ . '/tamplates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
}
catch (\Exceptions\DbExceptions $e) {
    $view = new \view\View(__DIR__ . '/tamplates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
}

