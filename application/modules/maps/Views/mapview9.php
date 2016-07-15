          <section class="vbox">
            <div class="drawer drawer-right">
              <header role="banner">
                <div class="drawer-header">
                  <button type="button" class="drawer-toggle drawer-hamburger">
                    <p>Map Options</p>
                  </button>
                </div>

                <div class="drawer-main drawer-default">
                  <nav class="drawer-nav" role="navigation">
                    <ul class="drawer-menu">
                      <li class="drawer-menu-item">
                        Map Item Selector
                        <ul class="drawer-submenu">
                          <li class="drawer-submenu-item"><input type="checkbox" name="report" id="report" onclick="onclick_report()" checked="true"> Tags/Reports</li>
                          <li class="drawer-submenu-item"><input type="checkbox" name="semuter" id="semuter" onclick="onclick_user()"> Semut Member</li>
                          <li class="drawer-submenu-item"><input type="checkbox" name="commuter" id="commuter" onclick="onclick_stops()" checked="true"> Commuter Train</li>
                          <? if (!$this->session->userdata('logged_in')) { ?>
                          <li class="drawer-submenu-item"><input type="checkbox" name="cctv" id="cctv" onclick="onclick_cctv()" checked="true"> Cameras</li>
						  
                          <? } else { ?>
						  <li class="drawer-submenu-item"><input type="checkbox" name="parkingplace" id="parkingplace" onclick="click_place_parking()" checked="true"> Parking Areas</li>
                          <li class="drawer-submenu-item"><input type="checkbox" name="friends" id="friends" onclick="onclick_friends()" checked="true"> Friends</li>
                          <li class="drawer-submenu-item"><input type="checkbox" name="cctv_v" id="cctv_v" onclick="onclick_cctv_video()" checked="true"> Cameras</li>
                          <?}?>
                        </ul>
                        Places Item Selector
                        <ul class="drawer-submenu">
                          <li class="drawer-submenu-item"><input type="checkbox" name="foodplace" id="foodplace" onclick="click_place_food()"> Food & Drink</li>
                          <li class="drawer-submenu-item"><input type="checkbox" name="hotelplace" id="hotelplace" onclick="click_place_hotel()"> Hotel</li>
                          <li class="drawer-submenu-item"><input type="checkbox" name="hospitalplace" id="hospitalplace" onclick="click_place_hospital()"> Hospital</li>
                          <li class="drawer-submenu-item"><input type="checkbox" name="gasplace" id="gasplace" onclick="click_place_gas()"> Gas Station</li>
                          <li class="drawer-submenu-item"><input type="checkbox" name="fashionplace" id="fashionplace" onclick="click_place_fashion()"> Fashion</li>
                          <li class="drawer-submenu-item"><input type="checkbox" name="univplace" id="univplace" onclick="click_place_univ()"> University</li>
                        </ul>
						<input type="checkbox" name="angkotplace" class="angkotplace" onclick="click_place_angkot(26)">&nbsp;&nbsp;Show Angkot
           <br><a onclick="showPopup('popup');" style="cursor:pointer">Daftar Trayek Angkot</a>
                      </li>
                    </ul>

                    <div class="drawer-footer"><span></span></div>
                  </nav>
                </div>
              </header>

              <div class="drawer-overlay">
              </div>
            </div>
            <div id='peta'>
				<img id="lot" src="<?=base_url(); ?>asset/lskkparking/empty_small.jpg" hidden>
				<img id="car" src="<?=base_url(); ?>asset/lskkparking/red-car_small.png" hidden>
				<img id="nocar" src="<?=base_url(); ?>asset/lskkparking/no_car_small.jpg" hidden>
            </div>
			<div id="popup" style="display:none;
    position:absolute;
    top:50%;
    left:50%;
    height:400px;
    width:400px;
    margin:-200px 0 0 -200px;background:#fff;color:#000;padding:20px;overflow-y:scroll;">
    <ul style="list-style-type:none;">
      <h3>Trayek Angkot</h3>
       <?php
          $this->db->select('KODE_TRAYEK,NAMA_TRAYEK');
          $this->db->from('at_trayek');
          $query = $this->db->get();
          foreach ($query->result() as $row) { ?>
          <li style="padding:5px;margin:5px;"><input type="checkbox" name="angkotplace" class="trayekplace" onclick="click_place_angkot2(<?php echo $row->KODE_TRAYEK;?>)">
          <?php echo $row->NAMA_TRAYEK; ?>
        </li>
        <?php 
        }
        ?>
    </ul>
    <br><a onclick="closePopup('popup');" style="cursor:pointer;color:#ff0000;">(X) Tutup</a>
  </div>
          </section>
    

