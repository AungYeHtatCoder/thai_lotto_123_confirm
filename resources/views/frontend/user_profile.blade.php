@extends('user_layout.app')

@section('css')
<style>
.profile-icon{
    font-size: 100px;
    color: #009382
}
</style>
@endsection

@section('content')
@include('user_layout.nav')

<div class="row" style="min-height: 100vh;">
    <div
      class="col-lg-4 col-md-6 offset-lg-4 offset-md-3 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <div class="text-center py-3">
        @if (Auth::user()->profile)
        <img src="{{ Auth::user()->profile }}" class="me-3 rounded-circle border border-1 border-success" width="90px" alt="">
        @else
        <i class="fas fa-user-circle profile-icon d-block me-3"></i>
        @endif
    </div>

    <div class="d-flex justify-content-between py-3 px-2">
        <div class="d-flex">

            <div>
                <p class="d-block mb-0" style="font-weight: 700;color:#009382">{{ Auth::user()->name }}</p>
                <p class="d-block mt-0 mb-0" style="font-weight: 700;color:#009382">{{ Auth::user()->phone }}</p>
                <div class=" text-success">
                    @if (Auth::user()->address)
                    <i class="fas fa-location-dot me-2"></i>
                    <span>{{ Auth::user()->address }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <p class="mb-0" style="color:#009382; font-weight:700;">လက်ကျန်ငွေ</p>
            <p class="mt-0 mb-0" style="color:#009382; font-weight:700;">{{ Auth::user()->balance }} kyats</p>
            <div class="dropstart my-2">
                <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">အကောင့် ပြင်ဆင်ရန်
                </button>
                <ul class="dropdown-menu border border-none shadow rounded-0" style="background: #e7fff9;">
                  <li><a class="dropdown-item text-success" href="#" onclick="event.preventDefault();" data-bs-target="#updateProfile" data-bs-toggle="modal">ဓာတ်ပုံတင်ရန်</a></li>
                  <li><a class="dropdown-item text-success" href="#" onclick="event.preventDefault();" data-bs-target="#updateInfo" data-bs-toggle="modal">မိမိအချက်အလက်ပြင်ရန်</a></li>
                  <li><a class="dropdown-item text-success" href="#" onclick="event.preventDefault();" data-bs-target="#updatePassword" data-bs-toggle="modal">Password ပြင်ရန်</a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-around">
        <a href="{{ url('/user/fill-balance') }}" type="button" class="btn btn-success" style="text-decoration: none;">ငွေသွင်းမည်</a>
        <a href="{{ url('/user/withdraw-money')}}" type="button" class="btn btn-danger" style="text-decoration: none;">ငွေထုတ်မည်</a>
    </div>
    {{-- <hr> --}}

    <div class="my-4">
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

        <div class="d-flex justify-content-between text-success">
            <div id="morning" class="text-center w-100 shadow rounded pt-3 border border-1 border-success" style="cursor: pointer;">
                <i class="fas fa-list d-block fa-2x"></i>
                <p style="color: #1706da">မနက်ပိုင်းထီထိုးမှတ်တမ်း</p>
            </div>
            <div id="evening" class="text-center w-100 rounded pt-3" style="cursor: pointer;">
                <i class="fas fa-list d-block fa-2x"></i>
                <p style="color: blueviolet">ညနေပိုင်းထီထိုးမှတ်တမ်း</p>
            </div>
        </div>

        <div class="morning my-4">
             @foreach ($morningDigits['two_digits'] as $index => $digit)

            <div class="mb-3 d-flex justify-content-around text-white p-2 rounded shadow" style="background: rgb(0,187,189);
            background: linear-gradient(211deg, rgba(0,187,189,1) 0%, rgba(28,147,0,1) 100%);">
                <div>
                    <span class="d-block">Session</span>
                    <span class="d-block">Morning</span>
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
            <p class="text-right">Total Amount for Morning: ||&nbsp; &nbsp; စုစုပေါင်းထိုးကြေး
                <strong>{{ $morningDigits['total_amount'] }} MMK</strong>
            </p>
            </div>
            {{-- <div class="mb-3 d-flex justify-content-around text-white p-2 rounded shadow" style="background: rgb(0,187,189);
            background: linear-gradient(211deg, rgba(0,187,189,1) 0%, rgba(28,147,0,1) 100%);">
                <div>
                    <span class="d-block">Session</span>
                    <span class="d-block">Morning</span>
                </div>
                <div>
                    <span class="d-block">Date</span>
                    <span class="d-block">10-11-2023 Friday 04:07 PM</span>
                </div>
                <div>
                    <span class="d-block">2D</span>
                    <span class="d-block">12</span>
                </div>
                <div>
                    <span class="d-block">နီုင်/ရှုံး</span>
                    <span class="d-block">နိုင်</span>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-around text-white p-2 rounded shadow" style="background: rgb(0,187,189);
            background: linear-gradient(211deg, rgba(0,187,189,1) 0%, rgba(28,147,0,1) 100%);">
                <div>
                    <span class="d-block">Session</span>
                    <span class="d-block">Morning</span>
                </div>
                <div>
                    <span class="d-block">Date</span>
                    <span class="d-block">10-11-2023 Friday 04:07 PM</span>
                </div>
                <div>
                    <span class="d-block">2D</span>
                    <span class="d-block">12</span>
                </div>
                <div>
                    <span class="d-block">နီုင်/ရှုံး</span>
                    <span class="d-block">နိုင်</span>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-around text-white p-2 rounded shadow" style="background: rgb(0,187,189);
            background: linear-gradient(211deg, rgba(0,187,189,1) 0%, rgba(28,147,0,1) 100%);">
                <div>
                    <span class="d-block">Session</span>
                    <span class="d-block">Morning</span>
                </div>
                <div>
                    <span class="d-block">Date</span>
                    <span class="d-block">10-11-2023 Friday 04:07 PM</span>
                </div>
                <div>
                    <span class="d-block">2D</span>
                    <span class="d-block">12</span>
                </div>
                <div>
                    <span class="d-block">နီုင်/ရှုံး</span>
                    <span class="d-block">နိုင်</span>
                </div>
            </div> --}}
        </div>

        <div class="evening d-none my-4">
             @if(isset($eveningDigits['two_digits']) && count($eveningDigits['two_digits']) == 0)
        <p class="text-center bg-success text-white px-3 py-2 mt-3">
            ညနေပိုင်း ကံစမ်းထားသော ထီဂဏန်းများ မရှိသေးပါ
              <span>
               <a href="{{ route('admin.GetTwoDigit')}}" style="color: #1706da; text-decoration:none">
               <strong>ထီးထိုးရန် နိုပ်ပါ</strong></a>
              </span>
        </p>
         @endif
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
            </div>
            @endforeach
            <div class="mb-3 d-flex justify-content-around text-white p-2 rounded shadow" style="background: rgb(0,187,189);
            background: linear-gradient(211deg, rgba(0,187,189,1) 0%, rgba(28,147,0,1) 100%);">
            <p class="text-right">Total Amount for Evening : ||&nbsp; &nbsp; စုစုပေါင်းထိုးကြေး
                <strong>{{ $eveningDigits['total_amount'] }} MMK</strong>
            </p>
            </div>
            {{-- <div class="mb-3 d-flex justify-content-around text-white p-2 rounded shadow" style="background: rgb(0,187,189);
            background: linear-gradient(211deg, rgba(0,187,189,1) 0%, rgba(28,147,0,1) 100%);">
                <div>
                    <span class="d-block">Session</span>
                    <span class="d-block">Evening</span>
                </div>
                <div>
                    <span class="d-block">Date</span>
                    <span class="d-block">10-11-2023 Friday 04:07 PM</span>
                </div>
                <div>
                    <span class="d-block">2D</span>
                    <span class="d-block">12</span>
                </div>
                <div>
                    <span class="d-block">နီုင်/ရှုံး</span>
                    <span class="d-block">နိုင်</span>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-around text-white p-2 rounded shadow" style="background: rgb(0,187,189);
            background: linear-gradient(211deg, rgba(0,187,189,1) 0%, rgba(28,147,0,1) 100%);">
                <div>
                    <span class="d-block">Session</span>
                    <span class="d-block">Evening</span>
                </div>
                <div>
                    <span class="d-block">Date</span>
                    <span class="d-block">10-11-2023 Friday 04:07 PM</span>
                </div>
                <div>
                    <span class="d-block">2D</span>
                    <span class="d-block">12</span>
                </div>
                <div>
                    <span class="d-block">နီုင်/ရှုံး</span>
                    <span class="d-block">နိုင်</span>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-around text-white p-2 rounded shadow" style="background: rgb(0,187,189);
            background: linear-gradient(211deg, rgba(0,187,189,1) 0%, rgba(28,147,0,1) 100%);">
                <div>
                    <span class="d-block">Session</span>
                    <span class="d-block">Evening</span>
                </div>
                <div>
                    <span class="d-block">Date</span>
                    <span class="d-block">10-11-2023 Friday 04:07 PM</span>
                </div>
                <div>
                    <span class="d-block">2D</span>
                    <span class="d-block">12</span>
                </div>
                <div>
                    <span class="d-block">နီုင်/ရှုံး</span>
                    <span class="d-block">နိုင်</span>
                </div>
            </div> --}}
        </div>

    </div>



        {{-- <div class="d-flex justify-content-center align-items-center">

            <form id="uploadForm" enctype="multipart/form-data">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">
                        <span class="material-icons text-white" style="font-size: 100px;">
                            account_circle
                            </span>
                        </label>
                        <input type="file" class="form-control visually-hidden" id="fileInput" name="fileInput" accept="image/*">

                        <div style="font-weight: 700;">
                            <p>လက်ကျန်ငွေ</p>
                            <p>0.00 kyats</p>
                        </div>
                    </div>

                    <div>
                        <a href="#" type="button" class="d-block btn btn-outline-success px-3 mb-3" style="text-decoration: none;">ငွေသွင်းမည်</a>
                        <a href="#" type="button" class="d-block btn btn-outline-danger px-3 mt-3" style="text-decoration: none;">ငွေထုတ်မည်</a>
                    </div>


                </div>

                <div class="">
                    <input type="text" name="user_name" class="form-control mb-3" value="Queen" />
                    <input type="text" name="user_password" class="form-control mb-3" value="+959 ******213" />
                    <textarea name="user_address"  cols="40" rows="5">Mandalay</textarea>
                </div>

                <div class="mt-5">
                    <a href="{{ url('/user-dashboard/changePassword') }}" type="button" class="btn btn-outline-light px-3" style="text-decoration: none;">Change Password</a>
                    <a href="#" type="button" class="btn btn-outline-success px-3" style="text-decoration: none;">Update Profile</a>
                </div>

                <!-- <button type="submit" class="btn btn-primary">Upload</button> -->
            </form>

        </div> --}}
</div>

{{-- profile update --}}
<div class="modal" tabindex="-1" id="updateProfile">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-user me-2"></i>ဓာတ်ပုံတင်ရန်</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.profiles.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <input type="file" class="form-control" name="profile">
          {{-- <p>Modal body text goes here.</p> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Update</button>
        </form>
        </div>
      </div>
    </div>
</div>
{{-- profile info update --}}
<div class="modal" tabindex="-1" id="updateInfo">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>အချက်အလက်များပြင်ရန်</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.changePhoneAddress', Auth::user()->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter Name" value="{{ Auth::user()->name }}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone" value="{{ Auth::user()->phone }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" class="form-control" name="address" placeholder="Enter Address" value="{{ Auth::user()->address }}">
                </div>

          {{-- <p>Modal body text goes here.</p> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Update</button>
        </form>
        </div>
      </div>
    </div>
</div>
{{-- change password --}}
<div class="modal" tabindex="-1" id="updatePassword">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-key me-2"></i>Password ပြင်ရန်</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.changePassword', Auth::user()->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="old_password" class="form-label">Old Password</label>
                    <input type="password" id="old_password" class="form-control" name="old_password" placeholder="Enter Old Password" value="">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter New Password" value="">
                </div>
          {{-- <p>Modal body text goes here.</p> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Update</button>
        </form>
        </div>
      </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#morning').click(function() {
     $('#morning').addClass('shadow');
     $('#morning').addClass('border');
     $('#morning').addClass('border-1');
     $('#morning').addClass('border-success');
     $('#evening').removeClass('shadow');
     $('#evening').removeClass('border');
     $('#evening').removeClass('border-1');
     $('#evening').removeClass('border-success');

     $('.morning').removeClass('d-none');
     $('.evening').addClass('d-none');
    });
    $('#evening').click(function() {
     $('#morning').removeClass('shadow');
     $('#morning').removeClass('border');
     $('#morning').removeClass('border-1');
     $('#morning').removeClass('border-success');
     $('#evening').addClass('shadow');
     $('#evening').addClass('border');
     $('#evening').addClass('border-1');
     $('#evening').addClass('border-success');

     $('.morning').addClass('d-none');
     $('.evening').removeClass('d-none');
    });
</script>
@endsection
