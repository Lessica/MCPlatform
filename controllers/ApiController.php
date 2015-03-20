<?php
namespace frontend\controllers;
date_default_timezone_set('Asia/Shanghai');
header('Content-type: application/json');

use Yii;
use frontend\models\Mkeys;
use frontend\models\Mdevices;
use frontend\models\Mscripts;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;

function urlencode_ch($url = "") {
    $url = rawurlencode($url);
    $a = array("%3A", "%2F", "%40");
    $b = array(":", "/", "@");
    $url = str_replace($a, $b, $url);
    return $url;
}

/**
 * Api controller
 */
class ApiController extends Controller
{
    private function time2Units ($time)
    {
       $day    = floor($time / 60 / 60 / 24);
       $time  -= $day * 60 * 60 * 24;
       $hour   = floor($time / 60 / 60);
       $time  -= $hour * 60 * 60;
       $minute = floor($time / 60);
       $elapse = '';

       $unitArr = array('天' => 'day', '时' => 'hour', '分' => 'minute');

       foreach ( $unitArr as $cn => $u )
       {
           if ( $$u > 0 )
           {
               $elapse .= $$u . $cn;
           }
       }

       return $elapse;
    }
    
    private function mkcode($code) {
        $sum = 0;
        for ($i = 0; $i < strlen($code); $i++) {
            $sum += pow(ord($code[$i]) % 16, $i % 7);
        }
        return($sum);
    }
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public function actionIndex() {
        $result = [
            'status' => 0,
            'msg' => '通信成功',
            't' => time(),
        ];
        $get_info = Yii::$app->request->get();
        $required_paras = ['t', 'uuid', 'code'];
        foreach ($required_paras as $para_key) {
            if (!isset($get_info[$para_key]) || empty($get_info[$para_key])) {
                $result['status'] = -1;
                $result['msg'] = '参数错误';
                echo(json_encode($result));
                exit();
            }
        }
        $curr_time = intval($get_info['t']);
        if (abs(time() - $curr_time) > 10) {
            $result['status'] = -2;
            $result['msg'] = '请求超时';
            echo(json_encode($result));
            exit();
        }
        $uuid = $get_info['uuid'];
        $code = $get_info['code'];
        if (strlen($uuid) != 32 || strlen($code) != 16) {
            $result['status'] = -3;
            $result['msg'] = '参数长度不正确';
            echo(json_encode($result));
            exit();
        } else {
            $result['verify'] = $this->mkcode($code);
        }
        $result['crc32'] = crc32($code);
        echo(json_encode($result));
        exit();
    }
    
    public function actionAdd() {
        $result = [
            'status' => 0,
            'msg' => '充值成功',
            't' => time(),
        ];
        $get_info = Yii::$app->request->get();
        $required_paras = ['t', 'uuid', 'serial', 'code'];
        foreach ($required_paras as $para_key) {
            if (!isset($get_info[$para_key]) || empty($get_info[$para_key])) {
                $result['status'] = -1;
                $result['msg'] = '参数错误';
                echo(json_encode($result));
                exit();
            }
        }
        $curr_time = intval($get_info['t']);
        if (abs(time() - $curr_time) > 300) {
            $result['status'] = -2;
            $result['msg'] = '请求超时';
            echo(json_encode($result));
            exit();
        }
        $uuid = $get_info['uuid'];
        $code = $get_info['code'];
        if (strlen($uuid) != 32 || strlen($code) != 16) {
            $result['status'] = -3;
            $result['msg'] = '参数长度不正确';
            echo(json_encode($result));
            exit();
        } else {
            $result['verify'] = $this->mkcode($code);
        }
        if (!preg_match('/[0-9A-Za-z]/', $uuid)) {
            $result['status'] = -4;
            $result['msg'] = '参数校验失败';
            echo(json_encode($result));
            exit();
        }
        $serial = $get_info['serial'];
        if (($serial_model = Mkeys::findByKey($serial)) !== null) {
            if ($serial_model -> doUse()) {
                $sid = $serial_model -> getSid();
                if (($device_model = Mdevices::findByUUID($uuid, $sid)) !== null) {
                    $serial_model -> save();
                    $day = $serial_model -> getTime();
                    $time = $day * 3600 * 24;
                    $left_time = $device_model -> getTime() - time();
                    if ($left_time < 0) {
                        $device_model -> setTime();
                    }
                    $device_model -> addTime($time);
                    $device_model -> setRole(1);
                    $device_model -> save();
                    $result['value'] = $day;
                } else {
                    $result['status'] = -5;
                    $result['msg'] = '无效的设备号';
                    echo(json_encode($result));
                    exit();
                }
            } else {
                $result['status'] = -6;
                $result['msg'] = '充值卡已被使用';
                echo(json_encode($result));
                exit();
            }
        } else {
            $result['status'] = -7;
            $result['msg'] = '无效的充值卡';
            echo(json_encode($result));
            exit();
        }
        echo(json_encode($result));
        exit();
    }

