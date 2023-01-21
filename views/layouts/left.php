<aside class="main-sidebar">

    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
      <li class="header">DASHBOARD MANAJEMEN</li>
      <!-- Optionally, you can add icons to the links -->

      <?php
        if (Yii::$app->user->identity->level == '5') {
          $id_user=Yii::$app->user->identity->id_user;
          $level=Yii::$app->user->identity->level;
        ?>
         
          <li><router-link :to="{name: 'indexMenu', params:  {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"><i class="fa fa-folder"></i> <span>DATA MENU & STOK</span></router-link></li>
          <li><router-link :to="{name: 'indexKategoriMenu', params:  {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"s><i class="fa  fa-list"></i> <span>KATEGORI MENU</span></router-link></li>
          <li><router-link :to="{name: 'indexKategoriPesan', params:  {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"><i class="fa  fa-file"></i> <span>KATEGORI PESANAN</span></router-link></li>
          <li><router-link :to="{name: 'indexMeja', params:  {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"><i class="fa fa-table text-green"></i> <span>DATA MEJA</span></router-link></li>
          <li><router-link :to="{name: 'indexPembayaran', params:  {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"><i class="fa  fa-credit-card"></i> <span>PEMBAYARAN & PJUALAN</span></router-link></li>
          <li><router-link :to="{name: 'indexUserAkun', params:  {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"><i class="fa fa-user"></i> <span>DATA USER SISTEM</span></router-link></li>
      <?php
      }
      elseif(Yii::$app->user->identity->level == '4')
      {
        $id_user=Yii::$app->user->identity->id_user;
        $level=Yii::$app->user->identity->level;
      ?>
         <li><router-link :to="{name: 'pemesanan', params: {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"><i class="fa fa-shopping-cart text-green"></i> <span>PEMESANAN MENU</span></router-link></li>
        <li><router-link :to="{name: 'indexPesananKasir', params: {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"><i class="fa  fa-th-large"></i> <span>DATA PESANAN</span></router-link></li>
      <?php
      }
      elseif(Yii::$app->user->identity->level == '3')
      {
        $id_user=Yii::$app->user->identity->id_user;
        $level=Yii::$app->user->identity->level;
      ?>
          <li><router-link :to="{name: 'indexPesanan', params: {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"><i class="fa  fa-th-large"></i> <span>DATA PESANAN</span></router-link></li>
        <?php
      }
      //MAKANAN
      elseif(Yii::$app->user->identity->level == '2')
      {
        $id_user=Yii::$app->user->identity->id_user;
        $level=Yii::$app->user->identity->level;
        ?>
            <li><router-link :to="{name: 'indexPesanan', params: {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"><i class="fa  fa-th-large"></i> <span>DATA PESANAN</span></router-link></li>
          <?php
      }
      //PELAYAN 
      elseif(Yii::$app->user->identity->level == '1')
      {
        $id_user=Yii::$app->user->identity->id_user;
        $level=Yii::$app->user->identity->level;
        ?>
             <li><router-link :to="{name: 'pemesanan', params: {id_user:'<?= $id_user; ?>',level:'<?= $level ?>'}}"><i class="fa fa-shopping-cart text-green"></i> <span>PEMESANAN MENU</span></router-link></li>
          <?php
      }
      ?>

    </ul>

    </section>

</aside>
