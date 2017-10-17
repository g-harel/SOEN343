let ft = new FormTemplates();
let ModifyDelete = (function () {
    let editDelete_Monitor = null;
    let editDelete_Desktop = null;
    let editDelete_Tablet = null;
    let editDelete_Laptop = null;
    return {
        init: function () {
            editDelete_Monitor = {
                editLink: $('.edit-monitor-link'),
                modal: $('.bs-edit-monitor-modal-lg'),
                deleteLink: $('#delMonitorLink')
            };
            editDelete_Desktop = {
                editLink: $('.edit-desktop-link'),
                modal: $('.bs-edit-desktop-modal-lg'),
                deleteLink: $('#delDesktopLink')
            };
            editDelete_Tablet = {
                editLink: $('.edit-tablet-link'),
                modal: $('.bs-edit-tablet-modal-lg'),
                deleteLink: $('#delTabletLink')
            };
            editDelete_Laptop = {
                editLink: $('.edit-laptop-link'),
                modal: $('.bs-edit-laptop-modal-lg'),
                deleteLink: $('#delLaptopLink')
            };
            this.bindModifyActions();
            this.bindDeleteActions();
        },
        bindModifyActions: function () {
            editDelete_Monitor.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let monitorElements = [];
                rowElements.each(function () {
                    monitorElements.push($(this).text());
                });
                let monitorInstance = {
                    id: monitorElements[0],
                    brand: monitorElements[1],
                    price: monitorElements[2],
                    displaySize: monitorElements[4],
                    weight: monitorElements[5]
                };
                editDelete_Monitor.modal.find('.modal-body > form').empty();
                editDelete_Monitor.modal.find('.modal-body > form').append(
                    ft.monitorForm(monitorInstance)
                );
                $(editDelete_Monitor.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDelete_Desktop.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let desktopElements = [];
                rowElements.each(function () {
                    desktopElements.push($(this).text());
                });
                let desktopInstance = {
                    id: desktopElements[0],
                    brand: desktopElements[1],
                    price: desktopElements[2],
                    processorType: desktopElements[4],
                    ramSize: desktopElements[5],
                    cpuCores: desktopElements[6],
                    storageSize: desktopElements[7],
                    weight: desktopElements[8],
                    height:desktopElements[9],
                    width: desktopElements[10],
                    thickness: desktopElements[11]
                };
                editDelete_Desktop.modal.find('.modal-body > form').empty();
                editDelete_Desktop.modal.find('.modal-body > form').append(
                    ft.desktopForm(desktopInstance)
                );
                $(editDelete_Desktop.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDelete_Laptop.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let laptopElements = [];
                rowElements.each(function () {
                    laptopElements.push($(this).text());
                });
                let laptopInstance = {
                    id: laptopElements[0],
                    brand: laptopElements[1],
                    price: laptopElements[2],
                    processorType: laptopElements[4],
                    ramSize:laptopElements[5],
                    weight: laptopElements[6],
                    cpuCores: laptopElements[7],
                    storageSize: laptopElements[8],
                    displaySize: laptopElements[9],
                    battery: laptopElements[10],
                    os:laptopElements[11],
                    camera: laptopElements[12],
                    touchscreen: laptopElements[13]
                };
                editDelete_Laptop.modal.find('.modal-body > form').empty();
                editDelete_Laptop.modal.find('.modal-body > form').append(
                    ft.laptopForm(laptopInstance)
                );
                $(editDelete_Laptop.modal).modal('show');
                event.preventDefault();
                return false; //for good measure
            });

            editDelete_Tablet.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let tabletElements = [];
                rowElements.each(function () {
                    tabletElements.push($(this).text());
                });
                let tabletInstance = {
                    id: tabletElements[0],
                    brand: tabletElements[1],
                    price: tabletElements[2],
                    processorType: tabletElements[4],
                    ramSize:tabletElements[5],
                    weight: tabletElements[6],
                    cpuCores: tabletElements[7],
                    storageSize: tabletElements[8],
                    displaySize: tabletElements[9],
                    height:tabletElements[10],
                    width: tabletElements[11],
                    thickness: tabletElements[12],
                    battery: tabletElements[13],
                    os:tabletElements[14],
                    camera: tabletElements[15],
                    touchscreen: tabletElements[16]
                };
                editDelete_Tablet.modal.find('.modal-body > form').empty();
                editDelete_Tablet.modal.find('.modal-body > form').append(
                    ft.tabletForm(tabletInstance)
                );
                $(editDelete_Tablet.modal).modal('show');
                event.preventDefault();
                return false;
            });
        },
        bindDeleteActions: function () {
            let delete_links = [
                editDelete_Laptop.deleteLink,
                editDelete_Tablet.deleteLink,
                editDelete_Desktop.deleteLink,
                editDelete_Monitor.deleteLink
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
