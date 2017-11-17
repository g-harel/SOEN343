function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validatePostalCode(code) {
    const regex = /^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/;
    return regex.test(code);
}
/*
 * register
 */
$(document).ready(() => {
    $('.number').keydown((e) => {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $('form').on('submit', (e) => {
        // validation code
        const emailHelp = $('#emailHelp');
        const postalHelp = $('#postalHelp');
        $('#result').text('');
        const email = $('#email').val();
        if (!validateEmail(email)) {
            emailHelp.text(`${email} is not a valid email.`);
            emailHelp.css('color', 'red');
            e.preventDefault();
        }

        const code = $('#postal_code').val();
        if (!validatePostalCode(code)) {
            postalHelp.text(`${code} is not a valid postal Code.`);
            postalHelp.css('color', 'red');
            e.preventDefault();
        }
    });
});
