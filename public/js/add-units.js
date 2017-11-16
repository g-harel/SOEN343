$(document).ready(() => {
    const formUnits = {
        unitForm: $('#serial-next'),
        monitor: {
            form: $('form#monitor-form-units'),
            unitInput: $('#monitor-units'),
            modal: '.addUnitsMonitorLink'
        }
    };
    $(".modal"+formUnits.monitor.modal+"").on("hidden.bs.modal", function() {
        formUnits.monitor.form.find('#units-inputs-container').empty();
        formUnits.monitor.unitInput.val(0);
        formUnits.unitForm.removeClass('hidden');
    });
    $('.generate-serial-form').on('click', function () {
        let fields = null;
        let appendElem = null;
        if($(this).attr('name', 'monitor-serial')) {
            console.log('hello');
            fields = formUnits.monitor.unitInput.val();
            appendElem = function(h) {
                formUnits.monitor.form.find('#units-inputs-container').append(h);
            }
        }
        for(let i = 0; i < fields; i++){
            appendElem(`<div class="form-group serial-number">
                <label>Serial #</label>
                <input type="text" id="serial-number" value="${randomString()}" class="form-control">
                </div>`)
        }
        formUnits.unitForm.addClass('hidden');
    })
});

function randomString() {
    let chars ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let len = 5;
    let result = '';
    for (let i = len; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}
