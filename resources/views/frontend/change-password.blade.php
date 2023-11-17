@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <div style="padding-bottom:100px">
        <h6
          class="text-center p-3"
          style="color: #265166; font-weight: bolder"
        >
          လျှို့ဝှက်နံပါတ်ပြောင်းမည်
        </h6>
        <div class="container my-3">
          <form
            action="#"
            method="post"
          >
            <input
              type="hidden"
              name="_token"
              value="c0JqurocMEvXXknPpB9sJ6UirfJoyKvZo0GsU98i"
              autocomplete="off"
            />
            <input type="hidden" name="_method" value="PUT" />
            <div class="form-group">
              <input
                type="password"
                class="form-control"
                placeholder="လျှို့ဝှက်နံပါတ်အဟောင်း"
                name="current_password"
                id="current_password"
              />
            </div>
            <p
              class="text-center mt-1"
              style="font-size: 13px; color: #265166"
            >
              ကျေးဇူးပြု၍လျှို့ဝှက်နံပါတ်အသစ်ကိုနှစ်ကြိမ်ရိုက်ထည့်ပါ။
            </p>
            <p
              class="text-center mt-1 text-success"
              style="font-size: 13px"
            >
              မှတ်ချက် - လျှို့ဝှက်နံပါတ် နှစ်ခုတူညီရပါမည်
            </p>
            <div class="form-group">
              <input
                type="password"
                class="form-control"
                placeholder="လျှို့ဝှက်နံပါတ်အသစ်"
                name="new_password"
                id="new_password"
              />
            </div>
            <div class="form-group mt-4">
              <input
                type="password"
                class="form-control"
                placeholder="အတည်လျှို့ဝှက်နံပါတ်"
                name="new_password_confirmation"
                id="new_password_confirmation"
              />
            </div>
            <a href=""
              ><p
                class="text-danger"
                style="
                  font-size: 14px;
                  text-align: right;
                  text-decoration: none;
                "
              >
                လျှို့ဝှက်နံပါတ်မေ့နေပါသလား?
              </p></a
            >
            <div class="form-group my-2">
              <button type="submit" class="pw-btn btn text-white">
                ပြောင်းမည်
              </button>
            </div>
          </form>
          <div class="row m-2">
            <div
              class="col-lg-12 mx-auto font-weight-bold"
              style="color: #ab0000"
            >
              <p>လျှို့ဝှက်နံပါတ်</p>
              <p>1. အကောင့်ဝင်ရန် အသုံးပြုရမည်<br /></p>
              <p>2. ငွေထုတ်ယူရန် အသုံးပြုရမည်</p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mx-auto">
              <p class="text-danger font-weight-bold">
                အကောင့်လုံခြုံမှုရှိစေရန် သင်၏ လျှို့ဝှက်နံပါတ် ကို
                မည်သူ့ကိုမျှမပြောပါနှင့်။
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@include('user_layout.footer')


@endsection