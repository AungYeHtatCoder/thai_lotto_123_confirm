@extends('user_layout.app')

@section('style')

<style>
.toggled {
 background-color: #265166 !important;
 /* Change this to the color you want */
}
</style>

@endsection

@include('user_layout.sub_nav')
@section('content')
<div class="row" style="height: 100vh">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #b6c5d8">
  <div>
   <p>(3)လုံးပူး ဂဏန်းများ</p>
   <p class="text-center">
    ဂဏန်းအရေအတွက်: <span id="totalCount" class="totalCount">0</span>
   </p>
  </div>

  <div id="buttonContainer1" class="buttonContainer box-container" style="height: auto">
   <button id="btn1" class="box-btn btn" onclick="toggleCount('1', 'container1', 1)">
    000
   </button>
   <button id="btn2" class="box-btn btn" onclick="toggleCount('2', 'container1', 1)">
    111
   </button>
   <button id="btn3" class="box-btn btn" onclick="toggleCount('3', 'container1', 1)">
    222
   </button>
   <button id="btn4" class="box-btn btn" onclick="toggleCount('4', 'container1', 1)">
    333
   </button>
   <button id="btn5" class="box-btn btn" onclick="toggleCount('5', 'container1', 1)">
    444
   </button>
   <button id="btn6" class="box-btn btn" onclick="toggleCount('6', 'container1', 1)">
    555
   </button>
   <button id="btn7" class="box-btn btn" onclick="toggleCount('7', 'container1', 1)">
    666
   </button>
   <button id="btn8" class="box-btn btn" onclick="toggleCount('8', 'container1', 1)">
    777
   </button>
   <button id="btn9" class="box-btn btn" onclick="toggleCount('7', 'container1', 1)">
    888
   </button>
   <button id="btn10" class="box-btn btn" onclick="toggleCount('8', 'container1', 1)">
    999
   </button>
  </div>

  <div id="buttonContainer2" class="buttonContainer box-container" style="height: auto">
   <p>အကွက် 100</p>
   <button id="btn11" class="box-btn btn" onclick="toggleCount('11', 'container2', 100)">
    000-099
   </button>
   <button id="btn12" class="box-btn btn" onclick="toggleCount('12', 'container2', 100)">
    100-199
   </button>
   <button id="btn13" class="box-btn btn" onclick="toggleCount('13', 'container2', 100)">
    200-299
   </button>
   <button id="btn14" class="box-btn btn" onclick="toggleCount('14', 'container2', 100)">
    300-399
   </button>
   <button id="btn15" class="box-btn btn" onclick="toggleCount('15', 'container2', 100)">
    400-499
   </button>
   <button id="btn16" class="box-btn btn" onclick="toggleCount('16', 'container2', 100)">
    500-599
   </button>
   <button id="btn17" class="box-btn btn" onclick="toggleCount('17', 'container2', 100)">
    600-699
   </button>
   <button id="btn18" class="box-btn btn" onclick="toggleCount('18', 'container2', 100)">
    700-799
   </button>
   <button id="btn19" class="box-btn btn" onclick="toggleCount('19', 'container2', 100)">
    800-899
   </button>
   <button id="btn20" class="box-btn btn" onclick="toggleCount('20', 'container2', 100)">
    900-999
   </button>
  </div>

  <div class="mt-3">
   <input type="number" class="form-control w-100" placeholder="ငွေပမာဏ (အနည်းဆုံး 100 ကျပ်)" />
  </div>
 </div>
</div>

<div class="row">
 <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 py-3 fixed-bottom text-center">

  <div class="row d-flex justify-content-center align-items-center">
   <div class="col-5">
    <a type="button" href="#" class="btn remove-btn" onclick="deleteTotalCount()">ဖျက်မည်</a>
   </div>
   <div class="col-5">
    <a href="{{ url('/threed-confirm') }}" class="btn play-btn ">ထိုးမည်</a>
   </div>


  </div>

 </div>
</div>
</div>
@section('script')
<script>
// Object to store button counts
var buttonCounts1 = {
 1: 0,
 2: 0
};
var buttonCounts2 = {
 3: 0,
 4: 0
};

// Function to toggle the count for a button
function toggleCount(buttonId, containerId, incrementValue) {
 console.log(buttonId);
 console.log(containerId);
 console.log(incrementValue);

 var buttonCounts =
  containerId === 'container1' ? buttonCounts1 : buttonCounts2;
 console.log(buttonCounts);

 buttonCounts[buttonId] =
  buttonCounts[buttonId] === incrementValue ? 0 : incrementValue;

 //Change button color on toggle
 var button = document.getElementById('btn' + buttonId);
 button.classList.toggle('toggled');

 updateTotal();
}

// Function to delete the total count
function deleteTotalCount() {
 buttonCounts1 = [];
 buttonCounts2 = [];
 var total = 0;

 document.getElementById('totalCount').textContent = total;

 // Reset button colors

 var buttons = document.querySelectorAll('.btn');

 buttons.forEach((button) => button.classList.remove('toggled'));
}

// Function to update the total count for all containers
function updateTotal() {
 var total = Object.values(buttonCounts1)
  .concat(Object.values(buttonCounts2))
  .reduce((acc, count) => acc + count, 0);
 document.getElementById('totalCount').textContent = total;
}
</script>
@endsection
@endsection