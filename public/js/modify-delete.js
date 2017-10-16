var formTemplates = new FormTemplates();
var ModifyDelete = (function () {
    var editMonitorLink = {}, editMonitorModal = {}, delMonitorLink = {};
    var editDesktopLink = {}, editDesktopModal = {}, delDesktopLink = {};
    var editLaptopLink = {}, editLaptopModal = {}, delLaptopLink = {};
    var editTabletLink = {}, editTabletModal = {}, delTabletLink = {};
    return {
        init: function () {
            editMonitorLink = $('.edit-monitor-link');
            editMonitorModal = $('.bs-edit-monitor-modal-lg');
            delMonitorLink = $('#delMonitorLink');
            editDesktopLink = $('.edit-desktop-link');
            editDesktopModal = $('.bs-edit-desktop-modal-lg');
            delDesktopLink = $('#delDesktopLink');
            editLaptopLink = $('.edit-laptop-link');
            editLaptopModal = $('.bs-edit-laptop-modal-lg');
            delLaptopLink = $('#delLaptopLink');
            editTabletLink = $('.edit-tablet-link');
            editTabletModal = $('.bs-edit-tablet-modal-lg');
            delTabletLink = $('#delTabletLink');
            this.bindModifyActions();
            this.bindDeleteActions();
        },
        bindModifyActions: function () {
            editMonitorLink.click(function (event){
                var tableRow = $(this).parent().parent().parent();
                var rowElements = tableRow.find('td');
                var monitorElements = [];
                rowElements.each(function () {
                    monitorElements.push($(this).text());
                });
                var monitorInstance = {
                    id: monitorElements[0],
                    brand: monitorElements[1], // brand drop down is not editable to make it simpler
                    price: monitorElements[2],
                    displaySize: monitorElements[4], // display size is also not editable
                    weight: monitorElements[5]
                };
                editMonitorModal.find('.modal-body > form').empty();
                editMonitorModal.find('.modal-body > form').append(
                    formTemplates.monitorForm(monitorInstance)
                );
                $(editMonitorModal).modal('show');

                event.preventDefault();
                return false; //for good measure
            });
            editDesktopLink.click(function (event){
                var tableRow = $(this).parent().parent().parent();
                var rowElements = tableRow.find('td');
                var desktopElements = [];
                rowElements.each(function () {
                    desktopElements.push($(this).text());
                });
                var desktopInstance = {
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
                console.log(desktopInstance);

                editDesktopModal.find('.modal-body > form').empty();
                editDesktopModal.find('.modal-body > form').append(
                    formTemplates.desktopForm(desktopInstance)
                );
                $(editDesktopModal).modal('show');
                event.preventDefault();
                return false; //for good measure
            });
            editLaptopLink.click(function (event){
                var tableRow = $(this).parent().parent().parent();
                var rowElements = tableRow.find('td');
                var laptopElements = [];
                rowElements.each(function () {
                    laptopElements.push($(this).text());
                });
                var laptopInstance = {
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
                console.log(laptopInstance);

                editLaptopModal.find('.modal-body > form').empty();
                editLaptopModal.find('.modal-body > form').append(
                    formTemplates.laptopForm(laptopInstance)
                );
                $(editLaptopModal).modal('show');

                event.preventDefault();
                return false; //for good measure
            });
            editTabletLink.click(function (event){
                var tableRow = $(this).parentsUntil('tr').parent().eq(0);
                var rowElements = tableRow.find('td');
                var tabletElements = [];
                rowElements.each(function () {
                    tabletElements.push($(this).text());
                });
                var tabletInstance = {
                    id: tabletElements[0],
                    brand: tabletElements[1], // brand drop down is not editable to make it simpler
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
                console.log(tabletInstance);

                var html = formTemplates.tabletForm(tabletInstance);
                editTabletModal.find('.modal-body > form').empty();
                editTabletModal.find('.modal-body > form').append(html);
                $(editTabletModal).modal('show');

                event.preventDefault();
                return false; //for good measure
            });
        },
        bindDeleteActions: function () {
            var del_links = [
                delLaptopLink,
                delTabletLink,
                delDesktopLink,
                delMonitorLink
            ];
            for(var i = 0; i < del_links.length; i++) {
                del_links[i].on('show.bs.modal', function (event) {
                    var link = $(event.relatedTarget);
                    var qty = link.data('qty');
                    var itemId = link.data('id');
                    // cannot delete the whole item from the db, so (qty - 1)
                    var modal = $(this);
                    // default qty to be removed is 1
                    modal.find('.modal-body input[type=number]').val(1);
                    modal.find('.modal-body input[type=hidden]').val(itemId);
                    modal.find('.modal-body input[type=number]').attr('max', (qty - 1));
                });
            }
        }
        
    }; // end return
})();

$(document).ready(function () {
    ModifyDelete.init();
});
