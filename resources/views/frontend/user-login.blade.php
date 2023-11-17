@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row" style="min-height: 100vh;">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <img src="{{ asset('user_app/assets/images/login.jpg') }}" class="w-100 my-2" alt="">
    <form action="" >
        <input type="text" name="signin_phone" class="form-control w-75 ps-3 my-3 mx-auto py-2" placeholder="ဖုန်းနံပတ်ဖြည့်ပါ" />
        <input type="password" name="signin_password" class="form-control w-75 ps-3 my-3 mx-auto py-2" placeholder="လျှို့ဝှက်နံပါတ်ဖြည့်ပါ" />

        <div class="d-flex justify-content-end align-items-center me-5">
            <small><a href="#" style="text-decoration: none;">လျှို့ဝှက်နံပါတ် မေ့နေပါသလား။</a></small>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <button type="button" name="signin_btn" class="btn btn-outline-primary w-75 mx-auto mt-4 ">၀င်မည်</button>
        </div>
        

        <hr/>

        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ url('/user-register') }}" type="button" name="signin_btn" class="btn btn-outline-success w-75 mx-auto mt-4 " style="text-decoration: none;">အကောင့် အသစ်ဖွင့်မည်</a>
        </div>
    </form>
</div>
{{-- @include('user_layout.footer') --}}


@endsection