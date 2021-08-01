@if (session('success_alert'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success_alert') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('error_alert'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error_alert') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif