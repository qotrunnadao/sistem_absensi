// BOX FULLSCREEN
$(document).ready(function() {
    $(".toggle-expand-btn").click(function(e) {
        $(this).closest('.box.box-success').toggleClass('box-fullscreen');
    });


    $(".select2").select2({
        placeholder: "Pilih",
    });
});

