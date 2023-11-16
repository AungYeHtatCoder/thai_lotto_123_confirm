@extends('user_layout.app')

@section('content')
<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 navs fixed-top">
  <div class="px-3 py-3">
   <div class="d-flex justify-content-between">
    <span>
     <a class="material-icons text-white" href="3d-bet.html">arrow_back</a>
    </span>
    <h5 class="mx-auto">
     <a href="../index.html" class="text-white">Diamond 2D | 3D</a>
    </h5>
    <span>
     <a class="material-icons text-white" data-bs-toggle="modal" data-bs-target="#additionalNumber">add</a>
    </span>
   </div>
  </div>
 </div>
</div>
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
      <td>123</td>
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
      <td>223</td>
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
      <td>223</td>
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

<div class="modal fade" id="additionalNumber" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="additionalNumberLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content text-white" style="background: #b6c5d8">
   <div class="modal-body">
    <h6>ထိုးဂဏန်း တိုးမည်</h6>
    <div class="form-group">
     <label class="form-label">ဂဏန်း</label>
     <input type="number" class="form-control" name="" id="addNum" />
    </div>
    <div class="form-group">
     <label class="form-label">ငွေပမာဏ</label>
     <input type="number" class="form-control" name="" id="addAmt" />
    </div>
    <div class="pt-2 d-flex justify-content-end">
     <button type="button" class="btn btn-sm me-3" data-bs-dismiss="modal" id="modalCloseBtn">
      ဖျက်ရန်
     </button>
     <button type="button" onclick="addNumber()" class="btn btn-sm">
      တိုးမည်
     </button>
    </div>
   </div>
  </div>
 </div>
</div>
@section('script')
<script>
 function addNumber() {
  const newRowContainer = document.getElementById('additionalRow');
  const numberInput = document.getElementById('addNum');
  const amountInput = document.getElementById('addAmt');
  const number = numberInput.value;
  const amount = amountInput.value;

  // Create a new table row
  const newRow = document.createElement('tr');
  newRow.addClass = 'bg-white';

  // Set the innerHTML of the new row
  newRow.innerHTML = `
        <td>4.</td>
        <td>${number}</td>
        <td>${amount}</td>
        <td>
          <div class="d-flex justify-content-center">
            <a href=""><i class="fa-regular fa-pen-to-square mx-3"></i></a>
            <a href=""><i class="fa-regular fa-trash-can text-danger"></i></a>
          </div>
        </td>
      `;

  // Append the new row to the container
  newRowContainer.appendChild(newRow);

  // Clear input values
  numberInput.value = '';
  amountInput.value = '';

  // Close the modal
  closeModal();
 }

 function closeModal() {
  const modalTrigger = document.getElementById('modalCloseBtn');
  modalTrigger.click();
 }
</script>
@endsection
@endsection