<script>
$(document).ready(function() {
  $(".drawer").drawer();
});
function showPopup(id){
  var popup = document.getElementById(id);
  popup.style.display ='block';
}
function closePopup(id){
  var popup = document.getElementById(id);
  popup.style.display ='none';
}
  window.base_url = <?php echo json_encode(base_url()); ?>;
  var map = L.map('peta').setView([-6.9268,107.6035], 13);

  var day = <?=$time; ?>;
  var isLogedIn = <?=$isloggedin;?>;

  var semuters;
  var usermarker;
  var userLayer   = L.layerGroup();

  var friends;
  var friendmarker;
  var friendLayer   = L.layerGroup();

  var cctv;
  var cctvmarker;
  //var cctvLayer = new L.MarkerClusterGroup();
  var cctvLayer = L.layerGroup();

  var reports;        
  var reportsmarker;
  var reportLayer = L.layerGroup();

  var foods;        
  var foodmarker;
  var foodLayer = L.layerGroup();

  var hotels;        
  var hotelmarker;
  var hotelLayer = L.layerGroup();

  var hospitals;        
  var hospitalmarker;
  var hospitalLayer = L.layerGroup();

  var gases;        
  var gasmarker;
  var gasLayer = L.layerGroup();

  var fashions;        
  var fashionmarker;
  var fashionLayer = L.layerGroup();

  var univs;        
  var univmarker;
  var univLayer = L.layerGroup();
  
  var parkings;        
  var parkingmarker;
  var parkingLayer = L.layerGroup();
  
  var angkot;   
  var angkotTrayek;     
  var angkotmarker;
  var angkotLayer = L.layerGroup();
  
  var camLayer = L.layerGroup();
  
  var station;
  var stationmarker;
  var stationLayer = L.layerGroup();

  var train;
  var trainmarker;
  var trainLayer = L.layerGroup();


  var stopsPopupContent = '<div></div>';
  window.base_url = <?php echo json_encode(base_url()); ?>;

    var femaleIcon = L.icon({
        iconUrl: base_url+'/asset/images/female.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var maleIcon = L.icon({
        iconUrl: base_url+'/asset/images/male.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var cameraIcon = L.icon({
        iconUrl: base_url+'/asset/images/camera.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var foodIcon = L.icon({
        iconUrl: base_url+'/asset/images/resto.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var hotelIcon = L.icon({
        iconUrl: base_url+'/asset/images/hotel.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var hospitalIcon = L.icon({
        iconUrl: base_url+'/asset/images/hospital.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var gasIcon = L.icon({
        iconUrl: base_url+'/asset/images/gas.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var fashionIcon = L.icon({
        iconUrl: base_url+'/asset/images/fashion.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var universityIcon = L.icon({
        iconUrl: base_url+'/asset/images/university.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var trafficIcon = L.icon({
        iconUrl: base_url+'/asset/images/traffic.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var policeIcon = L.icon({
        iconUrl: base_url+'/asset/images/police.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var accidentIcon = L.icon({
        iconUrl: base_url+'/asset/images/accident.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var disasterIcon = L.icon({
        iconUrl: base_url+'/asset/images/disaster.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var closureIcon = L.icon({
        iconUrl: base_url+'/asset/images/closure.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });

    var otherIcon = L.icon({
        iconUrl: base_url+'/asset/images/report.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
	
	var parkingIcon = L.icon({
        iconUrl: base_url+'/asset/images/parking.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
	
	var angkotIcon1 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot1.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon2 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot2.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon3 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot3.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon4 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot4.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon5 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot5.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon6 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot6.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon7 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot7.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon8 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot8.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon9 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot9.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon10 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot10.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon11 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot11.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon12 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot12.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon13 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot13.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon14 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot14.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon15 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot15.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon16 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot16.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon17 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot17.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon18 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot18.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon19 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot19.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon20 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot20.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon21 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot21.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon22 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot22.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon23 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot23.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon24 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot24.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon25 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot25.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon26 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot26.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon27 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot27.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var angkotIcon28 = L.icon({
        iconUrl: base_url+'/asset/angkottracer/position/Angkot28.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
  var stationIcon = L.icon({
        iconUrl: base_url + '/asset/commuter/img/marker-station.png',

        iconSize:     [28, 44], // size of the icon
        iconAnchor:   [14, 43], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });


    var trainIcon = L.icon({
        iconUrl: base_url + '/asset/commuter/img/marker-train.png',

        iconSize:     [30, 30], // size of the icon
        iconAnchor:   [14, 20] // point of the icon which will correspond to marker's location
        // popupAnchor:  [0, -43] // point from which the popup should open relative to the iconAnchor
    });
	
  $(function() {
    if (day==1) {
      L.tileLayer('http://api.tiles.mapbox.com/v4/mapbox.light/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoic3J1cGllZWUiLCJhIjoib05wWVBWTSJ9.RqbymEhEdLg2eDuVr6oPZg', {
     
      maxZoom: 20,
      minZoom: 4
      }).addTo(map);
    } else{
      L.tileLayer('http://api.tiles.mapbox.com/v4/mapbox.dark/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoic3J1cGllZWUiLCJhIjoib05wWVBWTSJ9.RqbymEhEdLg2eDuVr6oPZg', {
     
      maxZoom: 20,
      minZoom: 4
      }).addTo(map);
    };
    onclick_report();
    onclick_user();
    onclick_stops();
    if (isLogedIn == 0) {
      onclick_cctv();
	  click_place_parking();
    }else if(isLogedIn == 1){
      onclick_friends;
      onclick_cctv_video;
	  click_place_parking();
    };
  });

function onclick_report() {
  reportLayer.clearLayers();
  var reportIcon;
  $.get('<?=base_url('maps/get_reports')?>', function(reports) {
    reports = $.parseJSON(reports);
    if($('#report').is(":checked")){
      for(i=0;i<reports.length;i++){
          if (reports[i].parenttype == 1) {
            reportIcon = trafficIcon;
          } else if (reports[i].parenttype == 2) {
            reportIcon = policeIcon;  
          } else if (reports[i].parenttype == 3) {
            reportIcon = accidentIcon;
          } else if (reports[i].parenttype == 4) {
            reportIcon = disasterIcon;
          } else if (reports[i].parenttype == 5) {
            reportIcon = closureIcon;
          } else if (reports[i].parenttype == 6){
            reportIcon = otherIcon;
          };
          reportsmarker = new L.marker([reports[i].lat,reports[i].lon], {icon: reportIcon});
          reportLayer.addLayer(reportsmarker);
          reportsmarker.bindPopup(reports[i].type+' | Description:'+ reports[i].description +'<br> Time: '+reports[i].time+'| By: '+reports[i].reporter);
      }
      reportLayer.addTo(map);
    }
    
  });
}

function onclick_user() {
  userLayer.clearLayers();
  $.post('<?=base_url('maps/get_semuters')?>', function(semuters) {
    semuters = $.parseJSON(semuters);   
    if($('#semuter').is(":checked")){
      for(i=0;i<semuters.length;i++){
          var userIcon = maleIcon;
          if (semuters[i].avt == 0) {
            userIcon = femaleIcon;
          };
          usermarker = new L.marker([semuters[i].lat,semuters[i].lon], {icon: userIcon});
          userLayer.addLayer(usermarker);
          usermarker.bindPopup(semuters[i].name);
      }
      userLayer.addTo(map);
    }
  });
}

function onclick_friends() {
  friendLayer.clearLayers();
  $.post('<?=base_url('maps/get_member_friends')?>', function(friends) {
    friends = $.parseJSON(friends);   
    if($('#friends').is(":checked")){
      for(i=0;i<friends.length;i++){
          var userIcon = maleIcon;
          if (friends[i].avt == 0) {
            userIcon = femaleIcon;
          };
          friendmarker = new L.marker([friends[i].lat,friends[i].lon], {icon: userIcon});
          friendLayer.addLayer(friendmarker);
          friendmarker.bindPopup(friends[i].name);
      }
      friendLayer.addTo(map);
    }
  });
}

function onclick_cctv() {
  cctvLayer.clearLayers();
  $.post('<?=base_url('maps/get_cctv')?>', function(cctv) {
    cctv = $.parseJSON(cctv);
    if($('#cctv').is(":checked")){
      for(i=0;i<5;i++){
          cctvmarker = new L.marker([cctv[i].Latitude,cctv[i].Longitude], {icon: cameraIcon});
          cctvLayer.addLayer(cctvmarker);
          cctvmarker.bindPopup('<img width="320" height="240" src="'+cctv[i].Screenshot+'"><br><p>',{maxWidth: 600});
      }
      //cctvLayer.addTo(map);
      map.addLayer(cctvLayer);
    }
    
  });
}

function onclick_cctv_video() {
  cctvLayer.clearLayers();
  $.post('<?=base_url('maps/get_cctv')?>', function(cctv) {
    cctv = $.parseJSON(cctv);
    if($('#cctv_v').is(":checked")){
      for(i=0;i<5;i++){
          cctvmarker = new L.marker([cctv[i].Latitude,cctv[i].Longitude], {icon: cameraIcon});
          cctvLayer.addLayer(cctvmarker);
          cctvmarker.bindPopup('<video width="320" height="240" autoplay controls><source src="'+ cctv[i].Video +'" type="video/mp4">Your browser does not support the video tag.</video>',{maxWidth: 400});
      }
      cctvLayer.addTo(map);
    }
    
  });
}

function click_place_food() {
  foodLayer.clearLayers();
  $.get('<?=base_url('maps/get_places?type=1')?>', function(foods) {
    foods = $.parseJSON(foods);
    if($('#foodplace').is(":checked")){
      for(i=0;i<foods.length;i++){
          foodmarker = new L.marker([foods[i].lat,foods[i].lon], {icon: foodIcon});
          foodLayer.addLayer(foodmarker);
          foodmarker.bindPopup(foods[i].name+'<br>'+foods[i].address);
      }
      foodLayer.addTo(map);
    }
  });
}

function click_place_angkot() {
   angkotLayer.clearLayers();
  $.get('<?=base_url('maps/get_angkot')?>', function(angkot) {
    angkot = $.parseJSON(angkot);
    if($('.angkotplace').is(":checked")){
      for(i=0;i<angkot.length;i++){
          // if(angkot[i].KODE_TRAYEK==kode){
            if(angkot[i].JUMLAH_PENUMPANG==1){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon1});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon2});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==2){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon3});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon4});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==3){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon5});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon6});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==4){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon7});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon8});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==5){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon9});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon10});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==6){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon11});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon12});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==7){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon13});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon14});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==8){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon15});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon16});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==9){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon17});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon18});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==10){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon19});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon20});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==11){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon21});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon22});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==12){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon23});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon24});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==13){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon25});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon26});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==14){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon27});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon28});
              }
            }
            angkotLayer.addLayer(angkotmarker);
          // }
          angkotmarker.bindPopup('Jumlah Penumpang : '+angkot[i].JUMLAH_PENUMPANG+'<br>');
      }
      angkotLayer.addTo(map);
    }
  });
}

