@extends('user_layout.app')

@section('content')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4">
  <!--start navbar -->
  @include('user_layout.sub_nav')
  <!-- start content -->
  <div class="row content" style="height: 880px">
   <div class="stick">
    <div class="d-flex justify-content-between pt-4">
     <div class="">
      <i class="fa-regular fa-circle-user fa-2xl"></i>
     </div>
     <div>
      <h2 class="ms-2"><a href="{{ route('login') }}">Login</a></h2>
     </div>
     <div>
      <i class="fa-solid fa-bell fa-2xl"></i>
     </div>
    </div>

    <div class="ticks mb-2">
     <hr style="
                    height: 20px;
                    background-color: #ffffff;
                    margin-top: 20px;
                  " />
    </div>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
     <div class="carousel-inner">
      <div class="carousel-item">
       <img src="https://thailotto123.net/assets/img/banners/banner6551a36c29352.png" style="max-height: 500px"
        class="d-block w-100" alt="..." />
       <marquee behavior="" direction="" style="background-color: blue; color: aliceblue">
        Thai 2D - 3D App သည် Thai နိုင်ငံ Official App ဖြစ်ပြီး ၂၄
        နာရီ ကြားခံမလိုပဲ ငွေသွင်းငွေထုတ်လုပ်နိုင်ပါသည်။
       </marquee>
      </div>
      <div class="carousel-item">
       <img src="https://thailotto123.net/assets/img/banners/banner6551a35f3f8a0.png" style="max-height: 500px"
        class="d-block w-100" alt="..." />
       <marquee behavior="" direction="" style="background-color: blue; color: aliceblue">
        Thai 2D - 3D App သည် Thai နိုင်ငံ Official App ဖြစ်ပြီး ၂၄
        နာရီ ကြားခံမလိုပဲ ငွေသွင်းငွေထုတ်လုပ်နိုင်ပါသည်။
       </marquee>
      </div>
      <div class="carousel-item">
       <img src="https://thailotto123.net/assets/img/banners/banner6551a3505d2c9.png" style="max-height: 500px"
        class="d-block w-100" alt="..." />
       <marquee behavior="" direction="" style="background-color: blue; color: aliceblue">
        Thai 2D - 3D App သည် Thai နိုင်ငံ Official App ဖြစ်ပြီး ၂၄
        နာရီ ကြားခံမလိုပဲ ငွေသွင်းငွေထုတ်လုပ်နိုင်ပါသည်။
       </marquee>
      </div>
      <div class="carousel-item active">
       <img src="https://thailotto123.net/assets/img/banners/banner6551a3505d2c9.png" style="max-height: 500px"
        class="d-block w-100" alt="..." />
       <marquee behavior="" direction="" style="background-color: blue; color: aliceblue">
        Thai 2D - 3D App သည် Thai နိုင်ငံ Official App ဖြစ်ပြီး ၂၄
        နာရီ ကြားခံမလိုပဲ ငွေသွင်းငွေထုတ်လုပ်နိုင်ပါသည်။
       </marquee>
      </div>
      <div class="carousel-item">
       <img src="https://thailotto123.net/assets/img/banners/banner6551a3505d2c9.png" style="max-height: 500px"
        class="d-block w-100" alt="..." />
       <marquee behavior="" direction="" style="background-color: blue; color: aliceblue">
        Thai 2D - 3D App သည် Thai နိုင်ငံ Official App ဖြစ်ပြီး ၂၄
        နာရီ ကြားခံမလိုပဲ ငွေသွင်းငွေထုတ်လုပ်နိုင်ပါသည်။
       </marquee>
      </div>
     </div>
    </div>

    <div class="d-flex justify-content-around mt-2">
     <div>
      <div class="buttons">
       <a href="{{ route('admin.GetTwoDigit') }}" class="">2D PLAY</a>
      </div>
      <a href="{{ url('/twod') }}" class="text-dark text-decoration-none">
       <p class="font-weight-bold text">2D</p>
      </a>
     </div>
     <div>
      <div class="buttons">
       <a href="{{ url('/threeD') }}">3D PLAY</a>
      </div>
      <a href="{{ url('/threeD') }}" class="text-dark text-decoration-none">
       <p class="font-weight-bold text text-center">3D</p>
      </a>
     </div>
    </div>

    <div class="d-flex justify-content-around">
     <div>
      <div class="button">
       <a href="#"><img class="w-100 buttons-img" src="{{ asset('user_app/assets/images/logo1.jpg') }}" alt="" /></a>
      </div>
      <a href="#" class="text-dark text-decoration-none">
       <p class="font-weight-bold text">2D</p>
      </a>
     </div>
     <div>
      <div class="button">
       <a href="#"><img class="buttons-img" src="{{ asset('user_app/assets/images/logo1.jpg') }}" alt="" /></a>
      </div>
      <a href="#" class="text-dark text-decoration-none">
       <p class="text">2D</p>
      </a>
     </div>
    </div>
   </div>
  </div>
  <!-- end content -->
 </div>

 <!-- end navbar -->



</div>

@include('user_layout.footer')

</div>
</div>


@endsection