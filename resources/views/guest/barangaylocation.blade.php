<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Barangay Clearance</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/creative.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">



    <style type="text/css">
        header.masthead {
            position: relative;
            width: 100%;
            min-height: auto;
            text-align: center;
            color: #fff;
            background-image: url(resources/assets/img/header.jpg) !important;
            background-position: center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

  </head>
    <body id="page-top">
            
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <a class="navbar-brand" href="#page-top">Barangay Clearance</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

             @if (Route::has('login'))
                     <ul class="navbar-nav ml-auto">
                    @if (Auth::check())
                     <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                    @else
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/barangaylocation') }}">Barangay Location</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('/barangayofficials') }}">Barangay Officials</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Register</a>
                      </li>

                    @endif
                    </ul>
            @endif

     
      </div>
    </nav>


 <div id="map" style="width:100%;height: 700px;"></div>


    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Let's Get In Touch!</h2>
            <hr class="primary">
            <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            <i class="fa fa-phone fa-3x sr-contact" data-sr-id="9" style="; visibility: visible;  -webkit-transform: scale(0.3); opacity: 0;transform: scale(0.3); opacity: 0;"></i>
            <p>123-456-6789</p>
          </div>
          <div class="col-lg-4 mr-auto text-center">
            <i class="fa fa-envelope-o fa-3x sr-contact" data-sr-id="10" style="; visibility: visible;  -webkit-transform: scale(0.3); opacity: 0;transform: scale(0.3); opacity: 0;"></i>
            <p>
              <a href="mailto:your-email@your-domain.com">info@barangayclearance.com</a>
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/creative.min.js') }}"></script>
 <script src="https://maps.google.com/maps/api/js?key=AIzaSyCMwT4MxXMtf42ycnlusXGTINrjWT1-15A"></script>
 <script src="https://www.bunnyradar.com/assets/admin/js/oms.min.js"></script>  
 <script>
   window.onload = function() {
      var gm = google.maps;
      var map = new gm.Map(document.getElementById('map'), {
        mapTypeId: 'satellite',
        center: new gm.LatLng('7.081936','125.561650'), 
        zoom: 25,  // whatevs: fitBounds will override
        scrollwheel: false
      });
      var iw = new gm.InfoWindow();
      var oms = new OverlappingMarkerSpiderfier(map,
        {markersWontMove: true, markersWontHide: true});


      var shadow = new gm.MarkerImage(
        'https://www.google.com/intl/en_ALL/mapfiles/shadow50.png',
        new gm.Size(37, 34),  // size   - for sprite clipping
        new gm.Point(0, 0),   // origin - ditto
        new gm.Point(10, 34)  // anchor - where to meet map location
      );

        var iconBase = 'http://localhost/clearance/resources/assets/img/';

      
      oms.addListener('click', function(marker) {
        iw.setContent(marker.desc);
        iw.open(map, marker);
      });
      oms.addListener('spiderfy', function(markers) {
        for(var i = 0; i < markers.length; i ++) {
          markers[i].setIcon(iconBase + 'marker.png');
          markers[i].setShadow(null);
        } 
        iw.close();
      });
      oms.addListener('unspiderfy', function(markers) {
        for(var i = 0; i < markers.length; i ++) {
          markers[i].setIcon(iconBase + 'marker.png');
          markers[i].setShadow(shadow);
        }
      });

      
      var bounds = new gm.LatLngBounds();

      function runOnComplete(){
        for (var i = 0; i < global_arr.length; i ++) {
            var datum = global_arr[i];
            var loc = new gm.LatLng(datum.lat, datum.lon);
            bounds.extend(loc);
            var marker = new gm.Marker({
              position: loc,
              title: '',
              map: map,
              icon: iconBase + 'marker.png',
              shadow: shadow
            });
            marker.desc = '<center><a href="http://localhost/clearance/storage/app/'+datum.profile_picture+'"><img src="http://localhost/clearance/storage/app/'+datum.profile_picture+'" style="width:150px;height:150px;"> <br> '+datum.fullname+'</a></center>';
            oms.addMarker(marker);
          }

          // Uncomment This if you want to  load map on fit bound
          //map.fitBounds(bounds);

          // for debugging/exploratory use in console
          window.map = map;
          window.oms = oms;
      }
      
      var global_arr = [];

      $.getJSON("http://localhost/clearance/api/admin/officials", function(restdata) {
        console.log(restdata);
           $.each(restdata, function(key, value) {
            global_arr.push({id: value.id,
                             profile_picture : value.profilepic,
                             lat: value.latitude,
                             lon: value.longitude,
                             fullname : value.firstname+' '+value.lastname,
                           });
           });
          runOnComplete();
      });
         
      
    }
</script>   
  


</body>
        </div>
    </body>
</html>
