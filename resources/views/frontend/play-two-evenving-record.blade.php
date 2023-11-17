@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <div style="height: 100vh;">
        <h6 class="mx-auto py-4 text-center" style="color:  #265166; font-weight: bold; font-size: 18px;">ထီထိုးမှတ်တမ်း</h6>
        <div class="card py-4 w-100 text-center shadow">
            <i class="fas fa-calendar fa-2x mb-3 d-block" style="color: #265166;" aria-hidden="true"></i>
            <span class="d-block" style="font-size: 20px;">2D Evening</span>
        </div>
        <div class="card border border-1 p-3 my-3 text-center">
            <p class="text-center">ကံစမ်းထားသော ထီဂဏန်းများ မရှိသေးပါ
                <span>
                    <a href="2d.html" style="color: #1706da; text-decoration:none;font-size: 22px;">
                    <strong>ထီးထိုးရန် နိုပ်ပါ</strong></a>
                </span>
            </p>
            <div>
                <p class="text-right">Total Amount for Evening:
                    <strong>0</strong>
                </p>
            </div>

        </div>
    </div>

    </div>

</div>
@include('user_layout.footer')


@endsection