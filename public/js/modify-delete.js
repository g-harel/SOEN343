var monitorFormTemplate = '   <form id="monitor-form" class="form-horizontal">  '  +
    '   	<div class="col-md-12">  '  +
    '   		<div class="2"></div>  '  +
    '   		<div class="col-md-7">  '  +
    '   			<div class="form-group">  '  +
    '   				Brand Name:  '  +
    '   				<select name="monitor-brand" id="monitor-brand" class="form-control">  '  +
    '   					<option value="Select brands" title="Select brands" selected="" disabled="">Select brands</option>  '  +
    '   				</select>  '  +
    '   			</div>  '  +
    '   			<div class="form-group">  '  +
    '   				Price:  '  +
    '   				<input type="text" name="monitor-price" id="monitor-price" class="form-control" value="">  '  +
    '   			</div>  '  +
    '   			<div class="form-group">  '  +
    '   				Display size (inches):  '  +
    '   				<select name="monitor-display-size" id="monitor-display-size" class="form-control">  '  +
    '   				</select>  '  +
    '   			</div>  '  +
    '   			<div class="form-group">  '  +
    '   				Weight (Kg):  '  +
    '   				<input type="text" name="monitor-weight" id="monitor-weight" class="form-control">  '  +
    '   			</div>  '  +
    '   		</div>  '  +
    '   		<div class="2"></div>  '  +
    '   	</div>  '  +
    '   	<div class="row">  '  +
    '   		<div class="col-md-12">  '  +
    '   			<div class="col-md-7">  '  +
    '   				<button type="submit" class="btn btn-primary btn-lg" name="submit-monitor-form" id="submit-monitor-form">Submit</button>  '  +
    '   			</div>  '  +
    '   		</div>  '  +
    '   	</div>  '  +
    '  </form>  ' ;

// var util = new CommonUtil();
var ModifyDelete = (function () {

    // var deleteCarSel = {},
    //     confirmDeleteRecordSel = {},
    //     deleteConfirmBtnSel = {},
    //     rowAffectedSuccessSel = {};
    var editMonitorLink = {};

    return {

        /**
         * All the elements required before an
         * event occurred must be in the init function.
         */
        init: function () {

            // deleteCarSel = $(".dropdown a.delete-vehicle");
            // confirmDeleteRecordSel = $('#confirm-delete-record');
            // deleteConfirmBtnSel = $('#delete-yes');
            // rowAffectedSuccessSel = $('#row-affected-successfully');

            // call the event driven functions here
            editMonitorLink = $('.edit-monitor-link');

            this.bindModifyDeleteActions();
        },
        bindModifyDeleteActions: function () {

            editMonitorLink.click(function (event){
                console.log($(this));
                alert('Hello World!');
                event.preventDefault();
                return false; //for good measure
            });
        }
    }; // end return
})();

$(document).ready(function () {
    ModifyDelete.init();
});
