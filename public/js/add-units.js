$(document).ready(() => {
    const formUnits = {
        unitForm: $('#serial-next'),
        hideNext: function() {
            formUnits.unitForm.removeClass('hidden');
        },
        displayNext: function () {
            formUnits.unitForm.addClass('hidden');
        },
        monitor: {
            form: $('form#monitor-form-units'),
            unitInput: $('#monitor-units'),
            modal: '.addUnitsMonitorLink',
            emptyVal: function () {
                formUnits.monitor.form.find('#units-inputs-container').empty();
                formUnits.monitor.unitInput.val(0);
                formUnits.hideNext();
            }
        },
        desktop: {
            form: $('form#desktop-form-units'),
            unitInput: $('#desktop-units'),
            modal: '.addUnitsDesktopLink',
            emptyVal: function () {
                formUnits.desktop.form.find('#units-inputs-container').empty();
                formUnits.desktop.unitInput.val(0);
                formUnits.hideNext();
            }
        },
        laptop: {
            form: $('form#laptop-form-units'),
            unitInput: $('#laptop-units'),
            modal: '.addUnitsLaptopLink',
            emptyVal: function () {
                formUnits.laptop.form.find('#units-inputs-container').empty();
                formUnits.laptop.unitInput.val(0);
                formUnits.hideNext();
            }
        },
        tablet: {
            form: $('form#tablet-form-units'),
            unitInput: $('#tablet-units'),
            modal: '.addUnitsTabletLink',
            nextBtn: 'monitor-serial-next-btn',
            emptyVal: function () {
                formUnits.tablet.form.find('#units-inputs-container').empty();
                formUnits.tablet.unitInput.val(0);
                formUnits.hideNext();
            }
        }
    };
    $(".modal"+formUnits.monitor.modal+"").on("hidden.bs.modal", function() {
        formUnits.monitor.emptyVal();
    });
    $(".modal"+formUnits.desktop.modal+"").on("hidden.bs.modal", function() {
        formUnits.desktop.emptyVal();
    });
    $(".modal"+formUnits.laptop.modal+"").on("hidden.bs.modal", function() {
        formUnits.laptop.emptyVal();
    });
    $(".modal"+formUnits.tablet.modal+"").on("hidden.bs.modal", function() {
        formUnits.tablet.emptyVal();
    });
    $('input[name=monitor-serial]').on('click', function () {
        let fields = formUnits.monitor.unitInput.val();
        serialInputs(fields, formUnits.monitor.form);
        formUnits.displayNext();
    });
    $('input[name=laptop-serial]').on('click', function () {
        let fields = formUnits.laptop.unitInput.val();
        serialInputs(fields, formUnits.laptop.form);
        formUnits.displayNext();
    });
    $('input[name=desktop-serial]').on('click', function () {
        let fields = formUnits.desktop.unitInput.val();
        serialInputs(fields, formUnits.desktop.form);
        formUnits.displayNext();
    });
    $('input[name=tablet-serial]').on('click', function () {
        let fields = formUnits.tablet.unitInput.val();
        serialInputs(fields, formUnits.tablet.form);
        formUnits.displayNext();
    });
});

function serialInputs(fields, form) {
    let h = null;
    for(let i = 0; i < fields; i++){
        form.find('#units-inputs-container').append(`<div class="form-group serial-number">
        <label>Serial #</label>
        <input type="text" id="serial-number" name="serial${i}" value="${randomString()}" class="form-control">
        </div>`);
    }
    return h;
}
$('#addUnitsMonitorLink').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); // Button that triggered the modal
    const itemID = button.data('id'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    const modal = $(this);
    console.log(itemID);
    modal.find('.modal-body input[type=hidden]#monitor-id').attr('value',itemID);

});

$('#addUnitsLaptopLink').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); // Button that triggered the modal
    const itemID = button.data('id'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    const modal = $(this);
    console.log(itemID);
    modal.find('.modal-body input[type=hidden]#laptop-id').attr('value',itemID);

});

function randomString() {
    let chars ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let len = 5;
    let result = '';
    for (let i = len; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}