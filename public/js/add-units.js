function generateNum() {
    let num = '';
    for (let i = 0; i <= 2; i++) {
        num += Math.floor(Math.random() * 10) + 1;
    }
    return num;
}

function generateAlphaNumStr() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const alphaLen = 6;
    const alphaNumLen = 9;
    let result = '';
    for (let i = alphaLen; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    const generated = (generateNum() + result);
    return generated.substr(0, alphaNumLen);
}

function serialInputs(fields, form) {
    const h = null;
    for (let i = 0; i < fields; i++) {
        form.find('#units-inputs-container').append(`<div class="form-group serial-number">
        <label>Serial #${i +1}</label>
        <input type="text" id="serial-number" name="serial${i}" value="${generateAlphaNumStr()}" class="form-control" readonly>
        </div>`);
    }
    return h;
}

$(document).ready(() => {
    const formUnits = {
        unitForm: $('#serial-next'),
        hideNext() {
            formUnits.unitForm.removeClass('hidden');
        },
        displayNext() {
            formUnits.unitForm.addClass('hidden');
        },
        monitor: {
            form: $('form#monitor-form-units'),
            unitInput: $('#monitor-units'),
            modal: '.addUnitsMonitorLink',
            emptyVal() {
                formUnits.monitor.form.find('#units-inputs-container').empty();
                formUnits.monitor.unitInput.val(0);
                formUnits.hideNext();
            },
        },
        desktop: {
            form: $('form#desktop-form-units'),
            unitInput: $('#desktop-units'),
            modal: '.addUnitsDesktopLink',
            emptyVal() {
                formUnits.desktop.form.find('#units-inputs-container').empty();
                formUnits.desktop.unitInput.val(0);
                formUnits.hideNext();
            },
        },
        laptop: {
            form: $('form#laptop-form-units'),
            unitInput: $('#laptop-units'),
            modal: '.addUnitsLaptopLink',
            emptyVal() {
                formUnits.laptop.form.find('#units-inputs-container').empty();
                formUnits.laptop.unitInput.val(0);
                formUnits.hideNext();
            },
        },
        tablet: {
            form: $('form#tablet-form-units'),
            unitInput: $('#tablet-units'),
            modal: '.addUnitsTabletLink',
            nextBtn: 'monitor-serial-next-btn',
            emptyVal() {
                formUnits.tablet.form.find('#units-inputs-container').empty();
                formUnits.tablet.unitInput.val(0);
                formUnits.hideNext();
            },
        },
    };
    $(`.modal${formUnits.monitor.modal}`).on('hidden.bs.modal', () => {
        formUnits.monitor.emptyVal();
    });
    $(`.modal${formUnits.desktop.modal}`).on('hidden.bs.modal', () => {
        formUnits.desktop.emptyVal();
    });
    $(`.modal${formUnits.laptop.modal}`).on('hidden.bs.modal', () => {
        formUnits.laptop.emptyVal();
    });
    $(`.modal${formUnits.tablet.modal}`).on('hidden.bs.modal', () => {
        formUnits.tablet.emptyVal();
    });
    $('input[name=monitor-serial]').on('click', () => {
        const fields = formUnits.monitor.unitInput.val();
        serialInputs(fields, formUnits.monitor.form);
        formUnits.displayNext();
    });
    $('input[name=laptop-serial]').on('click', () => {
        const fields = formUnits.laptop.unitInput.val();
        serialInputs(fields, formUnits.laptop.form);
        formUnits.displayNext();
    });
    $('input[name=desktop-serial]').on('click', () => {
        const fields = formUnits.desktop.unitInput.val();
        serialInputs(fields, formUnits.desktop.form);
        formUnits.displayNext();
    });
    $('input[name=tablet-serial]').on('click', () => {
        const fields = formUnits.tablet.unitInput.val();
        serialInputs(fields, formUnits.tablet.form);
        formUnits.displayNext();
    });
});

$('#addUnitsMonitorLink').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const itemID = button.data('id');
    const modal = $(this);
    modal.find('.modal-body input[type=hidden]#monitor-id').attr('value', itemID);
});

$('#addUnitsDesktopLink').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const itemID = button.data('id');
    const modal = $(this);
    modal.find('.modal-body input[type=hidden]#desktop-id').attr('value', itemID);
});

$('#addUnitsTabletLink').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const itemID = button.data('id');
    const modal = $(this);
    modal.find('.modal-body input[type=hidden]#tablet-id').attr('value', itemID);
});

$('#addUnitsLaptopLink').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const itemID = button.data('id');
    const modal = $(this);
    modal.find('.modal-body input[type=hidden]#laptop-id').attr('value', itemID);
});
