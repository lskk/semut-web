<section class="vbox">
  <header class="header bg-white b-b b-light">
    <p><?=$profile['Name'];?> profile</p>
  </header>
  <section class="scrollable">
    <section class="hbox stretch">
      <aside class="aside-lg bg-light lter b-r">
        <section class="vbox">
          <section class="scrollable">
            <div class="wrapper">
              <div class="clearfix m-b">
                <a href="#" class="pull-left thumb m-r">
                  <img src="<?=base_url();?>/asset/images/avatar_default.jpg" class="img-circle">
                </a>
                <div class="clear">
                  <div class="h3 m-t-xs m-b-xs"><?=$profile['Name'];?></div>
                  <small class="text-muted"><i class="fa fa-map-marker"></i>  Indonesia</small>
                </div>                
              </div>
              <div class="panel wrapper panel-success">
                <div class="row">
                  <div class="col-xs-4">
                    <a href="#">
                      <span class="m-b-xs h4 block"><?=$profile['Poin'];?></span>
                      <small class="text-muted">Poins</small>
                    </a>
                  </div>
                  <div class="col-xs-4">
                    <a href="#">
                      <span class="m-b-xs h4 block"><?=$reports;?></span>
                      <small class="text-muted">Posts</small>
                    </a>
                  </div>
                  <div class="col-xs-4">
                    <a href="#">
                      <span class="m-b-xs h4 block"><?=$checkins;?></span>
                      <small class="text-muted">Checkins</small>
                    </a>
                  </div>
                </div>
              </div>
              <div>
                <small class="text-uc text-xs text-muted">Level</small>
                <p><?if ((int)$profile['PoinLevel']<=1000) {
                  echo 'Newbie';
                } else if ((int)$profile['PoinLevel']<=10000) {
                  echo 'Addict';
                } else if ((int)$profile['PoinLevel']<=50000) {
                  echo 'Geek';
                } else if ((int)$profile['PoinLevel']>50000) {
                  echo 'Freak';
                }
                ?></p>
                <div class="line"></div>
                <small class="text-uc text-xs text-muted">Deposit</small>
                <p>
                  <?  if ((int)$profile['deposit']==null) {
                    echo 'tidak ada deposit';
                  } else  {
                    echo 'Rp. '; 
                    echo  $profile['deposit'];
                  }                     

                  ?>
                </p>

                <div class="line"></div>
                <small class="text-uc text-xs text-muted">Reputation</small>

                <p class="m-t-sm">
                  <div class="sparkline inline" data-type="bar" data-height="15" data-bar-width="15" data-bar-spacing="5" data-stacked-bar-color="['#149625', '#eee']">
                    <?=$Bar;?>
                  </div>
                </p>
              </div>
              <div class="line"></div>
              <small class="text-uc text-xs text-muted">Pin Barcode</small>
              <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='+<?php echo  $profile['Barcode']; ?>" height="100%" width="100%"/>
              <form class="form" id="frmupdate" role="form" action="<?php echo base_url() ?>member/update" method="POST">
                <div class="form-group" style = "display:none">
                  <input type="text" class="form-control" name="contact" value=<?=$profile['ID'];echo rand(100, 200);?>>
                </div>

                <div class="form-group">
                  <input type="hidden" name="hidden" value=<?=$profile['ID'];?>>
                  <input type="submit" class="btn btn-success" id="exampleInputPassword2" value="reload">
                </div>

              </form>
            </div>
            <div class="line"></div>
            <?if(isset($info)) {?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="fa fa-ban-circle"></i><?=$info;?>
            </div>
            <? } if(isset($warning)) {?>
            <div class="alert alert-warning">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <i class="fa fa-ban-circle"></i><?=$warning;?>
            </div>
            <? } ?>


          </div>
        </section>
      </section>
    </aside>
    <aside >

    <input id="tab1" type="radio" name="tabs" checked>
    <label for="tab1">Booking</label>

    <input id="tab2" type="radio" name="tabs">
    <label for="tab2">Account Inquiry</label>

    <input id="tab3" type="radio" name="tabs">
    <label for="tab3">Friend</label>
    
    <input id="tab4" type="radio" name="tabs">
    <label for="tab4">Tag</label>

    <main id="content1" >
      <section >
  <section >
    <table>
      <tr>
        <td><h4>Lokasi Parkir :</h4></td><td>&nbsp;&nbsp;</td>
    <td><form method="post" action="#" name="frm">
      <select name="kode_trayek" onChange="frm.submit();">
          <option value="LSKK Parking">LSKK Parking</option>  
      </select>
    </form></td>
      </tr>
    </table><br>
    <section>
       <img width="480" height="320" src="<?=base_url(); ?>asset/lskkparking/update.jpeg?t='+new Date().getTime()+'">
    </section>
    <section>
    <br>
       <button onclick="myFunction()">Booking</button>

<script>
function myFunction() {
     
    alert("Area parkir yang disarankan adalah lskklot1. Klik Oke untuk booking.");
}
</script>
    </section>
  </section>
