@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<!-- profile section start -->
@include('user_layout.profile')
<!-- profile section end -->

<!-- kyat-baht -->
<div class="my-2 d-flex justify-content-around align-items-center">
  <div class="kyat">Kyat / ကျပ်</div>
  <img src="{{ asset('user_app/assets/img/arrow.png') }}" width="32px" height="32px" alt="" />
  <div class="baht">Baht / ဘတ်</div>
</div>

<div class="d-flex justify-content-around align-items-center mx-auto" style="
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

<!-- carousel -->
<div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade mt-3 px-3" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('user_app/assets/img/banner.png') }}" style="max-height: 500px" class="d-block w-100" alt="..." />
      <div class="marquee">
        <div class="marquee-text">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          Dolorem ea id exercitationem. Quos consequuntur vitae soluta
          aliquid odit temporibus beatae iste autem?
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('user_app/assets/img/banner.png') }}" style="max-height: 500px" class="d-block w-100" alt="..." />
      <div class="marquee">
        <div class="marquee-text">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          Dolorem ea id exercitationem. Quos consequuntur vitae soluta
          aliquid odit temporibus beatae iste autem?
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('user_app/assets/img/banner.png') }}" style="max-height: 500px" class="d-block w-100" />
      <div class="marquee">
        <div class="marquee-text">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          Dolorem ea id exercitationem. Quos consequuntur vitae soluta
          aliquid odit temporibus beatae iste autem?
        </div>
      </div>
    </div>
  </div>
</div>
<!-- carousel -->

<!-- button section start-->
<div class="d-flex justify-content-around align-items-center" style="margin-top: 16px">
  <div>
    <a href="{{ url('/twod') }}" class="btns">2Dထိုးမည်</a>
    <p class="d-block mt-2 text-center" style="font-size: 14px; font-weight: 700; color: var(--default)">
      ၂လုံးထီ
    </p>
  </div>
  <div>
    <a href="{{ url('/threeD') }}" class="btns">3Dထိုးမည်</a>
    <p class="d-block mt-2 text-center" style="font-size: 14px; font-weight: 700; color: var(--default)">
      ၃လုံးထီ
    </p>
  </div>
</div>

<div class="d-flex justify-content-around align-items-center" style="margin-top: 16px">
  <img src="{{ asset('user_app/assets/img/logo1.png') }}" class="w-100" style="border-radius: 16px" alt="" />
  <img src="{{ asset('user_app/assets/img/logo2.png') }}" class="w-100" style="border-radius: 16px" alt="" />
</div>
<!-- button section end-->
@include('user_layout.footer')

@endsection