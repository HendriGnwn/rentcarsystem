<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use yii\rbac\DbManager as BaseDbManager;

/**
 * Description of DbManager
 *
 * @author Hendri
 */

class DbManager extends BaseDbManager
{
    protected function executeRule($user, $item, $params)
    {
        if (empty($item->ruleName)) {
            return true;
        }

         return parent::executeRule($user, $item, $params);
    }
}
