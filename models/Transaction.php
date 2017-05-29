<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property string $code
 * @property integer $customer_id
 * @property integer $car_id
 * @property integer $driver_id
 * @property string $rent_at
 * @property string $rent_finish_at
 * @property string $actualy_total
 * @property string $bill_total
 * @property integer $status
 * @property integer $status_payment
 * @property string $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Customer $customer
 * @property Car $car
 * @property Driver $driver
 * @property User $user
 * @property TransactionReturn[] $transactionReturns
 */
class Transaction extends \app\models\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'customer_id', 'car_id', 'driver_id', 'rent_at', 'rent_finish_at', 'actualy_total', 'bill_total', 'status', 'status_payment', 'user_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['customer_id', 'car_id', 'driver_id', 'status', 'status_payment', 'user_id', 'created_by', 'updated_by'], 'integer'],
            [['rent_at', 'rent_finish_at', 'created_at', 'updated_at'], 'safe'],
            [['actualy_total', 'bill_total'], 'number'],
            [['code'], 'string', 'max' => 30],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'customer_id' => 'Customer ID',
            'car_id' => 'Car ID',
            'driver_id' => 'Driver ID',
            'rent_at' => 'Rent At',
            'rent_finish_at' => 'Rent Finish At',
            'actualy_total' => 'Actualy Total',
            'bill_total' => 'Bill Total',
            'status' => 'Status',
            'status_payment' => 'Status Payment',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionReturns()
    {
        return $this->hasMany(TransactionReturn::className(), ['transaction_id' => 'id']);
    }
}