function click_place_angkot2(kode) {
   angkotLayer.clearLayers();
  $.get('<?=base_url('maps/get_angkot')?>', function(angkot) {
    angkot = $.parseJSON(angkot);
    if($('.trayekplace').is(":checked")){
      for(i=0;i<angkot.length;i++){
          if(angkot[i].KODE_TRAYEK==kode){
            if(angkot[i].JUMLAH_PENUMPANG==1){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon1});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon2});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==2){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon3});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon4});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==3){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon5});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon6});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==4){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon7});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon8});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==5){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon9});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon10});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==6){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon11});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon12});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==7){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon13});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon14});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==8){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon15});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon16});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==9){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon17});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon18});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==10){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon19});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon20});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==11){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon21});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon22});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==12){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon23});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon24});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==13){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon25});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon26});
              }
            }
            else if(angkot[i].JUMLAH_PENUMPANG==14){
              if(angkot[i].PERJALANAN==1){
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon27});
              }
              else{
                angkotmarker = new L.marker([angkot[i].LAT,angkot[i].LON], {icon: angkotIcon28});
              }
            }
            angkotLayer.addLayer(angkotmarker);
          }
          angkotmarker.bindPopup('Jumlah Penumpang : '+angkot[i].JUMLAH_PENUMPANG+'<br>');
      }
      angkotLayer.addTo(map);
    }
  });
}


