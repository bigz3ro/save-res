@if(Session::has('error'))
    <div class="alert alert-danger fade in alert-dismissible" style="margin-top:18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        {{Session::get('error')}}
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success fade in alert-dismissible" style="margin-top:18px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
        {{Session::get('success')}}
    </div>
@endif