/**
 * Created by dxuser on 9/7/18.
 */

 (function(){
    var LocationSearchOperations;
    LocationSearchOperations = (function(){
        LocationSearchOperations.prototype = Object.create(Main.prototype);

        function LocationSearchOperations(input_id, callback){
            //console.log('LocationSearchOperations init',input_id)
            var _this = this;
            this.events = [];
            this.init(input_id, callback);
        }

        LocationSearchOperations.prototype.init = function (input_id, callback) {
            var _this = this;
            //Location Search Autocomplete with Google Places API


            var locationInput = document.getElementById(input_id);
            var area= "", city= "", state = "";
            var options = {
                // types: ['(cities)'],
                componentRestrictions: {country: 'ng'},
            };

            var autocomplete = new google.maps.places.Autocomplete(locationInput, options);
            google.maps.event.addListener(autocomplete, 'place_changed', ()=>callback(autocomplete))


        };


        return LocationSearchOperations;
    })();


    window.LocationSearchOperations = LocationSearchOperations;

}).call(this);