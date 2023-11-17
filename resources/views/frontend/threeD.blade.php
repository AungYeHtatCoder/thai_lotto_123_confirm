@extends('user_layout.app')

<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 navs fixed-top">
  <div class="px-3 py-3">
   <div class="d-flex justify-content-between">
    <span>
     <a class="material-icons text-white" href="{{ url('/') }}">arrow_back</a>
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
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8">
  <div class="flesh-card">
   <div class="d-flex justify-content-between">
    <div class="d-flex justify-content-between">
     <span class="material-icons">account_balance_wallet</span>
     <p class="px-2">လက်ကျန်ငွေ</p>
    </div>
    <div class="d-flex justify-content-between">
     <span class="material-icons"> update </span>
     <p class="px-2">ပိတ်ရန်ကျန်ချိန်</p>
    </div>
   </div>

   <div class="d-flex justify-content-between">
    <p class="ms-5">0.00</p>
    <p class="me-2">
     2023-11-16 <br />
     02:30:00PM
    </p>
   </div>
  </div>

  <div class="card text-center event-card">
   <div class="d-flex p-1 justify-content-around">
    <div>
     <a href="">
      <span class="material-icons">manage_search</span>
      <p>မှတ်တမ်း</p>
     </a>
    </div>
    <div>
     <a href="{{ url('/threed-winner') }}">
      <span class="material-icons">stars</span>
      <p>ကံထူးရှင်များ</p>
     </a>
    </div>
    <div>
     <a href="{{ url('/threed-history') }}">
      <span class="material-icons">event_note</span>
      <p>ထွက်ဂဏန်းများ</p>
     </a>
    </div>
   </div>
  </div>

  <div class="container-fluid" style="margin-top: 30px; height: 100vh">
   <div class="threed-card">
    <div>
     <p>Date <br /><span>01-11-2023</span></p>
    </div>
    <div>
     <p>3D <br /><span>512</span></p>
    </div>
   </div>
   <div class="threed-card">
    <div>
     <p>Date <br /><span>01-11-2023</span></p>
    </div>
    <div>
     <p>3D <br /><span>512</span></p>
    </div>
   </div>
   <div class="threed-card">
    <div>
     <p>Date <br /><span>01-11-2023</span></p>
    </div>
    <div>
     <p>3D <br /><span>512</span></p>
    </div>
   </div>
   <div class="threed-card">
    <div>
     <p>Date <br /><span>01-11-2023</span></p>
    </div>
    <div>
     <p>3D <br /><span>512</span></p>
    </div>
   </div>
   <div class="threed-card">
    <div>
     <p>Date <br /><span>01-11-2023</span></p>
    </div>
    <div>
     <p>3D <br /><span>512</span></p>
    </div>
   </div>
   <div class="threed-card">
    <div>
     <p>Date <br /><span>01-11-2023</span></p>
    </div>
    <div>
     <p>3D <br /><span>512</span></p>
    </div>
   </div>
   <div class="threed-card">
    <div>
     <p>Date <br /><span>01-11-2023</span></p>
    </div>
    <div>
     <p>3D <br /><span>512</span></p>
    </div>
   </div>
  </div>
 </div>
</div>

<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 py-3 fixed-bottom text-center">
  <a href="{{ url('/threed-bet') }}" class="btn custom">ထိုးမည်</a>
 </div>
</div>
@endsection