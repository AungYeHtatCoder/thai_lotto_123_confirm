@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="my-4">
 <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
        <p class="text-center bg-success text-white px-3 py-2">တစ်နေ့တာ 2D ထိုး မှတ်တမ်း</p>
        @if(isset($morningDigits['two_digits']) && count($morningDigits['two_digits']) == 0)
        <p class="text-center bg-success text-white px-3 py-2 mt-3">
            ကံစမ်းထားသော ထီဂဏန်းများ မရှိသေးပါ
              <span>
               <a href="{{ route('admin.GetTwoDigit')}}" style="color: #1706da; text-decoration:none">
               <strong>ထီးထိုးရန် နိုပ်ပါ</strong></a>
              </span>
        </p>
         @endif

        {{-- <div class="d-flex justify-content-between text-success">
            <div id="morning" class="text-center w-100 shadow rounded pt-3 border border-1 border-success" style="cursor: pointer;">
                <i class="fas fa-list d-block fa-2x"></i>
                <p style="color: #1706da">မနက်ပိုင်းထီထိုးမှတ်တမ်း</p>
            </div> --}}
            <div id="evening" class="text-center w-100 rounded pt-3" style="cursor: pointer;">
                <i class="fas fa-list d-block fa-2x"></i>
                <p style="color: blueviolet">ညနေပိုင်းထီထိုးမှတ်တမ်း</p>
            </div>
        </div>

        <div class="morning my-4">
             @foreach ($eveningDigits['two_digits'] as $index => $digit)

            <div class="mb-3 d-flex justify-content-around text-white p-2 rounded shadow" style="background: rgb(0,187,189);
            background: linear-gradient(211deg, rgba(0,187,189,1) 0%, rgba(28,147,0,1) 100%);">
                <div>
                    <span class="d-block">Session</span>
                    <span class="d-block">Evening</span>
                </div>
                <div>
                    <span class="d-block">Date</span>
                    <span class="d-block">{{ $digit->pivot->created_at->format('d M Y (l) (h:i a)') }}</span>
                </div>
                <div>
                    <span class="d-block">2D</span>
                    <span class="d-block">{{ $digit->two_digit }}</span>
                </div>
                <div>
                    <span class="d-block">ထိုးကြေး</span>
                    <span class="d-block">{{ $digit->pivot->sub_amount }}</span>
                </div>
                {{-- <div>
                    <span class="d-block">နီုင်/ရှုံး</span>
                    <span class="d-block">နိုင်</span>
                </div> --}}
            </div>
            @endforeach
            <div class="mb-3 d-flex justify-content-around text-white p-2 rounded shadow" style="background: rgb(0,187,189);
            background: linear-gradient(211deg, rgba(0,187,189,1) 0%, rgba(28,147,0,1) 100%);">
            <p class="text-right">Total Amount for Evening: ||&nbsp; &nbsp; စုစုပေါင်းထိုးကြေး
                <strong>{{ $eveningDigits['total_amount'] }} MMK</strong>
            </p>
            </div>
            
        </div>

       
    </div>
</div>
@include('user_layout.footer')


@endsection