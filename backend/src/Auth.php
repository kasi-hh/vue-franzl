<?php
/**
 * Created by PhpStorm.
 * User: kasi
 * Date: 29.01.2019
 * Time: 15:57
 */

namespace App;


class Auth {
    public function __invoke(\Slim\Http\Request $request, \Slim\Http\Response $response, callable $next) {
        $next($request, $response);
        return $response->withHeader('x-auth','test');
    }
}