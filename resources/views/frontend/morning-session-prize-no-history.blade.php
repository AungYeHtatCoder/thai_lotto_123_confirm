@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <h4 class="text-center my-3">မှတ်တမ်း</h4>
    <ul class="nav nav-justified" >
      <li class="nav-item card p-2">
        <a class="nav-link" id="twod-tab" data-toggle="tab" href="#twodmorning">
          <i class="fas fa-calendar fa-2x mb-3 d-block" aria-hidden="true"></i>
          <span class="d-block" style="font-size: 20px;">Morning 2D ထီပေါက်စဉ်</span>
        </a>
      </li>
      <li class="nav-item card ms-2">
        <a class="nav-link" id="threed-tab" data-toggle="tab" href="#twodevening">
          <i class="fas fa-calendar fa-2x mb-3 d-block" aria-hidden="true"></i>
          <span class="d-block" style="font-size: 20px;">Evening 2D ထီပေါက်စဉ်</span>
        </a>
      </li>
    </ul>

    <div class="tab-content" style="height: 100vh;">
      <div class="tab-pane fade" id="twodmorning">
        <div class="card p-4 rounded my-3">
          <div class="d-flex justify-content-between">
            <div class="text-center">
              <p class="mb-0 pb-0">Session</p>
              <p class="mb-0 pb-0">Morning</p>
            </div>
            <div class="text-center">
              <p class="mb-0 pb-0">Date</p>
              <p class="mb-0 pb-0">
                10-11-2023
                Friday
                04:07 PM 
              </p>
            </div>
            <div>
              <p class="mb-0 pb-0">2D</p>
              <p class="text-warning mb-0 pb-0">12</p>
            </div>
          </div>
        </div>

        <div class="card p-4 rounded my-3">
          <div class="d-flex justify-content-between">
            <div class="text-center">
              <p class="mb-0 pb-0">Session</p>
              <p class="mb-0 pb-0">Morning</p>
            </div>
            <div class="text-center">
              <p class="mb-0 pb-0">Date</p>
              <p class="mb-0 pb-0">
                10-11-2023
                Friday
                04:07 PM 
              </p>
            </div>
            <div>
              <p class="mb-0 pb-0">2D</p>
              <p class="text-warning mb-0 pb-0">12</p>
            </div>
          </div>
        </div>

        <div class="card p-4 rounded my-3">
          <div class="d-flex justify-content-between">
            <div class="text-center">
              <p class="mb-0 pb-0">Session</p>
              <p class="mb-0 pb-0">Morning</p>
            </div>
            <div class="text-center">
              <p class="mb-0 pb-0">Date</p>
              <p class="mb-0 pb-0">
                10-11-2023
                Friday
                04:07 PM 
              </p>
            </div>
            <div>
              <p class="mb-0 pb-0">2D</p>
              <p class="text-warning mb-0 pb-0">12</p>
            </div>
          </div>
        </div>

        <div class="card p-4 rounded my-3">
          <div class="d-flex justify-content-between">
            <div class="text-center">
              <p class="mb-0 pb-0">Session</p>
              <p class="mb-0 pb-0">Morning</p>
            </div>
            <div class="text-center">
              <p class="mb-0 pb-0">Date</p>
              <p class="mb-0 pb-0">
                10-11-2023
                Friday
                04:07 PM 
              </p>
            </div>
            <div>
              <p class="mb-0 pb-0">2D</p>
              <p class="text-warning mb-0 pb-0">12</p>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="twodevening">
        <div class="card p-4 rounded my-3">
          <div class="d-flex justify-content-between">
            <div class="text-center">
              <p class="mb-0 pb-0">Session</p>
              <p class="mb-0 pb-0">Evening</p>
            </div>
            <div class="text-center">
              <p class="mb-0 pb-0">Date</p>
              <p class="mb-0 pb-0">
                10-11-2023
                Friday
                04:07 PM 
              </p>
            </div>
            <div>
              <p class="mb-0 pb-0">2D</p>
              <p class="text-warning mb-0 pb-0">12</p>
            </div>
          </div>
        </div>
        <div class="card p-4 rounded my-3">
          <div class="d-flex justify-content-between">
            <div class="text-center">
              <p class="mb-0 pb-0">Session</p>
              <p class="mb-0 pb-0">Evening</p>
            </div>
            <div class="text-center">
              <p class="mb-0 pb-0">Date</p>
              <p class="mb-0 pb-0">
                10-11-2023
                Friday
                04:07 PM 
              </p>
            </div>
            <div>
              <p class="mb-0 pb-0">2D</p>
              <p class="text-warning mb-0 pb-0">12</p>
            </div>
          </div>
        </div>
        <div class="card p-4 rounded my-3">
          <div class="d-flex justify-content-between">
            <div class="text-center">
              <p class="mb-0 pb-0">Session</p>
              <p class="mb-0 pb-0">Evening</p>
            </div>
            <div class="text-center">
              <p class="mb-0 pb-0">Date</p>
              <p class="mb-0 pb-0">
                10-11-2023
                Friday
                04:07 PM 
              </p>
            </div>
            <div>
              <p class="mb-0 pb-0">2D</p>
              <p class="text-warning mb-0 pb-0">12</p>
            </div>
          </div>
        </div>
        <div class="card p-4 rounded my-3">
          <div class="d-flex justify-content-between">
            <div class="text-center">
              <p class="mb-0 pb-0">Session</p>
              <p class="mb-0 pb-0">Evening</p>
            </div>
            <div class="text-center">
              <p class="mb-0 pb-0">Date</p>
              <p class="mb-0 pb-0">
                10-11-2023
                Friday
                04:07 PM 
              </p>
            </div>
            <div>
              <p class="mb-0 pb-0">2D</p>
              <p class="text-warning mb-0 pb-0">12</p>
            </div>
          </div>
        </div>
        
      </div>
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

<script>
  document.getElementById('twod-tab').addEventListener('click', function() {
  document.getElementById('twod-tab').classList.add('active');
  document.getElementById('threed-tab').classList.remove('active');
  document.getElementById('twodmorning').classList.add('show', 'active');
  document.getElementById('twodevening').classList.remove('show', 'active');
});


document.getElementById('threed-tab').addEventListener('click', function() {
  document.getElementById('threed-tab').classList.add('active');
  document.getElementById('twod-tab').classList.remove('active');
  document.getElementById('twodevening').classList.add('show', 'active');
  document.getElementById('twodmorning').classList.remove('show', 'active');
});
</script>
{{-- @include('user_layout.footer') --}}
@endsection