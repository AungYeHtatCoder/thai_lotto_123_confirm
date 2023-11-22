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
  <div class="w-100 h-25 text-center text-white p-4 rounded" style="background-color: #265166;">
   <p style="font-weight: 800;font-size: 3.5rem;">576</p>
   <div>
    <small class="fw-bold">November 21 2023 (Tuesday)</small>
   </div>
  </div>

  <div class="mt-4">
   <div class="d-flex justify-content-between align-items-center px-3 py-2 my-2" style="border-bottom: 1px solid #265166 ;">
    <p>21-11-2023</p>
    <p class="fw-bold">970</p>
   </div>
   <div class="d-flex justify-content-between align-items-center px-3 py-2 my-2" style="border-bottom: 1px solid #265166 ;">
    <p>19-11-2023</p>
    <p class="fw-bold">578</p>
   </div>
   <div class="d-flex justify-content-between align-items-center px-3 py-2 my-2" style="border-bottom: 1px solid #265166 ;">
    <p>5-11-2023</p>
    <p class="fw-bold">245</p>
   </div>
   <div class="d-flex justify-content-between align-items-center px-3 py-2 my-2" style="border-bottom: 1px solid #265166 ;">
    <p>21-11-2023</p>
    <p class="fw-bold">970</p>
   </div>
   <div class="d-flex justify-content-between align-items-center px-3 py-2 my-2" style="border-bottom: 1px solid #265166 ;">
    <p>19-11-2023</p>
    <p class="fw-bold">578</p>
   </div>
   <div class="d-flex justify-content-between align-items-center px-3 py-2 my-2" style="border-bottom: 1px solid #265166 ;">
    <p>5-11-2023</p>
    <p class="fw-bold">245</p>
   </div>
  </div>


 </div>

</div>

{{-- @include('user_layout.footer') --}}
@endsection