<div class="row text-center">
    <div class="col-12">
        @php
        $imgpath = $agent->avater ? '/storage/' . $agent->avater : 'img/dummy-user.png';
        @endphp
        <img class="profile-user-img img-fluid img-circle" style="height: 100px; width: 100px;" src="{{ asset($imgpath) }}" alt="">
    </div>
    <div class="col-12">
        <b> {{ $agent->name }} </b>
    </div>
    <div class="col-12">
        {{ $agent->mobile }}
    </div>
    <div class="col-12">
        <p>Are you sure to assign the order to <b> {{ $agent->name }} </b>.</p>
    </div>
</div>