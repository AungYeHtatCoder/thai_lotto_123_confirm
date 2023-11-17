@include('user_layout.header')
@yield('style')

<body>
 <div class="container-fluid">
  @yield('content')

  <!-- start footer -->

  {{-- @include('user_layout.footer') --}}


  <!-- end footer -->
 </div>
 @include('user_layout.js')
 @yield('script')