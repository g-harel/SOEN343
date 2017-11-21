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
    for (let i = alphaLen; i > 0; --i) {
        result += chars[Math.floor(Math.random() * chars.length)];
    }
    const generated = (generateNum() + result);
    return generated.substr(0, alphaNumLen);
}

function serialInputs(fields, form) {
    const h = null;
    for (let i = 0; i < fields; i++) {
        form.find('#units-inputs-container').append(`<div class="form-group serial-number">
        <label>Serial #${i + 1}</label>
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
            modal: '.addUnitsMonitorLink',
            nextBtn: $('input[name=monitor-serial]'),
            emptyVal() {
                formUnits.monitor.form.find('#units-inputs-container').empty();
                formUnits.hideNext();
            },
        },
        desktop: {
            form: $('form#desktop-form-units'),
            modal: '.addUnitsDesktopLink',
            nextBtn: $('input[name=desktop-serial]'),
            emptyVal() {
                formUnits.desktop.form.find('#units-inputs-container').empty();
                formUnits.hideNext();
            },
        },
        laptop: {
            form: $('form#laptop-form-units'),
            modal: '.addUnitsLaptopLink',
            nextBtn: $('input[name=laptop-serial]'),
            emptyVal() {
                formUnits.laptop.form.find('#units-inputs-container').empty();
                formUnits.hideNext();
            },
        },
        tablet: {
            form: $('form#tablet-form-units'),
            modal: '.addUnitsTabletLink',
            nextBtn: $('input[name=tablet-serial]'),
            emptyVal() {
                formUnits.tablet.form.find('#units-inputs-container').empty();
                formUnits.hideNext();
            },
        },
    };
    const specs = [
        formUnits.monitor,
        formUnits.desktop,
        formUnits.laptop,
        formUnits.tablet,
    ];
    specs.forEach((element) => { // populate the units modal on click 'Next' btn
        $(element.nextBtn).on('click', () => {
            const fields = $(element.form).find('#num-of-units').val();
            if (fields === '0' || fields === '') {
                return false;
            }
            serialInputs(fields, element.form);
            formUnits.displayNext();
            return true;
        });
    });
    specs.forEach((element) => { // empty the units modal on close
        $(`.modal${element.modal}`).on('hidden.bs.modal', () => {
            element.emptyVal();
            element.form.find('input#num-of-units').val(0);
        });
    });
    specs.forEach((element) => { // passed unit number to the hidden input use for 'Add Units'
        $(element.modal).on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const itemID = button.data('id');
            const modal = $(this);
            modal.find('.modal-body input[type=hidden][name=item-id]').attr('value', itemID);
        });
    });
});

