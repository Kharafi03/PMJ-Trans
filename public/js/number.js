document.addEventListener('DOMContentLoaded', function() {
    const numberInputs = document.querySelectorAll('input[type="number"]');

    numberInputs.forEach(function(input) {
        // Prevent "-" from being entered
        input.addEventListener('keypress', function(event) {
            if (event.which === 45 || event.key === '-') {
                event.preventDefault();
            }
        });

        // Remove any negative signs that might have been pasted
        input.addEventListener('input', function() {
            let value = input.value;
            if (value.indexOf('-') !== -1) {
                input.value = value.replace('-', '');
            }
        });

        // Ensure no negative value remains after input loses focus
        input.addEventListener('blur', function() {
            let value = input.value;
            if (value < 0) {
                input.value = Math.abs(value); // Convert negative to positive
            }
        });
    });
});