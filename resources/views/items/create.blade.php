@extends('layouts.app')

@section('content')
    <a href="/items" class='btn btn-default'>Go Back</a>
    <h1>Create Items</h1>
        <div class="radio">
        <!-- Inital Form -->
            <form name ="form1" id="myForm" method ="post"> 
            <label><input type="radio" name="type" id="type_Computer" value="Computer" onclick="toggleOptions();">Desktop Computer</label><br>
            <label><input type="radio" name="type" id="type_Laptop" value="Laptop" onclick="toggleOptions();">Laptop</label><br>
            <label><input type="radio" name="type" id="type_Tablet" value="Tablet" onclick="toggleOptions();">Tablet</label><br>
            <label><input type="radio" name="type" id="type_Television" value="Television" onclick="toggleOptions();">Television</label><br>
            </form>
        </div>

        <!-- Form for Computers -->
        <div id="nextSetOfComputerOptions" style="display:none;" class="form-group">
            <form id="desktop">
                Dimensions (in centimeters):<br>
                <input type="text" name="dimensions" class="form-control"><br>
                Processor Type:<br>
                <input type="text" name="processor" class="form-control"><br>
                RAM Size:<br>
                <select name="ram" class="form-control">
                    <option value="512">512 MB</option>
                    <option value="1">1 GB</option>
                    <option value="2">2 GB</option>
                    <option value="4">4 GB</option>
                    <option value="8">8 GB</option>
                    <option value="12">12 GB</option>
                </select><br>
                Weight:<br>
                <input type="text" name="weight" class="form-control"><br>
                Number of Cores:<br>
                <select name="core" class="form-control">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="8">8</option>
                </select><br>
                Hard Drive Size:<br>
                <select name="harddrive" class="form-control">
                    <option value="64">64 GB</option>
                    <option value="128">128 GB</option>
                    <option value="256">256 GB</option>
                    <option value="500">500 GB</option>
                    <option value="1">1 TB</option>
                    <option value="1.5">1.5 TB</option>
                    <option value="2">2 TB</option>
                    <option value="4">4 TB</option>
                </select><br>
                Brand Name:<br>
                <input type="text" name="brand" class="form-control"><br>
                Model Number:<br>
                <input type="text" name="model" class="form-control"><br>
                Price:<br>
                <input type="text" name="price" class="form-control"><br><br><br>
                Monitor Display Size (if any; in inches):<br>
                <input type="text" name="monitor-size" class="form-control"><br>
                Monitor Weight:<br>
                <input type="text" name="monitor-weight" class="form-control"><br>
                Monitor Brand:<br>
                <input type="text" name="monitor-brand" class="form-control"><br>
                Monitor Model Number:<br>
                <input type="text" name="monitor-model" class="form-control"><br>
                Monitor Price:<br>
                <input type="text" name="monitor-price" class="form-control"><br>
            
                <!-- bootstrap submit button -->
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </form>
        </div>

        <!-- Form for Laptops -->
        <div id="nextSetOfLaptopOptions" style="display:none;" class="form-group">
            <form id="laptop">
                Display Size (in inches):<br>
                <input type="text" name="display-size-laptop" class="form-control"><br>
                Processor Type:<br>
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
        <div id="nextSetOfTelevisionOptions" style="display:none;" class="form-group">
            Detailed Dimensions (in centimeters):<br>
            <input type="text" name="dimensions-television" class="form-control"><br>
            Weight:<br>
            <input type="text" name="weight-television" class="form-control"><br>
            Model Number:<br>
            <input type="text" name="model-television" class="form-control"><br>
            Brand Name:<br>
            <input type="text" name="brand-television" class="form-control"><br>
            Price:<br>
            <input type="text" name="price-television" class="form-control"><br>

            <!-- bootstrap submit button -->
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </div>

        <!-- trigger onclick depending on which radio button checked -->
        <script type="text/javascript">
        function toggleOptions() {
            if ( document.getElementById('type_Computer').checked ) {
                document.getElementById('nextSetOfTabletOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'none';
                document.getElementById('nextSetOfComputerOptions').style.display = '';
                } 
            else if ( document.getElementById('type_Laptop').checked )
                {
                document.getElementById('nextSetOfTabletOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'none';
                document.getElementById('nextSetOfComputerOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = '';
                }
            else if ( document.getElementById('type_Tablet').checked )
                {
                document.getElementById('nextSetOfComputerOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'none';
                document.getElementById('nextSetOfTabletOptions').style.display = '';
                }
                else if ( document.getElementById('type_Television').checked )
                {
                document.getElementById('nextSetOfTabletOptions').style.display = 'none';
                document.getElementById('nextSetOfComputerOptions').style.display = 'none';
                document.getElementById('nextSetOfLaptopOptions').style.display = 'none';
                document.getElementById('nextSetOfTelevisionOptions').style.display = '';
                }
        }
        </script>

        
        @endsection