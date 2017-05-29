<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction_return".
 *
 * @property integer $id
 * @property integer $transaction_id
 * @property string $code
 * @property string $return_at
 * @property string $total
 * @property string $description
 * @property string $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Transaction $transaction
 * @property User $user
 */
class TransactionReturn extends \app\models\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_return';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_id', 'code', 'return_at', 'total', 'description', 'user_id'], 'required'],
            [['transaction_id', 'user_id', 'created_by', 'updated_by'], 'integer'],
            [['return_at', 'created_at', 'updated_at'], 'safe'],
            [['total'], 'number'],
            [['code'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 255],
            [['transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['transaction_id' => 'id']],
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
            'transaction_id' => 'Transaction ID',
            'code' => 'Code',
            'return_at' => 'Return At',
            'total' => 'Total',
            'description' => 'Description',
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
    public function getTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'transaction_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
