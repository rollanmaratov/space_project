


<!DOCTYPE html>
<html lang="en">

<head>
  <title>KazSTSat's Web Project</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <!-- wRunner CSS -->
  <link rel="stylesheet" href="css/wrunner-default-theme.css">
  <!-- wRunner JS -->
  <script src="js/wrunner-native.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="js/common.js"></script>
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <!-- for the map -->
  <style>
    table,
    td {
      border: 1px solid black;
    }
  </style>

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
</head>

<body>

  <!-- Navbar -->
  <div class="w3-top">
    <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
      <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1"
        href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
      <a href="#" class="w3-bar-item w3-button w3-theme-l1">Logo</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white"></a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white"></a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white"></a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white"></a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white"></a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white"></a>
    </div>
  </div>

  <!-- Sidebar -->
  <nav class="w3-sidebar w3-bar-block w3-collapse w3-small w3-theme-l5 w3-animate-left" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-large w3-padding-large w3-hover-black"
      title="Close Menu">
    </a>
    <br>
    <h4 class="w3-center">Найденные снимки</h4>
    <table>
      <tr>
        <th>Название</th>
        <th>Облачность</th>
        <th>Угол</th>
        <th>Дата</th>
      </tr>
        <?php 
           $conn = new mysqli("localhost", "gyegempz_kazst", "123456q!", "gyegempz_kazst");
           $dateFrom = $_POST['dateFrom']; 
           $dateDue = $_POST['dateDue']; 
           $cloud1 = $_POST['cloud1'];
           $cloud2 = $_POST['cloud2'];
           $angle1 = $_POST['angle1'];
           $angle2 = $_POST['angle2'];
           $lat = $_POST['latw'];
           $lng = $_POST['lngw'];
           $sql= "SELECT caption, cloudCover, state, creationDate FROM r_acquisition_updated WHERE AcquisitionID in (
           SELECT AcquisitionID FROM r_stripparameters_updated WHERE 
           UpCoorLat > 33.687781758439364 AND 33.687781758439364 > LowCoorLat 
           AND UpCoorLon > -95.93261718750001 AND LowCoorLon < -95.93261718750001 AND
           '$dateFrom' < trueCaptureStart AND trueCaptureStart < '$dateDue' AND 
           '$cloud1' < cloudCover AND cloudCover < '$cloud2' AND 
           '$angle1' < roll AND roll < '$angle2')" ; 
           $rs = mysqli_query($conn, $sql); 
           if($rs){  
           while($row=mysqli_fetch_array($rs)) {
               echo "<tr><td>".$row['caption']."</td>
                     <td>".$row['cloudCover']."</td>
                     <td>".$row['state']."</td>
                     <td>".$row['creationDate']."</td></tr>";
                      }
                 }  
                 
           ?>
    </table>
  </nav>
  
  <!--MAIN-->

  <div class="w3-main" style="margin-left:350px; margin-top:-12px;">
    <h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <div id="map" style="height:400px;"></div>

    <div id="placeinfo">
      <table style="width: 100%">
        <tr>
          <th>Широта <div id="lat"></div>
          </th>
          <th>Долгота <div id="lng">
          </th>
        </tr>
        <tr>
          <th>
            <div id="address"></div>
          </th>
        </tr>
      </table>
    </div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script type="text/javascript">
      var lat = 51.07685689840186
      var lng = 71.38356608436422
      var map = L.map('map').setView([lat, lng], 12);
      const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreepMap</a> contributors';
      const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
      const tiles = L.tileLayer(tileUrl, {
        attribution
      });
      tiles.addTo(map);

      var markerOptions = {
        title: "MyLocation",
        clickable: true,
        draggable: true
      }
      var marker = new L.Marker([lat, lng], markerOptions)
      marker.addTo(map);

      document.getElementById("lat").innerHTML = lat;
      document.getElementById("lng").innerHTML = lng;

      function moveMarker(e) {
        lat = (e.latlng.lat);
        lng = (e.latlng.lng);
        var newLatLng = new L.LatLng(lat, lng)
        marker.setLatLng(newLatLng);
        document.getElementById("lat").innerHTML = lat;
        document.getElementById("lng").innerHTML = lng;
      }

      marker.on('drag', function (e) {
        lat = (e.latlng.lat);
        lng = (e.latlng.lng);
        var newLatLng = new L.LatLng(lat, lng)
        marker.setLatLng(newLatLng);
        document.getElementById("lat").innerHTML = lat;
        document.getElementById("lng").innerHTML = lng;
      })

      //document.getElementById('address').innerHTML = lat;

      map.on('click', moveMarker);
    </script>
  </div>
</body>

</html>