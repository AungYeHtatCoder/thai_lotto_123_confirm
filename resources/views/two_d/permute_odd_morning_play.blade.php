@extends('user_layout.app')
@section('style')
<link rel="stylesheet" href="{{ asset('user_app/assets/css/balance.css')}}">

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
          <option value="2">04:00 PM</option>
        </select>
      </div>
    </div>

    <div class="d-flex justify-content-between mt-3 custom-btn">
      <button class="fs-6 px-3">ပတ်လည်</button>
      <input type="text" name="amount" id="amount" placeholder="ငွေပမာဏ" class="form-control w-50 text-center border-black" />
    </div>


    <div class="d-flex justify-content-between mt-3 custom-btn">
      <a class="btn mt-3" data-bs-toggle="modal" data-bs-target="#colorModal"><span class="material-icons">
          question_mark
        </span>အရောင်ရှင်းလင်းချက်</a>
      <a href="{{ route('admin.QuickMorningPlayTwoDigit') }}" class="btn p-3 text-white" style="background-color: #2a576c">အမြန်ရွေးရန်</a>
    </div>
    <div class="container-fluid my-5">
        <p>အရောင်ရှင်းလင်းချက်</p>

        <div class="scrollable-container overflow-scroll mt-6 digit-box">
            <div class="main-row">
    @foreach ($twoDigits->chunk(3) as $chunk)
    <div class="column">
        @foreach ($chunk as $digit)
            @php
                $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
                    ->where('two_digit_id', $digit->id)
                    ->sum('sub_amount');
            @endphp

            @if ($totalBetAmountForTwoDigit < 5000)
                <div class="text-center digit digit-button" style="background-color: javascript:getRandomColor();"
                    data-digit="{{ $digit->two_digit }}" onclick="selectDigit('{{ $digit->two_digit }}', this)">
                    {{ $digit->two_digit }}
                    <small class="d-block" style="font-size: 10px">{{ $remainingAmounts[$digit->id] }}</small>
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
                <div class="col-2 text-center digit disabled" style="background-color: javascript:getRandomColor();"
                    data-digit="{{ $digit->two_digit }}" onclick="showLimitFullAlert()">
                    {{ $digit->two_digit }}
                </div>
            @endif
        @endforeach
    </div>
    @endforeach
</div>
    
        </div>
       
    </div>

 <div class="dream-form">
        <div class="card mt-3">
            <div class="card-body">
                <div class="row mt-3">
            <div class="col-4">
                <button class="btn btn-success w-100" id="odd">မမ - Odd</button>
            </div>
            <div class="col-4">
                <button class="btn btn-success w-100" id="even">စုံစုံ - Even</button>
            </div>
            <div class="col-4">
              <button class="fs-6 px-3 btn btn-primary" id="permuteButton" onclick="permuteDigits()">permulation</button>
            </div>

        </div>
            </div>
        </div>
        <div class="card">
         <div class="card-header">
             <h5 class="mb-0">အရောင်ရှင်းလင်းချက်</h5>
         </div>
         <div class="card-body">
          <div class="row">
           <div class="col-3">
            <button id="one_amount" class="btn btn-outline-primary">150MMK</button>
           </div>
           <div class="col-3">
            <button id="two_amount" class="btn btn-outline-secondary">200MMK</button>
          </div>
          <div class="col-3">
            <button id="three_amount" class="btn btn-outline-success">250MMK</button>
         </div>
         <div class="col-3">
            <button id="four_amount" class="btn btn-outline-danger">300MMK</button>
         </div>
          </div>
          <div class="row mt-3">
            <div class="col-3">
             <button id="six_amount" class="btn btn-outline-warning">350MMK</button>
            </div>
            <div class="col-3">
             <button id="seven_amount" class="btn btn-outline-info">500MMK</button>
           </div>
           <div class="col-3">
             <button id="eight_amount" class="btn btn-outline-dark">1000MMK</button>
          </div>
          <div class="col-3">
             <button id="nine_amount" class="btn btn-outline-primary">1500MMK</button>
          </div>
           </div>
           <div class="row mt-3">
            <div class="col-3">
             <button id="ten_amount" class="btn btn-outline-secondary">2000MMK</button>
            </div>
            <div class="col-3">
             <button id="eleven_amount" class="btn btn-outline-success">2500MMK</button>
           </div>
           <div class="col-3">
             <button id="twele_amount" class="btn btn-outline-danger">3000MMK</button>
           </div>
           <div class="col-3">
             <button id="theen_amount" class="btn btn-outline-warning">5000MMK</button>
           </div>
        </div>

    @if ($lottery_matches->is_active == 1)
        <form action="{{ route('admin.Quickstore') }}" method="post" class="p-4">
    @csrf
    <!-- Selected Digits Input -->
    <div class="mb-3 mt-3">
      <input type="text" id="outputField" name="selected_digits" class="form-control" placeholder="Selected digits" readonly>
    </div>

    <div class="mb-3 mt-3">
        <label for="permulated_digit">Permulated Digits</label>
        <input type="text" id="permulated_digit" class="form-control" readonly>
    </div>
    <!-- Amounts Inputs will be appended here -->
    <div id="amountInputs" class="col-md-12 mb-3"></div>

    <!-- Total Amount Input -->
    <div class="col-md-12 mb-3">
        <label for="totalAmount">Total Amount</label>
        <input type="text" id="totalAmount" name="totalAmount" class="form-control" readonly>
    </div>

    <!-- User ID Hidden Input -->
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

    <!-- Submit Buttons -->
    <div class="col-12 d-flex justify-content-center mt-3">
        <button type="submit" class="btn btn-delete mr-3">Cancel</button>
        <button type="submit" class="btn btn-confirm">Submit</button>
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
    // Helper function to filter digits based on a condition
