<?php
//automattic woocommerce dosyasını import ettim.
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://stage.creavitbelgium.be', // woocommerce magaza urlsi.
    'ck_bed58273305703e6188430d0cedd8064d3e3b205', // magaza anahtarı.
    'cs_feccf990c84682649d6f3fa63204e3ec7533b2e3', // secret anahtar numarası.
    [
        'wp_api' => true, //entegrasyonu etkinleştirme.
        'version' => 'wc/v3' // rest api versiyon.
    ]
);

$list = $woocommerce->get('orders'); //tüm siparişlerin listesini aldım.

echo '<pre>';
print_r($list); //tüm verileri ekranda gösterdim.
echo '</pre>';

echo '<h3>Sipariş Listesi</h3>';
//döngü ile sipariş verenlerin isimlerini ve siparişteki fiyat toplamını listeledim.
  foreach ($list as $key => $obj) { ?> 
    <ul>
       <li><?php echo $obj->billing->first_name; ?> : <?php echo $obj->total.'€'; ?></li>
    </ul>
   
  <?php } 

  //veri güncellemek için array list

    $data = array(
     'billing' => 
         array(
             'first_name' => 'Murat',
             'postcode'   => '1050',
             'state'      => '1'
     ) 
    );


  $woocommerce->put('orders/4224', $data); //4224 idli siparişin güncellenecek olan dataları.



  $data2 = array(
    'billing' => 
        array(
            'company'    => 'istanbul',
            'postcode'   => '34550',
            'state'      => '1'
     ) 
    );

  $woocommerce->put('orders/4223', $data2);//4223 idli siparişin güncellenecek olan dataları

  echo '<h3>Güncellenenler Listesi</h3>'; // güncellenmiş olarak olarak kaydettim
   foreach ($list as $key => $obj) {
   
    if($obj->billing->state == '1'){ ?>

       <ul>
    
         <li><?php echo $obj->billing->first_name; ?> : <?php echo $obj->total.'€'; ?></li>

       </ul>

   <?php }

  }

  ?>
