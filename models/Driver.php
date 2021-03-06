<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driver".
 *
 * @property integer $id
 * @property string $identity_number
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $join_at
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Transaction[] $transactions
 */
class Driver extends \app\models\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['identity_number', 'name', 'address', 'phone', 'join_at'], 'required'],
            [['join_at', 'created_at', 'updated_at'], 'safe'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['identity_number'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'identity_number' => 'Identity Number',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'join_at' => 'Join At',
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
        return $this->hasMany(Transaction::className(), ['driver_id' => 'id']);
    }
    
    public function getCombineAttribute() {
        return $this->name . ' - ' . $this->identity_number . ' - ' . $this->phone;
    }
	
	public static function getAvailableDrivers()
	{
		$models = self::find()->actived()->all();
		$drivers = [];
		foreach ($models as $model) {
			$used = Transaction::find()
				->andWhere([
					'driver_id' => $model->id,
					'status' => Transaction::STATUS_RENT
				])
				->count();
			if ($used == 0) {
				$drivers[] = $model->id;
			}
		}
		
		return self::find()->andWhere(['in', 'id', $drivers])->all();
	}
}
