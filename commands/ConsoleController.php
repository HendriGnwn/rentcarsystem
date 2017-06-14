<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Transaction;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ConsoleController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }
	
	public function actionChangeStatusPendingToRent()
	{
		echo "  > change status pending to rent ...\n";
		$counter = Transaction::consoleChangeStatusPendingToRent();
		echo "  > success, " . $counter . " transaction(s)";
	}
	
//	public function actionChangeStatusRentToFinish()
//	{
//		echo "  > change status rent to finish...\n";
//		$counter = Transaction::consoleChangeStatusRentToFinish();
//		echo "  > success, " . $counter . " transaction(s)";
//	}
}
