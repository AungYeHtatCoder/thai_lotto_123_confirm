@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<!-- profile section start -->
<div class="container-fluid profiles">
 <div class="d-flex justify-content-between align-items-center">
  <div class="d-flex">
   <img src="{{ asset('user_app/assets/img/Group.png') }}" class="rounded-circle mt-1" style="
                padding: 10px;
                background-color: #f6ffc3;
                color: var(--green);
                margin-right: 16px;
              " alt="" />
   <div>
    <span class="d-block py-0 my-0" style="font-size: 16px; color: var(--default); font-weight: 600">Su Yee</span>
    <span class="d-block py-0 my-0" style="font-size: 14px; color: var(--default); font-weight: 400">ID0123456789102453</span>
   </div>
  </div>
  <div class="">
   <img src="{{ asset('user_app/assets/img/myanmar.png') }}" width="24px" height="24px" style="margin-right: 16px" alt="" />
   <img src="{{ asset('user_app/assets/img/bell.png') }}" width="24px" height="24px" alt="" />
  </div>
 </div>
</div>
<!-- profile section end -->
<div class="d-flex justify-content-around align-items-center mx-auto mt-3" style="
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

<div class="d-flex justify-content-between align-items-center my-2 mx-auto" style="
          width: 358px;
          height: 90px;
          border: 1px solid #1c30e0;
          padding: 12px 16px;
          border-radius: 24px;
        ">
 <a href="{{ url('/topUp-bank') }}">
  <div class="menus">
   <img src="{{ asset('user_app/assets/img/2D/money-withdrawal 1.png') }}" width="20px" height="20px" alt="" />
  </div>
  <p class="d-block mt-1" style="font-size: 12px; font-weight: 500; color: #253490">
   ငွေဖြည့်
  </p>
 </a>

 <a href="{{ url('/withdraw-bank') }}">
  <div class="menus">
   <img src="{{ asset('user_app/assets/img/2D/send-money 1.png') }}" width="20px" height="20px" alt="" />
  </div>
  <p class="d-block mt-1" style="font-size: 12px; font-weight: 500; color: #253490">
   ငွေထုတ််
  </p>
 </a>

 <a href="#">
  <div class="menus">
   <img src="{{ asset('user_app/assets/img/2D/receipt.png') }}" width="20px" height="20px" alt="" />
  </div>
  <p class="d-block mt-1" style="font-size: 12px; font-weight: 500; color: #253490">
   မှတ်တမ်း
  </p>
 </a>
</div>

<!-- wallet info start -->
<div class="wallet text-dark pb-3 mx-3" style="font-size: 12px">
 <div class="wallet-content">
  <p class="text-center mb-4">ငွေဖြည့်လိုပါက</p>
  <p>၁။ "ငွေဖြည့်" ကို နှိပ်ပါ။</p>
  <p>
   ၂။ KBZ Pay, Wave Pay, CB Pay နှင့် AYA Pay တို့မှ မိမိငွေဖြည့်မည့်
   ဘဏ်ကို ရွေးပါ။
  </p>
  <p>
   ၃။ သက်ဆိုင်ရာ Pay ဖြင့် ငွေသွင်းနိုင်သော အကောင့်များ
   ပေါ်လာပါလိမ့်မည်။
  </p>
 </div>
</div>
<!-- wallet info end -->

@include('user_layout.footer')

@endsection