function click_place_hotel() {
  hotelLayer.clearLayers();
  $.get('<?=base_url('maps/get_places?type=2')?>', function(hotels) {
    hotels = $.parseJSON(hotels);
    if($('#hotelplace').is(":checked")){
      for(i=0;i<hotels.length;i++){
          hotelmarker = new L.marker([hotels[i].lat,hotels[i].lon], {icon: hotelIcon});
          hotelLayer.addLayer(hotelmarker);
          hotelmarker.bindPopup(hotels[i].name+'<br>'+hotels[i].address);
      }
      hotelLayer.addTo(map);
    }
  });
}

function click_place_hospital() {
  hospitalLayer.clearLayers();
  $.get('<?=base_url('maps/get_places?type=7')?>', function(hospitals) {
    hospitals = $.parseJSON(hospitals);
    if($('#hospitalplace').is(":checked")){
      for(i=0;i<hospitals.length;i++){
          hospitalmarker = new L.marker([hospitals[i].lat,hospitals[i].lon], {icon: hospitalIcon});
          hospitalLayer.addLayer(hospitalmarker);
          hospitalmarker.bindPopup(hospitals[i].name+'<br>'+hospitals[i].address);
      }
      hospitalLayer.addTo(map);
    }
  });
}

function click_place_gas() {
  gasLayer.clearLayers();
  $.get('<?=base_url('maps/get_places?type=4')?>', function(gases) {
    gases = $.parseJSON(gases);
    if($('#gasplace').is(":checked")){
      for(i=0;i<gases.length;i++){
          gasmarker = new L.marker([gases[i].lat,gases[i].lon], {icon: gasIcon});
          gasLayer.addLayer(gasmarker);
          gasmarker.bindPopup(gases[i].name+'<br>'+gases[i].address);
      }
      gasLayer.addTo(map);
    }
  });
}

