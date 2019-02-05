<?php
/**
 * Created by PhpStorm.
 * User: kasi
 * Date: 29.01.2019
 * Time: 15:49
 */


namespace App\Controller;

use \Firebase\JWT\JWT;
use Dflydev\FigCookies\FigResponseCookies;
use \Slim\Http\Response;
use \Slim\Http\Request;
use Dflydev\FigCookies\SetCookie;

class Auth extends \App\ControlerBase {

    /**
     * @param \Slim\Http\Request $request
     * @param Response $response
     * @return Response
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function loginAction(Request $request, Response $response): Response{
        $userName = $request->getParam('user');
        $password = $request->getParam('password');
        $config = $this->di->get('settings');
        $users = $config['users'];
        $userHash = $config['users'][$userName];
        $key = $config['jwt']['secret'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        /*
        return $response->withJson([
            'success'=>true,
            'hash'=>$hash,
            'userHash'=> $userHash,
            'password'=>$password,
            'data'=>password_get_info($hash),
            'valid'=>\App\Lib\Security::verifyPassword($password, $userHash),
        ]);
        */
        if (!isset($users[$userName])){
            return $response->withJson(['success'=>false,'message'=>'invalid username or password']);
        }
        if (!\App\Lib\Security::verifyPassword($password, $userHash)) {
            return $response->withJson(['success'=>false,'message'=>'invalid username or password']);
        }
        /** @noinspection SummerTimeUnsafeTimeManipulationInspection */
        $token = array(
            "iss" => "https://franzl.kasi-hamburg.de", //issuer
            "exp" => time()+(3600*24*100), //expires
            'iat' => time(), //issued at
            "app.user" => $userName,
        );

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($token, $key);
        /*
        $response = FigResponseCookies::set($response, SetCookie::create('token')
            ->withValue($jwt)
            ->withPath('/')
        );
        */
        return $response->withJson([
            'success'=>true,
            'token'=>$jwt
        ]);
        return $response
            ->withHeader('Authorization','Bearer '.$jwt);
    }
    public function hashAction(Request $request, Response $response): Response {
        $hash = password_hash($request->getParam('password'),PASSWORD_DEFAULT);
        return $response->withJson([
            'success'=>true,
            'data'=>$hash,
            'info'=>password_get_info($hash)
        ]);
    }
}