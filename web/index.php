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
  <link rel="stylesheet" href="https://www.kosmosnimki.ru/lib/geomixer_1.3/geomixer.css" charset="utf-8">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="css/rSlider.min.css">
  <script type="text/javascript" src="js/common.js"></script>
  <script type="text/javascript" src="js/rSlider.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link rel="stylesheet" href="bundle.css" charset="utf-8">
  
  <script src="map.js"></script>
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
      <a class="w3-bar-item w3-button w3-right w3-hide-large w3-large w3-theme-l1" href="javascript:void(0)"
        onclick="w3_open()"><i class="fa fa-bars"></i></a>
      <a href="#" class="w3-bar-item w3-button w3-theme-l1">Logo</a>
      <a href="#"
        class="w3-bar-item w3-button w3-hide-small leaflet-gmx-icon leaflet-gmx-icon-point leaflet-gmx-icon-img leaflet-gmx-icon-sprite leaflet-control"></a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small "></a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small"></a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small "></a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium "></a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium "></a>
    </div>
  </div>

  <!-- Sidebar -->
  <nav class="w3-sidebar w3-bar-block w3-collapse w3-small w3-theme-l5 w3-animate-left" id="mySidebar">


    <div class="date">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <label class="w3-medium" id="label1">Даты</label>
          <br><br>
        <label class="w3-small">c</label>
        <input type="date" name="dateFrom" min="2019-06-01" value="2019-06-01" style="width:120px; border: solid white;">
        <label class="w3-small">до</label>
        <input type="date" name="dateDue" style="width:120px; border: solid white;">
        <br><br>
        <label class="w3-medium" id="label1">Облачность, %</label>
            <br><br>
        <label class="w3-small" >от</label>
        <input type="text" id="cloud1"  name="cloud1" style="width:60px; border-radius:4px; border: solid white;">
        <label class="w3-small">до</label>
        <input type="text" id="cloud2" name="cloud2" style="width:60px; border-radius:4px; border: solid white;"><br><br>
        <label class="w3-medium" id="label1">Угол съемки, °</label>
        <br> <br>
          <label class="w3-small">от</label>
          <input type="text" id="angle1" name="angle1" style="width:60px; border-radius:4px; border: solid white;">
          <label class="w3-small">до</label>
          <input type="text" id="angle2" name="angle2" style="width:60px; border-radius:4px; border: solid white;"><br><br>
          <label class="w3-medium" id="label1">Координаты, °</label><br><br>
          
          <input type="text" id="latw" name="latw" style="width:200px; border-radius:4px; border: solid white;"><br><br>
          <input type="text" id="lngw" name="lngw" style="width:200px; border-radius:4px; border: solid white;"><br><br>
          
        <br> <br>
            <button type="submit" class="poisk">Найти снимки</button>
      </form>
    </div>

  </nav>

  <!--MAIN-->

  <div class="w3-main" style="margin-left:350px; margin-top:-12px;">
    <h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <div id="map" style="height:400px;"></div>
    <footer>
     
      <div class="w3-container w3-theme-l2 w3-padding-32" style="width:100%;height:100%;">
        <h4 class="w3-center">Найденные снимки</h4>
    <table style="width:100%; border:solid white 1px;">
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
           UpCoorLat > '$lat' AND '$lat' > LowCoorLat 
           AND UpCoorLon > '$lng' AND LowCoorLon < '$lng' AND
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
    <div style="float:left;margin-left:6%;">
    <form action="index.html">
      <button type="submit" class="poisk">Назад</button>
      </form></div>
      <div style="float:right;margin-right:9%;">
      <form action="#">                                     <!--email address should be written-->
        <button type="submit" class="poisk w3-button w3-black" id="myBtn" onclick="document.getElementById('id01').style.display='block'">Подать заявку</button>   
        </form></div>
      </div>
  
      <div class="w3-container w3-theme-l1">
        <p>@<a href="#" target="_blank">Copyrights</a></p>
      </div>
    </footer>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script type="text/javascript">
      var lat = 33.687781758439364
      var lng = -95.93261718750001 
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

       document.getElementById("latw").value = lat;
       document.getElementById("lngw").value = lng;

      function moveMarker(e) {
        lat = (e.latlng.lat);
        lng = (e.latlng.lng);
        var newLatLng = new L.LatLng(lat, lng)
        marker.setLatLng(newLatLng);
        document.getElementById("latw").value = lat;
        document.getElementById("lngw").value = lng;
      }

      marker.on('drag', function (e) {
        lat = (e.latlng.lat);
        lng = (e.latlng.lng);
        var newLatLng = new L.LatLng(lat, lng)
        marker.setLatLng(newLatLng);
        document.getElementById("latw").value = lat;
        document.getElementById("lngw").value = lng;
      })

      //document.getElementById('address').innerHTML = lat;

      map.on('click', moveMarker);
    </script>
  </div>

</body>

</html>
