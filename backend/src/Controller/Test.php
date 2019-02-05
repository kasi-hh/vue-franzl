<?php
/**
 * Created by PhpStorm.
 * User: kasi
 * Date: 29.01.2019
 * Time: 15:49
 */

namespace App\Controller;


class Test {

    public function indexAction(\Slim\Http\Request $request, \Slim\Http\Response $response){
        $response->getBody()->write('test');
        return $response;
    }
}