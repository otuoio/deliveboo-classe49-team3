let inputs = document.querySelectorAll('.validationCB');
let radioForCheckboxes = document.getElementById('radio-for-checkboxes');

function checkCheckboxes () {
    let isAtLeastOneCheckboxSelected = false;
    for(let i = inputs.length-1; i >= 0; i--) {
        if (inputs[i].checked) isAtLeastOneCheckboxSelected = true;
    }
    radioForCheckboxes.checked = isAtLeastOneCheckboxSelected
};

for(let i = inputs.length-1; i >= 0; i--) {
    inputs[i].addEventListener('change', checkCheckboxes)
};