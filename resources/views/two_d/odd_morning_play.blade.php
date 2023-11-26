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
        {{-- <p>အရောင်ရှင်းလင်းချက်</p> --}}

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
                    <small class="d-block" style="font-size: 10px">
                      {{-- {{ $remainingAmounts[$digit->id] }} --}}
                    </small>
                    <div class="progress">
                    @php
                    $totalAmount = 50000;
                    $betAmount = $totalBetAmountForTwoDigit; // the amount already bet
                    $remainAmount = $totalAmount - $betAmount; // the amount remaining that can be bet
                    $percentage = ($betAmount / $totalAmount) * 100;
                    // Determine the color of the progress bar based on the percentage
    $progressBarColor = '';
    if ($percentage <= 50) {
        $progressBarColor = 'bg-primary'; // Blue for 50% or less
    } elseif ($percentage > 50 && $percentage <= 75) {
        $progressBarColor = 'bg-warning'; // Yellow for between 50% and 75%
    } elseif ($percentage > 75) {
        $progressBarColor = 'bg-danger'; // Red for over 75%
    }
                @endphp
                <div class="progress-bar {{ $progressBarColor }}" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                <small class="d-block" style="font-size: 10px">
                      {{ $remainingAmounts[$digit->id] }}
                    </small>
                </div>

                    {{-- <div class="progress-bar" style="width: {{ $percentage }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> --}}
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
  <div class="card mt-2">
    <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="d-flex justify-content-between mt-3 custom-btn">
      
      <input type="text" name="amount" id="all_amount" placeholder="ငွေပမာဏ" class="form-control w-50 text-center border-black" />
    </div>
            </div>
            
          </div>
          
        </div>
      </div>
  </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row mt-3">
            <div class="col-6">
                <button class="btn btn-success w-100" id="odd">မမ - Odd</button>
            </div>
            <div class="col-6">
                <button class="btn btn-success w-100" id="even">စုံစုံ - Even</button>
            </div>
        </div>
            </div>
        </div>
        <div class="card">
         <div class="card-header">
             <h5 class="mb-0 text-center">အရောင်ရှင်းလင်းချက်
                                      <span><a href="{{ url('admin/morning-play-two-d')}}" class="btn btn-primary">Back To Play</a></span>
             </h5>
         </div>
         <div class="card-body">
          

    @if ($lottery_matches->is_active == 1)
        <form action="{{ route('admin.Quickstore') }}" method="post" class="p-4">
    @csrf
    <!-- Selected Digits Input -->
    <input type="text" id="outputField" name="selected_digits" class="form-control" placeholder="Selected digits" readonly>

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
    document.getElementById('odd').addEventListener('click', function() {
    const oddDigits = Array.from(document.querySelectorAll('.digit-button'))
        .filter(button => {
            const digits = button.getAttribute('data-digit').split('');
            return digits.every(digit => parseInt(digit) % 2 !== 0);
        })
        .map(button => button.getAttribute('data-digit'));

    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = oddDigits.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    oddDigits.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.min = '100';
        amountInput.max = '5000';
        amountInput.value = '100';
        amountInput.classList.add('form-control', 'mt-2', 'd-none');
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});


document.getElementById('even').addEventListener('click', function() {
    // Filter even numbers and also ensure that each digit is even
    const evenDigits = Array.from(document.querySelectorAll('.digit-button'))
    .map(button => button.getAttribute('data-digit').padStart(2, '0')) // Ensure two digits
    .filter(digit => digit[0] % 2 === 0 && digit[1] % 2 === 0) // Filter numbers where both digits are even
    .sort((a, b) => a.localeCompare(b, undefined, {numeric: true})); // Sort numerically


    // Assuming 'outputField' is where the selected digits will be displayed
    const outputField = document.getElementById('outputField');
    outputField.value = evenDigits.join(', ');

    // Now create amount input fields for these digits
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear previous inputs

    evenDigits.forEach(digit => {
        const amountInput = document.createElement('input');
        amountInput.type = 'number';
        amountInput.name = `amounts[${digit}]`; // Ensure this follows your naming scheme
        amountInput.id = `amount_${digit}`;
        amountInput.placeholder = `Amount for ${digit}`;
        amountInput.classList.add('form-control', 'mt-2', 'd-none');
        amountInput.min = '100'; // Assuming 100 is the minimum amount
        amountInput.max = '5000'; // Assuming 5000 is the maximum amount
        amountInput.required = true;
        // value 
        amountInput.value = '100';
        amountInput.onchange = updateTotalAmount; // Bind the change event to your total amount function

        // Append the new input to your amountInputs div
        amountInputsDiv.appendChild(amountInput);
    });

    // Call the updateTotalAmount function to initialize the values
    updateTotalAmount();
});
// Function to update all amounts when an amount button is clicked
function setAmountForAllDigits(amount) {
    const inputs = document.querySelectorAll('input[name^="amounts["]');
    inputs.forEach(input => {
        input.value = amount;
    });
    updateTotalAmount(); // Update the total amount after setting the new amounts
}

// Event listener for the amount input field
document.getElementById('all_amount').addEventListener('input', function() {
    const amount = this.value; // Get the current value of the input field
    setAmountForAllDigits(amount); // Set this amount for all digit inputs
});

function updateTotalAmount() {
    let total = 0;
    const inputs = document.querySelectorAll('input[name^="amounts["]'); // Get all amount inputs
    inputs.forEach(input => {
        const value = Number(input.value);
        if (value < 1 || value > 5000) {
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
            footer: `<a href="{{ url('user/wallet-deposite') }}" style="background-color: #007BFF; color: #FFFFFF; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Fill Balance - ငွေဖြည့်သွင်းရန် နိုပ်ပါ </a>`
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
@endsection

