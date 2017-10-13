var formTemplates = new FormTemplates();
var ModifyDelete = (function () {

    // for monitor
    var editMonitorLink = {},
        editMonitorModalBody = {},
        editMonitorModal = {};
    // for desktop
    var editDesktopLink = {},
         editDesktopModalBody = {},
         editDesktopModal = {};
    // for laptop
    var editLaptopLink = {},
         editLaptopModalBody = {},
         editLaptopModal = {};
    // for tablet
    var editTabletLink = {},
         editTabletModalBody = {},
         editTabletModal = {};
    // create a var for your link here
    

    return {

        /**
         * All the elements required before an
         * event occurred must be in the init function.
         */
        init: function () {

            editMonitorLink = $('.edit-monitor-link');
            editMonitorModalBody = $('#edit-monitor-form-body');
            editMonitorModal = $('.bs-edit-monitor-modal-lg');
            editDesktopLink = $('.edit-desktop-link');
            editDesktopModalBody = $('#edit-desktop-form-body');
            editDesktopModal = $('.bs-edit-desktop-modal-lg');
            editLaptopLink = $('.edit-laptop-link');
            editLaptopModalBody = $('#edit-laptop-form-body');
            editLaptopModal = $('.bs-edit-laptop-modal-lg');
            editTabletLink = $('.edit-tablet-link');
            editTabletModalBody = $('#edit-tablet-form-body');
            editTabletModal = $('.bs-edit-tablet-modal-lg');

            // assigned the var above to the class link here

            this.bindModifyDeleteActions();
        },
        bindModifyDeleteActions: function () {

            editMonitorLink.click(function (event){
                // returns the table row
                var tableRow = $(this).parent().parent().parent();
                // contains the text of each td
                var rowElements = tableRow.find('td');
                // array to hold the elements of this monitor
                var monitorElements = [];
                // get all the elements of this row
                // and save it to the array
                rowElements.each(function () {
                    monitorElements.push($(this).text());
                });

                var monitorInstance = {
                    id: monitorElements[0],
                    brand: monitorElements[1], // brand drop down is not editable to make it simpler
                    price: monitorElements[2],
                    quantity: monitorElements[3],
                    displaySize: monitorElements[4], // display size is also not editable
                    weight: monitorElements[5]
                };
                // check to make sure
                console.log(monitorInstance);

                // not using mustache
                var html = formTemplates.monitorFormTemplate(monitorInstance);
                editMonitorModalBody.empty();
                editMonitorModalBody.append(html);

                // finally show the modal
                $(editMonitorModal).modal('show');

                event.preventDefault();
                return false; //for good measure
            });
            editDesktopLink.click(function (event){
                // returns the table row
                var tableRow = $(this).parent().parent().parent();
                // contains the text of each td
                var rowElements = tableRow.find('td');
                // array to hold the elements of this desktop
                var desktopElements = [];
                // get all the elements of this row
                // and save it to the array
                rowElements.each(function () {
                    desktopElements.push($(this).text());
                });

                var desktopInstance = {
                     id: desktopElements[0],
                    brand: desktopElements[1], // brand drop down is not editable to make it simpler
                    price: desktopElements[2],
                    quantity: desktopElements[3],
                    processorType: desktopElements[4],
                    ramSize: desktopElements[5],
                    storageSize: desktopElements[6],
                    cpuCores: desktopElements[7], 
                    price: desktopElements[8],
                    weight: desktopElements[9],
                    height:desktopElements[10],
                    width: desktopElements[11],
                    thickness: desktopElements[12]
                    
                };
                // check to make sure
                console.log(desktopInstance);

                // not using mustache
                var html = formTemplates.desktopFormTemplate(desktopInstance);
                editDesktopModalBody.empty();
                editDesktopModalBody.append(html);

                // finally show the modal
                $(editDesktopModal).modal('show');

                event.preventDefault();
                return false; //for good measure
            });
             editLaptopLink.click(function (event){
                // returns the table row
                var tableRow = $(this).parent().parent().parent();
                // contains the text of each td
                var rowElements = tableRow.find('td');
                // array to hold the elements of this laptop
                var laptopElements = [];
                // get all the elements of this row
                // and save it to the array
                rowElements.each(function () {
                    laptopElements.push($(this).text());
                });

                var laptopInstance = {
                     id: laptopElements[0],
                    brand: laptopElements[1], // brand drop down is not editable to make it simpler
                    price: laptopElements[2],
                    quantity: laptopElements[3],
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
                // check to make sure
                console.log(laptopInstance);

                // not using mustache
                var html = formTemplates.laptopFormTemplate(laptopInstance);
                editlaptopModalBody.empty();
                editlaptopModalBody.append(html);

                // finally show the modal
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
