@extends('user_layout.app')

@section('style')
<style>
.outputButton {
 margin: 5px;
 padding: 5px;
 background-color: #428387;
 color: white;
 border: none;
 border-radius: 3px;
 cursor: pointer;

}
</style>
@endsection

@include('user_layout.sub_nav')
@section('content')
<div class="row" style="height: 100vh">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8">
  <div class="flesh-card">
   <div class="d-flex justify-content-between">
    <div class="d-flex justify-content-between">
     <span class="material-icons">account_balance_wallet</span>
     <p class="px-2">လက်ကျန်ငွေ</p>
    </div>
    <div class="d-flex justify-content-between">
     <span class="material-icons">clock</span>
     <p class="px-2">ပိတ်ရန်ကျန်ချိန်</p>
    </div>
   </div>

   <div class="d-flex justify-content-between">
    <p class="ms-5">0.00</p>
    <p class="me-2">
     2023-11-16 <br />
     02:30:00PM
    </p>
   </div>
  </div>

  <div class="d-flex justify-content-around align-items-center my-3">
   <button type="button" class="px-3 py-2 text-white border border-none rounded" style="
                background: linear-gradient(
                  90deg,
                  #428387,
                  #336876,
                  #265166 100%
                );
              ">
    အိမ်မက်
   </button>

   <h3 class="text-center">3D<br /><small>အောက်2လုံး</small></h3>

   <button type="button" class="px-3 py-2 text-white border border-none rounded" style="
                background: linear-gradient(
                  90deg,
                  #428387,
                  #336876,
                  #265166 100%
                );
              ">
    ဟော့ဂဏန်းများ
   </button>

  </div>

  <div class="d-flex justify-content-around align-items-center my-3">

   <input id="numberInput" type="text" class="form-control border border-none py-2 mx-2 w-100" id="exampleInput"
    placeholder="စာရိုက်ပြီး ဂဏန်းရွေးမည်" maxlength="3" required />

   <input type="number" placeholder="ဒဲ့ဂဏန်း ငွေပမာဏ" class="form-control border border-none py-2 w-100" required />

  </div>

  <div class="d-flex justify-content-between align-items-center mt-1">

   <button type="button" style="
                  background: linear-gradient(
                    90deg,
                    #428387,
                    #336876,
                    #265166 100%
                  );
                " class="text-white px-3 py-2 my-2 me-5 ms-2 border border-none rounded">
    ပတ်လည်
   </button>

   <input type="number" placeholder="ပတ်လည်ဂဏန်း ငွေပမာဏ" class="form-control border border-none py-2 w-50" required />
  </div>

  <div class="d-flex justify-content-end align-items-center">
   <button type="button" style="
                  background: linear-gradient(
                    90deg,
                    #428387,
                    #336876,
                    #265166 100%
                  );
                " class="text-white px-3 py-2 my-2 ms-2 border border-none rounded" onclick="showNumbers()">
    ရွေးမည်
   </button>
  </div>

  <div class="row d-flex justify-content-start align-items-center">
   <div class="col-4 col-sm-12">
    <a href="{{ url('/threed-quick') }}" type="button" style="text-decoration: none;
                background: linear-gradient(
                  90deg,
                  #428387,
                  #336876,
                  #265166 100%
                );
              " class="text-white px-3 py-2 my-2 ms-2 border border-none rounded">
     အမြန်ရွေးရန်
    </a>
   </div>

   <div class="col-6 col-sm-12">
    <a href="{{ url('/threed-num') }}" style="text-decoration: none;
                background: linear-gradient(
                  90deg,
                  #428387,
                  #336876,
                  #265166 100%
                );
              " class="text-white px-3 py-2 my-2 ms-2 border border-none rounded">
     အောက်2လုံး ဂဏန်းထိုးရန်
    </a>
   </div>
  </div>

  <div id="outputDiv" style="padding-bottom: 100px;padding-top: 10px">

  </div>

 </div>
</div>

<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 py-3 fixed-bottom text-center">
  <div class="row d-flex justify-content-center align-items-center">
   <div class="col-5">
    <a type="button" href="#" class="btn remove-btn" onclick="deleteNumbers()">ဖျက်မည်</a>
   </div>
   <div class="col-5">
    <a href="{{ url('/threed-confirm') }}" class="btn play-btn ">ထိုးမည်</a>
   </div>


  </div>
 </div>
</div>

@section('script')
<script>
// Array to store entered numbers
var enteredNumbers = [];

function showNumbers() {
 var inputText = document.getElementById("numberInput").value;
 var outputDiv = document.getElementById("outputDiv");

 if (!/^\d{3}$/.test(inputText)) {
  outputDiv.textContent = "Please enter exactly three digits.";
 } else {
  // Add the entered number to the array
  enteredNumbers.push(inputText);

  // Display all entered numbers with buttons
  updateOutput();

 }
}

function updateOutput() {
 var outputDiv = document.getElementById("outputDiv");

 // Clear previous content
 outputDiv.innerHTML = "";

 // Create a button for each entered number
 enteredNumbers.forEach(function(number) {
  var button = document.createElement("button");
  button.textContent = number;
  button.className = "outputButton";
  outputDiv.appendChild(button);
 });
 document.getElementById("numberInput").value = "";

}

function deleteNumbers() {
 // Clear the array of entered numbers
 enteredNumbers = [];

 // Clear the outputDiv
 var outputDiv = document.getElementById("outputDiv");
 outputDiv.innerHTML = "";
}
</script>
@endsection
@endsection