@extends('user_layout.app')

@section('content')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 navs fixed-top">
  <div class="px-3 py-3">
   <div class="d-flex justify-content-between">
    <span>
     <a class="material-icons text-white" href="../index.html">arrow_back</a>
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
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8">
  <div class="flesh-card">
   <div class="d-flex">
    <span class="material-icons">account_balance_wallet</span>
    <p class="px-2 mt-1">လက်ကျန်ငွေ</p>
   </div>
   <p>0.00 Kyat</p>
  </div>
  <div class="card text-center">
   <div class="card-body">
    <div class="d-flex p-1 justify-content-around">
     <div>
      <a href="#" class="text-decoration-none">
       <span class="material-icons">manage_search</span>
       <p>မှတ်တမ်း</p>
      </a>
     </div>
     <div>
      <a href="#" class="text-decoration-none">
       <span class="material-icons">stars</span>
       <p>ကံထူးရှင်များ</p>
      </a>
     </div>
     <div>
      <a href="#" class="text-decoration-none">
       <span class="material-icons">event_note</span>
       <p>ပိတ်ရက်</p>
      </a>
     </div>
    </div>
   </div>
  </div>

  <div class="results">
   <h1>71</h1>
   <p class="text-start">
    Updated:
    <span>11-11-2023 4:31:59PM</span>
   </p>

   <button type="button" class="btns" data-bs-toggle="modal" data-bs-target="#exampleModal">ထိုးမည်</button>

  </div>

  <div class="container mb-4">
   <div class="card text-center p-0 cards" style="background-color: #2a576c">
    <div class="card-body">
     <p class="text-center text-white">11:00:00</p>
     <div class="text-center">
      <div class="d-flex justify-content-between text-center">
       <p>Set</p>
       <p>Value</p>
       <p>2D</p>
      </div>
      <div class="d-flex justify-content-between text-center">
       <p>1389.57</p>
       <p>50981.87</p>
       <p>71</p>
      </div>
     </div>
    </div>
   </div>

   <div class="card text-center p-0 cards mt-3" style="background-color: #2a576c">
    <div class="card-body">
     <p class="text-center text-white">11:00:00</p>
     <div class="text-center">
      <div class="d-flex justify-content-between text-center">
       <p>Set</p>
       <p>Value</p>
       <p>2D</p>
      </div>
      <div class="d-flex justify-content-between text-center">
       <p>1389.57</p>
       <p>50981.87</p>
       <p>71</p>
      </div>
     </div>
    </div>
   </div>

   <div class="card text-center p-0 cards mt-3" style="background-color: #2a576c">
    <div class="card-body">
     <p class="text-center text-white">11:00:00</p>
     <div class="text-center">
      <div class="d-flex justify-content-between text-center">
       <p>Set</p>
       <p>Value</p>
       <p>2D</p>
      </div>
      <div class="d-flex justify-content-between text-center">
       <p>1389.57</p>
       <p>50981.87</p>
       <p>71</p>
      </div>
     </div>
    </div>
   </div>
  </div>


 </div>

</div>

@endsection