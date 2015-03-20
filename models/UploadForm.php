<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Upload form
 */
class UploadForm extends Model
{
    public $script;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['script'], 'required'],
        ];
    }

    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'script' => '脚本文件',
        ];
    }
}
