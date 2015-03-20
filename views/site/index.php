<?php
/* @var $this yii\web\View */
$this->title = '主页';
?>
<div class="site-index">
<?php if(Yii::$app->user->isGuest): ?>
    <div class="jumbotron">
        <h2>客户您好！</h2>

        <p class="lead">欢迎光临 <b><?= Yii::$app->params['siteName'] ?></b>。</p>

    </div>
<?php else: ?>
    <div class="jumbotron">
        <h2>管理员您好！</h2>

        <p class="lead">这是您在 82Flex 定制的 <b><?= Yii::$app->params['siteName'] ?></b> 站点后台，您可以在这里管理您脚本的充值卡、使用设备及脚本验证信息。</p>

        <p><a class="btn btn-lg btn-success" href="http://82flex.com">访问 82Flex</a></p>
    </div>
<?php endif; ?>
</div>
