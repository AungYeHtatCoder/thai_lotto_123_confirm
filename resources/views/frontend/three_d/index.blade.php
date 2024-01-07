@extends('user_layout.app')

@section('content')
@include('user_layout.nav')

<div class="d-flex justify-content-around align-items-center mx-auto" style="
          background-color: var(--default);
          width: 358px;
          height: 59px;
          border-radius: 24px;
          border: 2px solid var(--gold, #576265);
          background: #12486b;
          padding: 12px 16px;
          margin-top: 80px;
        ">
 <img src="{{ asset('user_app/assets/img/vector.png') }}" width="24px" height="24px" alt="" />
 <p class="pt-3" style="font-size: 16px; font-weight: 500">ပိုက်ဆံအိတ် </p>
 <p class="pt-3" style="
            font-size: 16px;
            font-weight: 700;
            font-family: 'Lato', sans-serif;
          ">
  {{ Auth::user()->balance }} Kyats
 </p>

 <img src="{{ asset('user_app/assets/img/plus.png') }}" class="rounded-circle" style="padding: 10px; color: var(--blue); background-color: #fff" alt="" />
</div>


<div class="">
 <div class="time-section mt-3 mx-2">
  <div>
   <img src="../assets/img/query_builder.png" alt="" />
   <span class="time-text"> 2023-11-16 </span>
  </div>
  <div>
   <span class="time-text">ပိတ်ချိန် 02:30:00 PM</span>
  </div>
 </div>

 <div class="dream-section">
  <img src="../assets/img/Border light.png" alt="" />
 </div>

 <div class="text-dark mx-auto mb-3" style="
            display: flex;
            width: 358px;
            height: 51px;
            justify-content: center;
            align-items: center;
            border-radius: 26.471px;
            background: #78d6c6;
            box-shadow: 0px 0px 21.176px 0px rgba(240, 252, 172, 0.9);
            border-radius: 25px;
            position: relative;
          ">
  <span>အိမ်မက်ဂဏန်း</span>
  <img src="{{ asset('user_app/assets/img/2D/image 4.png') }}" style="position: absolute; bottom: 0; right: 10px" alt="" />
 </div>

 <div class="btn-section">
  <a href="{{ url('/threed-quick') }}" class="text-decoration-none">
   <div class="threed-quick">အမြန်ရွေးရန်</div>
  </a>
  <a href="{{ url('/threed-under') }}" class="text-decoration-none">
   <div class="threed-quick">အောက်၂လုံးထိုးရန်</div>
  </a>
 </div>

 <div class="my-3 mx-2">
  <span style="
              color: var(--Font-Body, #5a5a5a);
              text-align: center;
              font-family: Noto Sans Myanmar;
              font-size: 14px;
              font-style: normal;
              font-weight: 400;
            ">ထိုးဂဏန်းရွေးမည်
  </span>
  <div class="play-section">
   <div>
    <input type="text" class="form-control" id="digit" style="
                  border: 1px solid var(--System-Gray-500, #9e9e9e);
                  background: var(--System-White, #fff);
                " />
   </div>
   <div>
    <input type="text" class="form-control" placeholder=" ‌ဒဲ့ဂဏန်း ငွေပမာဏ  " style="
                  border: 1px solid var(--System-Gray-500, #9e9e9e);
                  background: var(--System-White, #fff);
                " />
   </div>
  </div>
  <div class="play-section my-3">
   <div>
    <button class="btn" style="
                  display: flex;
                  width: 171px;
                  height: 45px;
                  padding: 10px;
                  justify-content: center;
                  align-items: center;
                  gap: 10px;
                  color: var(--Font-Heading, #232323);
                  border-radius: 10px;
                  background: #bbb;
                ">
     ပတ်လည်ထိုးမည်
    </button>
   </div>
   <div>
    <input type="text" class="form-control" placeholder=" ‌ပတ်လည်ငွေပမာဏ   " style="
                  border: 1px solid var(--System-Gray-500, #9e9e9e);
                  background: var(--System-White, #fff);
                " />
   </div>
  </div>
  <div style="
              display: flex;
              flex-direction: column;
              align-items: flex-end;
              gap: 10px;
              align-self: stretch;
            ">
   <button class="btn threed-choose" onclick="chooseNumber()">
    ရွေးမည်
   </button>
  </div>

  <div>
   <p style="
                color: var(--Font-Body, #5a5a5a);
                font-size: 14px;
                font-weight: 400;
              ">
    ရွေးချယ်ထားသောဂဏန်းများ
   </p>
   <div class="rounded mx-2" style="
                min-height: 150px;
                border-radius: 8px;
                border: 1px solid var(--System-Gray-500, #9e9e9e);
              ">
    <div class="d-flex align-items-center p-2" id="output" style="gap: 10px"></div>
   </div>
  </div>
 </div>
</div>

<!-- footer section start  -->
<footer class="fixed-bottom bg-white py-3 mx-auto">
 <div class="row">
  <div class="col">
   <a href="" onclick="removeNumber()" style="
                display: flex;
                padding: 10px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex: 1 0 0;
                border-radius: 10px;
                border: 1px solid #fe0000;
                color: #fe0000;
              ">ဖျက်မည်</a>
  </div>
  <div class="col">
   <a href="{{ url('/threed-confirm') }}" style="
                display: flex;
                padding: 10px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex: 1 0 0;
                border-radius: 10px;
                background: var(--Primary, #12486b);
              ">ထိုးမည်</a>
  </div>
 </div>
</footer>
<!-- footer section end -->

@endsection

@section('script')
<script>
 function chooseNumber() {
  const digit = document.getElementById('digit');
  const output = document.getElementById('output');
  const digitValue = digit.value;
  const result = document.createElement('div');
  result.classList.add('output');
  result.textContent = `${digitValue}`;
  output.appendChild(result);
  digit.value = '';
 }

 function removeNumber() {
  const output = document.getElementById('output');
  while (output.firstChild) {
   output.removeChild(output.firstChild);
  }
 }
</script>
@endsection