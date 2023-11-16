@extends('user_layout.app')


@include('user_layout.sub_nav')


@section('content')
<div class="row" style="height: 100vh">
  <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8">
    <h6 class="text-center fw-bold py-3" style="color: #265166">3D ကံထူးရှင်များ စာရင်း</h6>
    <div class="d-flex justify-content-between px-2">
      <p>စဉ်</p>
      <p>အမည်</p>
      <p>ထိုးငွေ</p>
      <p>ထီပေါက်ငွေ</p>
    </div>
    <div class="winner-card px-3 pt-2 d-flex justify-content-between">
      <p>1.</p>
      <div class="d-flex">
        <img src="{{ asset('user_app/assets/images/team-1.jpg') }}" width="50px" height="50px" style="border-radius: 50%" alt="" />
        <p class="d-block">UserName <span class="d-block">091234567</span></p>
      </div>
      <p>10,000</p>
      <p>10,000</p>
    </div>
    <div class="winner-card px-3 pt-2 d-flex justify-content-between">
      <p>2.</p>
      <div class="d-flex">
        <img src="{{ asset('user_app/assets/images/team-1.jpg') }}" width="50px" height="50px" style="border-radius: 50%" alt="" />
        <p class="d-block">UserName <span class="d-block">091234567</span></p>
      </div>
      <p>10,000</p>
      <p>10,000</p>
    </div>
    <div class="winner-card px-3 pt-2 d-flex justify-content-between">
      <p>3.</p>
      <div class="d-flex">
        <img src="{{ asset('user_app/assets/images/team-1.jpg') }}" width="50px" height="50px" style="border-radius: 50%" alt="" />
        <p class="d-block">UserName <span class="d-block">091234567</span></p>
      </div>
      <p>10,000</p>
      <p>10,000</p>
    </div>
    <div class="winner-card px-3 pt-2 d-flex justify-content-between">
      <p>4.</p>
      <div class="d-flex">
        <img src="{{ asset('user_app/assets/images/team-1.jpg') }}" width="50px" height="50px" style="border-radius: 50%" alt="" />
        <p class="d-block">UserName <span class="d-block">091234567</span></p>
      </div>
      <p>10,000</p>
      <p>10,000</p>
    </div>
    <div class="winner-card px-3 pt-2 d-flex justify-content-between">
      <p>5.</p>
      <div class="d-flex">
        <img src="{{ asset('user_app/assets/images/team-1.jpg') }}" width="50px" height="50px" style="border-radius: 50%" alt="" />
        <p class="d-block">UserName <span class="d-block">091234567</span></p>
      </div>
      <p>10,000</p>
      <p>10,000</p>
    </div>
    <div class="winner-card px-3 pt-2 d-flex justify-content-between">
      <p>6.</p>
      <div class="d-flex">
        <img src="{{ asset('user_app/assets/images/team-1.jpg') }}" width="50px" height="50px" style="border-radius: 50%" alt="" />
        <p class="d-block">UserName <span class="d-block">091234567</span></p>
      </div>
      <p>10,000</p>
      <p>10,000</p>
    </div>
    <div class="winner-card px-3 pt-2 d-flex justify-content-between">
      <p>7.</p>
      <div class="d-flex">
        <img src="{{ asset('user_app/assets/images/team-1.jpg') }}" width="50px" height="50px" style="border-radius: 50%" alt="" />
        <p class="d-block">UserName <span class="d-block">091234567</span></p>
      </div>
      <p>10,000</p>
      <p>10,000</p>
    </div>
    <div class="winner-card px-3 pt-2 d-flex justify-content-between">
      <p>8.</p>
      <div class="d-flex">
        <img src="{{ asset('user_app/assets/images/team-1.jpg') }}" width="50px" height="50px" style="border-radius: 50%" alt="" />
        <p class="d-block">UserName <span class="d-block">091234567</span></p>
      </div>
      <p>10,000</p>
      <p>10,000</p>
    </div>
  </div>
</div>
@endsection