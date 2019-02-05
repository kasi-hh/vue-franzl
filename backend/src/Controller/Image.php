<?php
/**
 * Created by PhpStorm.
 * User: kasi
 * Date: 29.01.2019
 * Time: 15:49
 */


namespace App\Controller;

use App\ControlerBase;
use App\Manager;
use Slim\Http\Request;
use Slim\Http\Response;

class Image extends ControlerBase {


    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function addAction(Request $request, Response $response, array $args){
        /** @var \App\Repository\Images $repo */
        $repo = Manager::getClassInstance('repository.images');
        $file = fopen($request->getParam('image'),'rb');
        $image = new \App\Model\Image([
            'title'=>$request->getParam('title'),
            'info'=>$request->getParam('info'),
        ]);
        try {
            $img = $repo->addImage($image, $file);
            return $response->withJson([
                'success'=>true,
                'image'=>$img,
                ]);
        }
        catch (\Exception $e){
            return $response->withJson( [
                'success'=>false,
                'message'=>$e->getMessage(),
                'file'=>$e->getFile(),
                'line'=>$e->getLine()
            ]);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function listAction(Request $request, Response $response, array $args):Response {
        /** @var \App\Repository\Images $repo */
        $repo = Manager::getClassInstance('repository.images');
        return $response->withJson([
            'success'=> true,
            'data' => $repo->getImageList($request->getParams())
        ]);
    }
}