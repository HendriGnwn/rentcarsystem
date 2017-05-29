<?php

namespace app\models;

use app\models\queries\ActiveRecordQuery;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;

class BaseActiveRecord extends ActiveRecord {

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    public function behaviors() {
        return [
                [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id'=>'created_by']);
    }

    public function getUpdatedBy() {
        return $this->hasOne(User::className(), ['id'=>'updated_by']);
    }

    public static function statusLabels() {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
            self::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
        ];
    }

    public function getStatusLabel() {
        $list = self::statusLabels();
        return $list[$this->status] ? $list[$this->status] : $this->status;
    }

    public function getStatusWithStyle() {
        switch ($this->status) {
            case self::STATUS_ACTIVE :
                return Html::label($this->getStatusLabel(), null, ['class' => 'label label-success label-sm']);
            case self::STATUS_INACTIVE :
                return Html::label($this->getStatusLabel(), null, ['class' => 'label label-danger label-sm']);
            default :
                return Html::label($this->getStatusLabel(), null, ['class' => 'label label-default label-sm']);
        }
    }

    /**
     * @inheritdoc
     * @return BaseActiveRecordQuery the active query used by this AR class.
     */
    public static function find() {
        return new ActiveRecordQuery(get_called_class());
    }

}
