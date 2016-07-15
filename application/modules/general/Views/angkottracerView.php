<section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><i class="fa fa-home"></i> Home</li>
              </ul>
              <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-users fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Angkot Stand by terminal</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-users fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong>34</strong></span>
                      <small class="text-muted text-uc">Angkot Running</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">                     
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-map-marker fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Angkot Off</small>
                    </a>
                  </div>
                </div>
              </section>
<section class="vbox bg-white">
  <header class="header b-b b-light hidden-print">
    <p>Statistik Angkot</p>
  </header>
  <section class="scrollable padder">
    <table>
      <tr>
        <td><h4>Trayek Angkot :</h4></td><td>&nbsp;&nbsp;</td>
    <td><form method="post" action="<?=base_url(); ?>general/angkottracer" name="frm">
      <select name="kode_trayek" onChange="frm.submit();">
        <?php
          $this->db->select('KODE_TRAYEK,NAMA_TRAYEK');
          $this->db->from('at_trayek');
          $query = $this->db->get();
          foreach ($query->result() as $row) { 
        ?>
        <option value="<?php echo $row->NAMA_TRAYEK; ?>"><?php echo $row->NAMA_TRAYEK;?></option>
        <?php } ?>
      </select>
    </form></td>
      </tr>
    </table><br>
    <div class="row">
      <div id="charts1"></div>
    </div>
  </section>
</section>

<script >
$(function () { 
    $('#charts1').highcharts({
        chart: {
            type: 'line'
        },
        rangeSelector : {
                allButtonsEnabled: true,
                buttons: [{
                    type: 'month',
                    count: 3,
                    text: 'Day',
                    dataGrouping: {
                        forced: true,
                        units: [['day', [1]]]
                    }
                }, {
                    type: 'year',
                    count: 1,
                    text: 'Week',
                    dataGrouping: {
                        forced: true,
                        units: [['week', [1]]]
                    }
                }, {
                    type: 'all',
                    text: 'Month',
                    dataGrouping: {
                        forced: true,
                        units: [['month', [1]]]
                    }
                }],
                buttonTheme: {
                    width: 60
                },
                selected: 2
            },
        title: {
            <?php if (isset($_POST['kode_trayek'])) { ?>
            text: 'Statistik Penumpang Angkot Trayek <?php echo $_POST['kode_trayek']; ?>'
            <?php 
             }
             else{ ?>
              text: 'Statistik Penumpang Angkot'
              <?php
             }
            ?>
        },
        xAxis: {
            categories: ['2015-08-06', '2015-08-19', '2015-08-28','2015-09-04','2015-09-23','2015-09-30','2015-10-01']
        },
        yAxis: {
            title: {
                text: 'Total Penumpang'
            }
        },
        series: [{
            name: 'Total Penumpang Angkot',
            data: [30, 40, 60, 50, 20, 30, 80]
        }]
    });
});
</script>