@extends('user_layout.app')
@section('style')
<style>
   .progress-bar-container {
        position: relative;
        background-color: #f3f3f3;
        border-radius: 10px;
        height: 20px;
        width: 100%;
        overflow: hidden;
        margin: 5px 0;
    }

    /* .progress-bar {
        position: absolute;
        background-color: #4caf50;
        height: 100%;
        transition: width 0.5s;
    } */

    .text-center.digit {
        margin: 0 10px 10px 0;
        padding: 10px;
        border: 1px solid #dcdcdc;
        border-radius: 10px;
        box-shadow: 2px 2px 10px #dcdcdc;
        transition: background-color 0.3s;
    }

    .text-center.digit:hover {
        background-color: #eaeaea;
    }

    .text-center.digit.disabled {
        cursor: not-allowed;
    }

    /* new  */
    .parallax > use {
    animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
    }
    .parallax > use:nth-child(1) {
    animation-delay: -2s;
    animation-duration: 7s;
    }
    .parallax > use:nth-child(2) {
    animation-delay: -3s;
    animation-duration: 10s;
    }
    .parallax > use:nth-child(3) {
    animation-delay: -4s;
    animation-duration: 13s;
    }
    .parallax > use:nth-child(4) {
    animation-delay: -5s;
    animation-duration: 20s;
    }
    .waves-height {
    width: 100%;
    height: 100px;
    }
    @keyframes move-forever {
    0% {
    transform: translate3d(-90px,0,0);
    }
    100% {
    transform: translate3d(85px,0,0);
    }
    }
    .coin-img {
    width: 30px;
    margin-right: 5px;
    }
    .bg-darkblue {
    background-color: #130a2b;
    }
    .digit.selected {
    background-color: #007bff;
    color: white;
    background-image: linear-gradient(310deg, #cb0c9f 0%, darkorchid 100%);
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    margin: 0 4px;
    /* Spacing between digits */
    }

    .digit {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* padding: 5px 0; */
    background: linear-gradient(white, white) padding-box,
    linear-gradient(to right, darkblue, darkorchid) border-box;
    border-radius: 15px;
    border: 3px solid transparent;
    font-size: 20px;
    font-weight: bold;
    transition: all 0.3s ease;
    cursor: pointer;
    /* margin: 0 5px; */
    /* Spacing between digits */
    }

    .beauty {
    font-family: 'Arial', sans-serif;
    /* Change as per your preference */
    /* background: linear-gradient(45deg, #f3f4f6, #ddd); */
    /* Light gradient background */
    padding: 0.5em;
    }

    @keyframes goldAnimate {
    0% {
    border-color: #ffd700;
    }

    50% {
    border-color: #ffcc00;
    }

    100% {
    border-color: #ffdb58;
    }
    }

    */
    /* General styles */

    .digit:hover {
    transform: translateY(-5px);
    /* Slight lift effect */
    box-shadow: 0 6px 2px rgba(0, 0, 0, 0.15);
    /* Increased shadow on hover */
    }

    .disabled {
    cursor: not-allowed;
    /* Indicates non-clickable */
    }

    .disabled:hover {
    transform: none;
    /* No lift effect for disabled */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* No change in shadow for disabled */
    }

    .scrollable-container {
        width: 100%;
        max-height: 450px;
        overflow-y: scroll;
    }
    .account-box {
        box-shadow: 0 6px 20px 0 rgb(0 0 0 / 19%);
        padding: 10px;
        font-size: 14px;
        border-radius: 10px;
    }
    .account-box h5,
    .balance-btn .btn {
    margin-bottom: 0;
    }

    @media (max-width: 768px) {
    .coin-img {
    margin-left: 5px;
    }
    .waves-height {
    height:40px;
    min-height:40px;
    }
    .account-box h5 {
    font-size: 14px;
    }

    }
    /* form */
    .dream-form {
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    }
    .btn-delete {
        background-color: #e74c3c;
        color: #fff;
    }
    .btn-confirm {
        background-color: #2ecc71;
        color: #fff;
    }
    .main-row{
        display: grid;
        grid-template-columns: auto auto auto auto auto;
        /* grid-gap: 10px; */
    }
    .column{
        height: 100%;
    }
</style>
@endsection
@section('content')
@include('user_layout.sub_nav')
<div class="row">
  <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #ffffff;">
    <div class="flesh-card">
      <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-between">
          <span class="material-icons">account_balance_wallet</span>
          <p class="px-2">လက်ကျန်ငွေ </p>
        </div>
        <div class="d-flex justify-content-between">
          <span class="material-icons">
            update
          </span>
          <p class="px-2">ပိတ်ရန်ကျန်ချိန်</p>
        </div>
      </div>

      <div class="d-flex justify-content-between">

        <p class="ms-5" class="font-green d-block" id="userBalance"
                    data-balance="{{ Auth::user()->balance }}">{{ Auth::user()->balance }} MMK</p>
        <p class="me-2">2023-11-16 <br /> 02:30:00PM</p>
      </div>

    </div>

    <div>
      <div class="d-flex justify-content-between custom-btn">
        <a href="dream-book.html" class="btn h-50 text-white p-2" style="background-color: #2a576c;"><span class="material-icons text-white icons">menu_book</span> အိမ်မက်</a>
        <div class="">
          <h1>2D</h1>
        </div>
        <select class="h-50 text-white">
          <option value="1">12:00 AM</option>
          <option value="2">04:30 PM</option>
        </select>
      </div>
    </div>

    <div class="d-flex justify-content-between mt-3 custom-btn">
      <button class="fs-6 px-3" id="permuteButton" onclick="permuteDigits()">ပတ်လည်</button>
      <input type="text" name="amount" id="amount" placeholder="ငွေပမာဏ" class="form-control w-50 text-center border-black" />
    </div>


    <div class="d-flex justify-content-between mt-3 custom-btn">
      <a class="btn mt-3" data-bs-toggle="modal" data-bs-target="#colorModal"><span class="material-icons">
          question_mark
        </span>အရောင်ရှင်းလင်းချက်</a>
           <a href="{{ route('admin.QuickMorningPlayTwoDigit') }}" class="btn p-3 text-white" style="background-color: #2a576c">အမြန်ရွေးရန်</a>
    </div>



    {{-- <div class="box-container mt-5" id="boxContainer"> --}}
      <div class="container-fluid my-5">
        <div class="scrollable-container mt-6 digit-box">
            <div class="main-row">
                @foreach ($twoDigits->chunk(4) as $chunk)
                <div class="column">
                    @foreach ($chunk as $digit)
                        @php
                            $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
                                ->where('two_digit_id', $digit->id)
                                ->sum('sub_amount');
                        @endphp

                        @if ($totalBetAmountForTwoDigit < 5000)
                            <div class="text-center digit"
                                style="background-color: {{ 'javascript:getRandomColor();' }};"
                                onclick="selectDigit('{{ $digit->two_digit }}', this)">
                                {{ $digit->two_digit }}
                                <small class="d-block"
                                    style="font-size: 10px">{{ $remainingAmounts[$digit->id] }}</small>
                                    <div class="progress">
                                        @php
                                        $totalAmount = 5000;
                                        $betAmount = $totalBetAmountForTwoDigit; // the amount already bet
                                        $remainAmount = $totalAmount - $betAmount; // the amount remaining that can be bet
                                        $percentage = ($betAmount / $totalAmount) * 100;
                                    @endphp

                                        <div class="progress-bar" style="width: {{ $percentage }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                            </div>
                        @else
                            <div class="col-2 text-center digit disabled"
                                style="background-color: {{ 'javascript:getRandomColor();' }}"
                                onclick="showLimitFullAlert()">
                                {{ $digit->two_digit }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
            </div>
        </div>
      </div>
    {{-- </div> --}}

    <div class="dream-form mt-3">
      <div class="row">
        <div class="col-md-12">

          
        </div>
      </div>
      <div class="card mt-3">
        <div class="card-header">
          <h5 class="mb-0">အရောင်ရှင်းလင်းချက် 
            <span><a href="{{ url('/')}}" class="btn btn-primary">Back To Main</a></span>
          </h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <button id="one_amount" class="btn btn-outline-primary">150MMK</button>
            </div>
            <div class="col-4">
              <button id="two_amount" class="btn btn-outline-secondary">200MMK</button>
            </div>
            <div class="col-4">
              <button id="three_amount" class="btn btn-outline-success">250MMK</button>
            </div>

          </div>
          <div class="row mt-3">
            <div class="col-4">
              <button id="four_amount" class="btn btn-outline-danger">300MMK</button>
            </div>
            <div class="col-4">
              <button id="six_amount" class="btn btn-outline-warning">350MMK</button>
            </div>
            <div class="col-4">
              <button id="seven_amount" class="btn btn-outline-info">500MMK</button>
            </div>

          </div>
          <div class="row mt-3">
            <div class="col-4">
              <button id="eight_amount" class="btn btn-outline-dark">1000MMK</button>
            </div>
            <div class="col-4">
              <button id="nine_amount" class="btn btn-outline-primary">1500MMK</button>
            </div>
            <div class="col-4">
              <button id="ten_amount" class="btn btn-outline-secondary">2000MMK</button>
            </div>

          </div>
          <div class="row mt-3">
            <div class="col-4">
              <button id="eleven_amount" class="btn btn-outline-success">2500MMK</button>
            </div>
            <div class="col-4">
              <button id="twele_amount" class="btn btn-outline-danger">3000MMK</button>
            </div>
            <div class="col-4">
              <button id="theen_amount" class="btn btn-outline-warning">5000MMK</button>
            </div>
          </div>

          {{-- <form action="https://thailotto123.net/admin/quick-two-d-play" method="post" class="p-4">
            <input type="hidden" name="_token" value="Kk6gDnv0C0gHjNm5XM6QB2HiyT3fXu9Qqrays0cM" autocomplete="off">
            <!-- Selected Digits Input -->
            <input type="text" id="outputField" name="selected_digits" class="form-control" placeholder="Selected digits">

            <div id="amuntInputs" class="col-md-12 mb-3"></div>

            <div class="col-md-12 mb-3">
              <label for="totalAmount">Total Amount</label>
              <input type="text" id="totalAmount" name="totalAmount" class="form-control" readonly="">
            </div>

            <input type="hidden" name="user_id" value="6">

            <div class="col-12 d-flex justify-content-center mt-3">
              <button type="submit" class="btn btn-danger me-2">Cancel</button>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form> --}}
          @if ($lottery_matches->is_active == 1)
        <form action="{{ route('admin.two-d-play.store') }}" method="post" class="p-4">
            @csrf
            <div class="form-header mb-4">
                {{-- <h2 class="text-center">Place Your Bet</h2> --}}
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="selected_digits">ရွှေးချယ်ထားသောဂဏန်းများ</label>
                    <input type="text" name="selected_digits" id="selected_digits" class="form-control" placeholder="Enter digits">
                </div>

                <div id="amountInputs" class="col-md-12 mb-3"></div>

                <div class="col-md-12 mb-3">
                    <label for="totalAmount">စုစုပေါင်းထိုးကြေး</label>
                    <input type="text" id="totalAmount" name="totalAmount" class="form-control" readonly>
                </div>

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

              <div class="col-12 d-flex justify-content-center mt-3">
              <button type="submit" class="btn btn-danger me-2">Cancel</button>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
            </div>
        </form>
    @else
        <div class="text-center p-4">
            <h3>Sorry, you can't play now. Please wait for the next round.</h3>
        </div>
    @endif


        </div>
      </div>
    </div>

    <!-- <div class=" mt-3 d-flex justify-content-between custom-btn">
          <button class="text-danger" style="background:#b9b4c7;border: none;">ဖျက်မည်</button>

          <a href="2d-confirm.html" class="btn text-white" style="background-color: #2a576c;">ထိုးမည်</a>
        </div> -->

  </div>

</div>
{{-- modal --}}
<div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title text-center">အရောင်ရှင်းလင်းချက်</h4>
        <h5 class="modal-title text-center mt-3">ထီထိုးငွေ 100% ပြည့်ပါက ဂဏန်းပိတ်ပါမည်။</h5>
        <div class="d-flex mt-3">
          <p class="betlimitcolor bg-success mt-1"></p>
          <h4 class="ms-2">50% အောက်</h4>
        </div>
        <div class="d-flex mt-3">
          <p class="betlimitcolor bg-warning mt-1"></p>
          <h4 class="ms-2">50% မှ 80%</h4>
        </div>
        <div class="d-flex mt-3">
          <p class="betlimitcolor bg-danger mt-1"></p>
          <h4 class="ms-2">80% မှ 99%</h4>
        </div>
        <div class="d-flex mt-3">
          <p class="betlimitcolor bg-secondary mt-1"></p>
          <h4 class="ms-2">ထိုးငွေပြည့်သွားပါပြီ</h4>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
     @if(session('SuccessRequest'))
         Swal.fire({
             icon: 'success',
             title: 'Success!',
             text: '{{ session('SuccessRequest') }}',
             timer: 3000,
             showConfirmButton: false
         });
     @endif
 });

 </script>
     <script>
         function showLimitFullAlert() {
             Swal.fire({
                 icon: 'info',
                 title: 'Limit Reached',
                 text: 'This two digit\'s amount limit is full.'
             });
         }

         function selectDigit(num, element) {
             const selectedInput = document.getElementById('selected_digits');
             const amountInputsDiv = document.getElementById('amountInputs');

             let selectedDigits = selectedInput.value ? selectedInput.value.split(",") : [];

             // Get the remaining amount for the selected digit
             const remainingAmount = Number(element.querySelector('small').innerText.split(' ')[1]);

             // Check if the user tries to bet more than the remaining amount
             if (selectedDigits.includes(num)) {
                 const betAmountInput = document.getElementById('amount_' + num);

                 if (Number(betAmountInput.value) > remainingAmount) {
                     Swal.fire({
                         icon: 'error',
                         title: 'Bet Limit Exceeded',
                         text: `You can only bet up to ${remainingAmount} for the digit ${num}.`
                     });
                     return;
                 }
             }

             // Check if the digit is already selected
             if (selectedDigits.includes(num)) {
                 // If it is, remove the digit, its style, and its input field
                 selectedInput.value = selectedInput.value.replace(num, '').replace(',,', ',').replace(/^,|,$/g, '');
                 element.classList.remove('selected');

                 const inputToRemove = document.getElementById('amount_' + num);
                 amountInputsDiv.removeChild(inputToRemove);
             } else {
                 // Otherwise, add the digit, its style, and its input field
                 selectedInput.value = selectedInput.value ? selectedInput.value + "," + num : num;
                 element.classList.add('selected');

                 const amountInput = document.createElement('input');
                 amountInput.setAttribute('type', 'number');
                 amountInput.setAttribute('name', 'amounts[' + num + ']');
                 amountInput.setAttribute('id', 'amount_' + num);
                 amountInput.setAttribute('placeholder', 'Amount for ' + num);
                 amountInput.setAttribute('min', '100');
                 amountInput.setAttribute('max', '5000');
                 amountInput.setAttribute('class', 'form-control mt-2');
                 amountInput.onchange = function() {
                     updateTotalAmount();
                     checkBetAmount(this, num);
                 };
                 amountInputsDiv.appendChild(amountInput);
             }
         }

         function permuteDigits() {
    const selectedInput = document.getElementById('selected_digits');
    let selectedValue = selectedInput.value.split(",");
    const amountInputsDiv = document.getElementById('amountInputs');

    // Iterate over each selected digit and permute if it's two digits
    selectedValue = selectedValue.map(num => {
        if (num && num.length === 2) {
            return num[1] + num[0];
        }
        return num;
    });

    // Update the selected input value
    selectedInput.value = selectedValue.join(",");

    // Update UI for each permuted digit
    selectedValue.forEach(num => {
        const digitElements = document.querySelectorAll('.digit');
        digitElements.forEach(elem => {
            if (elem.textContent.includes(num)) {
                elem.classList.add('selected');

                // Check if an input for this number already exists
                let amountInput = document.getElementById('amount_' + num);
                if (!amountInput) {
                    amountInput = document.createElement('input');
                    amountInput.setAttribute('type', 'number');
                    amountInput.setAttribute('name', 'amounts[' + num + ']');
                    amountInput.setAttribute('id', 'amount_' + num);
                    amountInput.setAttribute('placeholder', 'Amount for ' + num);
                    amountInput.setAttribute('min', '100');
                    amountInput.setAttribute('max', '5000');
                    amountInput.setAttribute('class', 'form-control mt-2');
                    amountInput.onchange = function() {
                        updateTotalAmount();
                        checkBetAmount(this, num);
                    };
                    amountInputsDiv.appendChild(amountInput);
                }
            }
        });
    });
}

         function checkBetAmount(inputElement, num) {
             // Replace the problematic line with the following code
             const digits = document.querySelectorAll('.digit');
             let digitElement = null;

             for (let i = 0; i < digits.length; i++) {
                 if (digits[i].textContent.includes(num)) {
                     digitElement = digits[i];
                     break;
                 }
             }

             // Ensure that the digitElement was found before proceeding
             if (!digitElement) {
                 console.error('Could not find the digit element for', num);
                 return;
             }

             // Continue with the rest of your function as before
             const remainingAmount = Number(digitElement.querySelector('small').innerText.split(' ')[1]);

             // Check if the entered bet amount exceeds the remaining amount
             if (Number(inputElement.value) > remainingAmount) {
                 Swal.fire({
                     icon: 'error',
                     title: 'Bet Limit Exceeded',
                     text: `You can only bet up to ${remainingAmount} for the digit ${num}.`
                 });
                 inputElement.value = ""; // Reset the input value
             }
         }
    
    function setAmountForAllDigits(amount) {
    const inputs = document.querySelectorAll('input[name^="amounts["]');
    inputs.forEach(input => {
        input.value = amount;
    });
    updateTotalAmount(); // Update the total amount after setting the new amounts
}

