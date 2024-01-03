@extends('user_layout.app')

@section('content')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4">
  <!--start navbar -->
  @include('user_layout.nav')
  <!-- start content -->
  <div class="row content mt-2" >
   <div class="stick">
    <div class="d-flex justify-content-between pt-4">
     <div class="">
        @if (!Auth::user())
        <i class="fa-regular fa-circle-user fa-2xl"></i>
        @elseif (Auth::user()->profile === null)
        <i class="fa-regular fa-circle-user fa-2xl"></i>
        @else
        <img src="{{ Auth::user()->profile ?? "" }}" width="55px" class="rounded-circle" alt="">
        @endif

     </div>
     <div>
      {{-- <h2 class="ms-2"><a href="{{ route('login') }}">Login</a></h2> --}}
       <div class="mt-2 text-white">
            @auth
                <p class="mb-0 pb-0">{{ Auth::user()->name }}</p>
                <p class="mb-0 pb-3">{{ Auth::user()->phone }}</p>

            @endauth
            @guest

                <a href="{{ route('login') }}" class="text-decoration-none text-white">
                    အကောင့်ဝင်ပါ |
                </a>
                <span>
                  {{-- register route --}}
                  <a href="{{ route('register') }}" class="text-decoration-none text-white">
                    | အကောင့်ဖွင့်ပါ
                  </a>
                </span>
            @endguest
          </div>
     </div>
     <div>
      <i class="fa-solid fa-bell fa-xl"></i>
     </div>
    </div>

        <div class="ticks mb-2">
          {{-- <hr class="" style="
                    height: 20px;
                    background-color: #ffffff;
                    margin-top: 20px;
                  " /> --}}
        </div>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item">
              <img src="{{ asset('user_app/assets/images/banner/banner6551a36c29352.png') }}" style="max-height: 500px" class="d-block w-100" alt="..." />
              <marquee behavior="" direction="" style="background-color: blue; color: aliceblue">
                Thai 2D - 3D App သည် Thai နိုင်ငံ Official App ဖြစ်ပြီး ၂၄
                နာရီ ကြားခံမလိုပဲ ငွေသွင်းငွေထုတ်လုပ်နိုင်ပါသည်။
              </marquee>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('user_app/assets/images/banner/banner6551a35f3f8a0.png') }}" style="max-height: 500px" class="d-block w-100" alt="..." />
              <marquee behavior="" direction="" style="background-color: blue; color: aliceblue">
                Thai 2D - 3D App သည် Thai နိုင်ငံ Official App ဖြစ်ပြီး ၂၄
                နာရီ ကြားခံမလိုပဲ ငွေသွင်းငွေထုတ်လုပ်နိုင်ပါသည်။
              </marquee>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('user_app/assets/images/banner/banner6551a3505d2c9.png') }}" style="max-height: 500px" class="d-block w-100" alt="..." />
              <marquee behavior="" direction="" style="background-color: blue; color: aliceblue">
                Thai 2D - 3D App သည် Thai နိုင်ငံ Official App ဖြစ်ပြီး ၂၄
                နာရီ ကြားခံမလိုပဲ ငွေသွင်းငွေထုတ်လုပ်နိုင်ပါသည်။
              </marquee>
            </div>
            <div class="carousel-item active">
              <img src="{{ asset('user_app/assets/images/banner/banner6551a3505d2c9.png') }}" style="max-height: 500px" class="d-block w-100" alt="..." />
              <marquee behavior="" direction="" style="background-color: blue; color: aliceblue">
                Thai 2D - 3D App သည် Thai နိုင်ငံ Official App ဖြစ်ပြီး ၂၄
                နာရီ ကြားခံမလိုပဲ ငွေသွင်းငွေထုတ်လုပ်နိုင်ပါသည်။
              </marquee>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('user_app/assets/images/banner/banner6551a3505d2c9.png') }}" style="max-height: 500px" class="d-block w-100" alt="..." />
              <marquee behavior="" direction="" style="background-color: blue; color: aliceblue">
                Thai 2D - 3D App သည် Thai နိုင်ငံ Official App ဖြစ်ပြီး ၂၄
                နာရီ ကြားခံမလိုပဲ ငွေသွင်းငွေထုတ်လုပ်နိုင်ပါသည်။
              </marquee>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-around mt-3">
              <a href="{{ url('/user/two-d-play-index') }}" class="buttons mb-5" style="font-size:30px; font-weight: 600;">2D</a>
              <a href="{{ url('/user/get-three-d') }}" class="buttons mb-5" style="font-size:30px; font-weight: 600;">3D</a>
        </div>

        <div class="d-flex justify-content-around " style="padding-bottom: 100px;">
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
