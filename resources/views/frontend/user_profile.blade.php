@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row" style="min-height: 100vh;">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >   
        <div class="d-flex justify-content-center align-items-center">
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
            
        </div>
</div>



@endsection