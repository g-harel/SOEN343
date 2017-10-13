

// add your template here
// use https://codebeautify.org/string-builder to stringtify the html


var formTemplates = new FormTemplates();
var ModifyDelete = (function () {

    // for monitor
    var editMonitorLink = {},
        editMonitorModalBody = {},
        editMonitorModal = {};

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



                console.log(monitorElements[0]);

                var monitorInstance = {
                    id: monitorElements[0],
                    brand: monitorElements[1],
                    price: monitorElements[2],
                    quantity: monitorElements[3],
                    displaySize: monitorElements[4],
                    weight: monitorElements[5]
                };

                // check to make sure
                console.log(monitorInstance);

                // use the template above as parameters of Mustache
                // see: http://coenraets.org/blog/2011/12/tutorial-html-templates-with-mustache-js/
                var html = formTemplates.monitorFormTemplate(monitorInstance);

                editMonitorModalBody.empty();
                editMonitorModalBody.append(html);

                console.log('hello');




                $(editMonitorModal).modal('show');


                event.preventDefault();
                return false; //for good measure
            });


            // use the var link for function

        }
    }; // end return
})();

$(document).ready(function () {
    ModifyDelete.init();
});
