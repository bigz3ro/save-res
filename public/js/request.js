// magic.js
$(document).ready(function() {
    // process the form
    $('#formPost').submit(function(event) {
        //Validate form
        var title = $.trim($('input[name="title"]').val());
        if (title == '') {
            alert("Bạn chưa nhập nội dung");
            return false;
        } else {
            var token = $('input[name="_token"]').val();
            var title = $('input[name="title"]').val();
            var salary_from = $('input[name="job_salary_from"]').val();
            var salary_to = $('input[name="job_salary_to"]').val();
            var description = $('textarea[name="description"]').val();
            var deadline = $('input[name="deadline"]').val();
            var tags = $("#select-tag").val();
            var locations = $("#select-location").val();
            var image = $('input[name="job-image"]')[0].files[0];

            var formData = new FormData();
            formData.append('_token', token);
            formData.append('title', title);
            formData.append('salary_from', salary_from);
            formData.append('salary_to', salary_to);
            formData.append('description', description);
            formData.append('deadline', deadline);
            formData.append('tags', tags);
            formData.append('locations', locations);
            formData.append('image', image);

            $(function() {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
                });
            });
            // // process the form
            $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: 'job/post', // the url where we want to POST
                    data: formData, // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                // using the done promise callback
                .done(function(data) {

                    // Reload page success
                    if (data.message === 'ok') {
                        location.reload();
                    };
                    // here we will handle errors and validation messages
                })
                .fail(function(data) {
                    if(data.status === 401) {
                        window.location.replace(document.location.origin+'/login');
                    }
                });

            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();
        }
    });
});
