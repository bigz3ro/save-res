$(document).ready( function() {
    $('.datetimepicker').datepicker(
        {
            language : 'vi',
            format : 'yyyy/mm/dd',
            autoclose: true
        }
    );

    $("#select-location").select2(
        { placeholder: "Chọn địa điểm" }
    );
    $("#select-tag").select2(
        { placeholder: "Gắn thẻ tag", tags: "true" }
    );

    $("#select-salary").change(function(){
        var value = $(this).val();
        switch (value) {
            case 'from':
                $("#salary_from").css("display", "inline");
                $("#salary_to").css("display", "none");
                break;
            case 'to':
                $("#salary_from").css("display", "none");
                $("#salary_to").css("display", "inline");
                break;
            case 'between':
                $("#salary-separator").css("display", "inline");
                $("#salary_from").css("display", "inline");
                $("#salary_to").css("display", "inline");
                break;
            default:
                $("#salary-separator").css("display", "none");
                $("#salary_from").css("display", "none");
                $("#salary_to").css("display", "none");
                break;
        }
    });

    if (window.location.href.indexOf('#_=_') > 0) {
        window.location = window.location.href.replace(/#.*/, '');
    }
})