function click_place_fashion() {
  fashionLayer.clearLayers();
  $.get('<?=base_url('maps/get_places?type=3')?>', function(fashions) {
    fashions = $.parseJSON(fashions);
    if($('#fashionplace').is(":checked")){
      for(i=0;i<fashions.length;i++){
          fashionmarker = new L.marker([fashions[i].lat,fashions[i].lon], {icon: fashionIcon});
          fashionLayer.addLayer(fashionmarker);
          fashionmarker.bindPopup(fashions[i].name+'<br>'+fashions[i].address);
      }
      fashionLayer.addTo(map);
    }
  });
}

function click_place_univ() {
  univLayer.clearLayers();
  $.get('<?=base_url('maps/get_places?type=6')?>', function(univs) {
    univs = $.parseJSON(univs);
    if($('#univplace').is(":checked")){
      for(i=0;i<univs.length;i++){
          univmarker = new L.marker([univs[i].lat,univs[i].lon], {icon: universityIcon});
          univLayer.addLayer(univmarker);
          univmarker.bindPopup(univs[i].name+'<br>'+univs[i].address);
      }
      univLayer.addTo(map);
    }
  });
}

function click_place_parking() {
		parkingLayer.clearLayers();
		$.get('<?=base_url('maps/get_places?type=11')?>', function(parkings) {
			parkings = $.parseJSON(parkings);
			if($('#parkingplace').is(":checked")){
			  for(i=0;i<parkings.length;i++){
				  parkingmarker = new L.marker([parkings[i].lat,parkings[i].lon], {icon: parkingIcon});
				  parkingLayer.addLayer(parkingmarker);
				  
					  parkingmarker.bindPopup( 
						'<canvas onload="loadImgs()" id="myCanvas" style="border:0px width="270" height="150" solid #c3c3c3;">Your browser does not support the HTML5 canvas tag.</canvas>'
						);
				  
				}
			  parkingLayer.addTo(map);
			  map.addLayer(parkingLayer);
			}
		});
}

