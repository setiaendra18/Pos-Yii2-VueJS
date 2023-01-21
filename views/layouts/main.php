<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

if (Yii::$app->controller->action->id === 'login') {
/**
 * Do not use this code in your template. Remove it.
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage()?>
    <!DOCTYPE html>
    <html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?=Html::csrfMetaTags()?>
        <title><?=Html::encode($this->title)?></title>
        <?php $this->head()?>
        <link rel="manifest" href="manifest.json" />
        <script type="text/javascript" src="OneSignalSDK.js"  async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "1bd90289-0c1e-419a-bab2-bf400ec66778",
      allowLocalhostAsSecureOrigin: true,
    });
  });
</script>
    </head>
    <body class="hold-transition skin-green-light fixed sidebar-mini">
    <?php $this->beginBody()?>
    <div class="wrapper" id="app">

        <?=$this->render(
        'header.php',
        ['directoryAsset' => $directoryAsset]
    )?>

        <?=$this->render(
        'left.php',
        ['directoryAsset' => $directoryAsset]
    )
    ?>

        <?=$this->render(
        'content.php',
        ['content' => $content, 'directoryAsset' => $directoryAsset]
    )?>

    </div>

    <?php $this->endBody()?>
    </body>
    </html>
    <?php $this->endPage()?>
<?php }?>
