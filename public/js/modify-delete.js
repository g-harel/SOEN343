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
            // its checked the radio button checked by the admin
            radioCheckerFn = function (adminChoice, choices) {
                if(adminChoice === "Yes") {
                    choices.eq(0).prop("checked", "checked"); // Yes
                } else {
                    choices.eq(1).prop("checked", "checked"); // No
                }
            };
            // for select drop downs
            // it adds "selected" in option item based
            genericOptionSelector = function (form, idSelector, adminSelected) {
                $.each(form.find(idSelector), function () {
                    let brandOption = $(this).find("option");
                    for (let i = 0; i < brandOption.length; i++) {
                        if (brandOption.eq(i).attr("title") === adminSelected) {
                            brandOption.eq(i).prop("selected", "selected");
                        }
                        if (brandOption.eq(i).val() === adminSelected) {
                            brandOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
            };
            editDeleteMonitor.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let monitorElements = [];
                rowElements.each(function () {
                    monitorElements.push($(this).text());
                });
                let form = editDeleteMonitor.modal.find('.modal-body > form');
                genericOptionSelector(form, "#monitor-brand", monitorElements[1]);
                genericOptionSelector(form, "#monitor-display-size", monitorElements[4]);
                form.find("#monitor-id").val(monitorElements[0]);
                form.find("#monitor-price").val(monitorElements[2]);
                form.find("#monitor-weight").val(monitorElements[5]);
                $(editDeleteMonitor.modal).modal('show');
                event.preventDefault();
                return false;
            });
            editDeleteDesktop.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let desktopElements = [];
                rowElements.each(function () {
                    desktopElements.push($(this).text());
                });
                let form = editDeleteDesktop.modal.find('.modal-body > form');
                genericOptionSelector(form, "#computer-brand", desktopElements[1]);
                genericOptionSelector(form, "#desktop-processor", desktopElements[4]);
                genericOptionSelector(form, "#desktop-ram-size", desktopElements[5]);
                genericOptionSelector(form, "#storage-capacity", desktopElements[7]);
                genericOptionSelector(form, "#cpu-cores", desktopElements[6]);
                form.find("#desktop-price").val(desktopElements[2]);
                form.find("#desktop-weight").val(desktopElements[8]);
                form.find("#desktop-height").val(desktopElements[9]);
                form.find("#desktop-width").val(desktopElements[10]);
                form.find("#desktop-thickness").val(desktopElements[11]);
                $(editDeleteDesktop.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDeleteTablet.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let tabletElements = [];
                rowElements.each(function () {
                    tabletElements.push($(this).text());
                });
                console.log(tabletElements);
                let form = editDeleteTablet.modal.find('.modal-body > form');
                genericOptionSelector(form, "#tablet-brand", tabletElements[1]);
                genericOptionSelector(form, "#tablet-processor", tabletElements[4]);
                genericOptionSelector(form, "#tablet-ram-size", tabletElements[5]);
                genericOptionSelector(form, "#tablet-storage-capacity", tabletElements[8]);
                genericOptionSelector(form, "#tablet-cpu-cores", tabletElements[7]);
                genericOptionSelector(form, "#tablet-os", tabletElements[14]);
                genericOptionSelector(form, "#tablet-display-size", tabletElements[9]);
                let cameraChoice = form.find("[name=tablet-camera]");
                radioCheckerFn(tabletElements[15], cameraChoice);
                let touchscreenChoice = form.find("[name=tablet-touchscreen]");
                radioCheckerFn(tabletElements[16], touchscreenChoice);
                form.find("#tablet-id").val(tabletElements[0]);
                form.find("#tablet-price").val(tabletElements[2]);
                form.find("#tablet-weight").val(tabletElements[6]);
                form.find("#tablet-height").val(tabletElements[10]);
                form.find("#tablet-thickness").val(tabletElements[12]);
                form.find("#tablet-battery").val(tabletElements[13]);
                $(editDeleteTablet.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDeleteLaptop.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let laptopElements = [];
                rowElements.each(function () {
                    laptopElements.push($(this).text());
                });
                let form = editDeleteLaptop.modal.find('.modal-body > form');
                genericOptionSelector(form, "#laptop-brand", laptopElements[1]);
                genericOptionSelector(form, "#laptop-processor", laptopElements[4]);
                genericOptionSelector(form, "#laptop-ram-size", laptopElements[5]);
                genericOptionSelector(form, "#laptop-cpu-cores", laptopElements[7]);
                genericOptionSelector(form, "#laptop-storage-capacity", laptopElements[8]);
                genericOptionSelector(form, "#laptop-display-size", laptopElements[9]);
                genericOptionSelector(form, "#laptop-os", laptopElements[11]);
                let cameraChoice = form.find("[name=laptop-camera]");
                radioCheckerFn(laptopElements[12], cameraChoice);
                let touchscreenChoice = form.find("[name=laptop-touchscreen]");
                radioCheckerFn(laptopElements[13], touchscreenChoice);
                form.find("#laptop-price").val(laptopElements[2]);
                form.find("#laptop-weight").val(laptopElements[6]);
                form.find("#laptop-battery").val(laptopElements[10]);
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