function filterDigits(condition) {
    return Array.from(document.querySelectorAll('.digit-button'))
        .map(button => button.getAttribute('data-digit').padStart(2, '0'))
        .filter(condition)
        .sort((a, b) => a.localeCompare(b, undefined, { numeric: true }));
}

// Function to update the output field and create amount inputs
function updateDisplayAndCreateAmountInputs(digits) {
    const outputField = document.getElementById('outputField');
    const amountInputsDiv = document.getElementById('amountInputs');

    outputField.value = digits.join(', ');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digits.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`;
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.min = '100';
        amountInput.max = '5000';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount;
        amountInputsDiv.appendChild(amountInput);
    });

    updateTotalAmount();
}

// Event listener for odd digits
document.getElementById('odd').addEventListener('click', function() {
    const oddCondition = digit => digit.split('').every(d => parseInt(d) % 2 !== 0);
    updateDisplayAndCreateAmountInputs(filterDigits(oddCondition));
});

// Event listener for even digits
document.getElementById('even').addEventListener('click', function() {
    const evenCondition = digit => digit.split('').every(d => parseInt(d) % 2 === 0);
    updateDisplayAndCreateAmountInputs(filterDigits(evenCondition));
});
// Function to permute and display digits
function permuteDigits() {
    const outputField = document.getElementById('outputField');
    const permulatedField = document.getElementById('permulated_digit');

    if (!outputField || !permulatedField) {
        console.error('Required field not found');
        return;
    }

    // Get the selected digits and trim any whitespace
    let selectedDigits = outputField.value.split(",").map(s => s.trim());
    
    const permutedDigits = selectedDigits.map(num => num.length === 2 ? num[1] + num[0] : num);

    // Update the outputField with both selected and permuted digits
    outputField.value = `${selectedDigits.join(", ")} , ${permutedDigits.join(", ")}`;

    // Update the permulatedField with the permuted digits only
    permulatedField.value = permutedDigits.join(",");

    // Combine selectedDigits and permutedDigits while removing duplicates
    const allDigits = [...selectedDigits, ...permutedDigits];
    // const allUniqueDigits = Array.from(new Set(allDigits));

    // const allUniqueDigits = Array.from(new Set([...selectedDigits, ...permutedDigits]));
    
    // Recreate the amount inputs for all unique digits
    createAmountInputs(allDigits);
}

// Function to create amount inputs for both selected and permuted digits
function createAmountInputs(digits) {
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear existing amount inputs

    // Create amount inputs for each digit
    digits.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`;
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100'; // Default value or retrieve existing value
        amountInput.min = '100';
        amountInput.max = '5000';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount;
        amountInputsDiv.appendChild(amountInput);
    });

    updateTotalAmount(); // Update the total amount to reflect changes
}
// function createAmountInputs(digits) {
//     const amountInputsDiv = document.getElementById('amountInputs');
//     amountInputsDiv.innerHTML = ''; // Clear existing amount inputs

