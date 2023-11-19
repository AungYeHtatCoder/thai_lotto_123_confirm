@extends('user_layout.app')

<div class="row">
  <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 navs fixed-top">
    <div class="px-3 py-3">
      <div class="d-flex justify-content-between">
        <span>
          <a class="material-icons text-white" href="{{ url('/user/wallet-deposite') }}">arrow_back</a>
        </span>
        <h5 class="mx-auto">
          <a href="{{ url('/') }}" class="text-white">Thai Lotto 123</a>
        </h5>
        <span>
          <a class="material-icons text-white" href="{{ url('/')}}">refresh</a>
        </span>
      </div>
    </div>
  </div>
</div>


@section('content')
<div class="row">
  <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8; height: 100vh">
    <h6 class="text-center mt-2 pb-2" style="color: #fff">ငွေထုတ်မည်</h6>

    <p style="color: #fff">မိမိ ငွေထုတ်ယူမည့်ဘဏ်တစ်ခုရွေးပါ</p>
    <div class="top-up-card">
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

    <div class="text-center mt-3">
      <p style="color: #fff">လက်ကျန်ငွေ: {{ Auth::user()->balance }} ကျပ်</p>
    </div>
    <hr class="my-custom-line" />

    <div class="row">
      <div class="container" id="top-up-form" style="display: none">
       <form action="">
        
        <div class="form-group mt-2">
          <a href="{{ url('/user/k-pay-withdraw-money') }}" class="btn top-up-btn">Kpay - ဆက်လုပ်ရန်</a>
        </div>
        <div class="form-group mt-2">
          <a href="{{ url('/user/cb-pay-withdraw-money') }}" class="btn top-up-btn">CBpay - ဆက်လုပ်ရန်</a>
        </div>
        <div class="form-group mt-2">
          <a href="{{ url('/user/wave-pay-withdraw-money') }}" class="btn top-up-btn">Wave pay - ဆက်လုပ်ရန်</a>
        </div>
        <div class="form-group mt-2">
          <a href="{{ url('/user/aya-pay-withdraw-money') }}" class="btn top-up-btn">AYA pay - ဆက်လုပ်ရန်</a>
        </div>
        </form>
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
    let form = document.getElementById('top-up-form');
    form.style.display = 'block';
  }
</script>
<script>
  function fillInputBox(element) {
    let value = element.getAttribute('data-value');
    console.log(value);
    let inputField = document.getElementById('inputField');
    inputField.value = value;
  }
</script>
@endsection
@endsection