<?php

namespace App\Service;

interface CriterionInterface{
    public function getId();
    public function isMatch();
}