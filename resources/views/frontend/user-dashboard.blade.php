@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <div style="margin-bottom: 100px;">
      <a href="{{ url('/user-dashboard/winningRecord') }}" class="card text-decoration-none text-dark shadow p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-list-ul list" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">ကံထူးရှင်များ</p>
              </div>
              <div>
                  <i class="fas fa-play" aria-hidden="true"></i>
              </div>
          </div>
      </a>
      <a href="{{ url('/user-dashboard/moriningPrize') }}" class="card text-decoration-none text-dark shadow p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-calendar-days list text-danger" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">ထွက်ဂဏန်းများ</p>
              </div>
              <div>
                  <i class="fas fa-play" aria-hidden="true"></i>
              </div>
          </div>
      </a>
      <a href="{{ url('/user-dashboard/moriningRecord') }}" class="card text-decoration-none text-dark shadow border border-1 p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-list-ul list" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">မနက်ပိုင်းထီထိုးမှတ်တမ်း</p>
              </div>
              <div>
                  <i class="fas fa-play" aria-hidden="true"></i>
              </div>
          </div>
      </a>
      <a href="{{ url('/user-dashboard/eveningRecord') }}" class="card text-decoration-none text-dark shadow border border-1 p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-list-ul list" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">ညနေပိုင်းထီထိုးမှတ်တမ်း</p>
              </div>
              <div>
                  <i class="fas fa-play" aria-hidden="true"></i>
              </div>
          </div>
      </a>
      <a href="{{ url('/user-dashboard/morningHistoryRecord') }}" class="card text-decoration-none text-dark shadow border border-1 p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-calendar-days list text-danger" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">မနက်ပိုင်းထွက်ဂဏန်းများ</p>
              </div>
              <div>
                  <i class="fas fa-play" aria-hidden="true"></i>
              </div>
          </div>
      </a>
  
      <a href="#" class="card text-decoration-none text-dark shadow border border-1 p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-calendar-days list text-danger" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">ညနေပိုင်းထွက်ဂဏန်းများ</p>
              </div>
              <div>
                  <i class="fas fa-play" aria-hidden="true"></i>
              </div>
          </div>
      </a>
  
      <a href="{{ url('/user-dashboard') }}" class="card text-decoration-none text-dark shadow border border-1 p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-star list text-warning" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">အမှတ် 0 (ကျပ်)</p>
              </div>
              
          </div>
      </a>
      <a href="my-bank.html" class="card text-decoration-none text-dark shadow border border-1 p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-wallet list text-success" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">ဘဏ်အကောင့်များ</p>
              </div>
              <div>
                  <i class="fas fa-play" aria-hidden="true"></i>
              </div>
          </div>
      </a>
      <a href="#" class="card text-decoration-none text-dark shadow border border-1 p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-lock text-success list" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">လျှို့ဝှက်နံပါတ်ပြောင်းရန်</p>
              </div>
              <div>
                  <i class="fas fa-play" aria-hidden="true"></i>
              </div>
          </div>
      </a>
      <a href="#" class="card text-decoration-none text-dark shadow border border-1 p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-user-group text-success list" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">မိတ်ဆက်ကုဒ်</p>
              </div>
              <div>
                  <i class="fas fa-play" aria-hidden="true"></i>
              </div>
          </div>
      </a>
      <a href="#" class="card text-decoration-none text-dark shadow border border-1 p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fas fa-comment-dots text-warning list" aria-hidden="true"></i>
                  </div>
                  <p class="pb-0 mb-0">အကြံပြုရန်</p>
              </div>
              <div>
                  <i class="fas fa-play" aria-hidden="true"></i>
              </div>
          </div>
      </a>
      <a href="#" class="card text-decoration-none text-dark shadow border border-1 p-3 my-3">
          <div class="d-flex justify-content-between">
              <div class="d-flex">
                  <div class="me-3">
                      <i class="fa-brands fa-google-play text-info list"></i>
                  </div>
                  <p class="pb-0 mb-0">ဗားရှင်း - 1.0.0</p>
              </div>
              <!-- <div>
                  <i class="fas fa-play"></i>
              </div> -->
          </div>
      </a>
      <a href="#" class="card logout-btn text-decoration-none text-dark p-3 my-3">
          <div class="d-flex align-items-center">
              <div class="me-2">
                  <i class="fas fa-power-off list" aria-hidden="true"></i>
              </div>
              <button type="submit" class="border-0 bg-transparent">
                  အကောင့်မှ ထွက်ခွာရန်
              </button>
              &nbsp; &nbsp; <i class="fas fa-chevron-right arrow-icon" aria-hidden="true"></i>
          </div>
      </a>
  </div>      

    </div>

</div>
@include('user_layout.footer')
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
{{-- @include('user_layout.footer') --}}
@endsection