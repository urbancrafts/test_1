'use strict';

(function() {

    var ImageUploadOperations;
    ImageUploadOperations = (function(){
        ImageUploadOperations.prototype = Object.create(Main.prototype);

        function ImageUploadOperations(){

            var _this = this;
            this.events = [];
            this.init();
        }

        ImageUploadOperations.prototype.init = function () {
            var _this = this;
            $("#image-container-bi").empty();
                for(var i = 0;i< 6;i++){
                    var uploadWrapperDiv = document.createElement('div');
                    uploadWrapperDiv.className = 'col-xs-4';
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/x-png, image/jpeg, image/jpg');
                    input.setAttribute('name', 'images');
                    input.setAttribute('data-validation-allowing', 'jpg, png, jpeg');
                    input.className = 'uploadFile';
                    var iconWrapper =  document.createElement('div');
                    iconWrapper.className = 'file-input-button text-center';
                    var icon = document.createElement('i');
                    icon.className = 'fa fa-2x fa-plus-circle';
                    icon.setAttribute('aria-hidden', "true");
                    iconWrapper.appendChild(icon);
                    var errorMsg = document.createElement('h5');
                    errorMsg.className = 'error-file-size';
                    uploadWrapperDiv.appendChild(input);
                    uploadWrapperDiv.appendChild(iconWrapper);
                    uploadWrapperDiv.appendChild(errorMsg);
                    $('#image-container-bi').append(uploadWrapperDiv);
            }

            $("#image-container-bi").on("change", '.uploadFile', function() {
                var emptyInputsPresent = false;
                var numberOfImgPicked = 0;
                // console.log($('#image-container-bi input'));
                Array.from($('#image-container-bi input')).forEach(function(input){
                    if(!input.value){
                        emptyInputsPresent = true;
                    }
                    else {
                        numberOfImgPicked += 1;
                    }
                });
                if(!emptyInputsPresent) {
                    if(numberOfImgPicked < 15) {                                  //Max number of images allowed to upload is set to 15
                        var uploadWrapperDiv = document.createElement('div');
                        uploadWrapperDiv.className = 'col-xs-4';
                        var input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/x-png, image/jpeg, image/jpg');
                        input.setAttribute('name', 'images');
                        input.setAttribute('data-validation-allowing', 'jpg, png, jpeg');
                        input.className = 'uploadFile';
                        var iconWrapper =  document.createElement('div');
                        iconWrapper.className = 'file-input-button text-center';
                        var icon = document.createElement('i');
                        icon.className = 'fa fa-2x fa-plus-circle';
                        icon.setAttribute('aria-hidden', "true");
                        iconWrapper.appendChild(icon);
                        uploadWrapperDiv.appendChild(input);
                        uploadWrapperDiv.appendChild(iconWrapper);
                        $('#image-container-bi').append(uploadWrapperDiv);
                    }
                }
            })
        };

        return ImageUploadOperations;
    })();

    window.ImageUploadOperations = ImageUploadOperations;

}).call(this);