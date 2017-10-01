@extends('layouts.app')

@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/items">Items</a></li>
            <li>Create Items</li>
        </ol>
        <h1>Create Items</h1>
    </div>

    <div class="row">
        <div class="col-md-12 radio no-pad">
            <form name="form1" id="myForm" method="post" class="">
                <div class="col-md-2">
                    <label><input type="radio" name="type" id="type_Computer" value="Computer"
                                  onclick="toggleOptions();">Desktop Computer</label>
                </div>
                <div class="col-md-2">
                    <label><input type="radio" name="type" id="type_Laptop" value="Laptop" onclick="toggleOptions();">Laptop</label>
                </div>
                <div class="col-md-2">
                    <label><input type="radio" name="type" id="type_Tablet" value="Tablet" onclick="toggleOptions();">Tablet</label>
                </div>
                <div class="col-md-2">
                    <label><input type="radio" name="type" id="type_Television" value="Television"
                                  onclick="toggleOptions();">Television</label>
                </div>
                <div class="col-md-2"></div>
            </form>
        </div>
    </div>

    <!-- Form for Computers -->
    <div id="nextSetOfComputerOptions" style="display:none;" class="form-group row bg-color-white">
        <form id="desktop" class="form-horizontal">
            <div class="col-md-12">
                <div class="col-md-5">
                    <div class="form-group">
                        Brand:
                        <select name="brand" id="computer-brand" class="form-control">
                            <option value="Select brands" title="Select brands" selected disabled>Select brands</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Processor Type:
                        <select name="processor" id="desktop-processor" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        RAM Size:
                        <select name="ram" id="desktop-ram-size" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        Hard Drive Size:
                        <select name="hard-drive-size" id="storage-capacity" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        Number of Cores:
                        <select name="core" id="cpu-cores" class="form-control"></select>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <div class="form-group">
                        Price:
                        <input type="text" name="desktop-price"  class="form-control">
                    </div>
                    <div class="form-group">
                        Weight (Kg):
                        <input type="text" name="desktop-weight" class="form-control">
                    </div>
                    <div class="form-group">
                        Height (cm):
                        <input type="text" name="desktop-height" class="form-control">
                    </div>
                    <div class="form-group">
                        Width (cm):
                        <input type="text" name="desktop-width" class="form-control">
                    </div>
                    <div class="form-group">
                        Thickness (cm):
                        <input type="text" name="desktop-thickness" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>


        </form>
    </div>

    <!-- Form for Laptops -->
    <div id="nextSetOfLaptopOptions" style="display:none;" class="form-group">
        <form id="laptop">
            Display Size (in inches):<br>
            <input type="text" name="display-size-laptop" class="form-control"><br>
            Processor Type:
            <input type="text" name="processor-laptop" class="form-control"><br>
            RAM Size:<br>
            <select name="ram-laptop" class="form-control">
                <option value="512">512 MB</option>
                <option value="1">1 GB</option>
                <option value="2">2 GB</option>
                <option value="4">4 GB</option>
                <option value="8">8 GB</option>
                <option value="12">12 GB</option>
            </select><br>
            Weight:<br>
            <input type="text" name="weight-laptop" class="form-control"><br>
            Number of Cores:<br>
            <select name="core-laptop" class="form-control">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="8">8</option>
            </select><br>
            Hard Drive Size:<br>
            <select name="harddrive-laptop" class="form-control">
                <option value="64">64 GB</option>
                <option value="128">128 GB</option>
                <option value="256">256 GB</option>
                <option value="500">500 GB</option>
                <option value="1">1 TB</option>
                <option value="1.5">1.5 TB</option>
                <option value="2">2 TB</option>
                <option value="4">4 TB</option>
            </select><br>
            Battery Information:<br>
            <input type="text" name="battery" class="form-control"><br>
            Brand Name:<br>
            <input type="text" name="brand-laptop" class="form-control"><br>
            Model Number:<br>
            <input type="text" name="model-laptop" class="form-control"><br>
            Built-in Operating System:<br>
            <input type="text" name="os-laptop" class="form-control"><br>
            Price:<br>
            <input type="text" name="price-laptop" class="form-control"><br>
            <input type="radio" name="camera" value="Camera">Built-in Camera<br>
            <input type="radio" name="touch-screen" value="Touch-Screen">Touch-Screen<br>

            <!-- bootstrap submit button -->
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </form>
    </div>

    <!-- Form for Tablets -->
    <div id="nextSetOfTabletOptions" style="display:none;" id="form-group">
        <form id="tablet">
            Display Size (in inches):<br>
            <input type="text" name="display-size-tablet" class="form-control"><br>
            Detailed Dimensions (in centimeters):<br>
            <input type="text" name="dimensions-tablet" class="form-control"><br>
            Weight:<br>
            <input type="text" name="weight-tablet" class="form-control"><br>
            Processor Type:<br>
            <input type="text" name="processor-tablet" class="form-control"><br>
            RAM Size:<br>
            <select name="ram-tablet" class="form-control">
                <option value="256">256 MB</option>
                <option value="512">512 MB</option>
                <option value="1">1 GB</option>
                <option value="2">2 GB</option>
                <option value="4">4 GB</option>
            </select><br>
            Weight:<br>
            <input type="text" name="weight-laptop" class="form-control"><br>
            Number of Cores:<br>
            <select name="core-tablet" class="form-control">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select><br>
            Hard Drive Size:<br>
            <select name="harddrive-tablet" class="form-control">
                <option value="64">64 GB</option>
                <option value="128">128 GB</option>
                <option value="256">256 GB</option>
                <option value="500">500 GB</option>
                <option value="1">1 TB</option>
                <option value="1.5">1.5 TB</option>
                <option value="2">2 TB</option>
                <option value="4">4 TB</option>
            </select><br>
            Battery Information:<br>
            <input type="text" name="battery-tablet" class="form-control"><br>
            Brand Name:<br>
            <input type="text" name="brand-tablet" class="form-control"><br>
            Model Number:<br>
            <input type="text" name="model-tablet" class="form-control"><br>
            Built-in Operating System:<br>
            <input type="text" name="os-tablet" class="form-control"><br>
            Camera Information:<br>
            <input type="text" name="camera-tablet" class="form-control"><br>
            Price:<br>
            <input type="text" name="price-laptop" class="form-control"><br>

            <!-- bootstrap submit button -->
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </form>
    </div>

    <!-- Form for Televisions -->
    <div id="nextSetOfTelevisionOptions" style="display:none;" class="row bg-color-white">
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
                        <input type="text" name="television-price" class="form-control">
                    </div>
                    <div class="form-group">
                        Height (cm):
                        <input type="text" name="television-height" class="form-control">
                    </div>
                    <div class="form-group">
                        Width (cm):
                        <input type="text" name="television-width" class="form-control">
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <div class="form-group">
                        Thickness (cm):
                        <input type="text" name="television-thickness" class="form-control">
                    </div>
                    <div class="form-group">
                        Weight (Kg):
                        <input type="text" name="television-weight" class="form-control">
                    </div>
                    <div class="form-group">
                        Type:
                        <select name="television-type" id="television-type" class="form-control"></select>
                    </div>
                </div>
            </div>
        </form>
        <!-- bootstrap submit button -->
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </div>

    <!-- trigger onclick depending on which radio button checked -->
    <script type="text/javascript">
        function toggleOptions() {
            if (document.getElementById('type_Computer').checked) {
                document.getElementById('nextSetOfTabletOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'none';
                document.getElementById('nextSetOfComputerOptions').style.display = '';
            }
            else if (document.getElementById('type_Laptop').checked) {
                document.getElementById('nextSetOfTabletOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'none';
                document.getElementById('nextSetOfComputerOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = '';
            }
            else if (document.getElementById('type_Tablet').checked) {
                document.getElementById('nextSetOfComputerOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'none';
                document.getElementById('nextSetOfTabletOptions').style.display = '';
            }
            else if (document.getElementById('type_Television').checked) {
                document.getElementById('nextSetOfTabletOptions').style.display = 'none';
                document.getElementById('nextSetOfComputerOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = '';
            }
        }
    </script>


@endsection