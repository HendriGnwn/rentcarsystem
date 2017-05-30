<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $identity_number
 * @property string $photo_identity_number
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
class Customer extends BaseActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $photoFile;
    
    public function init()
    {
        parent::init();
        
        $this->path = 'web/data/customer/';
        if (!is_dir(Yii::getAlias('@app/' . $this->path))) {
            mkdir(Yii::getAlias('@app/' . $this->path));
        }
        
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['identity_number', 'name', 'address', 'phone', 'join_at'], 'required'],
            [['join_at', 'created_at', 'updated_at', 'photo_identity_number'], 'safe'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['identity_number'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['photoFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => false,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1],
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
            'photoFile' => 'Photo Identity Number',
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
     * @return ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['customer_id' => 'id']);
    }
    
    /**
     * @param type $insert
     * @return type
     */
    public function beforeSave($insert) 
    {
        $this->processUploadFile();
        
        return parent::beforeSave($insert);
    }
    
    /**
     * - delete photoFile
     * 
     * @return type
     */
    public function beforeDelete()
    {
        /* todo: delete the corresponding file in storage */
        $this->deleteFile();
        
        return parent::beforeDelete();
    }
    
    protected function deleteFile()
    {
        @unlink(Yii::getAlias('@app/' . $this->path) . $this->photo_identity_number);
    }
        
    /**
     * process uploaded file
     * 
     * @return boolean
     */
    public function processUploadFile()
    {
        if (!empty($this->photoFile)) {
            $this->deleteFile();

            $path = str_replace('web/', '', $this->path);
            
            // generate filename
            $filename = Inflector::slug($this->name . '-' . Yii::$app->security->generateRandomString(20));
            $filename = $filename . '.' . $this->photoFile->extension;
            
            $this->photoFile->saveAs($path . $filename);
            $this->photo_identity_number = $filename;
        }

        return true;
    }
    
    /**
     * get url file
     * 
     * @return type
     */
    public function getPhotoIdentityNumberUrl() 
    {
        if (empty($this->photo_identity_number)) {
            return null;
        }

        $path = $this->path . $this->photo_identity_number;

        if (!file_exists(Yii::getAlias('@app/' . $path))) {
            return null;
        }

        return Url::to('@' . $path, true);
    }

    public function getPhotoIdentityNumberUrlHtml($name = null, $options = ['target' => '_blank']) 
    {
        $name = $name ? $name : $this->name;

        if (!$this->getPhotoIdentityNumberUrl()) {
            return $name;
        }

        return Html::a($name, $this->getPhotoIdentityNumberUrl(), $options);
    }
    
    public function getPhotoIdentityNumberImg($options = ['class' => 'img-responsive'])
    {
        if (!$this->getPhotoIdentityNumberUrl()) {
            return null;
        }
        
        return Html::img($this->getPhotoIdentityNumberUrl(), $options);
    }
    
    public function getCombineAttribute() {
        return $this->name . ' - ' . $this->identity_number;
    }
}
