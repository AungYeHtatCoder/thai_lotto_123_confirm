@extends('user_layout.app')

@include('user_layout.nav')

@section('content')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8; height: 100vh">
  <h6 class="text-center text-white p-3">ကျွန်ုပ်တို့ကို ဆက်သွယ်ရန်</h6>
  <div class="container" style="padding-bottom: 120px">
   <p class="text-justify text-white">
    အောက်ပါတို့သည်
    <span class="fw-bold text-dark">Diamond 2D | 3D </span>တရားဝင်ဖုန်းနံပါတ်များ ဖြစ်ပါသည်
   </p>
   <div class="service-card mt-4">
    <p class="mt-3">ငွေဖြည့် / ငွေထုတ်</p>
    <div class="phone-icon">
     <i class="fa-brands fa-telegram px-3"></i>
     <i class="fa-brands fa-viber"></i>
    </div>
   </div>
   <div class="service-card mt-4">
    <p class="mt-3">ငွေဖြည့် / ငွေထုတ်</p>
    <div class="phone-icon">
     <i class="fa-brands fa-telegram px-3"></i>
     <i class="fa-brands fa-viber"></i>
    </div>
   </div>
   <div class="service-card mt-4">
    <p class="mt-3">ငွေဖြည့် / ငွေထုတ်</p>
    <div class="phone-icon">
     <i class="fa-brands fa-telegram px-3"></i>
     <i class="fa-brands fa-viber"></i>
    </div>
   </div>
  </div>
 </div>
</div>
@include('user_layout.footer')
@endsection