setInterval(function(){
	//alert('interval');
	$.get('<?=base_url('parking/get_lot_data')?>', function(data) {
		//alert('get '+data);
		dt = $.parseJSON(data);
		  for(i=0;i<dt.length;i++){
				var c = document.getElementById("myCanvas");
				var context = c.getContext("2d");
				var lot = document.getElementById("lot");
				var car = document.getElementById("car");
				var nocar = document.getElementById("nocar");
				context.drawImage(lot, 0, 0);
				
				var size = 17;
				var x = 3;
				var y = 40;
				var g = 20;
				var xPosDuration = 25;
				var xPosPay = 50;
				context.font = "20px Georgia";
				context.fillStyle = "#ffffff";
				
				context.fillText("LSKK Parking",3, xPosDuration);
				context.font = "12px Georgia";
				for(var i=0;i<8;i++){
					var m = dt[i].lot_stat;
					context.fillText("Lot-"+(i+1),x+(g*i)+5,125);
					if(m == 1) {
						context.drawImage(car, x+(g*i),y);
					}
					else {
						context.drawImage(nocar,x+(g*i),y);
					}
					x = x + size;
				}
			}
			c.addEventListener('click', function() { 
				//parkingLayer.clearLayers();
				loadCam();
				//click_place_parking();
			}, false);
	});
}, 5000) //every 5 seconds check to db

function loadCam(){
		parkingLayer.clearLayers();
	  $.get('<?=base_url('maps/get_places?type=11')?>', function(data) {
		data = $.parseJSON(data);
		if($('#parkingplace').is(":checked")){
		  for(i=0;i<data.length;i++){
			parkingmarker = new L.marker([data[i].lat,data[i].lon], {icon: parkingIcon});
			parkingLayer.addLayer(parkingmarker);
			
			if(data[i].ID == '272')
			{
			  parkingmarker.bindPopup(
			  '<a href="#" onclick="click_place_parking();">'
			  +'<img width="320" height="240" src="<?=base_url(); ?>asset/lskkparking/update.jpeg?t='+new Date().getTime()+'">'
			  +'</a><br>'
			  +'<? if (!$this->session->userdata('logged_in')) { ?>'
			  +'<b>'+data[i].name+'</b><br>'+data[i].address+'<br><br>'+data[i].description,{maxWidth: 340}
			  +'<? } else { ?>'
			  +'</a><br>'
			  +'<font size="5"><a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='+<?php echo  $profile['Barcode'] ?>+'&choe=UTF-8" target="_blank">print</a></font><br>'
			  +'<b>'+data[i].name+'</b><br>'+data[i].address+'<br><br>'+data[i].description,{maxWidth: 340}
			  +'<? } ?>'
				);
			}else if(data[i].ID == '273')
			{
					parkingmarker.bindPopup(
					  '<img width="320" height="240" src="<?=base_url(); ?>asset/lskkparking/sabuga.jpeg">'
					  +'<br>'
					  +'<b>'+data[i].name+'</b><br>'+data[i].address+'<br><br>'+data[i].description,{maxWidth: 340}
						);
			}else{
					parkingmarker.bindPopup(
				  '<img width="320" height="240" src="<?=base_url(); ?>asset/lskkparking/rshs.jpeg">'
				  +'<br>'
				  +'<b>'+data[i].name+'</b><br>'+data[i].address+'<br><br>'+data[i].description,{maxWidth: 340}
					);
			}
		 }
		  parkingLayer.addTo(map);
		  map.addLayer(parkingLayer);
			}
	});
}
function onclick_stops(){
  stationLayer.clearLayers();
  $.get('<?=base_url('maps/get_stops')?>', function(stops) {
    // stops = $.parseJSON(stops);
    if($('#commuter').is(":checked")){

      console.log(stops.length);

      for(var i=0; i < stops.length; i++){
        stationmarker = new L.marker([stops[i].stop_lat, stops[i].stop_lon], {num: i, stop: stops[i], stop_id: stops[i].stop_id, icon: stationIcon});
        stationmarker.bindPopup('<h4><a href="' + stops[i].stop_url + '"target="_blank">'+ stops[i].stop_name + '</a></h4>\
            <div>' + stops[i].stop_desc + '</div>\
            <h5>Jadwal Kereta</h5>\
            <ul class="span-jadwal"></ul>\
            ').on('click', onStopsClick);
        stationLayer.addLayer(stationmarker);



        // L.marker([stops[i].stop_lat, stops[i].stop_lon], {num: i, stop: stops[i], stop_id: stops[i].stop_id, icon: stationIcon})
        //   .bindPopup('<h3><a href="' + stops[i].stop_url + '"target="_blank">'+ stops[i].stop_name + '</a></h3>\
        //     <div>' + stops[i].stop_desc + '</div>\
        //     <h4>Jadwal Kereta</h4>\
        //     <ul class="span-jadwal"></ul>\
        //     ')
        //   .addTo(map).on('click', onStopsClick);
      }

      stationLayer.addTo(map);
    }

  });
}

