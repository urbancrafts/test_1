$(document).ready(function () {
    
    //image thumbnail file input
    $(function () {
      $(".image-container-bi").on("change", ".uploadFile", function () {
        var objFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
  
        if (/^image/.test(files[0].type)) {
          // only image file
          var reader = new FileReader(); // instance of the FileReader
          reader.readAsDataURL(files[0]); // read the local file
  
          reader.onloadend = function () {
            // set image data as background of div
            var fileSize = files[0].size;
            objFile.siblings(".error-file-size").hide();
            if (fileSize / (1024 * 1024) > 10) {
              resetImage(objFile);
              objFile
                .siblings(".error-file-size")
                .text("Banner Image must be under 10MB ")
                .show();
            } else {
              objFile
                .next(".file-input-button")
                .css("background-image", "url(" + this.result + ")");
              objFile
                .next(".file-input-button")
                .find(".fa-plus-circle")
                .addClass("fa-times-circle");
              objFile
                .next(".file-input-button")
                .find(".fa-plus-circle")
                .removeClass("fa-plus-circle");
            }
          };
  
          var img = new Image();
          img.onload = function () {
            if (this.width < 600 || this.height < 400) {
              resetImage(objFile);
              objFile
                .siblings(".error-file-size")
                .text("Image dimension should be above 600px x 400px ")
                .show();
            }
          };
          var _URL = window.URL || window.webkitURL;
          img.src = _URL.createObjectURL(files[0]);
        }
      });
  
      $(".image-container-bi").on("click", ".uploadFile", function (e) {
        var objFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) {
          // do selection
        } else {
          e.preventDefault();
          resetImage(objFile);
        }
      });
    });
  
    //Solution to modal padding left issue
  
});