    public function actionVerify()
    {
        $result = [
            'status' => 0,
            'msg' => '验证成功',
            't' => time(),
        ];
        $get_info = Yii::$app->request->get();
        $required_paras = ['t', 'uuid', 'sid', 'version', 'code'];
        foreach ($required_paras as $para_key) {
            if (!isset($get_info[$para_key]) || empty($get_info[$para_key])) {
                $result['status'] = -1;
                $result['msg'] = '参数错误';
                echo(json_encode($result));
                exit();
            }
        }
        $curr_time = intval($get_info['t']);
        if (abs(time() - $curr_time) > 300) {
            $result['status'] = -2;
            $result['msg'] = '请求超时';
            echo(json_encode($result));
            exit();
        }
        $uuid = $get_info['uuid'];
        $code = $get_info['code'];
        if (strlen($uuid) != 32 || strlen($code) != 16) {
            $result['status'] = -3;
            $result['msg'] = '参数长度不正确';
            echo(json_encode($result));
            exit();
        } else {
            $result['verify'] = $this->mkcode($code);
        }
        if (!preg_match('/[0-9A-Za-z]/', $uuid)) {
            $result['status'] = -4;
            $result['msg'] = '参数校验失败';
            echo(json_encode($result));
            exit();
        }
        $sid = $get_info['sid'];
        $version = $get_info['version'];
        if (($script_model = Mscripts::findOne($sid)) == null) {
            $result['status'] = -5;
            $result['msg'] = '脚本不存在';
            echo(json_encode($result));
            exit();
        } else {
            $new_version = $script_model -> getVersion();
            if ($version != $new_version) {
                $result['status'] = 3;
                $result['msg'] = '检测到新版本';
                $result['version'] = $new_version;
                $result['name'] = $script_model -> getName();
                $result['size'] = $script_model -> getSize();
                $result['url'] = urlencode_ch($script_model -> getUrl());
                $result['logs'] = $script_model -> getLogs();
                echo(json_encode($result));
                exit();
            } else {
                $script_model -> addRun();
                $script_model -> save();
            }
        }
        if (($device_model = Mdevices::findByUUID($uuid, $sid)) !== null) {
            $device_model -> addRun();
            $device_model -> save();
            $left_time = $device_model -> getTime() - time();
            if ($left_time > 0) {
                $result['status'] = 0;
                $result['lefttime'] = $left_time;
                $result['notice'] = Yii::$app->params['notice'];
            } else {
                $result['status'] = 2;
                $result['lefttime'] = 0;
                $result['notice'] = Yii::$app->params['notice'];
            }
            $result['format'] = $this->time2Units($left_time);
            $result['role'] = $device_model -> getRole();
            echo(json_encode($result));
            exit();
        } else {
            $new_model = new Mdevices();
            $new_info = [
                'Mdevices' => [
                    'uuid' => $uuid,
                    'sid' => $sid,
                    'regtime' => time(),
                    'totime' => time() + intval(Yii::$app->params['mtestTime']),
                    'role' => 0,
                    'runtimes' => 0,
                ],
            ];
            if ($new_model->load($new_info) && $new_model->save()) {
                $new_model -> addRun();
                $new_model -> save();
                $left_time = $new_model -> getTime() - time();
                $result['status'] = 1;
                $result['lefttime'] = $left_time;
                $result['notice'] = Yii::$app->params['notice'];
                $result['format'] = $this->time2Units($left_time);
                $result['role'] = $new_model -> getRole();
                echo(json_encode($result));
                exit();
            } else {
                $result['status'] = -6;
                $result['msg'] = '设备添加失败';
                echo(json_encode($result));
                exit();
            }
        }
        echo(json_encode($result));
        exit();
    }
}