function onStopsClick(e) {
  console.log(this.options.stop_id);

  $.get('<?=base_url('maps/get_stops_time')?>' + '/' + this.options.stop_id, function(stops_time) {
    // stops_time = $.parseJSON(stops_time);

    console.log(stops_time.length);
    // console.log(stops_time[0]);

    var span_jadwal = '';

    for(var i=0; i < stops_time.length; i++){
      console.log(stops_time[i].trip_id + '-' + stops_time[i].arrival_time + '-' + stops_time[i].departure_time + '-');
      span_jadwal = span_jadwal + '<li><span class="trip-id" data-trip-id="KA'+ stops_time[i].trip_id +'" >' + stops_time[i].trip_id + '</span> <span class="arrival-time">' + stops_time[i].arrival_time + '</span> <span class="departure-time">' + stops_time[i].departure_time + '</span> <span class="trip-status trip-on-time">On Time</span></li>';
    }

    // var a = m[this.options.num].getPopup();
    // var b = a._content.replace('<ul class="span-jadwal"></ul>","<ul class="span-jadwal">' + span_jadwal +'</ul>');
    // this.setPopupContent(b);
    $('.span-jadwal').html(span_jadwal);
    getDelay();

    $('.trip-id').click(function(){
      console.log($(this).data("trip-id"));

      trainLayer.clearLayers();
      $.get('<?=base_url('maps/get_train')?>' + '/' + $(this).data("trip-id"), function(train) {
          trainmarker = new L.marker([train.lat, train.long], {icon: trainIcon});
          trainLayer.addLayer(trainmarker);

          trainLayer.addTo(map);

          map.panTo(new L.LatLng(train.lat, train.long));

      });
    });

  });



}

function getDelay(){
  console.log('get delay');

  $.post('<?=base_url('maps/get_delays')?>', function(delays) {
    delays = $.parseJSON(delays);
    console.log('delays' + delays.length);
    for(var i=0; i < delays.length; i++){
      $('*[data-trip-id=' + delays[i].trip_id + ']').siblings('.trip-status').removeClass('trip-on-time').addClass('trip-delayed').html(Math.floor(delays[i].delay / 60) + " minutes");
      console.log(delays[i].trip_id + " - " + delays[i].delay);
    }
  });
}

</script>
        