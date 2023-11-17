@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
    <p class="text-center mt-3">မှတ်တမ်း</p>
    <div class="d-flex justify-content-between">
        <div class="card py-4 w-100 text-center bg-light shadow" id="twod">
            <i class="fas fa-calendar fa-2x mb-3 d-block" aria-hidden="true" style="color: #2a576c;"></i>
            <span class="" style="font-size: 25px; ">2D ထီပေါက်စဉ်</span>
        </div>
        <div class="py-4 w-100 text-center bg-light text-green shadow" id="threed" style="border-radius: 5px">
            <i class="fas fa-calendar fa-2x mb-3 d-block" aria-hidden="true" style="color: #2a576c;"></i>
            <span class="">
                <a href="#" style="text-decoration:none" class="p-0">
                <strong style="font-size: 18px; color: #2a576c;">ထီးထိုးရန် နိုပ်ပါ</strong></a>
            </span>
        </div>
    </div>

    <div class="twod" style="padding-bottom: 300px">
        <div class="card border border-1 p-3 my-3 text-center">
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