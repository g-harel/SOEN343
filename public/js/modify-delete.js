var formTemplates = new FormTemplates();
var ModifyDelete = (function () {
    // for monitor
    var editMonitorLink = {}, editMonitorModal = {};
    // for desktop
    var editDesktopLink = {}, editDesktopModal = {};
    // for laptop
    var editLaptopLink = {}, editLaptopModal = {};
    // for tablet
    var editTabletLink = {}, editTabletModalBody = {}, editTabletModal = {};


    return {
        init: function () {
            editMonitorLink = $('.edit-monitor-link');
            editMonitorModal = $('.bs-edit-monitor-modal-lg');
            editDesktopLink = $('.edit-desktop-link');
            editDesktopModal = $('.bs-edit-desktop-modal-lg');
            editLaptopLink = $('.edit-laptop-link');
            editLaptopModal = $('.bs-edit-laptop-modal-lg');
            editTabletLink = $('.edit-tablet-link');
            editTabletModalBody = $('#edit-tablet-form-body');
            editTabletModal = $('.bs-edit-tablet-modal-lg');

            this.bindModifyDeleteActions();
        },
        bindModifyDeleteActions: function () {
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
                // returns the table row
                var tableRow = $(this).parent().parent().parent();
                // contains the text of each td
                var rowElements = tableRow.find('td');
                // array to hold the elements of this tablet
                var desktopElements = [];
                // get all the elements of this row
                // and save it to the array
                rowElements.each(function () {
                    desktopElements.push($(this).text());
                });

                var desktopInstance = {
                     id: tabletElements[0],
                    brand: tabletElements[1], // brand drop down is not editable to make it simpler
                    price: tabletElements[2],
                    quantity: tabletElements[3],
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
                // check to make sure
                console.log(tabletInstance);

                // not using mustache
                var html = formTemplates.tabletFormTemplate(tabletInstance);
                editTabletModalBody.empty();
                editTabletModalBody.append(html);

                // finally show the modal
                $(editTabletModal).modal('show');

                event.preventDefault();
                return false; //for good measure
            });
        }
    }; // end return
})();

$(document).ready(function () {
    ModifyDelete.init();
});
