@extends('user_layout.app')
@section('style')
<style>
 .table tr th,
 .table td {
  color: #fff;
  background-color: #265166;
  padding: 16px;

 }

 .custom-tables>.table tr>td,
 .table tr>td>a {
  color: white;
 }
</style>
@endsection
@section('content')
@include('user_layout.nav')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 pt-2" style="background-color: #b6c5d8; height: 120vh; padding-bottom: 1000px">
  <p class="text-center fs-4 fw-bold mt-3 text-white">2D Calendar</p>
  <div>
   <p class="text-center fw-bold custom-tables">2023-11-21 (Tuesday)</p>
   <table class="table table-transparent">
    <tr>
     <th>Time</th>
     <th>BTC</th>
     <th>ETH</th>
     <th>2D</th>
    </tr>
    <tr>
     <td>9:30</td>
     <td>12,245.00</td>
     <td>24,235.00</td>
     <td>45</td>
    </tr>
    <tr>
     <td>12:00</td>
     <td>12,245.00</td>
     <td>24,235.00</td>
     <td>45</td>
    </tr>
    <tr>
     <td>2:00</td>
     <td>12,245.00</td>
     <td>24,235.00</td>
     <td>45</td>
    </tr>
    <tr>
     <td>4:00</td>
     <td>12,245.00</td>
     <td>24,235.00</td>
     <td>45</td>
    </tr>
   </table>
  </div>

  <div>
   <p class="text-center fw-bold custom-tables">2023-11-20 (Monday)</p>
   <table class="table table-bordered table-transparent">
    <tr>
     <th>Time</th>
     <th>BTC</th>
     <th>ETH</th>
     <th>2D</th>
    </tr>
    <tr>
     <td>9:30</td>
     <td>12,245.00</td>
     <td>24,235.00</td>
     <td>45</td>
    </tr>
    <tr>
     <td>9:30</td>
     <td>12,245.00</td>
     <td>24,235.00</td>
     <td>45</td>
    </tr>
    <tr>
     <td>2:00</td>
     <td>12,245.00</td>
     <td>24,235.00</td>
     <td>45</td>
    </tr>
    <tr>
     <td>4:00</td>
     <td>12,245.00</td>
     <td>24,235.00</td>
     <td>45</td>
    </tr>
   </table>
  </div>


 </div>

</div>

@include('user_layout.footer')
@endsection