// Attach event listeners to all amount buttons
document.getElementById('one_amount').addEventListener('click', function() { setAmountForAllDigits(150); });
document.getElementById('two_amount').addEventListener('click', function() { setAmountForAllDigits(200); });
document.getElementById('three_amount').addEventListener('click', function() { setAmountForAllDigits(250); });
document.getElementById('four_amount').addEventListener('click', function() { setAmountForAllDigits(300); });
// document.getElementById('five_amount').addEventListener('click', function() { setAmountForAllDigits(350); });
document.getElementById('six_amount').addEventListener('click', function() { setAmountForAllDigits(350); });
document.getElementById('seven_amount').addEventListener('click', function() { setAmountForAllDigits(500); });
document.getElementById('eight_amount').addEventListener('click', function() { setAmountForAllDigits(1000); });
document.getElementById('nine_amount').addEventListener('click', function() { setAmountForAllDigits(1500); });
document.getElementById('ten_amount').addEventListener('click', function() { setAmountForAllDigits(2000); });
document.getElementById('eleven_amount').addEventListener('click', function() { setAmountForAllDigits(2500); });
document.getElementById('twele_amount').addEventListener('click', function() { setAmountForAllDigits(3000); });
document.getElementById('theen_amount').addEventListener('click', function() { setAmountForAllDigits(5000); });

         // New function to calculate and display the total amount
         function updateTotalAmount() {
             let total = 0;
             const inputs = document.querySelectorAll('input[name^="amounts["]');
             inputs.forEach(input => {
                 total += Number(input.value);
             });

             // Get the user's current balance from the data attribute
             const userBalanceSpan = document.getElementById('userBalance');
             let userBalance = Number(userBalanceSpan.getAttribute('data-balance'));

             // Check if user balance is less than total amount
             if (userBalance < total) {
                 //alert('Your balance is not enough to play two digit.');
                 Swal.fire({
                     icon: 'error',
                     title: 'Oops...',
                     text: 'Your balance is not enough to play two digit. - သင်၏လက်ကျန်ငွေ မလုံလောက်ပါ - ကျေးဇူးပြု၍ ငွေဖြည့်ပါ။',
                     footer: `<a href=
         "{{ url('user/wallet') }}" style="background-color: #007BFF; color: #FFFFFF; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Fill Balance - ငွေဖြည့်သွင်းရန် နိုပ်ပါ </a>`
                 });
                 return; // Exit the function to prevent further changes
             }
             // Decrease the user balance by the total
             userBalance -= total;

             // Update the displayed balance and the data attribute
             userBalanceSpan.textContent = userBalance;
             userBalanceSpan.setAttribute('data-balance', userBalance);

             document.getElementById('totalAmount').value = total;
         }
         // sweet alert
         document.querySelector('form').addEventListener('submit', function(event) {
             event.preventDefault(); // prevent the form from submitting immediately

             Swal.fire({
                 title: 'Are you sure- ထိုးမှာလား ?',
                 text: 'You are about to submit your lottery choices.',
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonText: 'Yes, submit it! - ထိုးမယ်!',
                 cancelButtonText: 'No, cancel! - မထိုးပါ!'
             }).then((result) => {
                 if (result.isConfirmed) {
                     // If the user clicked "Yes", submit the form
                     event.target.submit();
                 }
             });
         });
     </script>
     <script>
         function getRandomColor() {
             const letters = '0123456789ABCDEF';
             let color = '#';
             for (let i = 0; i < 6; i++) {
                 color += letters[Math.floor(Math.random() * 16)];
             }
             return color;
         }

         document.querySelectorAll('.digit.disabled').forEach(el => {
             el.style.backgroundColor = getRandomColor();
         });
     </script>
@endsection
