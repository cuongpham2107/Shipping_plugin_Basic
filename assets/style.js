$(document).ready(function(){
    $('#btnImage').on("click", function () {
        var images = wp.media({
            title: "Upload Image",
            multiple: false,
       }).open().on("select",function (e) {
            var uploadedImages = images.state().get("selection").first();
            var selectedImages = uploadedImages.toJSON();
            $("#getImage").attr("src",selectedImages.url);
            var data = selectedImages.url;
            
            $("#value_logo").val(data);
       });

    });

});