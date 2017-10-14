function FormTemplates() {
    // add your template here
    // use https://codebeautify.org/string-builder to stringtify the html
    this.monitorForm = function (monitor) {
        var h = '<div class="col-md-12">  ' +
                '   		<div class="2"></div>  ' +
                '   		<div class="col-md-7">  ' +
                '   			<div class="form-group">  ' +
                '   				<input type="hidden" name="monitor-id" id="monitor-id" class="hidden" value="' + monitor.id + '">  ' +
                '   			</div>  ' +
                '   			<div class="form-group">  ' +
                '   				Brand Name:  ' +
                '<select name="monitor-brand" id="monitor-brand" class="form-control">  ';
                    $.each(dropDownOptions.monitor.brands, function (key, value) {
                        if (monitor.brand === value) {
                            h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
                        } else {
                            h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
                        }
                    });
                h += '   </select>  ';
                h += '</div>  ' +
                    '<div class="form-group">  ' +
                    '   				Price:  ' +
                    '   				<input type="text" name="monitor-price" id="monitor-price" class="form-control" value="' + monitor.price + '">  ' +
                    '   			</div>  ' +
                    '   			<div class="form-group">  ' +
                    '   				Display size (inches):  ' +
                    '<select name="monitor-display-size" id="monitor-display-size" class="form-control">';
                        $.each(dropDownOptions.monitor.displaySize, function (key, value) {
                            if (monitor.displaySize === value.toString()) {
                                h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
                            } else {
                                h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
                            }
                        });
                h += '</select></div>';
                h += '   			<div class="form-group">  ' +
                    '   				Weight (Kg):  ' +
                    '   				<input type="text" name="monitor-weight" id="monitor-weight" class="form-control" value="' + monitor.weight + '">  ' +
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
                    '   	</div>  ';
        return h;
    };

    this.desktopForm = function (desktop) {
        var h = '   <div class="col-md-12">  '  +
            '   	<div class="col-md-5">  '  +
            '   		<div class="form-group">  '  +
            '   			Brand:  '  +
            '   			<select name="computer-brand" id="computer-brand" class="form-control">  ';
            $.each(dropDownOptions.computer.brands, function (key, value) {
                if (desktop.brand === value) {
                    h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
                } else {
                    h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
                }
            });
            h += '   			</select>  '  +
            '   		</div>  '  +
            '   		<div class="form-group">  '  +
            '   			Processor Type:  '  +
            '   			<select name="desktop-processor" id="desktop-processor" class="form-control">';
            $.each(dropDownOptions.computer.processorType, function (key, value) {
                if (desktop.processorType === value) {
                    h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
                } else {
                    h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
                }
            });
            h +=    '</select>  '  +
            '   		</div>  '  +
            '   		<div class="form-group">  '  +
            '   			RAM Size:  '  +
            '   			<select name="desktop-ram-size" id="desktop-ram-size" class="form-control">  ';
            $.each(dropDownOptions.computer.ramSize, function (key, value) {
                if (desktop.ramSize === value) {
                    h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
                } else {
                    h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
                }
            });
            h += '   			</select>  '  +
            '   		</div>  '  +
            '   		<div class="form-group">  '  +
            '   			Hard Drive Size:  '  +
            '   			<select name="storage-capacity" id="storage-capacity" class="form-control">';
            $.each(dropDownOptions.computer.storageSize, function (k, v) {
                if (desktop.storageSize === v) {
                    h += '<option value="'+v[0]+'" title="'+v[1]+'" selected>'+v[1]+'</option>';
                } else {
                    h += '<option value="'+v[0]+'" title="'+v[1]+'">'+v[1]+'</option>';
                }
            });
            h +=    '</select>  '  +
            '   		</div>  '  +
            '   		<div class="form-group">  '  +
            '   			Number of Cores:  '  +
            '   			<select name="desktop-cpu-cores" id="cpu-cores" class="form-control">';
            $.each(dropDownOptions.computer.cpuCores, function (key, value) {
                if (desktop.cpuCores === value) {
                    h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
                } else {
                    h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
                }
            });
            h += '</select>  '  +
            '   		</div>  '  +
            '   	</div>  '  +
            '   	<div class="col-md-2"></div>  '  +
            '   	<div class="col-md-5">  '  +
            '   		<div class="form-group">  '  +
            '   			Price:  '  +
            '   			<input type="text" value="'+desktop.price+'" name="desktop-price" id="desktop-price" class="form-control">  '  +
            '   		</div>  '  +
            '   		<div class="form-group">  '  +
            '   			Weight (Kg):  '  +
            '   			<input type="text" value="'+desktop.weight+'" name="desktop-weight" id="desktop-weight" class="form-control">  '  +
            '   		</div>  '  +
            '   		<div class="form-group">  '  +
            '   			Height (cm):  '  +
            '   			<input type="text" value="'+desktop.height+'" name="desktop-height" id="desktop-height" class="form-control">  '  +
            '   		</div>  '  +
            '   		<div class="form-group">  '  +
            '   			Width (cm):  '  +
            '   			<input type="text" value="'+desktop.width+'" name="desktop-width" id="desktop-width" class="form-control">  '  +
            '   		</div>  '  +
            '   		<div class="form-group">  '  +
            '   			Thickness (cm):  '  +
            '   			<input type="text" value="'+desktop.thickness+'" name="desktop-thickness" id="desktop-thickness" class="form-control">  '  +
            '   		</div>  '  +
            '   	</div>  '  +
            '   </div>  '  +
            '   <div class="row">  '  +
            '   	<div class="col-md-12">  '  +
            '   		<div class="col-md-6">  '  +
            '   			<button type="submit" class="btn btn-primary btn-lg" name="submit-desktop-form"  '  +
            '   					id="submit-desktop-form">Submit  '  +
            '   			</button>  '  +
            '   		</div>  '  +
            '   	</div>  '  +
            '  </div>  ' ;
        return h;
    };

    this.laptopForm = function (laptop) {
        var h = '   <div class="col-md-12">  '  +
        '   	<div class="col-md-5">  '  +
        '   		<div class="form-group">  '  +
        '   			Brand:  '  +
        '   			<select name="laptop-brand" id="laptop-brand" class="form-control">  ';
        $.each(dropDownOptions.computer.brands, function (key, value) {
            if (laptop.brand === value) {
                h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
            } else {
                h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
            }
        });
        h += '</select>  '  +
        '   		</div>  '  +
        '   		<div class="form-group">  '  +
        '   			Processor Type:  '  +
        '   			<select name="laptop-processor" id="laptop-processor" class="form-control">';

        $.each(dropDownOptions.computer.processorType, function (key, value) {
            if (laptop.processorType === value) {
                h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
            } else {
                h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
            }
        });
        h += '</select>  '  +
        '   		</div>  '  +
        '   		<div class="form-group">  '  +
        '   			RAM Size:  '  +
        '   			<select name="laptop-ram-size" id="laptop-ram-size" class="form-control">  ';
        $.each(dropDownOptions.computer.ramSize, function (key, value) {
            if (laptop.ramSize === value) {
                h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
            } else {
                h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
            }
        });
        h += '</select>  '  +
        '   		</div>  '  +
        '   		<div class="form-group">  '  +
        '   			Hard Drive Size:  '  +
        '   			<select name="laptop-storage-capacity" id="laptop-storage-capacity" class="form-control">';
        $.each(dropDownOptions.computer.storageSize, function (k, v) {
            if (laptop.storageSize === v) {
                h += '<option value="'+v[0]+'" title="'+v[1]+'" selected>'+v[1]+'</option>';
            } else {
                h += '<option value="'+v[0]+'" title="'+v[1]+'">'+v[1]+'</option>';
            }
        });
        h += '</select>  '  +
        '   		</div>  '  +
        '   		<div class="form-group">  '  +
        '   			Number of Cores:  '  +
        '   			<select name="laptop-cpu-cores" id="laptop-cpu-cores" class="form-control">';
        $.each(dropDownOptions.computer.cpuCores, function (key, value) {
            if (laptop.cpuCores === value) {
                h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
            } else {
                h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
            }
        });
        h +=    '</select>  '  +
        '   		</div>  '  +
        '   	</div>  '  +
        '   	<div class="col-md-2"></div>  '  +
        '   	<div class="col-md-5">  '  +
        '   		<div class="form-group">  '  +
        '   			Display size (inches):  '  +
        '   			<select name="laptop-display-size" id="laptop-display-size" class="form-control">';
        $.each(dropDownOptions.computer.displaySize, function (key, value) {
            if (laptop.displaySize === value.toString()) {
                h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
            } else {
                h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
            }
        });
        h += '</select>  '  +
        '   		</div>  '  +
        '   		<div class="form-group">  '  +
        '   			Price:  '  +
        '   			<input type="text" value="'+laptop.price+'" name="laptop-price" id="laptop-price"  class="form-control">  '  +
        '   		</div>  '  +
        '   		<div class="form-group">  '  +
        '   			Weight (Kg):  '  +
        '   			<input type="text" value="'+laptop.weight+'" name="laptop-weight" id="laptop-weight" class="form-control">  '  +
        '   		</div>  '  +
        '   		<div class="form-group">  '  +
        '   			Battery:  '  +
        '   			<input type="text" value="'+laptop.battery+'" name="laptop-battery" id="laptop-battery" class="form-control">  '  +
        '   		</div>  '  +
        '   		<div class="form-group">  '  +
        '   			OS:  '  +
        '   			<select name="laptop-os" id="laptop-os" class="form-control">';
        $.each(dropDownOptions.computer.os, function (key, value) {
            if (laptop.os === value) {
                h += '<option value="' + value + '" title="' + value + '" selected>' + value + '</option>';
            } else {
                h += '<option value="' + value + '" title="' + value + '">' + value + '</option>';
            }
        });
        h +=    '</select>  '  +
        '   		</div>  '  +
        '   		<div class="form-group">  '  +
        '   			Camera:<br>  ';
        if(laptop.camera === "Yes") {
            h += '<input type="radio" title="laptop camera" name="laptop-camera" value="Yes" id="laptop-camera" checked>&nbsp;Yes ';
            h += '<input type="radio" title="laptop camera" name="laptop-camera" value="No" id="laptop-camera">&nbsp;No ';
        } else {
            h += '<input type="radio" title="laptop camera" name="laptop-camera" value="Yes" id="laptop-camera">&nbsp;Yes ';
            h += '<input type="radio" title="laptop camera" name="laptop-camera" value="No" id="laptop-camera" checked>&nbsp;No ';
        }
        h += '</div>  '  +
        '   		<div class="form-group">  '  +
        '   			Touchscreen:<br>  ';
        if(laptop.touchscreen === "Yes") {
            h += '<input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="Yes" id="laptop-camera" checked>&nbsp;Yes ';
            h += '<input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="No" id="laptop-camera">&nbsp;No  ';
        } else {
            h += '<input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="Yes" id="laptop-camera">&nbsp;Yes ';
            h += '<input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="No" id="laptop-camera" checked>&nbsp;No  ';
        }
        h += '   		</div>  '  +
        '   	</div>  '  +
        '   </div>  '  +
        '   <div class="row">  '  +
        '   	<div class="col-md-12">  '  +
        '   		<div class="col-md-6">  '  +
        '   			<button type="submit" class="btn btn-primary btn-lg" name="submit-laptop-form" id="submit-laptop-form">Submit</button>  '  +
        '   		</div>  '  +
        '   	</div>  '  +
        '  </div>  ' ;
        return h;
    }


}
