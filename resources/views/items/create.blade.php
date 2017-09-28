@extends('layouts.app')

@section('content')
    <a href="/items" class='btn btn-default'>Go Back</a>
    <h1>Create Items</h1>
        <div class="form-group">
        <!-- Inital Form -->
            <form name ="form1" id="myForm" method ="post"> 
            <input type="radio" name="type" id="type_Computer" value="Computer" onclick="toggleOptions();">
            Desktop Computer<br>
            <input type="radio" name="type" id="type_Laptop" value="Laptop" onclick="toggleOptions();">
            Laptop<br>
            <input type="radio" name="type" id="type_Tablet" value="Tablet" onclick="toggleOptions();"> 
            Tablet<br>
            <input type="radio" name="type" id="type_Television" value="Television" onclick="toggleOptions();"> 
            Television<br>
            </form>
        </div>

        <!-- Form for Computers -->
        <div id="nextSetOfComputerOptions" style="display:none;">
            <form id="desktop">
                Dimensions (in centimeters):<br>
                <input type="text" name="dimensions"><br>
                Processor Type:<br>
                <input type="text" name="processor"><br>
                RAM Size:<br>
                <select name="ram">
                    <option value="512">512 MB</option>
                    <option value="1">1 GB</option>
                    <option value="2">2 GB</option>
                    <option value="4">4 GB</option>
                    <option value="8">8 GB</option>
                    <option value="12">12 GB</option>
                </select><br>
                Weight:<br>
                <input type="text" name="weight"><br>
                Number of Cores:<br>
                <select name="core">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="8">8</option>
                </select><br>
                Hard Drive Size:<br>
                <select name="harddrive">
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
                <input type="text" name="brand"><br>
                Model Number:<br>
                <input type="text" name="model"><br>
                Price:<br>
                <input type="text" name="price"><br><br><br>
                Monitor Display Size (if any; in inches):<br>
                <input type="text" name="monitor-size"><br>
                Monitor Weight:<br>
                <input type="text" name="monitor-weight"><br>
                Monitor Brand:<br>
                <input type="text" name="monitor-brand"><br>
                Monitor Model Number:<br>
                <input type="text" name="monitor-model"><br>
                Monitor Price:<br>
                <input type="text" name="monitor-price"><br>
            </form>
        </div>

        <!-- Form for Laptops -->
        <div id="nextSetOfLaptopOptions" style="display:none;">
            <form id="laptop">
                Display Size (in inches):<br>
                <input type="text" name="display-size-laptop"><br>
                Processor Type:<br>
                <input type="text" name="processor-laptop"><br>
                RAM Size:<br>
                <select name="ram-laptop">
                    <option value="512">512 MB</option>
                    <option value="1">1 GB</option>
                    <option value="2">2 GB</option>
                    <option value="4">4 GB</option>
                    <option value="8">8 GB</option>
                    <option value="12">12 GB</option>
                </select><br>
                Weight:<br>
                <input type="text" name="weight-laptop"><br>
                Number of Cores:<br>
                <select name="core-laptop">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="8">8</option>
                </select><br>
                Hard Drive Size:<br>
                <select name="harddrive-laptop">
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
                <input type="text" name="battery"><br>
                Brand Name:<br>
                <input type="text" name="brand-laptop"><br>
                Model Number:<br>
                <input type="text" name="model-laptop"><br>
                Built-in Operating System:<br>
                <input type="text" name="os-laptop"><br>
                Price:<br>
                <input type="text" name="price-laptop"><br>
                <input type="radio" name="camera" value="Camera">Built-in Camera<br>
                <input type="radio" name="touch-screen" value="Touch-Screen">Touch-Screen<br>
            </form>
        </div>

        <!-- Form for Tablets -->
        <div id="nextSetOfTabletOptions" style="display:none;">
            <form id="tablet">
                Display Size (in inches):<br>
                <input type="text" name="display-size-tablet"><br>
                Detailed Dimensions (in centimeters):<br>
                <input type="text" name="dimensions-tablet"><br>
                Weight:<br>
                <input type="text" name="weight-tablet"><br>
                Processor Type:<br>
                <input type="text" name="processor-tablet"><br>
                RAM Size:<br>
                <select name="ram-tablet">
                    <option value="256">256 MB</option>
                    <option value="512">512 MB</option>
                    <option value="1">1 GB</option>
                    <option value="2">2 GB</option>
                    <option value="4">4 GB</option>
                </select><br>
                Weight:<br>
                <input type="text" name="weight-laptop"><br>
                Number of Cores:<br>
                <select name="core-tablet">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select><br>
                Hard Drive Size:<br>
                <select name="harddrive-tablet">
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
                <input type="text" name="battery-tablet"><br>
                Brand Name:<br>
                <input type="text" name="brand-tablet"><br>
                Model Number:<br>
                <input type="text" name="model-tablet"><br>
                Built-in Operating System:<br>
                <input type="text" name="os-tablet"><br>
                Camera Information:<br>
                <input type="text" name="camera-tablet"><br>
                Price:<br>
                <input type="text" name="price-laptop"><br>
            </form>
        </div>

        <!-- Form for Televisions -->
        <div id="nextSetOfTelevisionOptions" style="display:none;">
            Detailed Dimensions (in centimeters):<br>
            <input type="text" name="dimensions-television"><br>
            Weight:<br>
            <input type="text" name="weight-television"><br>
            Model Number:<br>
            <input type="text" name="model-television"><br>
            Brand Name:<br>
            <input type="text" name="brand-television"><br>
            Price:<br>
            <input type="text" name="price-television"><br>
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

        <!-- bootstrap submit button -->
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        @endsection