@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row" style="min-height: 100vh;">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <img src="{{ asset('user_app/assets/images/login.jpg') }}" class="w-100 my-2" alt="">
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="w-75 ps-3 my-3 mx-auto py-2">
            <input type="text" name="name" class="form-control"  placeholder="အမည်ထည့်ပါ" />
            @error('name')
            <span class="text-danger d-block">
                *{{ $message }}
            </span>
            @enderror
        </div>
        <div class="w-75 ps-3 my-3 mx-auto py-2">
            <input type="email" name="email" class="form-control" placeholder="အီးမေးလ် ဖြည့်ပါ" />
            @error('email')
            <span class="text-danger d-block">
                *{{ $message }}
            </span>
            @enderror
        </div>
        <div class="w-75 ps-3 my-3 mx-auto py-2">
            <input type="password" name="password" class="form-control" placeholder="လျှို့ဝှက်နံပါတ်ဖြည့်ပါ" />
            @error('password')
            <span class="text-danger d-block">
                *{{ $message }}
            </span>
            @enderror
        </div>
        <div class="w-75 ps-3 my-3 mx-auto py-2">
            <input type="password" name="password_confirmation" class="form-control" placeholder="နောက်တစ်ခါ လျှို့ဝှက်နံပါတ်ဖြည့်ပါ"/>
            @error('password_confirmation')
            <span class="text-danger d-block">
                *{{ $message }}
            </span>
            @enderror
        </div>





        <div class="d-flex justify-content-center align-items-center">
            <button type="submit" name="signin_btn" class="btn btn-outline-success w-75 mx-auto mt-4 py-2">၀င်မည်</button>
        </div>
    </form>
</div>
{{-- @include('user_layout.footer') --}}


@endsection
