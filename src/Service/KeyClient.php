<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 16.01.2020
 * Time: 3:28
 */

namespace App\Service;


class KeyClient extends CriterionFactory // таких классов должно быть несколько на каждый критерий
{
    protected $id = 1;

    // Данный метод отличается для каждого критерия
    public function isMatch(){
        // получение client_id
        $clientId = $this->requestService->getClientId();
        //TODO по $clientId узнать значение keyword (ключевитости) пользователя

        $dateCreate = $this->requestService->getDateCreate();
        // TODO если keyword соответствует = key ("ключевой клиент") и $dateCreate > 01.01.20, то запрос соответствует данному критерию
        return true;
        // если нет то
        return false;
    }
}