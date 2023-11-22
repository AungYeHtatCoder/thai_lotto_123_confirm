@extends('user_layout.app')
@section('style')
<style>
 .table tr th,
 .table td {
  color: #fff;
  background-color: #265166;
  padding: 16px;
  /* Adjust the padding to change the space between columns and rows */
  border: 1px solid #fff;
  /* Set the border to transparent */
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
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8;">
  <div>
   <p class="text-center fw-bold custom-tables">2023-11-21 (Tuesday)</p>
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

{{-- @include('user_layout.footer') --}}
@endsection