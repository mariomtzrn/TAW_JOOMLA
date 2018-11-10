<?php $mvc_u = new mvc_controller_user(); ?>
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
</style>
<script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.19.0.min.js"></script>
<div class="container-fluid">
    <!-- Begin Page Header-->
    <div class="row">
        <div class="page-header">
          <div class="d-flex align-items-center">
              <h2 class="page-header-title">DWASH</h2>
              <div>
              </div>
          </div>
        </div>
    </div>
    <!-- End Page Header -->
    <div class="row flex-row">
        <div class="col-xl-12">
            <!-- Basic Map Marker -->
            <div class="widget has-shadow">
                <div class="widget-header bordered no-actions d-flex align-items-center">
                  <h4>Como Llegar</h4>
                </div>
                <div class="widget-body">
                  <!--div class="mapouter">
                    <div class="gmap_canvas">
                      <iframe width="1000" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=upv%20ciudad%20victoria&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                      </iframe>
                      <a href="https://www.pureblack.de/google-maps/"></a>
                    </div>
                    <style>.mapouter{text-align:right;height:inherit;width:inherit;}.gmap_canvas {overflow:hidden;background:none!important;height:inherit;width:inherit;}</style>
                  </div-->
                  <div class='container' id='map-canvas' style="width:600px;height:400px"></div>
                </div>
            </div>
            <!-- End Basic Map Marker -->
        </div>
    </div>
    <!-- End Row -->
</div>
<!-- End Container -->
<script>
    window.lat = 37.7850;
    window.lng = -122.4383;

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(updatePosition);
        }

        return null;
    };

    function updatePosition(position) {
      if (position) {
        window.lat = position.coords.latitude;
        window.lng = position.coords.longitude;
      }
    }

    setInterval(function(){updatePosition(getLocation());}, 10000);

    function currentLocation() {
      return {lat:window.lat, lng:window.lng};
    };

    var map;
    var mark;
    var destino;

    var initialize = function() {
      map  = new google.maps.Map(document.getElementById('map-canvas'), {center:{lat:lat,lng:lng},zoom:12});
      mark = new google.maps.Marker({position:{lat:lat, lng:lng}, map:map});
      destino = new google.maps.Marker({position:{lat:23.729126, lng:-99.077586}, map:map});
    };

    window.initialize = initialize;

    var redraw = function(payload) {
      lat = payload.message.lat;
      lng = payload.message.lng;

      map.setCenter({lat:lat, lng:lng, alt:0});
      mark.setPosition({lat:lat, lng:lng, alt:0});
    };

    var pnChannel = "map2-channel";

    var pubnub = new PubNub({
      publishKey:   'pub-c-6d83c420-ccc0-4b5c-b932-d3749c7487f0',
      subscribeKey: 'sub-c-570f739c-e460-11e8-b3e4-b6494454df27'
    });

    pubnub.subscribe({channels: [pnChannel]});
    pubnub.addListener({message:redraw});

    setInterval(function() {
      pubnub.publish({channel:pnChannel, message:currentLocation()});
    }, 5000);
    </script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyD-8_3yxl4D7dcg0eZ0icH3PS4j0myYwtg&callback=initialize"></script>
