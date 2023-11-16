@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8; ">
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

  <div class="container mb-4" style="padding-bottom: 200px">
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

<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">ထိုးမည့်အချိန် (section) ကိုရွေးပါ</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body">
    <div class="modal-btn">
     <a href="{{ url('/twodplay') }}" class="text-decoration-none btn">12:00 AM</a>
    </div>
    <div class="modal-btn mt-2">
     <a href="#" class="text-decoration-none btn">04:00 PM</a>
    </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn modal-button">ထိုးမည်</button>
   </div>
  </div>
 </div>
</div>
@include('user_layout.footer')
@endsection