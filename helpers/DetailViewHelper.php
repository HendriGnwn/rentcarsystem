<?php

namespace app\helpers;

use app\models\User;

/**
 * Description of DetailViewHelper
 * 
 * @author Hendri <hendri.gnw@gmail.com>
 */
class DetailViewHelper
{
    /**
     * @param $model
     * @param $attribute
     * @see User
     */
    public static function author($model, $attribute)
    {
        $user = User::findOne($model->$attribute);
        if($user) {
            $user = $user->username;
        } else {
            $user = $model->$attribute;
        }

        return [
            'attribute' => $attribute,
            'value' => $user,
        ];
    }
	
	/**
	 * @param type $model
	 * @param type $attribute
	 * @param type $format
	 * @return array
	 */
	public static function dateTime($model, $attribute, $format = 'd M Y H:i:s')
	{
		return [
			'attribute' => $attribute,
			'value' => FormatConverter::dateFormat($model->$attribute, $format),
		];
	}
	
	/**
	 * @param type $model
	 * @param type $attribute
	 * @param type $format
	 * @return array
	 */
	public static function date($model, $attribute, $format = 'd M Y')
	{
		return [
			'attribute' => $attribute,
			'value' => FormatConverter::dateFormat($model->$attribute, $format),
		];
	}
}