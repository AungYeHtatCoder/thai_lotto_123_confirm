@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="d-flex justify-content-around align-items-center mx-auto profiles" style="
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
  <a href="#">
    <div class="menus">
      <img src="{{ asset('user_app/assets/img/2D/money-withdrawal 1.png') }}" width="20px" height="20px" alt="" />
    </div>
    <p class="d-block mt-1" style="font-size: 12px; font-weight: 500; color: #253490">
      ငွေဖြည့်
    </p>
  </a>

  <a href="#">
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
<!-- play section  start-->
<div class="p-3">
  <div class="twod_styles mx-auto">
    <h5 class="d-flex justify-content-center align-items-center" style="font-size: 20px">
      83
    </h5>
  </div>
  <div class="text-center mt-1" style="color: #5a5a5a; font-size: 16px; line-height: 20px">
    Last Update: 30 Nov 2023 04:29:44 PM
  </div>
  <div class="d-flex justify-content-center align-items-center mt-3" width="126px" height="45px">
    <button type="button" class="text-white" style="
              border-radius: 10px;
              background: var(--default);
              padding: 10px;
              border: none;
              font-size: 16px;
            " data-bs-toggle="modal" data-bs-target="#time_modal">
      ထိုးမည်
    </button>
  </div>
</div>
<!-- play section end -->

<!--  -->
<div>
  <div class="mx-auto lives">
    <p class="text-center">11:00:00</p>

    <div class="d-flex justify-content-around align-items-center">
      <h6>Set</h6>
      <h6>Value</h6>
      <h6>2D</h6>
    </div>
    <div class="d-flex justify-content-around align-items-center">
      <h6>1397.99</h6>
      <h6>12091.35</h6>
      <h6>31</h6>
    </div>

    <hr style="height: 2px; background-color: #8b93c4" class="mx-3" />

    <div class="d-flex justify-content-around align-items-center">
      <h6>Set</h6>
      <h6>Value</h6>
      <h6>2D</h6>
    </div>
    <div class="d-flex justify-content-around align-items-center">
      <h6>1397.99</h6>
      <h6>12091.35</h6>
      <h6>31</h6>
    </div>

    <hr style="height: 2px; background-color: #8b93c4" class="mx-3" />

    <div class="d-flex justify-content-around align-items-center">
      <h6>Set</h6>
      <h6>Value</h6>
      <h6>2D</h6>
    </div>
    <div class="d-flex justify-content-around align-items-center">
      <h6>1397.99</h6>
      <h6>12091.35</h6>
      <h6>31</h6>
    </div>

    <hr style="height: 2px; background-color: #8b93c4" class="mx-3" />

    <div class="d-flex justify-content-around align-items-center">
      <h6>Set</h6>
      <h6>Value</h6>
      <h6>2D</h6>
    </div>
    <div class="d-flex justify-content-around align-items-center">
      <h6>1397.99</h6>
      <h6>12091.35</h6>
      <h6>31</h6>
    </div>
  </div>
</div>

@include('user_layout.footer')
<!-- time modal -->
<!-- Modal -->
<div class="modal fade" id="time_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="top: 30%">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title text-dark" id="exampleModalLongTitle" style="font-size: 15px">ထိုးမည့်အချိန် (section) ကိုရွေးပါ
        </span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; outline: none; background-color: #fff">
          <span aria-hidden="true" style="font-size: 30px">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button class="btn w-100 my-1" style="background: var(--linear)">
          <a href="{{ url('/twodplay') }}">10:00 AM</a>
        </button>
        <button class="btn w-100 my-1" style="background: var(--linear)">
          <a href="{{ url('/twodplay') }}">12:00 AM</a>
        </button>
        <button class="btn btn-outline-primary w-100 my-1" style="background: var(--linear)">
          <a href="{{ url('/twodplay') }}">2:00 AM</a>
        </button>
        <button class="btn btn-outline-primary w-100 my-1" style="background: var(--linear)">
          <a href="{{ url('/twodplay') }}">4:00 AM</a>
        </button>
      </div>
      <!-- <div class="modal-footer d-flex justify-content-center align-items-center">
            <button type="button" class="btn btn-primary px-5 py-2">ထိုးမည်</button>
            </div> -->
    </div>
  </div>
</div>

@endsection