//     digits.forEach(digit => {
//         const amountInput = document.createElement('input');
//         amountInput.type = 'number';
//         amountInput.name = `amounts[${digit}]`;
//         amountInput.id = `amount_${digit}`;
//         amountInput.placeholder = `Amount for ${digit}`;
//         amountInput.value = '100'; // Default value or retrieve existing value
//         amountInput.min = '100';
//         amountInput.max = '5000';
//         amountInput.classList.add('form-control', 'mt-2');
//         amountInput.onchange = updateTotalAmount;
//         amountInputsDiv.appendChild(amountInput);
//     });

//     updateTotalAmount(); // Update the total amount to reflect changes
// }

// Function to permute and display digits
// function permuteDigits() {
//     const outputField = document.getElementById('outputField');
//     const permulatedField = document.getElementById('permulated_digit');

//     if (!outputField || !permulatedField) {
//         console.error('Required field not found');
//         return;
//     }

//     let selectedDigits = outputField.value.split(",").map(s => s.trim());
//     const permutedDigits = selectedDigits.map(num => num.length === 2 ? num[1] + num[0] : num);
//     const allUniqueDigits = Array.from(new Set([...selectedDigits, ...permutedDigits]));

//     outputField.value = `${selectedDigits.join(", ")} , ${permutedDigits.join(", ")}`;
//     permulatedField.value = permutedDigits.join(",");
    
//     createAmountInputs(allUniqueDigits);
// }

// // Function to create amount inputs
// function createAmountInputs(digits) {
//     const amountInputsDiv = document.getElementById('amountInputs');
//     amountInputsDiv.innerHTML = ''; // Clear existing amount inputs

//     digits.forEach(digit => {
//         const amountInput = document.createElement('input');
//         amountInput.type = 'number';
//         amountInput.name = `amounts[${digit}]`;
//         amountInput.id = `amount_${digit}`;
//         amountInput.placeholder = `Amount for ${digit}`;
//         amountInput.value = '100'; // Default value
//         amountInput.classList.add('form-control', 'mt-2');
//         amountInput.onchange = updateTotalAmount;
//         amountInputsDiv.appendChild(amountInput);
//     });

//     updateTotalAmount(); // Update the total amount
// }
// Function to update all amounts when an amount button is clicked
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


function updateTotalAmount() {
    let total = 0;
    const inputs = document.querySelectorAll('input[name^="amounts["]'); // Get all amount inputs
    inputs.forEach(input => {
        const value = Number(input.value);
        if (value < 100 || value > 5000) {
            // If the input value is less than 100 or greater than 5000, show an error and reset the input
            Swal.fire({
                icon: 'error',
                title: 'Invalid amount',
                text: 'The amount for each two-digit number must be between 100 and 5000 MMK.'
            });
            input.value = ''; // Reset the invalid input
        } else {
            total += value; // Add valid input values to the total
        }
    });

    // Check against the user's balance
    const userBalanceSpan = document.getElementById('userBalance');
    let userBalance = Number(userBalanceSpan.getAttribute('data-balance'));

    if (userBalance < total) {
        // If the balance is insufficient, show an error
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Your balance is not enough to play two digit. - သင်၏လက်ကျန်ငွေ မလုံလောက်ပါ - ကျေးဇူးပြု၍ ငွေဖြည့်ပါ။',
            footer: `<a href="{{ url('user/wallet') }}" style="background-color: #007BFF; color: #FFFFFF; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Fill Balance - ငွေဖြည့်သွင်းရန် နိုပ်ပါ </a>`
        });
    } else {
        // If the balance is sufficient, update the display
        userBalanceSpan.textContent = `လက်ကျန်ငွေ - ${(userBalance - total).toFixed(2)} MMK`; // Format for display
        userBalanceSpan.setAttribute('data-balance', userBalance - total);

        // Update the total amount display
        document.getElementById('totalAmount').value = total.toFixed(2);
    }
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
     @if(session('SuccessRequest'))
         Swal.fire({
             icon: 'success',
             title: 'Success! သင့်ကံစမ်းမှုအောင်မြင်ပါသည် ! သိန်းထီးဆုကြီးပေါက်ပါစေ',
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

