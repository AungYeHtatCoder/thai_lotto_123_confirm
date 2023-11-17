@extends('user_layout.app')

<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 navs fixed-top">
  <div class="px-3 py-3">
   <div class="d-flex justify-content-between">
    <span>
     <a class="material-icons text-white" href="{{ url('/promotion') }}">arrow_back</a>
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
  <div style="margin-bottom: 100px">
   <img src="https://file.thai2d3dgame.com/files/promotions/40a5d3cc-7c82-4105-b43f-eb64aa58521d.png" alt="" class="w-100" style="margin-top: 5px; border-radius: 10px" />
   <div class="mt-3">
    <p>❗💦 သင်္ကြန်နှစ်ကူး အထူးပရိုမိုးရှင်💦❗</p>
    <p>
     🔔💦သင်္ကြန်ကာလထဲမှာ Thai Sin ချစ်သူတို့ကိုပေးမယ့်
     ပရိုမိုးရှင်းလေးကတော့...
    </p>
    <p>🗓️April 1 ရက်နေ့မှ April 10 ရက်နေ့အထိ (10)ရက်တိတိ</p>
    <p>2D - ⏰ တနင်္လာနေ့တိုင်း - (4)ကြိမ်လုံး - အဆ (90)</p>

    <p>
     ⏰ အင်္ဂါနေ့မှ သောကြာနေ့အထိ<br />
     🔸10 : 30 AM - 90 ဆ<br />
     🔸12 : 01 PM - 85 ဆ<br />
     🔸02 : 30 PM - 90 ဆ<br />
     🔸04 : 30 PM - 85 ဆ နဲ့<br />
     🔹3D - အဆ (700)၊ သွပ်ပတ်လည် (10) ဆ တို့ကို ရှယ်ပေးသွားမှာ
     ဖြစ်ကြောင်း သတင်းကောင်းပါးလိုက်ပါသည်။..🌼
    </p>

    <p>
     🔺ပရိုမိုးရှင်းအသေးစိတ်သိရန်....<br />
     Page Messenger or<br />
     Viber ph number- 09 983 880 968 , 09 973 530 306<br />
     🌐Thai 2D3D website- www.thai2d3d.com
    </p>
   </div>
  </div>
 </div>
</div>

@include('user_layout.footer')
@endsection