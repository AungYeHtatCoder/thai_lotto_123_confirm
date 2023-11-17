@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <div class="d-flex justify-content-between">
        <div class="card py-4 w-100 text-center text-green shadow" id="twod">
            <i class="fas fa-calendar fa-2x mb-3 d-block" aria-hidden="true"></i>
            <span class="" style="font-size: 25px">2D ထီပေါက်စဉ်</span>
        </div>
        <div class="card py-4 w-100 text-center text-green" id="threed">
            <i class="fas fa-calendar fa-2x mb-3 d-block" aria-hidden="true"></i>
            <span class="d-block">
                <a href="https://thailotto123.net/admin/get-two-d" style="color: #1706da; text-decoration:none">
                <strong>ထီးထိုးရန် နိုပ်ပါ</strong></a>
            </span>
        </div>
    </div>

    <div class="twod" style="padding-bottom: 300px">
        <div class="card border border-1 p-3 my-3 text-center morning-card">
            <div>
                <p class="text-center text-green">12:01 PM</p>
                <div class="d-flex justify-content-around">
                    <div>
                        
                        <p>No MorningPrizeNo History</p>
                    </div>
                    
                </div>
                <hr>
            </div>
            
            

        </div>
        
    </div>

    </div>

</div>
@include('user_layout.footer')


@endsection