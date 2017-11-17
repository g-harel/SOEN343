$(document).ready(() => {
    const formUnits = {
        unitForm: $('#serial-next'),
        itemNextBtn: [
            'monitor-serial-next-btn',
            'desktop-serial-next-btn',
            'laptop-serial-next-btn',
            'tablet-serial-next-btn'
        ],
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
            nextBtn: 'monitor-serial-next-btn',
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
            nextBtn: 'monitor-serial-next-btn',
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
            nextBtn: 'monitor-serial-next-btn',
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
    $('.generate-serial-form').on('click', function () {
        let fields = null;
        let appendElem = null;
        for(let i = 0; i < formUnits.itemNextBtn.length; i++) {
            if($(this).attr('name', formUnits.itemNextBtn[i])) {
                fields = formUnits.monitor.unitInput.val();
                appendElem = function(h) {
                    formUnits.monitor.form.find('#units-inputs-container').append(h);
                }
            }
        }
        for(let i = 0; i < fields; i++){
            appendElem(`<div class="form-group serial-number">
                <label>Serial #</label>
                <input type="text" id="serial-number" name="serial${i}" value="${randomString()}" class="form-control">
                </div>`)
        }
        formUnits.displayNext();
    })

    $('#addUnitsMonitorLink').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget); // Button that triggered the modal
        const itemID = button.data('id'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        const modal = $(this);
        console.log(itemID);
        modal.find('.modal-body input[type=hidden]#monitor-id').attr('value',itemID);

    })
});


function randomString(){
        const editDeleteMonitor = {
            editLink: $('.edit-monitor-link'),
            modal: $('.bs-edit-monitor-modal-lg'),
            deleteLink: $('#delMonitorLink'),
        };
    let chars ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let len = 5;
    let result = '';
    for (let i = len; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
    return result;
}
