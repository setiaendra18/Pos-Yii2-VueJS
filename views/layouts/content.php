<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section class="content container-fluid">
    <transition>
        <router-view></router-view>
    </transition>
    <div v-if="this.$route.matched.length == 0">
    
        <?= $content ?>
    </div>
    </section>
</div>

<footer class="main-footer">
    
    <strong>Made With 	&#10084; Endra Setiawan Teknik Informatika 2018<br>
   <!-- AdminLTE Template :Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.-->
</footer>

