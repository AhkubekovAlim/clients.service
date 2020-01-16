<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 16.01.2020
 * Time: 3:28
 */

namespace App\Service;


use App\Entity\RequestService;

abstract class CriterionFactory implements CriterionInterface
{
    protected $requestService;
    protected $id;

    public function __constructor(RequestService $requestService){
        $this->requestService = $requestService;
    }

    public function getId(){
        return $this->id;
    }

    abstract public function isMatch();
}