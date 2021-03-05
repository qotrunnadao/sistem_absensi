@extends('layouts.app')
@section('title','Lihat Absensi')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header border-bottom mt-0">
                <h3 class="card-title">
                    <i class="fas fa-eye mr-1"></i>
                    Detail Data Absensi
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <div class="mb-3 float-left">
                        @if ($absensi_data->foto)
                        <img src="{{ asset('storage/absensi/' . $absensi_data->foto) }}" alt="{{ $absensi_data->name }}" class="fotoDetail">
                        @else
                        <img src="{{ asset('img/not-found.png' . $absensi_data->foto) }}" alt="{{ $absensi_data->name }}" class="fotoDetail">
                        @endif
                    </div>
                    <tr>
                        <td width="20%"><b>Nama Karyawan</b></td>
                        <td>{{ $absensi_data->user->name }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Jenis</b></td>
                        <td>{{ $absensi_data->jenis == 1 ? 'masuk' : 'pulang' }}</td>
                    </tr>

                    <tr>
                        <td width="20%"><b>Latitude</b></td>
                        <td>{{ $absensi_data->latitude }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Longitude</b></td>
                        <td>{{ $absensi_data->longitude }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Created At</b></td>
                        <td>{{ $absensi_data->created_at }}</td>
                    </tr>
                    <tr>
                        <td width="20%"><b>Updated At</b></td>
                        <td>{{ $absensi_data->updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header border-bottom mt-0">
                <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Detail Lokasi Absensi
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <div class="mb-3 float-left">
                        <tr>
                            <td><iframe width="100%" height="300" frameborder="10" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?q=-7.4579354,109.2787015&hl=es;z=14&output=embed"></iframe></td>
                        </tr>
                </table>
                {{-- <h1>Membuat Google Maps dengan API</h1>
                <input id="search-input" class="controls" type="text" placeholder="Cari...">
                <div id="googleMap" style="width:100%;height:300px;"></div>
                <div id="address"></div>
                <div id="latitude"></div>
                <div id="longitude"></div> --}}

                <a href="<?= url('') ?>/absensi" class="btn btn-danger float-right my-3">
                    <i class="fas fa-sign-out-alt"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    var marker;
    var map;
    var geocoder;
      var infowindow;
      var searchBox;

    function gMap() {
        var mapProp= {
            center:new google.maps.LatLng(-6.175307,106.827131),
            zoom:15,
        };

        map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        geocoder = new google.maps.Geocoder();
          infowindow = new google.maps.InfoWindow();

        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
            geoDecode();
        });

        searchBox = new google.maps.places.SearchBox(document.getElementById('search-input'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('search-input'));

        google.maps.event.addListener(searchBox, 'places_changed', function() {
            searchBox.set('map', null);
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;

            for (i = 0; place = places[i]; i++) {
                (function(place) {
                    marker = new google.maps.Marker({
                        position: place.geometry.location
                    });

                    marker.bindTo('map', searchBox, 'map');

                    google.maps.event.addListener(marker, 'map_changed', function() {
                        if (!this.getMap()) {
                            this.unbindAll();
                        }
                    });

                    bounds.extend(place.geometry.location);

                    geocoder.geocode({
                      'latLng': marker.getPosition()
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results[0]) {
                                document.getElementById("address").innerHTML = 'Alamat : ' + results[0].formatted_address;
                                document.getElementById("latitude").innerHTML = 'Latitude : ' + marker.getPosition().lat();
                                document.getElementById("longitude").innerHTML = 'Longitude : ' + marker.getPosition().lng();
                                infowindow.setContent(results[0].formatted_address);
                                infowindow.open(map, marker);
                            }
                        }
                    });
                }(place));
            }

            map.fitBounds(bounds);
            searchBox.set('map', map);
            map.setZoom(Math.min(map.getZoom(),15));
            geoDecode();
        });
    }

    function placeMarker(location) {
        if (marker == null) {
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
        } else {
            marker.setPosition(location);
        }
    }

    function geoDecode(){
        geocoder.geocode({
          'latLng': marker.getPosition()
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    document.getElementById("address").innerHTML = 'Alamat : ' + results[0].formatted_address;
                    document.getElementById("latitude").innerHTML = 'Latitude : ' + marker.getPosition().lat();
                    document.getElementById("longitude").innerHTML = 'Longitude : ' + marker.getPosition().lng();
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtbXh4_28zdONLj23vd9J-1XlcAFsoMQU&callback=gMap&libraries=places"></script>
@endsection
