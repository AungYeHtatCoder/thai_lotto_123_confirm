@extends('user_layout.app')

<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 navs fixed-top">
  <div class="px-3 py-3">
   <div class="d-flex justify-content-between">
    <span>
     <a class="material-icons text-white" href="{{ url('/topUp') }}">arrow_back</a>
    </span>
    <h5 class="mx-auto">
     <a href="../index.html" class="text-white">Diamond 2D | 3D</a>
    </h5>
    <span>
     <a class="material-icons text-white" href="../index.html">refresh</a>
    </span>
   </div>
  </div>
 </div>
</div>


@section('content')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8; height: 100vh">
  <p class="text-center mt-3" style="color: #fff">ငွေတင်မည်</p>
  <p class="text-center" style="color: #fff">
   ကျေးဇူးပြု၍ အောက်ပါ Wave Pay အကောင့်သို့ ငွေလွှဲပါ။
  </p>
  <div class="top-up-card d-flex justify-content-between">
   <div class="banks">
    <img src="{{ asset('user_app/assets/images/bank/kpay.png') }}" class="w-100" alt="" />
   </div>
   <p class="mt-4">K Pay</p>
   <hr class="vertical-line" style="border-left: 2px solid #000; height: 10vh" />
   <div class="mt-3 mx-5" style="color: #fff">
    <p>လွှဲငွေပမာဏ</p>
    <p>1,000 ကျပ်</p>
   </div>
  </div>

  <p class="mt-4" style="color: #fff; font-size: 14px">
   လုပ်ဆောင်မှုအမှတ်စဥ် (နောက်ဆုံးဂဏန်း ၆ လုံး)
  </p>
  <div class="form-group">
   <input type="number" class="form-control" placeholder="ဂဏန်းခြောက်လုံး ဖြည့်ပါ" name="" id="" />
  </div>
  <div class="form-group mt-4">
   <a href="" class="top-up-btn btn">တင်ပြမည်</a>
  </div>
  <p style="color: #fff">
   ငွေဖြည့်ရန်အဆင်မပြေမှုတစ်စုံတစ်ရာရှိပါက ဆက်သွယ်ရန်
  </p>
  <div class="service-card mt-4">
   <p class="mt-3">ငွေဖြည့် / ငွေထုတ်</p>
   <div class="phone-icon">
    <i class="fa-brands fa-telegram px-3"></i>
    <i class="fa-brands fa-viber"></i>
   </div>
  </div>
 </div>
</div>
@include('user_layout.footer')
@endsection