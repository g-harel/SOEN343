function FormTemplates() {
    this.monitorForm = function (monitor) {
        return `<div class="col-md-12">
                <div class="2"></div>
                <div class="col-md-7">
                    <div class="form-group">
                        Brand Name:
                        <select name="monitor-brand" id="monitor-brand" class="form-control">
                            <option value="Select brands" title="Select brands" selected disabled>Select brands</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Price:
                        <input type="text" name="monitor-price" value="${monitor.price}" id="monitor-price" class="form-control">
                    </div>
                    <div class="form-group">
                        Display size (inches):
                        <select name="monitor-display-size" id="monitor-display-size" class="form-control">
                            <option value="Select display size" title="Select display size" selected disabled>Select display size</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Weight (Kg):
                        <input type="text" name="monitor-weight" value="${monitor.weight}" id="monitor-weight" class="form-control">
                    </div>
                </div>
                <div class="2"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-7">
                        <button type="submit" class="btn btn-primary btn-lg" name="submit-monitor-form" id="submit-monitor-form">Submit</button>
                    </div>
                </div>
            </div>`;
    };

    this.desktopForm = function (desktop) {
        return `<div class="col-md-12">
                    <div class="col-md-5">
                        <div class="form-group">
                            Brand:
                            <select name="computer-brand" id="computer-brand" class="form-control">
                                <option value="Select brands" title="Select brands" selected disabled>Select brands</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Processor Type:
                            <select name="desktop-processor" id="desktop-processor" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            RAM Size:
                            <select name="desktop-ram-size" id="desktop-ram-size" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            Hard Drive Size:
                            <select name="storage-capacity" id="storage-capacity" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            Number of Cores:
                            <select name="desktop-cpu-cores" id="cpu-cores" class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <div class="form-group">
                            Price:
                            <input type="text" name="desktop-price" value="${desktop.price}" id="desktop-price" class="form-control">
                        </div>
                        <div class="form-group">
                            Weight (Kg):
                            <input type="text" name="desktop-weight" value="${desktop.weight}"  id="desktop-weight" class="form-control">
                        </div>
                        <div class="form-group">
                            Height (cm):
                            <input type="text" name="desktop-height" value="${desktop.height}" id="desktop-height" class="form-control">
                        </div>
                        <div class="form-group">
                            Width (cm):
                            <input type="text" name="desktop-width" value="${desktop.width}"  id="desktop-width" class="form-control">
                        </div>
                        <div class="form-group">
                            Thickness (cm):
                            <input type="text" name="desktop-thickness" value="${desktop.thickness}" id="desktop-thickness" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-lg" name="submit-desktop-form" id="submit-desktop-form">Submit</button>
                        </div>
                    </div>
                </div>`;

    };

    this.laptopForm = function (laptop) {
        return `<div class="col-md-12">
                <div class="col-md-5">
                    <div class="form-group">
                        Brand:
                        <select name="laptop-brand" id="laptop-brand" class="form-control">
                            <option value="Select brands" title="Select brands" selected disabled>Select brands</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Processor Type:
                        <select name="laptop-processor" id="laptop-processor" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        RAM Size:
                        <select name="laptop-ram-size" id="laptop-ram-size" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        Hard Drive Size:
                        <select name="laptop-storage-capacity" id="laptop-storage-capacity" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        Number of Cores:
                        <select name="laptop-cpu-cores" id="laptop-cpu-cores" class="form-control"></select>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <div class="form-group">
                        Display size (inches):
                        <select name="laptop-display-size" id="laptop-display-size" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        Price:
                        <input type="text" name="laptop-price" value="${laptop.price}" id="laptop-price"  class="form-control">
                    </div>
                    <div class="form-group">
                        Weight (Kg):
                        <input type="text" name="laptop-weight" value="${laptop.weight}" id="laptop-weight" class="form-control">
                    </div>
                    <div class="form-group">
                        Battery:
                        <input type="text" name="laptop-battery" value="${laptop.battery}" id="laptop-battery" class="form-control">
                    </div>
                    <div class="form-group">
                        OS:
                        <select name="laptop-os" id="laptop-os" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        Camera:<br>
                        <input type="radio" title="laptop camera" name="laptop-camera" value="Yes" id="laptop-camera">&nbsp;Yes
                        <input type="radio" title="laptop camera" name="laptop-camera" value="No" id="laptop-camera">&nbsp;No
                    </div>
                    <div class="form-group">
                        Touchscreen:<br>
                        <input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="Yes" id="laptop-camera">&nbsp;Yes
                        <input type="radio" title="laptop touchscreen" name="laptop-touchscreen" value="No" id="laptop-camera">&nbsp;No
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-lg" name="submit-laptop-form" id="submit-laptop-form">Submit</button>
                    </div>
                </div>
            </div>`;
    };

    this.tabletForm = function (tablet) {
        return`<div class="col-md-12">
                <div class="col-md-5">
                    <div class="form-group">
                        Brand:
                        <select name="tablet-brand" id="tablet-brand" class="form-control">
                            <option value="Select brands" title="Select brands" selected disabled>Select brands</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Processor Type:
                        <select name="tablet-processor" id="tablet-processor" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        RAM Size:
                        <select name="tablet-ram-size" id="tablet-ram-size" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        Hard Drive Size:
                        <select name="tablet-storage-capacity" id="tablet-storage-capacity" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        Number of Cores:
                        <select name="tablet-cpu-cores" id="tablet-cpu-cores" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        Weight (Kg):
                        <input type="text" name="tablet-weight" value="${tablet.weight}" id="tablet-weight" class="form-control">
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <div class="form-group">
                        Price:
                        <input type="text" name="tablet-price" value="${tablet.price}" id="tablet-price"  class="form-control">
                    </div>
                    <div class="form-group">
                        Display size (inches):
                        <select name="tablet-display-size" id="tablet-display-size" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        Thickness (cm):
                        <input type="text" name="tablet-thickness" value="${tablet.thickness}" id="tablet-thickness" class="form-control">
                    </div>
                    <div class="form-group">
                        Height (cm):
                        <input type="text" name="tablet-height" value="${tablet.height}" id="tablet-height" class="form-control">
                    </div>
                    <div class="form-group">
                        Battery:
                        <input type="text" name="tablet-battery" value="${tablet.battery}" id="tablet-battery" class="form-control">
                    </div>
                    <div class="form-group">
                        OS:
                        <select name="tablet-os" id="tablet-os" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        Camera:<br>
                        <input type="radio" title="tablet camera" name="tablet-camera" value="Yes" id="tablet-camera">&nbsp;Yes
                        <input type="radio" title="tablet camera" name="tablet-camera" value="No" id="tablet-camera">&nbsp;No
                    </div>
                    <div class="form-group">
                        Touchscreen:<br>
                        <input type="radio" title="tablet touchscreen" name="tablet-touchscreen" value="Yes" id="tablet-camera">&nbsp;Yes
                        <input type="radio" title="tablet touchscreen" name="tablet-touchscreen" value="No" id="tablet-camera">&nbsp;No
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-lg" name="submit-tablet-form" id="submit-tablet-form">Submit</button>
                    </div>
                </div>
            </div>`;
    };
}
