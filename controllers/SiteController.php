<?php
namespace frontend\controllers;
date_default_timezone_set('Asia/Shanghai');

use Yii;
use frontend\models\LoginForm;
use frontend\models\RechargeForm;
use frontend\models\UploadForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'upload'],
                'rules' => [
                    [
                        'actions' => ['logout', 'upload'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionRecharge()
    {
        $model = new RechargeForm();
        if ($model->load(Yii::$app->request->post())) {
            $result = $model->save();
            if ($result == 0) {
                return $this->render('success', [
                    'name' => '充值成功',
                    'message' => '向设备号 '.$model->uuid.' 充值 '.$model->days.' 天成功，感谢您的支持！',
                ]);
            } else if ($result == 1) {
                return $this->render('error', [
                    'name' => '充值失败',
                    'message' => '设备尚未注册，请先运行一次脚本以注册！',
                ]);
            } else if ($result == 2) {
                return $this->render('error', [
                    'name' => '充值失败',
                    'message' => '充值卡已被使用！',
                ]);
            } else if ($result == 3) {
                return $this->render('error', [
                    'name' => '充值失败',
                    'message' => '无效的充值卡！',
                ]);
            } else if ($result == 4) {
                return $this->render('recharge', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('error', [
                    'name' => '充值失败',
                    'message' => '未知错误！',
                ]);
            }
        } else {
            return $this->render('recharge', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionUpload() {
        $model = new UploadForm();
        if (Yii::$app->request->post()) {
            $isSuc = false;
            $root = Yii::$app->basePath;
            $folder = $root.'/web/static/';
            $script = UploadedFile::getInstance($model, 'script');
            $msg = '';
            $ext = $script->getExtension();
            if ($ext == "lua" || $ext == "luac") {
                $msg .= "上传文件：" . $script->name . "\n";
                $msg .= "文件尺寸：" . $script->size . " 字节\n";
                $desFilePath = $folder.$script->name;
                $msg .= "上传完成：/static/" . $script->name . "\n";
                if (file_exists($desFilePath)) {
                    unlink($desFilePath);
                }
                $script->saveAs($desFilePath);
                $isSuc = true;
            } else {
                $msg .= "无效的文件类型。";
            }
            if ($isSuc == true) {
                return $this->render('success', [
                    'name' => '上传成功',
                    'message' => $msg,
                ]);
            } else {
                return $this->render('error', [
                    'name' => '上传失败',
                    'message' => $msg,
                ]);
            }
        } else {
            return $this->render('upload', ['model' => $model]);
        }
    }
}
