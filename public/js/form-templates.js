function FormTemplates() {
    // add your template here
    // use https://codebeautify.org/string-builder to stringtify the html
    this.monitorFormTemplate = function (monitorInstance) {
        var h = '   <form id="monitor-form" class="form-horizontal" action="">  ' +
                '   	<div class="col-md-12">  ' +
                '   		<div class="2"></div>  ' +
                '   		<div class="col-md-7">  ' +
                '   			<div class="form-group">  ' +
                '   				<input type="hidden" name="monitor-id" id="monitor-id" class="hidden" value="' + monitorInstance.id + '">  ' +
                '   			</div>  ' +
                '   			<div class="form-group">  ' +
                '   				Brand Name:  ' +
                '<select name="monitor-brand" id="monitor-brand" class="form-control">  ';
                    $.each(dropDownOptions.monitor.brands, function (key, value) {
                        if (monitorInstance.brand === value) {
                            h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
                        } else {
                            h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
                        }
                    });
                h += '   </select>  ';
                h += '</div>  ' +
                    '<div class="form-group">  ' +
                    '   				Price:  ' +
                    '   				<input type="text" name="monitor-price" id="monitor-price" class="form-control" value="' + monitorInstance.price + '">  ' +
                    '   			</div>  ' +
                    '   			<div class="form-group">  ' +
                    '   				Display size (inches):  ' +
                    '<select name="monitor-display-size" id="monitor-display-size" class="form-control">';
                        $.each(dropDownOptions.monitor.displaySize, function (key, value) {
                            if (monitorInstance.displaySize === value.toString()) {
                                h += '<option value="' + value + '" title="' + value + '" selected>' + monitorInstance.displaySize + '</option>';
                            } else {
                                h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
                            }
                        });
                h += '</select></div>';
                h += '   			<div class="form-group">  ' +
                    '   				Weight (Kg):  ' +
                    '   				<input type="text" name="monitor-weight" id="monitor-weight" class="form-control" value="' + monitorInstance.weight + '">  ' +
                    '   			</div>  ' +
                    '   		</div>  ' +
                    '   		<div class="2"></div>  ' +
                    '   	</div>  ' +
                    '   	<div class="row">  ' +
                    '   		<div class="col-md-12">  ' +
                    '   			<div class="col-md-7">  ' +
                    '   				<button type="submit" class="btn btn-primary btn-lg" name="submit-monitor-form" id="submit-monitor-form">Submit</button>  ' +
                    '   			</div>  ' +
                    '   		</div>  ' +
                    '   	</div>  ' +
                    '  </form>  ';
        return h;
    }
}
