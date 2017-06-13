<?php

namespace app\models;

use app\helpers\FormatConverter;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "car".
 *
 * @property integer $id
 * @property string $police_number
 * @property string $year_out
 * @property string $car_type
 * @property string $color
 * @property string $price
 * @property string $quantity
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Transaction[] $transactions
 */
class Car extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['police_number', 'year_out', 'car_type', 'color', 'price', 'quantity'], 'required'],
            [['year_out', 'created_at', 'updated_at'], 'safe'],
            [['price'], 'number'],
            [['status', 'created_by', 'updated_by', 'quantity'], 'integer'],
            [['police_number'], 'string', 'max' => 10],
            [['car_type'], 'string', 'max' => 30],
            [['color'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'police_number' => 'Police Number',
            'year_out' => 'Year Out',
            'car_type' => 'Car Type',
            'color' => 'Color',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['car_id' => 'id']);
    }
    
    public function getFormattedPrice() {
        return FormatConverter::rupiahFormat($this->price, 2);
    }
    
    public function getCombineAttribute() {
        return $this->police_number . ' - ' . $this->car_type . ' - ' . $this->color . ' - ' . $this->getFormattedPrice();
    }
	
	public static function getQuantityAvailable($id)
	{
		$used = Transaction::find()
				->where([
					'car_id' => $id,
					'status' => Transaction::STATUS_RENT
				])
				->count();
		
		$model = self::find()
				->where([
					'id' => $id
				])
				->actived()
				->one();
		if (!$model) {
			return null;
		}
		
		return $model->quantity - $used;
	}
	
	public static function getAvailableCars()
	{
		$models = self::find()->actived()->all();
		$cars = [];
		foreach ($models as $model) {
			$used = Transaction::find()
				->where([
					'car_id' => $model->id,
					'status' => Transaction::STATUS_RENT
				])
				->count();
			if (($model->quantity - $used) > 0) {
				$cars[] = $model->id;
			}
		}
		
		return Car::find()->andWhere(['in', 'id', $cars])->all();
	}
}
