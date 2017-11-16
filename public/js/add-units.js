$(document).ready(() => {
    $('.generate-serial-form').on('click', function () {
        const fields = $('#monitor-units').val();
        const value = '<input type="text" id="serial-number" value="" class="form-control">';
        console.log(fields);
        for(let i = 0; i < fields; i++){
            $('#monitor-form-units').find('#serial-forms').append('<div class="form-group">' + '<label>Serial # '+(i+1)+'</label>' +
                '<input type="text" id="serial-number" value="'+randomString()+'" class="form-control"></div>');
        }
         $(this).remove();
    })
});

function randomString(length, chars) {
    chars ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    length = 5;
    let result = '';
    for (let i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}
