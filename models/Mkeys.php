<?php
namespace frontend\models;
use Yii;

class Mkeys extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mkeys';
    }

    public function rules()
    {
        return [
            [['key', 'sid', 'time'], 'required'],
            [['flag', 'sid', 'usetime', 'createtime', 'time'], 'integer'],
            ['flag', 'default', 'value' => 0],
            ['createtime', 'default', 'value' => time()],
            ['usetime', 'default', 'value' => 0],
        ];
    }
    
    public static function findByKey($key)
    {
        return static::findOne(['key' => $key]);
    }
    
    public function doUse() {
        if ($this -> flag === 0) {
            $this -> usetime = time();
            $this -> flag = 1;
            return 1;
        } else {
            return 0;
        }
    }
    
    public function getTime() {
        return $this->time;
    }
    
    public function getSid() {
        return $this->sid;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => '序列号',
            'sid' => '脚本ID',
            'flag' => '状态',
            'usetime' => '使用时间',
            'createtime' => '创建时间',
            'time' => '面值（天）',
        ];
    }
}
