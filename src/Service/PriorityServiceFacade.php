<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 15.01.2020
 * Time: 1:15
 */

namespace App\Service;

use App\Entity\RequestService;

class PriorityServiceFacade
{
    /**
     * @var array массив названий классов-критериев
     */
    private static $criterionClasses = [
        'KeyClient'
    ];

    public static function getPriority(RequestService $requestService){
        $priority = self:: calcPriority($requestService);
        return $priority;
    }

    // функция расчета приоритета запроса
    public static function calcPriority(RequestService $requestService){
        $priority = 0;
        foreach(self::$criterionClasses as $criterionClass){
            $criterionObj = new $criterionClass($requestService);
            if($criterionObj->isMatch()){ // проверка, соответствует ли шаблон критерию
                //TODO  если да, то из таблицаы weights получить строку по
                $criterionId = $criterionObj->getId();
                // и по типу запроса
                $type = $requestService->getTypeId();
                // в полученной строке weight суммируем к $priority
                $priority += $weight->getWeight();
            }
        }

        return $priority;
    }
}