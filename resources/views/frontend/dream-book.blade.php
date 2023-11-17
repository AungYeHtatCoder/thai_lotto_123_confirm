@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <div class="flesh-card">
      <div class="d-flex justify-content-between">
          <div class="d-flex justify-content-between">
              <span class="material-icons">account_balance_wallet</span>
              <p class="px-2">လက်ကျန်ငွေ</p>
          </div>
          <div class="d-flex justify-content-between">
              <span class="material-icons">
                update
                </span>
              <p class="px-2">ပိတ်ရန်ကျန်ချိန်</p>
          </div>
      </div>

      <div class="d-flex justify-content-between">

          <p class="ms-5">0.00</p>
          <p class="me-2">2023-11-16 <br/> 02:30:00PM</p>
      </div>
      
  </div>

  <div class="container" style="height: 800px;">
      <input type="number" name="amount" class="form-control" placeholder="‌ငွေပမာဏ"/>
      <div class="container mt-4">

          <div class="input-group flex-nowrap">
              <span class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></span>
              <input type="text" class="form-control" placeholder="search" aria-label="Username" aria-describedby="addon-wrapping">
          </div>
      </div>
  </div>

  <div class=" mt-3 d-flex justify-content-between custom-btn">
    <button class="text-danger" style="background:#b9b4c7;border: none;">ဖျက်မည်</button>

    <a href="2d-confirm.html" class="btn text-white" style="background-color: #2a576c;">ထိုးမည်</a>
  </div>
    </div>
</div>

@include('user_layout.footer')


@endsection