</section>
    </main>
    
    <main id="content2">
               
  <table class="table">
    <thead>
      <tr>
        <th>Nomor</th>
        <th>Mata Uang</th>
        <th>Nama Pengguna</th>
        <th>Saldo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>IDR</td>
        <td><?echo $profile['Name'];?></td>
        <td><?echo $profile['deposit'];?></td>
      </tr>
    </tbody>
  </table>
  <br/><br/><br/><br/>
      <section id="charts1" style="min-width: 820px; height: 500px; margin: 0 auto"></section> 
      <br/><br/>  <br/><br/>          
  <table class="table">
    <thead>
      <tr>
        <th>Nomor</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Debet</th>
        <th>Kredit</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>IDR</td>
        <td><?echo $profile['Name'];?></td>
        <td></td>
        <td><?echo $profile['deposit'];?></td>
      </tr>
      <tr>
        <td>2</td>
        <td>IDR</td>
        <td><?echo $profile['Name'];?></td>
        <td><?echo $profile['deposit'];?></td>
        <td></td>
      </tr>
      <tr>
        <td>3</td>
        <td>IDR</td>
        <td><?echo $profile['Name'];?></td>
        <td></td>
        <td><?echo $profile['deposit'];?></td>
      </tr>
      <tr>
        <td>4</td>
        <td>IDR</td>
        <td><?echo $profile['Name'];?></td>
        <td><?echo $profile['deposit'];?></td>
        <td></td>
      </tr>
      <tr>
        <td>5</td>
        <td>IDR</td>
        <td><?echo $profile['Name'];?></td>
        <td></td>
        <td><?echo $profile['deposit'];?></td>
      </tr>
    </tbody>
  </table>
    </main>
    
    <main id="content3">
     <section class="vbox">
        <header class="header bg-light bg-gradient">
          <ul class="nav nav-tabs nav-white">
            <li class="active"><a href="#friends" data-toggle="tab">My Friends</a></li>
            <li class=""><a href="#requests" data-toggle="tab">Friend Requests</a></li>
          </ul>
        </header>
        <section class="scrollable">
          <div class="tab-content">
            <div class="tab-pane active" id="friends">
              <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                <?if ($friend_list) {
                  foreach ($friend_list as $key) {?>
                  <li class="list-group-item">
                    <a href="#" class="thumb-sm pull-left m-r-sm">
                      <img src="<?=base_url(); ?>/asset/images/avatar_default.jpg" class="img-circle">
                    </a>
                    <a href="#" class="clear">
                      <strong class="block"><?=$key['Name'];?></strong>
                      <small>Join date: <?=$key['Joindate'];?></small>
                    </a>
                  </li>
                  <? }
                } else {?>
                <li class="list-group-item">
                  <strong class="block">No Friends</strong>
                </li>
                <?}?>
              </ul>
            </div>
            <div class="tab-pane" id="requests">
              <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                <?if ($friend_req_list) {
                  foreach ($friend_req_list as $key) {?>
                  <li class="list-group-item">
                    <a href="#" class="thumb-sm pull-left m-r-sm">
                      <img src="<?=base_url(); ?>/asset/images/avatar_default.jpg" class="img-circle">
                    </a>
                    <a href="#" class="clear">
                      <strong class="block"><?=$key['Name'];?></strong>
                      <small>Join date: <?=$key['Joindate'];?></small>
                    </a>
                  </li>
                  <? }
                } else {?>
                <li class="list-group-item">
                  <strong class="block">You don't have friend request</strong>
                </li>
                <?}?>
              </ul>
            </div>
          </div>
        </section>
      </section> 
     <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>    
    </main>
    
    <main id="content4">
      <div class="tab-content">
            <div class="tab-pane active" id="post">
              <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                <?if ($post_list) {
                  foreach ($post_list as $key) {?>
                  <li class="list-group-item" href="#email-content" data-toggle="class:show">
                    <a href="#" class="thumb-sm pull-left m-r-sm">
                      <img src="images/avatar_default.jpg" class="img-circle">
                    </a>
                    <a href="#" class="clear">
                      <small class="pull-right"><?=$key->Times;?></small>
                      <strong class="block"><?=$key->Type;?></strong>
                      <small><?=$key->Description;?></small>
                    </a>
                  </li>
                  <?}
                } else {?>
                <li class="list-group-item">
                  <strong class="block">No tags yet</strong>
                </li>
                <?}?>
              </ul>
            </div>
          </div>
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </main>
  </aside>
</section>
</section>
</section>
<style>
       
      @import url("http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
      main {
        display: none;
        padding: 20px 10px 0 10px;
        border-top: 1px solid #ddd;
        margin: 0 auto;
        background: #fff;
      }

      input {
        display: none;
      }
      label {
        display: inline-block;
        margin: 0 0 -1px;
        padding: 15px 25px;
        font-weight: 600;
        text-align: center;
        color: #bbb;
        border: 1px solid transparent;
      }

      label:before {
        font-family: fontawesome;
        font-weight: normal;
        margin-right: 10px;
      }

      label[for*='1']:before {
        content: '\f1cb';
      }

      label[for*='2']:before {
        content: '\f17d';
      }

      label[for*='3']:before {
        content: '\f16b';
      }

      label[for*='4']:before {
        content: '\f1a9';
      }

      label:hover {
        color: #888;
        cursor: pointer;
      }

      input:checked + label {
        color: #555;
        border: 1px solid #ddd;
        border-top: 2px solid orange;
        border-bottom: 1px solid #fff;
      }

      #tab1:checked ~ #content1,
      #tab2:checked ~ #content2,
      #tab3:checked ~ #content3,
      #tab4:checked ~ #content4 {
        display: block;
      }
    </style>
 <script type="text/javascript">
$(function () {
    $('#charts1').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Transaksi Pengguna'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Uang (Rp)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Debet',
            data: [7000, 6900, 9500, 14500, 18400, 21500, 25200, 26500, 23300, 18300, 13900, 9600]
        }, {
            name: 'Kredit',
            data: [3900, 4200, 5700, 8500, 11900, 15200, 17000, 16600, 14200, 10300, 6600, 4800]
        }]
    });
});
    </script>