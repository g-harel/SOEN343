let ModifyDelete = (function () {
    let editDeleteMonitor = null;
    let editDeleteDesktop = null;
    let editDeleteTablet = null;
    let editDeleteLaptop = null;
    let radioCheckerFn = null;
    let genericOptionSelector = null;
    return {
        init: function () {
            editDeleteMonitor = {
                editLink: $('.edit-monitor-link'),
                modal: $('.bs-edit-monitor-modal-lg'),
                deleteLink: $('#delMonitorLink')
            };
            editDeleteDesktop = {
                editLink: $('.edit-desktop-link'),
                modal: $('.bs-edit-desktop-modal-lg'),
                deleteLink: $('#delDesktopLink')
            };
            editDeleteTablet = {
                editLink: $('.edit-tablet-link'),
                modal: $('.bs-edit-tablet-modal-lg'),
                deleteLink: $('#delTabletLink')
            };
            editDeleteLaptop = {
                editLink: $('.edit-laptop-link'),
                modal: $('.bs-edit-laptop-modal-lg'),
                deleteLink: $('#delLaptopLink')
            };
            this.bindModifyActions();
            this.bindDeleteActions();
        },
        bindModifyActions: function () {
            /**
             * @param adminChoice - text from the clicked row
             * @param choices
             */
            radioCheckerFn = function (adminChoice, choices) {
                if(adminChoice === "Yes") {
                    choices.eq(0).prop("checked", "checked"); // Yes
                } else {
                    choices.eq(1).prop("checked", "checked"); // No
                }
            };
            /**
             * Adds "selected" in select drop down based
             * on the text value in clicked row
             * @param form
             * @param idSelector
             * @param adminSelected
             */
            genericOptionSelector = function (form, idSelector, adminSelected) {
                $.each(form.find(idSelector), function () {
                    let option = $(this).find("option");
                    for (let i = 0; i < option.length; i++) {
                        if (option.eq(i).attr("title") === adminSelected) {
                            option.eq(i).prop("selected", "selected");
                        }
                    }
                });
            };

            editDeleteMonitor.editLink.click(function (event) {
                let tableRow = $(this).parentsUntil('table');
                // get field text from clicked table row
                let id = tableRow.find("[data-id]").text();
                let brand = tableRow.find("[data-brand]").text();
                let price = tableRow.find("[data-price]").text();
                let weight = tableRow.find("[data-weight]").text();
                let displaySize = tableRow.find("[data-displaySize]").text();

                // populate the form modal with the obtained text above
                let form = editDeleteMonitor.modal.find('.modal-body > form#monitor-form');
                genericOptionSelector(form, "#monitor-brand", brand);
                genericOptionSelector(form, "#monitor-display-size", displaySize);
                form.find("#monitor-id").val(id);
                form.find("#monitor-price").val(price);
                form.find("#monitor-weight").val(weight);

                // finally show the modal
                $(editDeleteMonitor.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDeleteDesktop.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                // get field text from clicked table row
                let id = tableRow.find("[data-id]").text();
                let brand = tableRow.find("[data-brand]").text();
                let processor = tableRow.find("[data-processor]").text();
                let ramSize = tableRow.find("[data-ramSize]").text();
                let capacity = tableRow.find("[data-hddSize]").text();
                let cpuCores = tableRow.find("[data-cpuCores]").text();
                let price = tableRow.find("[data-price]").text();
                let weight = tableRow.find("[data-weight]").text();
                let height = tableRow.find("[data-height]").text();
                let width = tableRow.find("[data-width]").text();
                let thickness = tableRow.find("[data-thickness]").text();

                // populate the form modal with the obtained text above
                let form = editDeleteDesktop.modal.find('.modal-body > form#desktop-form');
                genericOptionSelector(form, "#computer-brand", brand);
                genericOptionSelector(form, "#desktop-processor", processor);
                genericOptionSelector(form, "#desktop-ram-size", ramSize);
                genericOptionSelector(form, "#storage-capacity", capacity);
                genericOptionSelector(form, "#cpu-cores", cpuCores);
                form.find("#desktop-price").val(price);
                form.find("#desktop-weight").val(weight);
                form.find("#desktop-height").val(height);
                form.find("#desktop-width").val(width);
                form.find("#desktop-thickness").val(thickness);

                $(editDeleteDesktop.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDeleteTablet.editLink.click(function (event){
                let tableRow = $(this).parentsUntil("table");
                // get field text from clicked table row
                let id = tableRow.find("[data-id]").text();
                let brand = tableRow.find("[data-brand]").text();
                let price = tableRow.find("[data-price]").text();
                let qty = tableRow.find("[data-qty]").text();
                let processor = tableRow.find("[data-processor]").text();
                let ramSize = tableRow.find("[data-ramSize]").text();
                let weight = tableRow.find("[data-weight]").text();
                let cpuCores = tableRow.find("[data-cpuCores]").text();
                let capacity = tableRow.find("[data-hddSize]").text();
                let displaySize = tableRow.find("[data-displaySize]").text();
                let height = tableRow.find("[data-height]").text();
                let width = tableRow.find("[data-width]").text();
                let thickness = tableRow.find("[data-thickness]").text();
                let battery = tableRow.find("[data-battery]").text();
                let os = tableRow.find("[data-os]").text();
                let camera = tableRow.find("[data-camera]").text();
                let touchscreen = tableRow.find("[data-touchscreen]").text();

                let form = editDeleteTablet.modal.find(".modal-body > form#tablet-form");
                genericOptionSelector(form, "#tablet-brand", brand);
                genericOptionSelector(form, "#tablet-processor", processor);
                genericOptionSelector(form, "#tablet-ram-size", ramSize);
                genericOptionSelector(form, "#tablet-storage-capacity", capacity);
                genericOptionSelector(form, "#tablet-cpu-cores", cpuCores);
                genericOptionSelector(form, "#tablet-os", os);
                genericOptionSelector(form, "#tablet-display-size", displaySize);
                let cameraChoice = form.find("[name=tablet-camera]");
                radioCheckerFn(camera, cameraChoice);
                let touchscreenChoice = form.find("[name=tablet-touchscreen]");
                radioCheckerFn(touchscreen, touchscreenChoice);
                form.find("#tablet-id").val(id);
                form.find("#tablet-price").val(price);
                form.find("#tablet-weight").val(weight);
                form.find("#tablet-height").val(height);
                form.find("#tablet-thickness").val(thickness);
                form.find("#tablet-battery").val(battery);

                $(editDeleteTablet.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDeleteLaptop.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let id =  tableRow.find("[data-id]").text();
                let brand =  tableRow.find("[data-brand]").text();
                let price =  tableRow.find("[data-price]").text();
                let qty =  tableRow.find("[data-qty]").text();
                let processor =  tableRow.find("[data-processor]").text();
                let ramSize =  tableRow.find("[data-ramSize]").text();
                let weight =  tableRow.find("[data-weight]").text();
                let cpuCores =  tableRow.find("[data-cpuCores]").text();
                let capacity =  tableRow.find("[data-hddSize]").text();
                let displaySize =  tableRow.find("[data-displaySize]").text();
                let battery =  tableRow.find("[data-battery]").text();
                let os =  tableRow.find("[data-os]").text();
                let camera =  tableRow.find("[data-camera]").text();
                let touchscreen =  tableRow.find("[data-touchscreen]").text();

                let form = editDeleteLaptop.modal.find('.modal-body > form#laptop-form');
                genericOptionSelector(form, "#laptop-brand", brand);
                genericOptionSelector(form, "#laptop-processor", processor);
                genericOptionSelector(form, "#laptop-ram-size", ramSize);
                genericOptionSelector(form, "#laptop-cpu-cores", cpuCores);
                genericOptionSelector(form, "#laptop-storage-capacity", capacity);
                genericOptionSelector(form, "#laptop-display-size", displaySize);
                genericOptionSelector(form, "#laptop-os", os);
                let cameraChoice = form.find("[name=laptop-camera]");
                radioCheckerFn(camera, cameraChoice);
                let touchscreenChoice = form.find("[name=laptop-touchscreen]");
                radioCheckerFn(touchscreen, touchscreenChoice);
                form.find("#laptop-price").val(price);
                form.find("#laptop-weight").val(weight);
                form.find("#laptop-battery").val(battery);

                $(editDeleteLaptop.modal).modal('show');
                event.preventDefault();
                return false;
            });
        },
        bindDeleteActions: function () {
            let delete_links = [
                editDeleteLaptop.deleteLink,
                editDeleteTablet.deleteLink,
                editDeleteDesktop.deleteLink,
                editDeleteMonitor.deleteLink
            ];
            for(let i = 0; i < delete_links.length; i++) {
                delete_links[i].on('show.bs.modal', function (event) {
                    let link = $(event.relatedTarget);
                    let qty = link.data('qty');
                    let itemId = link.data('id');
                    let modal = $(this);
                    modal.find('.modal-body input[type=number]').val(1);
                    modal.find('.modal-body input[type=hidden]').val(itemId);
                    modal.find('.modal-body input[type=number]').attr('max', (qty - 1));
                });
            }
        }
    };
})();

$(document).ready(function () {
    ModifyDelete.init();
});
