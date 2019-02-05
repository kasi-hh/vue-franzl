<?php
/**
 * Created by PhpStorm.
 * User: kasi
 * Date: 29.01.2019
 * Time: 14:20
 */

namespace App\Model;


use App\Lib\JsonLib;

class Image implements \JsonSerializable {
    protected $id;
    protected $title;
    protected $info;
    protected $href;
    protected $created;

    /**
     * Image constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? '';
        $this->title = $data['title'] ?? '';
        $this->info = $data['info'] ?? '';
        $this->href = $data['href'] ?? '';
        $this->create = $data['create'] ?? '';
    }
    public function jsonSerialize() {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'info'=>$this->info,
            'href'=>$this->href,
            'created'=>$this->created,
        ];
    }

    /**
     * @return mixed|string
     */
    public function getHref() {
        return $this->href;
    }

    /**
     * @return mixed|string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return mixed|string
     */
    public function getInfo() {
        return $this->info;
    }

    /**
     * @return mixed
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * @return mixed|string
     */
    public function getId() {
        return $this->id;
    }

}