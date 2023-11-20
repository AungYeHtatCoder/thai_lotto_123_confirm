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

</script>

<script>
 // odd morning play permute
 // function permuteDigits() {
//     const outputField = document.getElementById('outputField');
//     if (!outputField) {
//         console.error('outputField not found');
//         return;
//     }
    
//     // Split the current value by commas, map through each, and permute if it's two digits
//     let digits = outputField.value.split(',').map(digit => {
//         if (digit.length === 2) {
//             return digit[1] + digit[0]; // Swap the digits
//         }
//         return digit; // If not two digits, leave as is
//     });
    
//     // Join the permuted digits back into a string and update the outputField value
//     outputField.value = digits.join(', ');

//     // Update the amount inputs to reflect the permuted digits
//     createAmountInputs(digits);
// }

// function createAmountInputs(digits) {
//     const amountInputsDiv = document.getElementById('amountInputs');
//     amountInputsDiv.innerHTML = ''; // Clear existing inputs

//     // Create new input fields for the permuted digits
//     digits.forEach(digit => {
//         const amountInput = document.createElement('input');
//         amountInput.type = 'number';
//         amountInput.name = `amounts[${digit}]`;
//         amountInput.id = `amount_${digit}`;
//         amountInput.placeholder = `Amount for ${digit}`;
//         amountInput.value = '100'; // Default amount
//         amountInput.min = '100';
//         amountInput.max = '5000';
//         amountInput.classList.add('form-control', 'mt-2');
//         amountInput.onchange = updateTotalAmount; // Bind the onchange event
//         amountInputsDiv.appendChild(amountInput); // Append the new input field
//     });

//     updateTotalAmount(); // Update the total amount
// }
</script>