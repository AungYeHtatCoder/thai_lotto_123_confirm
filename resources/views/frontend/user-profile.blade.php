@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<!-- content section start -->
<div style="margin-top: 30px;height: 100vh;">
 <form id="uploadForm" enctype="multipart/form-data ">
  <div class="d-flex justify-content-around align-items-center">
   <div class="mt-5 me-0">
    @if(Auth::user()->profile)
    <img src="{{  Auth::user()->profile }}" alt="">
    @else
    <img src="{{ asset('user_app/assets/img/profile-img.png') }}" alt="">
    @endif
    <label for="fileInput" class="form-label" style="position: relative;">
     <div class="bg-primary rounded-circle p-2" style="position: absolute;bottom: -70px;right: 0;">
      <img src="{{ asset('user_app/assets/img/pencil.png') }}" alt="">
     </div>
    </label>
    <input type="file" class="form-control visually-hidden" id="fileInput" name="fileInput" accept="image/*">

   </div>

  </div>

  <div class="d-flex justify-content-center align-items-center my-2">
   <input type="text" value="{{ Auth::user()->name }}" class="w-75 rounded border border-none p-2" style="font-size: 14px;line-height: 20px;outline: none;color: #757575;" />
  </div>

  <div class="d-flex justify-content-center align-items-center my-2">
   <input type="text" value="{{ Auth::user()->phone }}" class="w-75 rounded border border-none p-2" style="font-size: 14px;line-height: 20px;outline: none;color: #C0C0C0;" />
  </div>

  <div class="d-flex justify-content-center align-items-center mt-5">
   <button type="button" class="w-75 mx-2 mt-5 py-2 rounded text-white border border-none" style="background: var(--linear);font-size: 18px;">အတည်ပြုပါ</button>
  </div>
 </form>

</div>
<!-- content section end -->

@include('user_layout.footer')
@endsection