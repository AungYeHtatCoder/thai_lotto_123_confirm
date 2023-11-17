@extends('user_layout.app')

<div class="row">
  <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 navs fixed-top">
    <div class="px-3 py-3">
      <div class="d-flex justify-content-between">
        <span>
          <a class="material-icons text-white" href="{{ url('/wallet') }}">arrow_back</a>
        </span>
        <h5 class="mx-auto">
          <a href="../index.html" class="text-white">Diamond 2D | 3D</a>
        </h5>
        <span>
          <a class="material-icons text-white" href="../index.html">refresh</a>
        </span>
      </div>
    </div>
  </div>
</div>


@section('content')
<div class="row">
  <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8; height: 100vh">
    <h6 class="text-center mt-2 pb-2" style="color: #fff">ငွေဖြည့်မည်</h6>

    <p style="color: #fff">မိမိ ငွေဖြည့်မည့်ဘဏ်တစ်ခုရွေးပါ</p>
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
      <p style="color: #fff">လက်ကျန်ငွေ: 0 ကျပ်</p>
    </div>
    <hr class="my-custom-line" />

    <div class="row">
      <div class="container" id="top-up-form" style="display: none">
        <div class="form-group">
          <p style="color: #fff">ငွေဖြည့်ပမာဏ</p>
          <input type="number" value="" class="form-control" name="" id="inputField" />
        </div>
        <div class="d-flex justify-content-between m-3">
          <div class="fill-box" data-value="1000" onclick="fillInputBox(this)">
            <p>1,000</p>
          </div>
          <div class="fill-box" data-value="5000" onclick="fillInputBox(this)">
            5,000
          </div>
          <div class="fill-box" data-value="10000" onclick="fillInputBox(this)">
            10,000
          </div>
        </div>
        <div class="d-flex justify-content-between m-3">
          <div class="fill-box" data-value="100000" onclick="fillInputBox(this)">
            100,000
          </div>
          <div class="fill-box" data-value="200000" onclick="fillInputBox(this)">
            200,000
          </div>
          <div class="fill-box" data-value="500000" onclick="fillInputBox(this)">
            500,000
          </div>
        </div>
        <div class="form-group">
          <a href="{{ url('/topUpSubmit') }}" class="btn top-up-btn">ဆက်လုပ်ရန်</a>
        </div>
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