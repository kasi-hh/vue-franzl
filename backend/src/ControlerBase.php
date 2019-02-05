<?php
/**
 * Created by PhpStorm.
 * User: kasi
 * Date: 31.01.2019
 * Time: 13:03
 */

namespace App;


class ControlerBase {
    /** @var \Slim\Container */
    protected $di;

    public function setDi(\Slim\Container $di){
        $this->di = $di;
    }
}