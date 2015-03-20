<?php

namespace frontend\models;

use Yii;

class Mscripts extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mscripts';
    }

    public function rules()
    {
        return [
            [['name', 'size', 'version', 'download_url'], 'required'],
            [['createtime', 'runtimes'], 'integer'],
            [['md5', 'sha1', 'sha256', 'name'], 'string', 'max' => 64],
            [['download_url', 'update_logs'], 'string', 'max' => 256],
            ['size', 'default', 'value' => 0],
            ['createtime', 'default', 'value' => time()],
            ['runtimes', 'default', 'value' => 0],
        ];
    }
    
    public function addRun()
    {
        $this->runtimes = $this->runtimes + 1;
    }
    
    public function checkSum($sha1) {
        return(strcmp($sha1, $this->sha1));
    }
    
    public function getName() {
        return($this->name);
    }
    
    public function getVersion() {
        return($this->version);
    }
    
    public function getUrl() {
        return($this->download_url);
    }
    
    public function getSize() {
        return($this->size);
    }
    
    public function getLogs() {
        return($this->update_logs);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'md5' => 'MD5',
            'sha1' => 'SHA1',
            'sha256' => 'SHA256',
            'version' => '版本',
            'download_url' => '下载地址',
            'update_logs' => '更新日志',
            'name' => '名称',
            'size' => '尺寸',
            'createtime' => '创建时间',
            'runtimes' => '运行次数',
        ];
    }
}
