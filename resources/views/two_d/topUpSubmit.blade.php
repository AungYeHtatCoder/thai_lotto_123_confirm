@extends('user_layout.app')

<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 navs fixed-top">
  <div class="px-3 py-3">
   <div class="d-flex justify-content-between">
    <span>
     <a class="material-icons text-white" href="{{ url()->previous() }}">arrow_back</a>
    </span>
    <h5 class="mx-auto">
     <a href="{{ url('/')}}" class="text-white">Thai Lotto 123</a>
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
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 pt-4" style="background-color: #b6c5d8; padding-bottom:150px;">
  <p class="text-center mt-3" style="color: #fff">ငွေတင်မည်</p>
  <p class="text-center" style="color: #fff">
   ကျေးဇူးပြု၍ အောက်ပါ K Pay အကောင့်မှ ငွေထုတ်ယူပါ။
  </p>
  <div class="top-up-card d-flex justify-content-between">
   <div class="banks">
    <img src="{{ asset('user_app/assets/images/bank/kpay.png') }}" class="w-100" alt="" />
   </div>
   <p class="mt-4">K Pay</p>
   <hr class="vertical-line" style="border-left: 2px solid #000; height: 10vh" />
   <div class="mt-3 mx-5" style="color: #fff">
    <p>လွှဲငွေပမာဏ</p>
    <p>--------</p>
   </div>
  </div>
  <form action="{{ route('user.StoreKpayFillMoney') }}" method="POST">
    @csrf
  <div class="form-group">
    <p style="color: #ab0000;">ငွေလက်ခံမည့်ဖုန်းနံပါတ်</p>
    {{-- <input type="number" value="" class="form-control" name="" id="inputField"> --}}
    <input type="number" id="kpay_no" name="kpay_no" class="form-control" value="{{ $user->kpay_no }}">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard()">Copy</button>
        </div>
  </div>
  <div class="form-group">
    <p style="color: #ab0000;">သင်၏ Kpay ဖုန်းနံပါတ်ထဲ့ပါ</p>
    <input type="number" value="" class="form-control" name="user_ph_no">
  </div>
  <p class="mt-4" style="color: #fff; font-size: 14px">
   လုပ်ဆောင်မှုအမှတ်စဥ် (နောက်ဆုံးဂဏန်း ၆ လုံး)
  </p>
  <div class="form-group">
   <input type="number" class="form-control" placeholder="ဂဏန်းခြောက်လုံး ဖြည့်ပါ" name="last_six_digit" id="" />
  </div>
  <div class="form-group">
          <p style="color: #fff">ငွေထုတ်ယူမည့် ပမာဏ</p>
          <input type="number" value="" class="form-control" name="amount" id="inputField" />
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
  <div class="form-group mt-4">
   <button type="submit" class="top-up-btn btn">ငွေဖြည့်မည်</button>
  </div>
  </form>
  <p style="color: #fff">
   ငွေဖြည့်ရန်အဆင်မပြေမှုတစ်စုံတစ်ရာရှိပါက ဆက်သွယ်ရန်
  </p>
  <div class="service-card mt-4">
   <p class="mt-3">ငွေဖြည့် / ငွေထုတ်</p>
   <div class="phone-icon">
    <i class="fa-brands fa-telegram px-3"></i>
    <i class="fa-brands fa-viber"></i>
   </div>
  </div>
 </div>
</div>
@include('user_layout.footer')
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    @if(session('SuccessRequest'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('SuccessRequest') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
});

</script>
<script>
  function fillInputBox(element) {
    let value = element.getAttribute('data-value');
    console.log(value);
    let inputField = document.getElementById('inputField');
    inputField.value = value;
  }
</script>
<script>
 

    function copyToClipboard() {
        var copyText = document.getElementById("kpay_no");
        copyText.select();
        document.execCommand("copy");
        alert("Copied: " + copyText.value); // Optional: Display an alert to indicate the value has been copied
    }
</script>
@endsection