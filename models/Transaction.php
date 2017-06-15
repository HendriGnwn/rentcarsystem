<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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
class Transaction extends BaseActiveRecord
{
    const STATUS_PENDING = 1;
    const STATUS_RENT = 2;
    const STATUS_FINISH = 10;
    const STATUS_CANCEL = 5;
    
    const STATUS_PAYMENT_DP = 1;
    const STATUS_PAYMENT_PAID = 2;
	
	public $start_date;
	public $end_date;
    
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
            [['customer_id', 'car_id', 'rent_at', 'rent_finish_at', 'actualy_total', 'bill_total', 'status_payment'], 'required'],
            [['customer_id', 'car_id', 'driver_id', 'status', 'status_payment', 'user_id', 'created_by', 'updated_by'], 'integer'],
            [['code', 'rent_at', 'rent_finish_at', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'safe'],
            [['actualy_total', 'bill_total'], 'number'],
            [['driver_id'], 'default', 'value' => null],
            [['code'], 'string', 'max' => 30],
			[['status'], 'default', 'value' => self::STATUS_PENDING],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
	
	public function fields() 
	{
		$fields = [
			'car',
			'customer',
			'driver',
		];
		
		return ArrayHelper::merge(parent::fields(), $fields);
	}
	
    
    public function beforeSave($insert) {
        
        $this->code = $this->generateCode();
        
        if ($insert) {
            $this->user_id = Yii::$app->user->id;
        }
        
        return parent::beforeSave($insert);
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
	
	public function afterSave($insert, $changedAttributes) {
		parent::afterSave($insert, $changedAttributes);
		self::consoleChangeStatusPendingToRent();
		//self::consoleChangeStatusRentToFinish();
	}

    /**
     * @return ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTransactionReturns()
    {
        return $this->hasOne(TransactionReturn::className(), ['transaction_id' => 'id']);
    }
    
    /**
     * generate code with format `[prefix][Ymd]-[xxxxxx]` where:
     * [prefix] INV
     * [Y] is current year in php date format.
     * [m] is current month in php date format.
     * [d] is current day in php date format.
     * [xxxxxx] is incremental number of order each day pad by certain length.
     * 
     * eg:
     * - INV-20161201-0001
     * - INV-20161201-0002
     * - INV-20161202-0001
     * - INV-20161202-0002
     * - INV-20170101-0001
     * 
     * @param type $prefix INV
     * @param type $padLength increment pad length
     * @param type $separator
     * @return string
     */
    public function generateCode($prefix = 'INV', $padLength = 4, $separator = '-') 
    {
        $car = Car::find()
                ->actived()
                ->where(['id' => $this->car_id])
                ->one();
        if ($car) {
            $policeNumber = $car->police_number;
        } else {
            $policeNumber = null;
        }
        
        $left = strtoupper($prefix) . '-' . strtoupper($policeNumber) . $separator . date('Y-m') . $separator;
        $leftLen = strlen($left);
        $increment = 1;

        $last = self::find()
                ->select('code')
                ->where(['LIKE', 'code', $left])
                ->orderBy(['id' => SORT_DESC])
                ->limit(1)
                ->scalar();

        if ($last) {
            $increment = (int) substr($last, $leftLen, $padLength);
            $increment++;
        }

        $number = str_pad($increment, $padLength, '0', STR_PAD_LEFT);

        return $left . $number;
    }
    
    public static function statusLabels() {
        return [
            self::STATUS_PENDING => Yii::t('app', 'Pending'),
            self::STATUS_RENT => Yii::t('app', 'Rent'),
            self::STATUS_FINISH => Yii::t('app', 'Finish'),
            self::STATUS_CANCEL => Yii::t('app', 'Cancel'),
        ];
    }

    public function getStatusLabel() {
        $list = self::statusLabels();
        return $list[$this->status] ? $list[$this->status] : $this->status;
    }

    public function getStatusWithStyle() {
        switch ($this->status) {
            case self::STATUS_PENDING :
                return Html::label($this->getStatusLabel(), null, ['class' => 'label label-warning label-sm']);
            case self::STATUS_RENT :
                return Html::label($this->getStatusLabel(), null, ['class' => 'label label-primary label-sm']);
            case self::STATUS_FINISH :
                return Html::label($this->getStatusLabel(), null, ['class' => 'label label-success label-sm']);
            case self::STATUS_CANCEL :
                return Html::label($this->getStatusLabel(), null, ['class' => 'label label-danger label-sm']);
            default :
                return Html::label($this->getStatusLabel(), null, ['class' => 'label label-default label-sm']);
        }
    }
    
    public static function statusPaymentLabels() {
        return [
            self::STATUS_PAYMENT_DP => Yii::t('app', 'Down Payment'),
            self::STATUS_PAYMENT_PAID => Yii::t('app', 'Paid'),
        ];
    }

    public function getStatusPaymentLabel() {
        $list = self::statusPaymentLabels();
        return $list[$this->status_payment] ? $list[$this->status_payment] : $this->status_payment;
    }

    public function getStatusPaymentWithStyle() {
        switch ($this->status_payment) {
            case self::STATUS_PAYMENT_DP :
                return Html::label($this->getStatusPaymentLabel(), null, ['class' => 'label label-primary label-sm']);
            case self::STATUS_PAYMENT_PAID :
                return Html::label($this->getStatusPaymentLabel(), null, ['class' => 'label label-success label-sm']);
            default :
                return Html::label($this->getStatusPaymentLabel(), null, ['class' => 'label label-default label-sm']);
        }
    }
    
    public static function calculateActuallyTotal($price, $day) {
        return (double) $price * (int) $day;
    }
	
	public static function consoleChangeStatusRentToFinish()
	{
		return Transaction::updateAll([
			'status' => Transaction::STATUS_FINISH
		], 'status != ' . self::STATUS_FINISH . ' AND rent_finish_at > "' . date('Y-m-d') . '"');
	}
	
	public static function consoleChangeStatusPendingToRent()
	{
		return Transaction::updateAll([
			'status' => Transaction::STATUS_RENT
		], 'status != ' . self::STATUS_FINISH . ' AND rent_at <= "' . date('Y-m-d') . '" AND rent_finish_at >= "' . date('Y-m-d') . '"');
	}
	
	public function getCombineAttribute() {
		return $this->code . ' - ' . $this->car->car_type . ' - ' . $this->customer->name;
	}
}
