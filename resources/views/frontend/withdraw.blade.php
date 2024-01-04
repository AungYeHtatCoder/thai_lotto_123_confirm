@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<!-- content section start -->
<div style="
          margin-top: 70px;
          margin-bottom: 83px;
          padding-bottom: 10px;
          color: #232323;
        ">
 <div class="text-center p-2" style="
            color: var(--Font-Heading, #232323);
            text-align: center;
            font-family: Noto Sans Myanmar;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            text-transform: capitalize;
          ">
  <p style="font-size: 16px">ငွေထုတ်မည်</p>
  <p style="font-size: 14px">
   ကျေးဇူးပြု၍ အောက်ပါ K Pay အကောင့်မှ ငွေထုတ်ယူပါ။
  </p>
 </div>

 <form class="m-2" style="
            font-size: 14px;
            position: relative;
            color: var(--Text-Body, #abb1cc);
          ">
  <label for="ph-number" class="my-2">
   သင်၏ Kpay ဖုန်းနံပါတ်ထည့်ပါ
  </label>
  <input type="text" class="form-control" placeholder="" style="
              border: 1px solid var(--System-Gray-500, #9e9e9e);
              background: var(--System-White, #fff);
            " />

  <label for="number" class="my-2">Kpay အကောင့်အမည် </label>
  <input type="text" class="form-control" placeholder="" style="
              border: 1px solid var(--System-Gray-500, #9e9e9e);
              background: var(--System-White, #fff);
            " />

  <label for="amount" class="my-2"> ငွေထုတ်ယူမည့် ပမာဏ</label>
  <input type="text" class="form-control" placeholder="" style="
              border: 1px solid var(--System-Gray-500, #9e9e9e);
              background: var(--System-White, #fff);
            " />
 </form>

 <div class="d-flex justify-content-center align-items-center my-3">
  <button class="topup-btns">1000</button>
  <button class="topup-btns">2000</button>
  <button class="topup-btns">3000</button>
 </div>
 <div class="d-flex justify-content-center align-items-center my-3">
  <button class="topup-btns">10000</button>
  <button class="topup-btns">20000</button>
  <button class="topup-btns">50000</button>
 </div>

 <div style="margin: 0 10px">
  <button class="w-100 p-3 my-2 rounded border border-none" style="background: var(--Primary, #12486b); color: #ffe9f8">
   ငွေထုတ်မည်
  </button>
 </div>

 <div class="m-2 p-2" style="
            background: var(
              --Primary-Linear-01,
              linear-gradient(93deg, #55aab0 -9.97%, #12486b 110.58%)
            );
            border-radius: 24px;
            border: 1px solid #bec6f6;
          ">
  <p class="text-center" style="
              color: #fff;
              text-align: center;
              font-family: Noto Sans Myanmar;
              font-size: 12px;
              font-style: normal;
              font-weight: 500;
              line-height: 16px; /* 133.333% */
              text-transform: capitalize;
            ">
   ငွေဖြည့်ရန်အဆင်မပြေမှုတစ်စုံတစ်ရာရှိပါက ဆက်သွယ်ရန်
  </p>
  <div class="d-flex justify-content-center align-items-center" style="gap: 16px">
   <img src="{{ asset('user_app/assets/img//telegram.png') }}" alt="" />
   <img src="{{ asset('user_app/assets/img//viber.png') }}" alt="" />
   <img src="{{ asset('user_app/assets/img//line.png') }}" alt="" />
   <img src="{{ asset('user_app/assets/img//Facebook.png') }}" alt="" />
  </div>
 </div>
</div>
<!-- content section end -->
@include('user_layout.footer')
@endsection