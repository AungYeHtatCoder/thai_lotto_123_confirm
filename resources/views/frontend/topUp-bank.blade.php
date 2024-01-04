@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="d-flex justify-content-around align-items-center mx-auto profiles" style="
          background-color: var(--default);
          width: 358px;
          height: 59px;
          border-radius: 24px;
          border: 2px solid var(--gold, #576265);
          background: #12486b;
          padding: 12px 16px;
        ">
  <img src="{{ asset('user_app/assets/img/vector.png') }}" width="24px" height="24px" alt="" />
  <p style="font-size: 16px; font-weight: 500">ပိုက်ဆံအိတ်</p>
  <p style="
            font-size: 16px;
            font-weight: 700;
            font-family: 'Lato', sans-serif;
          ">
    12,670 Kyats
  </p>
  <img src="{{ asset('user_app/assets/img/plus.png') }}" class="rounded-circle" style="padding: 10px; color: var(--blue); background-color: #fff" alt="" />
</div>
<!-- choose bank start -->
<div class="my-3 px-3">
  <div class="text-dark" style="
            font-family: Noto Sans Myanmar;
            font-size: 20px;
            font-weight: 600;
            line-height: 44px;
            letter-spacing: 0em;
            text-align: left;
            color: #5a5a5a;
          ">
    <p>မိမိငွေဖြည့်မည့်ဘဏ်တစ်ခုရွေးပါ</p>
  </div>
  <div class="d-flex justify-content-center align-items-center">
    <a href="{{ url('/topup') }}" class="text-decoration-none"><img src="{{ asset('user_app/assets/img/kpay.png') }}" class="px-2 m-2" alt="" /></a>
    <a href="{{ url('/topup') }}" class="text-decoration-none"><img src="{{ asset('user_app/assets/img/aya.png') }}" class="px-2 m-2" alt="" /></a>
  </div>
  <div class="d-flex justify-content-center align-items-center">
    <a href="{{ url('/topup') }}" class="text-decoration-none"><img src="{{ asset('user_app/assets/img/wave.png') }}" class="px-2 m-2" alt="" /></a>
    <a href="{{ url('/topup') }}" class="text-decoration-none"><img src="{{ asset('user_app/assets/img/cb.png') }}" class="px-2 m-2" alt="" /></a>
  </div>
</div>

<!-- choose band end -->
@include('user_layout.footer')
@endsection