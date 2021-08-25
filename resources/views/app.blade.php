<!DOCTYPE html>
<html lang="en">

<head>

  @include('admin.asset.css.layout_css')

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    @include('admin.navigation.navbar')

    @php
    use App\Constant\UserTypeConst;

    if(auth()->user()->user_type_id == UserTypeConst::ADMIN){
    @endphp

    @include('admin.navigation.sidebar')

    @php
    }elseif(auth()->user()->user_type_id == UserTypeConst::MERCHANT){
    @endphp

    @include('admin.navigation.merchantPanel.sidebar')

    @php
    }else{
    @endphp

    @include('admin.navigation.agentPanel.sidebar')
    
    @php
    }
    @endphp

    @yield('contentWrapper')

    @include('admin.navigation.footer')

  </div>

  @include('admin.asset.js.layout_js')

</body>

</html>