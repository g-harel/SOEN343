@extends('layouts.app')

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/items">Items</a></li>
            <li>Create Items</li>
        </ol>
    </div>

    <div class="row">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h2 class="size-font-30">Create Items</h2>
            </div>
            <div class="panel-body">
                <!-- radio buttons category -->
                <div class="row radio no-pad">
                    <div class="col-md-2">
                        <label><input type="radio" name="type" id="type_Computer" value="Computer" onclick="toggleOptions();">Desktop Computer</label>
                    </div>
                    <div class="col-md-2">
                        <label><input type="radio" name="type" id="type_Laptop" value="Laptop" onclick="toggleOptions();">Laptop</label>
                    </div>
                    <div class="col-md-2">
                        <label><input type="radio" name="type" id="type_Tablet" value="Tablet" onclick="toggleOptions();">Tablet</label>
                    </div>
                    <div class="col-md-2">
                        <label><input type="radio" name="type" id="type_Television" value="Television" onclick="toggleOptions();">Television</label>
                    </div>
                    <div class="col-md-2">
                        <label><input type="radio" name="type" id="type_Monitor" value="Monitor" onclick="toggleOptions();">Monitor</label>
                    </div>
                </div>

                <!-- Form for Computers -->
                <div id="nextSetOfComputerOptions" class="row hide-this-element"><hr>
                    <form id="desktop" class="form-horizontal">
                        <div class="col-md-12">
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
                                    <input type="text" name="desktop-price" id="desktop-price" class="form-control">
                                </div>
                                <div class="form-group">
                                    Weight (Kg):
                                    <input type="text" name="desktop-weight" id="desktop-weight" class="form-control">
                                </div>
                                <div class="form-group">
                                    Height (cm):
                                    <input type="text" name="desktop-height" id="desktop-height" class="form-control">
                                </div>
                                <div class="form-group">
                                    Width (cm):
                                    <input type="text" name="desktop-width" id="desktop-width" class="form-control">
                                </div>
                                <div class="form-group">
                                    Thickness (cm):
                                    <input type="text" name="desktop-thickness" id="desktop-thickness" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit-desktop-form" id="submit-desktop-form">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Form for Laptops -->
                <div id="nextSetOfLaptopOptions" class="row hide-this-element"><hr>
                    <form id="laptop" class="form-horizontal">
                        <div class="col-md-12">
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
                                <div class="form-group">
                                    Display size (inches):
                                    <select name="laptop-display-size" id="laptop-display-size" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    Price:
                                    <input type="text" name="laptop-price" id="laptop-price"  class="form-control">
                                </div>
                                <div class="form-group">
                                    Weight (Kg):
                                    <input type="text" name="laptop-weight" id="laptop-weight" class="form-control">
                                </div>
                                <div class="form-group">
                                    Battery:
                                    <input type="text" name="laptop-battery" id="laptop-battery" class="form-control">
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
                        </div>
                    </form>
                </div>

                <!-- Form for Tablets -->
                <div id="nextSetOfTabletOptions" class="row hide-this-element"><hr>
                    <form id="tablet"  class="form-horizontal">
                        <div class="col-md-12">
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
                                    <input type="text" name="tablet-weight" id="tablet-weight" class="form-control">
                                </div>
                                <div class="form-group">
                                    Price:
                                    <input type="text" name="tablet-price" id="tablet-price"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    Display size (inches):
                                    <select name="tablet-display-size" id="tablet-display-size" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    Thickness (cm):
                                    <input type="text" name="tablet-thickness" id="tablet-thickness" class="form-control">
                                </div>
                                <div class="form-group">
                                    Height (cm):
                                    <input type="text" name="tablet-height" id="tablet-height" class="form-control">
                                </div>
                                <div class="form-group">
                                    Battery:
                                    <input type="text" name="tablet-battery" id="tablet-battery" class="form-control">
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
                        </div>
                    </form>
                </div>

                <!-- Form for Televisions -->
                <div id="nextSetOfTelevisionOptions" class="row hide-this-element"><hr>
                    <form id="television" class="form-horizontal">
                        <div class="col-md-12">
                            <div class="col-md-5">
                                <div class="form-group">
                                    Brand Name:
                                    <select name="television-brand" id="television-brand" class="form-control">
                                        <option value="Select brands" title="Select brands" selected disabled>Select brands</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    Price:
                                    <input type="text" name="television-price" id="television-price" class="form-control">
                                </div>
                                <div class="form-group">
                                    Height (cm):
                                    <input type="text" name="television-height" id="television-height" class="form-control">
                                </div>
                                <div class="form-group">
                                    Width (cm):
                                    <input type="text" name="television-width" id="television-width" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    Thickness (cm):
                                    <input type="text" name="television-thickness" id="television-thickness" class="form-control">
                                </div>
                                <div class="form-group">
                                    Weight (Kg):
                                    <input type="text" name="television-weight" id="television-weight" class="form-control">
                                </div>
                                <div class="form-group">
                                    Type:
                                    <select name="television-type" title="television-type" id="television-type" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit-tv-form" id="submit-tv-form">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Form for Monitors -->
                <div id="nextSetOfMonitorOptions" class="row hide-this-element"><hr>
                    <form id="monitor-form" class="form-horizontal">
                        <div class="col-md-12">
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
                                    <input type="text" name="monitor-price" id="monitor-price" class="form-control">
                                </div>
                                <div class="form-group">
                                    Display size (inches):
                                    <select name="monitor-display-size" id="monitor-display-size" class="form-control"></select>
                                </div>
                                <div class="form-group">
                                    Weight (Kg):
                                    <input type="text" name="monitor-weight" id="monitor-weight" class="form-control">
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
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- trigger onclick depending on which radio button checked -->
    <script type="text/javascript">
        function toggleOptions() {
            if (document.getElementById('type_Computer').checked) {
                document.getElementById('nextSetOfTabletOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'none';
                document.getElementById('nextSetOfMonitorOptions').style.display = 'none';
                document.getElementById('nextSetOfComputerOptions').style.display = 'block';
            } else if (document.getElementById('type_Laptop').checked) {
                document.getElementById('nextSetOfTabletOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'none';
                document.getElementById('nextSetOfComputerOptions').style.display = 'none';
                document.getElementById('nextSetOfMonitorOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'block';
            } else if (document.getElementById('type_Tablet').checked) {
                document.getElementById('nextSetOfComputerOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'none';
                document.getElementById('nextSetOfMonitorOptions').style.display = 'none';
                document.getElementById('nextSetOfTabletOptions').style.display = 'block';
            } else if (document.getElementById('type_Television').checked) {
                document.getElementById('nextSetOfTabletOptions').style.display = 'none';
                document.getElementById('nextSetOfComputerOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'none';
                document.getElementById('nextSetOfMonitorOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'block';
            } else if (document.getElementById('type_Monitor').checked) {
                document.getElementById('nextSetOfTabletOptions').style.display = 'none';
                document.getElementById('nextSetOfComputerOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'none';
                document.getElementById('nextSetOfMonitorOptions').style.display = 'block';
            }
        }
    </script>


@endsection