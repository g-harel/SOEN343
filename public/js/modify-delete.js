const ModifyDelete = (() => {
    let editDeleteMonitor = null;
    let editDeleteDesktop = null;
    let editDeleteTablet = null;
    let editDeleteLaptop = null;
    let radioCheckerFn = null;
    let genericOptionSelector = null;
    const dataAttr = {
        id: '[data-id]',
        brand: '[data-brand]',
        price: '[data-price]',
        qty: '[data-qty]',
        processor: '[data-processor]',
        ramSize: '[data-ramSize]',
        weight: '[data-weight]',
        cpuCores: '[data-cpuCores]',
        capacity: '[data-hddSize]',
        displaySize: '[data-displaySize]',
        height: '[data-height]',
        width: '[data-width]',
        thickness: '[data-thickness]',
        battery: '[data-battery]',
        os: '[data-os]',
        camera: '[data-camera]',
        touchscreen: '[data-touchscreen]',
    };
    return {
        init() {
            editDeleteMonitor = {
                editLink: $('.edit-monitor-link'),
                modal: $('.bs-edit-monitor-modal-lg'),
                deleteLink: $('#delMonitorLink'),
            };
            editDeleteDesktop = {
                editLink: $('.edit-desktop-link'),
                modal: $('.bs-edit-desktop-modal-lg'),
                deleteLink: $('#delDesktopLink'),
            };
            editDeleteTablet = {
                editLink: $('.edit-tablet-link'),
                modal: $('.bs-edit-tablet-modal-lg'),
                deleteLink: $('#delTabletLink'),
            };
            editDeleteLaptop = {
                editLink: $('.edit-laptop-link'),
                modal: $('.bs-edit-laptop-modal-lg'),
                deleteLink: $('#delLaptopLink'),
            };
            this.ModifyDelete.bindModifyActions();
            this.ModifyDelete.bindDeleteActions();
        },
        bindModifyActions() {
            /**
             * Checked radio button based on the value
             * of Touchscreen and Camera clicked row
             * @param adminChoice - text from the clicked row
             * @param choices
             */
            radioCheckerFn = function (adminChoice, choices) {
                if (adminChoice.toLowerCase() === 'yes' || adminChoice === 1 || adminChoice === '1') {
                    choices.eq(0).prop('checked', 'checked'); // Yes
                } else {
                    choices.eq(1).prop('checked', 'checked'); // No
                }
            };
            /**
             * Adds "selected" in select drop down option item based
             * on the text value in clicked row
             * @param form
             * @param idSelector
             * @param adminSelected
             */
            genericOptionSelector = (form, idSelector, adminSelected) => {
                $.each(form.find(idSelector), () => {
                    const option = $(this).find('option');
                    for (let i = 0; i < option.length; ++i) {
                        if (option.eq(i).attr('title') === adminSelected) {
                            option.eq(i).prop('selected', 'selected');
                        }
                    }
                });
            };

            editDeleteMonitor.editLink.click((event) => {
                const tr = $(this).parentsUntil('tbody');
                const form = editDeleteMonitor.modal.find('.modal-body > form#monitor-form');
                // monitor drop downs
                genericOptionSelector(form, '#monitor-brand', tr.find(dataAttr.brand).text());
                genericOptionSelector(form, '#monitor-display-size', tr.find(dataAttr.displaySize).text());
                // monitor input fields
                form.find('#monitor-id').val(tr.find(dataAttr.id).text());
                form.find('#monitor-price').val(tr.find(dataAttr.price).text());
                form.find('#monitor-weight').val(tr.find(dataAttr.weight).text());

                $(editDeleteMonitor.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDeleteDesktop.editLink.click((event) => {
                const tr = $(this).parentsUntil('tbody');
                const form = editDeleteDesktop.modal.find('.modal-body > form#desktop-form');
                // desktop drop downs
                genericOptionSelector(form, '#computer-brand', tr.find(dataAttr.brand).text());
                genericOptionSelector(form, '#desktop-processor', tr.find(dataAttr.processor).text());
                genericOptionSelector(form, '#desktop-ram-size', tr.find(dataAttr.ramSize).text());
                genericOptionSelector(form, '#storage-capacity', tr.find(dataAttr.capacity).text());
                genericOptionSelector(form, '#cpu-cores', tr.find(dataAttr.cpuCores).text());
                // desktop input fields
                form.find('#desktop-price').val(tr.find(dataAttr.price).text());
                form.find('#desktop-weight').val(tr.find(dataAttr.weight).text());
                form.find('#desktop-height').val(tr.find(dataAttr.height).text());
                form.find('#desktop-width').val(tr.find(dataAttr.width).text());
                form.find('#desktop-thickness').val(tr.find(dataAttr.thickness).text());

                $(editDeleteDesktop.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDeleteTablet.editLink.click((event) => {
                const tr = $(this).parentsUntil('tbody');
                const form = editDeleteTablet.modal.find('.modal-body > form#tablet-form');
                // tablet drop downs
                genericOptionSelector(form, '#tablet-brand', tr.find(dataAttr.brand).text());
                genericOptionSelector(form, '#tablet-processor', tr.find(dataAttr.processor).text());
                genericOptionSelector(form, '#tablet-ram-size', tr.find(dataAttr.ramSize).text());
                genericOptionSelector(form, '#tablet-storage-capacity', tr.find(dataAttr.capacity).text());
                genericOptionSelector(form, '#tablet-cpu-cores', tr.find(dataAttr.cpuCores).text());
                genericOptionSelector(form, '#tablet-os', tr.find(dataAttr.os).text());
                genericOptionSelector(form, '#tablet-display-size', tr.find(dataAttr.displaySize).text());
                // tablet radio buttons
                const cameraChoice = form.find('[name=tablet-camera]');
                radioCheckerFn(tr.find(dataAttr.camera).text(), cameraChoice);
                const touchscreenChoice = form.find('[name=tablet-touchscreen]');
                radioCheckerFn(tr.find(dataAttr.touchscreen).text(), touchscreenChoice);
                // tablet input fields
                form.find('#tablet-id').val(tr.find(dataAttr.id).text());
                form.find('#tablet-price').val(tr.find(dataAttr.price).text());
                form.find('#tablet-weight').val(tr.find(dataAttr.weight).text());
                form.find('#tablet-height').val(tr.find(dataAttr.height).text());
                form.find('#tablet-thickness').val(tr.find(dataAttr.thickness).text());
                form.find('#tablet-battery').val(tr.find(dataAttr.battery).text());

                $(editDeleteTablet.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDeleteLaptop.editLink.click((event) => {
                const tr = $(this).parentsUntil('tbody');
                const form = editDeleteLaptop.modal.find('.modal-body > form#laptop-form');
                // laptop drop down fields
                genericOptionSelector(form, '#laptop-brand', tr.find(dataAttr.brand).text());
                genericOptionSelector(form, '#laptop-processor', tr.find(dataAttr.processor).text());
                genericOptionSelector(form, '#laptop-ram-size', tr.find(dataAttr.ramSize).text());
                genericOptionSelector(form, '#laptop-cpu-cores', tr.find(dataAttr.cpuCores).text());
                genericOptionSelector(form, '#laptop-storage-capacity', tr.find(dataAttr.capacity).text());
                genericOptionSelector(form, '#laptop-display-size', tr.find(dataAttr.displaySize).text());
                genericOptionSelector(form, '#laptop-os', tr.find(dataAttr.os).text());
                // laptop radio buttons
                const cameraChoice = form.find('[name=laptop-camera]');
                radioCheckerFn(tr.find(dataAttr.camera).text(), cameraChoice);
                const touchscreenChoice = form.find('[name=laptop-touchscreen]');
                radioCheckerFn(tr.find(dataAttr.touchscreen).text(), touchscreenChoice);
                // laptop input fields
                form.find('#laptop-price').val(tr.find(dataAttr.price).text());
                form.find('#laptop-weight').val(tr.find(dataAttr.weight).text());
                form.find('#laptop-battery').val(tr.find(dataAttr.battery).text());

                $(editDeleteLaptop.modal).modal('show');
                event.preventDefault();
                return false;
            });
        },
        bindDeleteActions() {
            const deleteLinks = [
                editDeleteLaptop.deleteLink,
                editDeleteTablet.deleteLink,
                editDeleteDesktop.deleteLink,
                editDeleteMonitor.deleteLink,
            ];
            for (let i = 0; i < deleteLinks.length; ++i) {
                deleteLinks[i].on('show.bs.modal', (event) => {
                    const link = $(event.relatedTarget);
                    const qty = link.data('qty');
                    const itemId = link.data('id');
                    const modal = $(this);
                    modal.find('.modal-body input[type=number]').val(1);
                    modal.find('.modal-body input[type=hidden]').val(itemId);
                    modal.find('.modal-body input[type=number]').attr('max', (qty - 1));
                });
            }
        },
    };
})();

$(document).ready(() => {
    ModifyDelete.init();
});
