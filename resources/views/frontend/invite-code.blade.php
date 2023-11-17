@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <div style="height: 100vh;">
      <div>

          <div class="text-center m-3"><img src="{{ asset('user_app/assets/images/friends.svg') }}" width="200px" height="150px" alt="">
              <p class="mx-5">သင်၏မိတ်ဆက်ကုဒ်</p>

          </div>
          <p class="p-2">သင့်အား App ကိုမိတ်ဆက်ပေးသောသူ၏ မိတ်ဆက်ကုဒ်ကို ဖြည့်ပါ။(သင်၏မိတ်ဆက်ကုဒ်ကို ဖြည့်ရန်မဟုတ်ပါ)</p>
      </div>
      <div class="">
          <div class="">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="မိတ်ဆက်ကုဒ်" name="" id="">
                  <p class="text-danger font-weight-bold mt-2" style="font-size: 14px;">မိတ်ဆက်ကုဒ် လိုအပ်ပါသည်</p>
              </div>
              <div class="form-group mt-3">
                  <a href="" class="pw-btn btn text-white">ဆက်လုပ်ရန်</a>
              </div>
          </div>
      </div>
    </div>
</div>
</div>
@include('user_layout.footer')


@endsection