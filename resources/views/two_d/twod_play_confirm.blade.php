@extends('user_layout.app')

@include('user_layout.nav')

@section('content')

<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8">
  <div style="height: 100vh">
   <h6 class="m-3 text-center text-white">ထိုးမည့်ဂဏန်းများ</h6>
   <table class="table text-center">
    <tbody id="additionalRow">
     <tr>
      <th>စဉ်</th>
      <th>ဂဏန်း</th>
      <th>ငွေပမာဏ</th>
      <th>ပြင် / ဖျက်</th>
     </tr>
     <tr>
      <td>1</td>
      <td>12</td>
      <td>100</td>
      <td>
       <div class="d-flex justify-content-center">
        <a href=""><i class="fa-regular fa-pen-to-square mx-3"></i></a>
        <a href=""><i class="fa-regular fa-trash-can text-danger"></i></a>
       </div>
      </td>
     </tr>
     <tr>
      <td>2</td>
      <td>22</td>
      <td>100</td>
      <td>
       <div class="d-flex justify-content-center">
        <a href=""><i class="fa-regular fa-pen-to-square mx-3"></i></a>
        <a href=""><i class="fa-regular fa-trash-can text-danger"></i></a>
       </div>
      </td>
     </tr>
     <tr>
      <td>3</td>
      <td>23</td>
      <td>100</td>
      <td>
       <div class="d-flex justify-content-center">
        <a href=""><i class="fa-regular fa-pen-to-square mx-3"></i></a>
        <a href=""><i class="fa-regular fa-trash-can text-danger"></i></a>
       </div>
      </td>
     </tr>
    </tbody>
   </table>

   <div class="d-flex justify-content-around">
    <p>စုစုပေါင်းငွေပမာဏ</p>
    <p>200 ကျပ်</p>
   </div>
   <hr />
   <div class="text-center text-white py-2" style="background: #336876; border-radius: 5px">
    <p class="pt-2">လက်ကျန်ငွေ</p>
    <p>0 ကျပ်</p>
   </div>
  </div>
 </div>
</div>
<div class="row" style="background: #fff">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 py-3 text-center fixed-bottom">
  <div class="row">
   <div class="col-6">
    <a href="" class="btn remove-btn">ပြန်ရွေးမည်</a>
   </div>
   <div class="col-6">
    <a href="" class="btn play-btn">ထိုးမည်</a>
   </div>
  </div>
 </div>
</div>

@endsection