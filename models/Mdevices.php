<?php

namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "mdevices".
 *
 * @property integer $id
 * @property string $uuid
 * @property integer $regtime
 * @property integer $totime
 * @property integer $role
 * @property integer $runtimes
 */
class Mdevices extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mdevices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uuid', 'sid', 'regtime', 'totime', 'role', 'runtimes'], 'required'],
            [['sid', 'regtime', 'totime', 'role', 'runtimes'], 'integer'],
            [['uuid'], 'string', 'max' => 64]
        ];
    }
    
    /**
     * Finds devices by uuid
     *
     * @param string $uuid
     * @return static|null
     */
    public static function findByUUID($uuid, $sid)
    {
        return static::findOne(['uuid' => $uuid, 'sid' => $sid]);
    }
    
    public function addRun()
    {
        $this->runtimes = $this->runtimes + 1;
    }
    
    public function getTime() {
        return $this->totime;
    }
    
    public function setTime() {
        $this->totime = time();
    }
    
    public function addTime($addTime) {
        $this->totime = $this->totime + $addTime;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => '设备号',
            'sid' => '脚本ID',
            'regtime' => '注册时间',
            'totime' => '到期时间',
            'role' => '状态',
            'runtimes' => '运行次数',
        ];
    }
}
