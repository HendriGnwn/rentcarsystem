<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property integer $id
 * @property string $police_number
 * @property string $year_out
 * @property string $car_type
 * @property string $color
 * @property string $price
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Transaction[] $transactions
 */
class Car extends \app\models\BaseActiveRecord
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
            [['police_number', 'year_out', 'car_type', 'color', 'price'], 'required'],
            [['year_out', 'created_at', 'updated_at'], 'safe'],
            [['price'], 'number'],
            [['status', 'created_by', 'updated_by'], 'integer'],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['car_id' => 'id']);
    }
    
    public function getFormattedPrice() {
        return \app\helpers\FormatConverter::rupiahFormat($this->price, 2);
    }
}
