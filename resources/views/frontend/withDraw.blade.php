@extends('user_layout.app')

@include('user_layout.sub_nav')

@section('content')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8; height: 100vh">
  <h6 class="text-center fw-bold p-3" style="color: #fff">
   ငွေထုတ်မည်
  </h6>
  <div class="col">
   <p style="color: #fff">ငွေထုတ်မည့်ဘဏ်အကောင့်သတ်မှတ်ပါ</p>
   <div class="d-flex justify-content-between">
    <div class="banks blur-image">
     <img src="{{ asset('user_app/assets/images/bank/kpay.png') }}" onclick="showForm()" class="w-100" alt="" />
    </div>
    <div class="banks blur-image">
     <img src="{{ asset('user_app/assets/images/bank/wpay.png') }}" onclick="showForm()" class="w-100" alt="" />
    </div>
    <div class="banks blur-image">
     <img src="{{ asset('user_app/assets/images/bank/cbpay.png') }}" onclick="showForm()" class="w-100" alt="" />
    </div>
    <div class="banks blur-image">
     <img src="{{ asset('user_app/assets/images/bank/aya_logo.png') }}" onclick="showForm()" class="w-100" alt="" />
    </div>
   </div>
  </div>
  <!-- <div class="row mt-3"> -->
  <div class="mt-2" id="withdraw-form" style="display: none">
   <div class="form-group p-2 ms-3">
    <label for="" class="form-label" style="color: #fff">သင့် KBZ Pay အကောင့်</label>
    <input type="text" class="form-control w-100" name="" id="" placeholder="ငွေလက်ခံမည့် သင့်KBZ Pay အကောင့်သတ်မှတ်ပါ" />
   </div>
   <div class="form-group p-2 ms-3">
    <label for="" class="form-label" style="color: #fff">ငွေလက်ခံမည့် KBZ Pay ကိုအတည်ပြုရန်</label>
    <input type="text" class="form-control w-100" name="" id="" placeholder="ငွေလက်ခံမည့် သင့်KBZ Pay အကောင့်သတ်မှတ်ပါ" />
   </div>
   <div class="p-3 ms-3">
    <button type="button" class="top-up-btn">အတည်ပြုသည်</button>
   </div>
  </div>
 </div>
</div>
@include('user_layout.footer')

@section('script')
<script>
 function showForm() {
  const blurImages = document.querySelectorAll('.blur-image');

  blurImages.forEach((image) => {
   image.addEventListener('click', function() {
    // Remove the 'active' class from all images
    blurImages.forEach((otherImage) => {
     otherImage.classList.remove('active');
    });

    // Add the 'active' class to the clicked image
    this.classList.add('active');
   });
  });
  let form = document.getElementById('withdraw-form');
  form.style.display = 'block';
 }
</script>
@endsection
@endsection