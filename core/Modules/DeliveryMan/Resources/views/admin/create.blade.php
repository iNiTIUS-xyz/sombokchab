@extends("backend.admin-master")

@section("style")
<style>
    #dropdownMenu {
        min-width: 100%;
        margin-top:55px;
    }
</style>
@endsection

@section("site-title", __("Create delivery zone"))

@section("content")
    <div class="card">
        <x-msg.success />
        <x-msg.error />
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">
                    {{ __("Create delivery zone") }}
                </h4>

                <div class="button-wrapper">
                    <a href="{{ route("admin.delivery-man.zone.index") }}" class="btn btn-info">{{ __("Delivery Zones") }}</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    {{ __("display a video here for an instruction about how user will create zone") }}
                </div>
                <div class="col-md-7">
                    <form action="{{ route("admin.delivery-man.zone.store") }}" method="post">
                        @csrf
                        <div class="form-group mb-30">
                            <label for="floatingInput">{{ __('Zone Name') }}</label>

                            <input type="text" class="form-control" id="floatingInput" name="name"
                                   placeholder="{{ __('Zone Name') }}" required
                                   value="{{old('name')}}">
                        </div>

                        <div class="form-group mb-3" style="display: none">
                            <label class="input-label"
                                   for="exampleFormControlInput1">{{ __('Coordinates') }}
                                <span
                                        class="input-label-secondary">{{ __('Draw your zone on the map') }}</span>
                            </label>
                            <textarea type="text" rows="8" name="coordinates" id="coordinates"
                              class="form-control" readonly></textarea>
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
                            <button class="cmn_btn btn_bg_profile mt-3" type="submit">{{ __("Create Delivery Zone") }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="https://maps.googleapis.com/maps/api/js?key={{ get_static_option('map_api_key_client') }}&libraries=drawing,places&v=3.45.8"></script>

    <script>
        var myLocation = { latitude: 23.7745978, longitude: 90.4219535 };
        let map;
        // Global declaration of the map
        let lastpolygon = null;

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

        google.maps.event.addDomListener(window, 'load', initialize);


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
                    initialize();
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