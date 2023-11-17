@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <div style="height: 100vh;">
        <h6 class="mx-auto p-3" style="color:  #265166; font-weight: bold; font-size: 18px;">သင်ငွေလက်ခံမည့်ဘဏ်အကောင့်များ</h6>
        <div class="container">
         <div class="d-flex justify-content-between">
          <div class="banks">
           <img src="{{ asset('user_app/assets/images/bank/kpay.png') }}" class="w-100" alt="">
          </div>
          <div class="banks">
           <img src="{{ asset('user_app/assets/images/bank/wpay.png') }}" class="w-100" alt="">
          </div>
          <div class="banks">
           <img src="{{ asset('user_app/assets/images/bank/cbpay.png') }}" class="w-100" alt="">
          </div>
          <div class="banks">
           <img src="{{ asset('user_app/assets/images/bank/aya_logo.png') }}" class="w-100" alt="">
          </div>
         </div>
    </div>
    </div>
    
    

    

</div>
</div>
@include('user_layout.footer')


@endsection