<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\Mkeys;
use frontend\models\Mdevices;
use frontend\models\Mscripts;

/**
 * Recharge form
 */
class RechargeForm extends Model
{
    public $uuid;
    public $card;
    public $days;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['uuid', 'filter', 'filter' => 'trim'],
            ['card', 'filter', 'filter' => 'trim'],
            [['uuid', 'card'], 'required'],
            ['uuid', 'string', 'min' => 32, 'max' => 32, 'tooShort' => '设备号应该包含至少 {min} 个字符。', 'tooLong' => '设备号只能包含至多 {max} 个字符。'],
            ['card', 'validateCard'],
            ['uuid', 'validateUUID'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }
    
    public function validateUUID($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $serial_model = Mkeys::findByKey($this->card);
            if (!$serial_model) {
                $this->addError($attribute, '无效的充值卡。');
                return;
            }
            $sid = $serial_model -> getSid();
            $model = Mdevices::findByUUID($this->uuid, $sid);
            if (!$model) {
                $this->addError($attribute, '无效的设备号。');
                return;
            }
        }
    }
    
    public function validateCard($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $model = Mkeys::findByKey($this->card);
            if (!$model) {
                $this->addError($attribute, '无效的充值卡。');
            }
        }
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uuid' => '设备号',
            'card' => '充值卡',
            'verifyCode' => '验证码',
        ];
    }
    
    public function save() {
        if ($this->validate()) {
            if (($serial_model = Mkeys::findByKey($this->card)) !== null) {
                if ($serial_model -> doUse()) {
                    $sid = $serial_model -> getSid();
                    if (($device_model = Mdevices::findByUUID($this->uuid, $sid)) !== null) {
                        $serial_model -> save();
                        $this->days = $serial_model -> getTime();
                        $time = $this->days * 3600 * 24;
                        $left_time = $device_model -> getTime() - time();
                        if ($left_time < 0) {
                            $device_model -> setTime();
                        }
                        $device_model -> addTime($time);
                        $device_model -> setRole(1);
                        $device_model -> save();
                    } else {
                        return 1;
                    }
                } else {
                    return 2;
                }
            } else {
                return 3;
            }
            return 0;
        } else {
            return 4;
        }
    }
}
