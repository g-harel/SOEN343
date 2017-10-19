let ModifyDelete = (function () {
    let editDeleteMonitor = null;
    let editDeleteDesktop = null;
    let editDeleteTablet = null;
    let editDeleteLaptop = null;
    let radioCheckerFn = null;
    let genericOptionSelector = null;
    let dataAttr = {
            id: "[data-id]",
            brand: "[data-brand]",
            price: "[data-price]",
            qty: "[data-qty]",
            processor: "[data-processor]",
            ramSize: "[data-ramSize]",
            weight: "[data-weight]",
            cpuCores: "[data-cpuCores]",
            capacity: "[data-hddSize]",
            displaySize: "[data-displaySize]",
            height: "[data-height]",
            width: "[data-width]",
            thickness: "[data-thickness]",
            battery: "[data-battery]",
            os: "[data-os]",
            camera: "[data-camera]",
            touchscreen: "[data-touchscreen]"
        };
    return {
        init: function () {
            editDeleteMonitor = {
                editLink: $(".edit-monitor-link"),
                modal: $(".bs-edit-monitor-modal-lg"),
                deleteLink: $("#delMonitorLink")
            };
            editDeleteDesktop = {
                editLink: $(".edit-desktop-link"),
                modal: $(".bs-edit-desktop-modal-lg"),
                deleteLink: $("#delDesktopLink")
            };
            editDeleteTablet = {
                editLink: $(".edit-tablet-link"),
                modal: $(".bs-edit-tablet-modal-lg"),
                deleteLink: $("#delTabletLink")
            };
            editDeleteLaptop = {
                editLink: $(".edit-laptop-link"),
                modal: $(".bs-edit-laptop-modal-lg"),
                deleteLink: $("#delLaptopLink")
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
                let tr = $(this).parentsUntil("table");
                let form = editDeleteMonitor.modal.find('.modal-body > form#monitor-form');

                genericOptionSelector(form, "#monitor-brand", tr.find(dataAttr.brand).text());
                genericOptionSelector(form, "#monitor-display-size", tr.find(dataAttr.displaySize).text());
                form.find("#monitor-id").val(tr.find(dataAttr.id).text());
                form.find("#monitor-price").val(tr.find(dataAttr.price).text());
                form.find("#monitor-weight").val(tr.find(dataAttr.weight).text());

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
                let tr = $(this).parentsUntil("table");
                let form = editDeleteTablet.modal.find(".modal-body > form#tablet-form");

                // tablet drop downs
                genericOptionSelector(form, "#tablet-brand", tr.find(dataAttr.brand).text());
                genericOptionSelector(form, "#tablet-processor", tr.find(dataAttr.processor).text());
                genericOptionSelector(form, "#tablet-ram-size", tr.find(dataAttr.ramSize).text());
                genericOptionSelector(form, "#tablet-storage-capacity", tr.find(dataAttr.capacity).text());
                genericOptionSelector(form, "#tablet-cpu-cores", tr.find(dataAttr.cpuCores).text());
                genericOptionSelector(form, "#tablet-os", tr.find(dataAttr.os).text());
                genericOptionSelector(form, "#tablet-display-size", tr.find(dataAttr.displaySize).text());

                // tablet radio buttons
                let cameraChoice = form.find("[name=tablet-camera]");
                radioCheckerFn(tr.find(dataAttr.camera).text(), cameraChoice);
                let touchscreenChoice = form.find("[name=tablet-touchscreen]");
                radioCheckerFn(tr.find(dataAttr.touchscreen).text(), touchscreenChoice);

                // tablet input fields
                form.find("#tablet-id").val(tr.find(dataAttr.id).text());
                form.find("#tablet-price").val(tr.find(dataAttr.price).text());
                form.find("#tablet-weight").val(tr.find(dataAttr.weight).text());
                form.find("#tablet-height").val(tr.find(dataAttr.height).text());
                form.find("#tablet-thickness").val(tr.find(dataAttr.thickness).text());
                form.find("#tablet-battery").val(tr.find(dataAttr.battery).text());

                $(editDeleteTablet.modal).modal("show");
                event.preventDefault();
                return false;
            });

            editDeleteLaptop.editLink.click(function (event){
                let tr = $(this).parentsUntil("table");
                let form = editDeleteLaptop.modal.find(".modal-body > form#laptop-form");

                // laptop drop down fields
                genericOptionSelector(form, "#laptop-brand", tr.find(dataAttr.brand).text());
                genericOptionSelector(form, "#laptop-processor", tr.find(dataAttr.processor).text());
                genericOptionSelector(form, "#laptop-ram-size", tr.find(dataAttr.ramSize).text());
                genericOptionSelector(form, "#laptop-cpu-cores", tr.find(dataAttr.cpuCores).text());
                genericOptionSelector(form, "#laptop-storage-capacity", tr.find(dataAttr.capacity).text());
                genericOptionSelector(form, "#laptop-display-size", tr.find(dataAttr.displaySize).text());
                genericOptionSelector(form, "#laptop-os", tr.find(dataAttr.os).text());

                // laptop radio buttons
                let cameraChoice = form.find("[name=laptop-camera]");
                radioCheckerFn(tr.find(dataAttr.camera).text(), cameraChoice);
                let touchscreenChoice = form.find("[name=laptop-touchscreen]");
                radioCheckerFn(tr.find(dataAttr.touchscreen).text(), touchscreenChoice);

                // laptop input fields
                form.find("#laptop-price").val(tr.find(dataAttr.price).text());
                form.find("#laptop-weight").val(tr.find(dataAttr.weight).text());
                form.find("#laptop-battery").val(tr.find(dataAttr.battery).text());

                $(editDeleteLaptop.modal).modal("show");
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
