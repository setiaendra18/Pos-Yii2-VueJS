<?php

/* @var $this yii\web\View */

$this->title = 'CAMILES MANAJEMEN SISTEM';
?>
<div class="site-index">
    <div class="body-content">
    <h2 class="text-center">-- SELAMAT DATANG DI SISTEM --</h2>
   <h3 class="text-center"><?=Yii::$app->user->identity->nama?> -- Sebagai :




                            <?php
$level = Yii::$app->user->identity->level;

if ($level == 1) {
    ?>
                            <span class="label label-warning">PELAYAN</span>
                            <?php
} else if ($level == 2) {
    ?>
                            <span class="label label-success">DIVISI MAKANAN</span>
                            <?php
} else if ($level == 3) {
    ?>
                            <span class="label label-info">DIVISI MINUMAN</span>
                            <?php
} else if ($level == 4) {
    ?>
                            <span class="label label-primary">KASIR</span>
                            <?php
} else {
    ?>
                            <span class="label label-danger">ADMIN</span>
                            <?php
}

?>

</h3>

    </div>
</div>
