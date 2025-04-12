@extends('backend.admin-master')

@section('site-title', __('Update delivery man zone'))

@section('style')
<style>
    #dropdownMenu {
        min-width: 100%;
        margin-top:55px;
    }
</style>
@endsection

@section('content')
    <x-msg.success />
    <x-msg.error />
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title">{{ __('Update delivery zone') }}</h4>
            @can('delivery-man-zone')
                <div class="btn-wrapper">
                    <a href="{{ route('admin.delivery-man.zone.index') }}"
                        class="cmn_btn btn_bg_profile">{{ __('Delivery Zones') }}</a>
                </div>
            @endcan
        </div>
        <div class="dashboard__card__body custom__form mt-4">
            <div class="row g-4">
                <div class="col-md-5">
                    <h6>{{ __('display a video here for an instruction about how user will Update zone') }}</h6>
                </div>
                <div class="col-md-7">
                    <form action="{{ route('admin.delivery-man.zone.update', $zone->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-30">
                            <label for="floatingInput">{{ __('Zone Name') }}</label>

                            <input type="text" class="form-control" id="floatingInput" name="name"
                                placeholder="{{ __('Zone Name') }}" required value="{{ old('name') ?? $zone->name }}">
                        </div>

                        <div class="form-group mb-3" style="display: none">
                            <label class="input-label" for="exampleFormControlInput1">{{ __('Coordinates') }}
                                <span class="input-label-secondary">{{ __('Draw your zone on the map') }}</span>
                            </label>
                            <textarea type="text" rows="8" name="coordinates" id="coordinates" class="form-control" readonly></textarea>
                        </div>

                        
                        <div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pac-input" placeholder="{{__('Search Location')}}"  aria-describedby="basic-addon2">
                                <ul class="dropdown-menu" id="dropdownMenu">
                                   
                                </ul>
                            </div>
                            <div class="mt-3" id="map-canvas" style="height: 310px"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="cmn_btn btn_bg_profile mt-3">{{ __('Update Delivery Zone') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ get_static_option('map_api_key_client') }}&libraries=drawing,places&v=3.45.8">
    </script>

    <script>
        let myLocation = {
            latitude: 23.7745978,
            longitude: 90.4219535
        };
        let map; // Global declaration of the map
        let lastpolygon = null;
        const polygonCoordinates = [
            @foreach (coordinatesArray($zone->polygon) as $coords)
                {
                    lat: {{ $coords['lat'] }},
                    lng: {{ $coords['lng'] }}
                },
            @endforeach
        ];

        function showPosition(position) {
            myLocation.latitude = position.coords.latitude;
            myLocation.longitude = position.coords.longitude;
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {

            }
        }

        function auto_grow() {
            let element = document.getElementById("coordinates");
            element.style.height = "5px";
            element.style.height = (element.scrollHeight) + "px";
        }

        function resetMap(controlDiv) {
            // ... existing code ...
        }

        function handleOverlayComplete(event) {
            if (lastpolygon) {
                lastpolygon.setMap(null);
            }

            $('#coordinates').val(event.overlay.getPath().getArray());
            lastpolygon = event.overlay;
            auto_grow();
        }

        function createSearchBox() {
            // ... existing code ...
        }

        function initialize() {
            // For each place, get the icon, name and location.
            const bounds = new google.maps.LatLngBounds();

            let myLatlng = {
                lat: {{ $center_lat }},
                lng: {{ $center_lng }}
            };

            let myOptions = {
                zoom: 13,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            };

            map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

            let zonePolygon = new google.maps.Polygon({
                paths: polygonCoordinates,
                strokeColor: "#050df2",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillOpacity: 0,
            });

            zonePolygon.setMap(map);

            zonePolygon.getPaths().forEach(function(path) {
                path.forEach(function(latlng) {
                    bounds.extend(latlng);
                    map.fitBounds(bounds);
                });
            });

            let drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [google.maps.drawing.OverlayType.POLYGON]
                },
                polygonOptions: {
                    editable: true
                }
            });

            drawingManager.setMap(map);
            getLocation();

            google.maps.event.addListener(drawingManager, "overlaycomplete", handleOverlayComplete);

            const resetDiv = document.createElement("div");
            resetMap(resetDiv, lastpolygon);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

            createSearchBox();
        }

        google.maps.event.addDomListener(window, 'load', initialize);

        // re-initialize
        function reinitialize() {
            let myLatlng = {
                lat: myLocation.latitude,
                lng: myLocation.longitude
            };

            let myOptions = {
                zoom: 13,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            };

            map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
            let drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [google.maps.drawing.OverlayType.POLYGON]
                },
                polygonOptions: {
                    editable: true
                }
            });

            drawingManager.setMap(map);
            getLocation();

            google.maps.event.addListener(drawingManager, "overlaycomplete", handleOverlayComplete);

            const resetDiv = document.createElement("div");
            resetMap(resetDiv, lastpolygon);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(resetDiv);

            createSearchBox();
        }
         // autocomplete
        const autocompleteService = new google.maps.places.AutocompleteService();

        const locationInput = document.getElementById('pac-input');



        locationInput.addEventListener('change', handleInput);
        locationInput.addEventListener('keyup', handleInput);

        function handleInput() {
            var geocoder = new google.maps.Geocoder();
            var address =locationInput.value; // Specify the location you want to get coordinates for

            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status === 'OK') {
                    latitude = results[0].geometry.location.lat();
                    longitude = results[0].geometry.location.lng();
                    myLocation={latitude:latitude,longitude:longitude}
                    reinitialize();
                } 
            });
        }

        $(document).on('keyup','#pac-input',function(){

            if (google.maps.places.PlacesServiceStatus.OK) {
                const inputText = locationInput.value;
                autocompleteService.getPlacePredictions(
                    { input: inputText },
                    function(predictions,status){
                        const suggestionHTML = predictions
                        .map(prediction => `<li ><a class="dropdown-item" href="javascript:void(0)" onclick="dataSelect('${prediction.description}')">${prediction.description}</a></li> `)
                        .join('');
                        document.getElementById('dropdownMenu').innerHTML = suggestionHTML;
                        $('#dropdownMenu').addClass('show');
                        $("#dropdownMenu li").trigger('click');
                    }
                );
            
            } else {
                document.getElementById('dropdownMenu').innerHTML = 'No suggestions available';
            }
        })



        //for input dropdown
        $(document).on('click','#pac-input',function(event) {
            event.stopPropagation();
            $('#dropdownMenu').toggleClass('show');
            console.log('asdfdsf')
        });
        function dataSelect(string){
            console.log(string)
            locationInput.value=string;
            handleInput()
            $('#dropdownMenu').toggleClass('show');
        }
    </script>
@endsection
