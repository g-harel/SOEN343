function FormTemplates() {
    // add your template here
    // use https://codebeautify.org/string-builder to stringtify the html
    this.monitorFormTemplate = function (monitorInstance) {
        return '   <form id="monitor-form" class="form-horizontal" action="">  '  +
            '   	<div class="col-md-12">  '  +
            '   		<div class="2"></div>  '  +
            '   		<div class="col-md-7">  '  +
            '   			<div class="form-group">  '  +
            '   				<input type="hidden" name="monitor-id" id="monitor-id" class="hidden" value="'+monitorInstance.id+'">  '  +
            '   			</div>  '  +
            '   			<div class="form-group">  '  +
            '   				Brand Name:  '  +
            '   				<input readonly type="text" name="monitor-brand" id="monitor-brand" class="form-control" value="'+monitorInstance.brand+'">  '  +
            '   			</div>  '  +
            '   			<div class="form-group">  '  +
            '   				Price:  '  +
            '   				<input type="text" name="monitor-price" id="monitor-price" class="form-control" value="'+monitorInstance.price+'">  '  +
            '   			</div>  '  +
            '   			<div class="form-group">  '  +
            '   				Display size (inches):  '  +
            '   				<input readonly type="text" name="monitor-display-size" id="monitor-display-size" class="form-control" value="'+monitorInstance.displaySize+'">  '  +
            '   			</div>  '  +
            '   			<div class="form-group">  '  +
            '   				Weight (Kg):  '  +
            '   				<input type="text" name="monitor-weight" id="monitor-weight" class="form-control" value="'+monitorInstance.weight+'">  '  +
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
    }
}
