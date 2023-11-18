@extends('user_layout.app')
@section('style')
<link rel="stylesheet" href="{{ asset('user_app/assets/css/balance.css')}}">
@endsection
@section('content')
@include('user_layout.nav')
<div class="row">
    <div
      class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4"
      style="background-color: #ffffff;"
    >
        <div class="flesh-card">
            <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-between">
                    <span class="material-icons">account_balance_wallet</span>
                    <p class="px-2">လက်ကျန်ငွေ</p>
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
            <a href="dream-book.html" class="btn h-50 text-white p-2" style="background-color: #2a576c;"><span class="material-icons text-white icons">menu_book</span>  အိမ်မက်</a>
            <div class=""><h1>2D</h1></div>
            <select class="h-50 text-white">
              <option value="1">12:00 AM</option>
              <option value="2">04:00 PM</option>
            </select>
          </div>
        </div>

        <div class="d-flex justify-content-between mt-3 custom-btn">
          <button class="fs-6 px-3">ပတ်လည်</button>
          <input type="text" name="amount" id="amount" placeholder="ငွေပမာဏ" class="form-control w-50 text-center border-black"/>
        </div>
        

        <div class="d-flex justify-content-between mt-3 custom-btn">
          <a class="btn mt-3" data-bs-toggle="modal" data-bs-target="#colorModal"><span class="material-icons">
            question_mark
            </span>အရောင်ရှင်းလင်းချက်</a>
          
        </div>

        

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

        <div class="dream-form mt-3">
            <div class="row">
               <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" id="zero" class="btn btn-primary">0</button>
                        <button type="button" id="one" class="btn btn-secondary">1</button>
                        <button type="button" id="two" class="btn btn-success">2</button>
                        <button type="button" id="three" class="btn btn-danger">3</button>
                        <button type="button" id="four" class="btn btn-warning">4</button>
                        <button type="button" id="five" class="btn btn-info">5</button>
                        <button type="button" id="six" class="btn btn-primary">6</button>
                        <button type="button" id="seven" class="btn btn-dark">7</button>
                        <button type="button" id="eight" class="btn btn-warning mt-1">8</button>
                        <button type="button" id="nine" class="btn btn-success mt-1">9</button>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                <a href="{{ route('admin.QuickOddMorningPlayTwoDigit') }}" class="btn btn-info btn-sm">မမ</a>
                <a href="{{ route('admin.QuickEvenMorningPlayTwoDigit') }}" class="btn btn-warning btn-sm">စုံစုံ</a>
                 <a href="{{ route('admin.QuickOddSameMorningPlayTwoDigit') }}" class="btn btn-primary btn-sm">မမ အပူး</a>
                <a href="{{ route('admin.QuickEvenSameMorningPlayTwoDigit') }}" class="btn btn-warning btn-sm">စုံစုံ အပူး</a>
                    </div>
                </div>
               </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">အရောင်ရှင်းလင်းချက်</h5>
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
        
                    @if ($lottery_matches->is_active == 1)
        <form action="{{ route('admin.Quickstore') }}" method="post" class="p-4">
    @csrf
    <!-- Selected Digits Input -->
    <input type="text" id="outputField" name="selected_digits" class="form-control" placeholder="Selected digits">

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
        

    </div>

  </div>

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
@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
    // zero addEventListener
 document.getElementById('zero').addEventListener('click', function() {
    const digitsStartingWithZero = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => button.getAttribute('data-digit').startsWith('0'))
        .map(button => button.getAttribute('data-digit'));
    
    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = digitsStartingWithZero.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digitsStartingWithZero.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});
// one addEventListener
 document.getElementById('one').addEventListener('click', function() {
    const digitsStartingWithZero = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => button.getAttribute('data-digit').startsWith('1'))
        .map(button => button.getAttribute('data-digit'));
    
    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = digitsStartingWithZero.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digitsStartingWithZero.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});
    // two addEventListener
    document.getElementById('two').addEventListener('click', function() {
    const digitsStartingWithZero = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => button.getAttribute('data-digit').startsWith('2'))
        .map(button => button.getAttribute('data-digit'));
    
    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = digitsStartingWithZero.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digitsStartingWithZero.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});

document.getElementById('three').addEventListener('click', function() {
    const digitsStartingWithZero = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => button.getAttribute('data-digit').startsWith('3'))
        .map(button => button.getAttribute('data-digit'));
    
    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = digitsStartingWithZero.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digitsStartingWithZero.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});

document.getElementById('four').addEventListener('click', function() {
    const digitsStartingWithZero = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => button.getAttribute('data-digit').startsWith('4'))
        .map(button => button.getAttribute('data-digit'));
    
    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = digitsStartingWithZero.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digitsStartingWithZero.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});

document.getElementById('five').addEventListener('click', function() {
    const digitsStartingWithZero = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => button.getAttribute('data-digit').startsWith('5'))
        .map(button => button.getAttribute('data-digit'));
    
    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = digitsStartingWithZero.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digitsStartingWithZero.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});

document.getElementById('six').addEventListener('click', function() {
    const digitsStartingWithZero = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => button.getAttribute('data-digit').startsWith('6'))
        .map(button => button.getAttribute('data-digit'));
    
    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = digitsStartingWithZero.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digitsStartingWithZero.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});

document.getElementById('seven').addEventListener('click', function() {
    const digitsStartingWithZero = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => button.getAttribute('data-digit').startsWith('7'))
        .map(button => button.getAttribute('data-digit'));
    
    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = digitsStartingWithZero.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digitsStartingWithZero.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});

document.getElementById('eight').addEventListener('click', function() {
    const digitsStartingWithZero = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => button.getAttribute('data-digit').startsWith('8'))
        .map(button => button.getAttribute('data-digit'));
    
    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = digitsStartingWithZero.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digitsStartingWithZero.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});

document.getElementById('nine').addEventListener('click', function() {
    const digitsStartingWithZero = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => button.getAttribute('data-digit').startsWith('9'))
        .map(button => button.getAttribute('data-digit'));
    
    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = digitsStartingWithZero.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    digitsStartingWithZero.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});
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

