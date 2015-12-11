<?php

namespace app\models;

use Yii;
use app\models\Authors;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date
 * @property string $preview
 * @property integer $author_id
 * @property string $date_create
 * @property string $date_update
 */
class Books extends \yii\db\ActiveRecord
{
    public $image;
    //public $authorfullname;

    const PATH_IMG = '/images';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'date_create', 'date_update'], 'safe'],
            [['author_id'], 'integer'],
           // [['date_create', 'date_update'], 'required'],
            [['name', 'preview'], 'string', 'max' => 255]
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'date' => Yii::t('app', 'Date'),
            'preview' => Yii::t('app', 'Preview'),
            'author_id' => Yii::t('app', 'Author ID'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_update' => Yii::t('app', 'Date Update'),
            'authorfullname' => Yii::t('app', 'Author'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    public function getAuthorFullName()
    {
        return $this->author->fullname;
    }

    /**
     * @inheritdoc
     * @return BooksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BooksQuery(get_called_class());
    }

    public function getImgDir()
    {
        return Yii::getAlias('@webroot') . Books::PATH_IMG;
    }

    public function getImgSrc()
    {
        return Books::PATH_IMG .'/'.$this->preview;
    }

    public function uploadImage()
    {
        $this->image = UploadedFile::getInstance($this, 'image');
        if (isset($this->image) ) {
            $this->image->saveAs($this->getImgDir() . '/' . $this->image->name);
            $this->preview = $this->image->name;
        }
    }
}
