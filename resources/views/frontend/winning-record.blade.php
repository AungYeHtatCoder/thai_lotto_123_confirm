@extends('user_layout.app')

@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #b6c5d8;"
    >
        <div class="my-2">
            <p style="font-size: 20px; color:#2a576c">တစ်လအတွင်း 2D ကံထူးရှင်များ</p>
        </div>
    
        <div class="d-flex justify-content-between p-3">

            <p>Updated at: <br><span class="font-weight-bold">
                
            <script>
                var d = new Date();
                document.write(d.toLocaleString());
            </script>
            </span></p>
            <div>

            <span class="font-weight-bold" style="font-size: 30px;color: #ab0000;">2
                ကံထူးရှင်များ
            </span>
            </div>
        </div>
        
        <div class=" mt-3" style="padding-bottom: 200px">
            <table class="winner-table table table-striped" width="100%">
              <tbody>
                <tr>
                  <td><i class="fa-regular fa-circle-user" style="font-size: 50px;"></i></td>
                  <td><span style="font-size: 10px">Super User</span> <p style="font-size: 10px">N/A</p></td>
                  <td><span>Session</span> <p>Evening</p></td>
                  <td><span>Win-No</span> <p>12</p></td>
                  <td><span>ထိုးငွေ</span> <p>2500</p></td>
                  <td><span>ထီပေါက်ငွေ</span> <p>212500</p></td>
                </tr>
                <tr>
                  <td><i class="fa-regular fa-circle-user" style="font-size: 50px;"></i></td>
                  <td><span style="font-size: 10px">Super User</span> <p style="font-size: 10px">N/A</p></td>
                  <td><span>Session</span> <p>Evening</p></td>
                  <td><span>Win-No</span> <p>12</p></td>
                  <td><span>ထိုးငွေ</span> <p>2500</p></td>
                  <td><span>ထီပေါက်ငွေ</span> <p>212500</p></td>
                </tr>
                <tr>
                    <td><i class="fa-regular fa-circle-user" style="font-size: 50px;"></i></td>
                    <td><span style="font-size: 10px">Super User</span> <p style="font-size: 10px">N/A</p></td>
                    <td><span>Session</span> <p>Evening</p></td>
                    <td><span>Win-No</span> <p>12</p></td>
                    <td><span>ထိုးငွေ</span> <p>2500</p></td>
                    <td><span>ထီပေါက်ငွေ</span> <p>212500</p></td>
                  </tr>
              </tbody>
            </table>
          </div>

    </div>

</div>
@include('user_layout.footer')
<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
   <div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">ထိုးမည့်အချိန် (section) ကိုရွေးပါ</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body">
    <div class="modal-btn">
     <a href="{{ url('/twodplay') }}" class="text-decoration-none btn">12:00 AM</a>
    </div>
    <div class="modal-btn mt-2">
     <a href="#" class="text-decoration-none btn">04:00 PM</a>
    </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn modal-button">ထိုးမည်</button>
   </div>
  </div>
 </div>
</div>
{{-- @include('user_layout.footer') --}}
@endsection