var dropDownOptions = {
    /**
     * Where do I get these data
     * http://www.rtings.com/tv/reviews/by-size/size-to-distance-relationship
     * https://www.thetoptens.com/best-television-brands/page1.asp
     * http://www.webopedia.com/TERM/O/operating_system.html
     * https://www.staples.ca/en/
     * https://en.wikipedia.org/wiki/List_of_computer_hardware_manufacturers
     */
    "computer": {
        "brands": [
            "Hewlett Packard",
            "Dell",
            "Acer",
            "Lenovo",
            "ASUS",
            "CyberPowerPC",
            "Apple",
            "iBUYPOWER",
            "MSI",
            "ZOTAC",
            "Alienware",
            "Microcad",
            "Microsoft",
            "IBM",
            "InFocus",
            "Intel",
            "Other"
        ],
        "ramSize": [
            2,
            4,
            6,
            8,
            12,
            16,
            32
        ],
        "processorType": [
            "AMD",
            "Intel",
            "Rockchip",
            "Other"
        ],
        "storageSize": [
            [512, "512MB"],
            [4, "4GB"],
            [8, "8GB"],
            [16, "16GB"],
            [32, "32GB"],
            [64, "64GB"],
            [120, "120GB"],
            [128, "128GB"],
            [180, "180GB"],
            [240, "240GB"],
            [480, "480GB"],
            [500, "500GB"],
            [1, "1TB"],
            [2, "2TB"]
        ],
        "os": [
            "Windows 7",
            "Windows 8",
            "Windows 8.1",
            "Windows 10",
            "Windows XP",
			"Windows RT",
            "Mac OS X 10.12",
            "Mac OS X 10.11",
            "Macc OS X 10.10",
            "Apple iOS",
            "Linux",
			"Google Android",
			"Amazon Fire OS",
			"Other"
        ],
        "width": [
            70.9,
            88.6,
            95.3,
            110.7,
            121.7,
            132.8,
            144.0,
            154.9,
            166.1
        ],
        "height": [
            39.9,
            49.8,
            53.6,
            62.2,
            68.6,
            74.7,
            81.0,
            87.1,
            93.5
        ],
        "cpuCores": [2,3,4,6,8],
        "displaySize": [
            4.3,
            5,
            7,
            7.9,
            8,
            12,
            13.3,
            14,
            15,
            15.4,
            15.7,
            19.5,
            21.5,
            23,
            23.8,
            27,
            28,
            34,
            57
        ]
    },
    "tv": {
        "brands": [
            "Sony ",
            "Samsung",
            "LG",
            "Panasonic",
            "Toshiba",
            "Philips",
            "Sharp",
            "Vizio",
            "Mitsubishi ",
            "Hisense",
            "Sanyo",
            "RCA",
            "Hitachi",
            "TCL",
            "JVC",
            "Micromax",
            "Hyundai",
            "Alba",
            "Logik",
            "Insignia",
            "Maxwell",
            "Skyworth",
            "Pensonic",
            "Coby",
            "Pioneer",
            "Haier",
            "Westinghouse",
            "Onida",
            "Vu",
            "Emerson",
            "Lloyd",
            "Devant",
            "Sansui",
            "BPL",
            "Seiki",
            "Element",
            "Changhong",
            "Videocon",
            "Sylvania",
            "Funai"
        ],
        "types": ["LCD", "LED", "OLED"],
        "width": [
            70.9,
            88.6,
            95.3,
            110.7,
            121.7,
            132.8,
            144.0,
            154.9,
            166.1
        ],
        "height": [
            39.9,
            49.8,
            53.6,
            62.2,
            68.6,
            74.7,
            81.0,
            87.1,
            93.5
        ]
    },
    "monitor": {
        "brands": [
            "3M",
            "Acer",
            "AOC Monitors",
            "Asus",
            "AOpen",
            "AU Optronics",
            "BenQ",
            "Biostar",
            "Foxconn",
            "Compaq",
            "Dell",
            "Eizo",
            "Fujitsu",
            "Gateway",
            "Hanns-G",
            "HP",
            "iZ3D",
            "LaCie",
            "Lenovo",
            "LG",
            "MAG Innovision",
            "NEC",
            "Philips",
            "Planar Systems",
            "Samsung",
            "Sceptre Incorporated",
            "Sharp",
            "Shuttle Inc.",
            "Sony",
            "Tatung Company",
            "ViewSonic",
            "Zalman"
        ],
        "displaySize": [
            4.3,
            5,
            7,
            7.9,
            8,
            12,
            13.3,
            14,
            15,
            15.4,
            15.7,
            19.5,
            21.5,
            23,
            23.8,
            27,
            28,
            34,
            57
        ]
    }

};


var FormFunctions = (function () {
    var desktopForm = {};
    var laptopForm = {};
    var tabletForm = {};
    var tvForm = {};
    var monitorForm = {};

    // click Add New redirect to Create Items
    var onClickCreateNewItems = {};

    return {

        init: function () {
            desktopForm = $('form#desktop');
            laptopForm = $('form#laptop');
            tabletForm = $('form#tablet');
            tvForm = $('form#television');
            monitorForm = $('form#monitor-form');
            onClickCreateNewItems = $('.create-new-items');

            this.formFunctions();
            this.createNewItemRedirectFn();
        },
        formFunctions: function () {
            // for computer (laptop, desktop, tablet) drop downs
            (function () {
                $.each(dropDownOptions.computer.brands, function (key, value) {
                    var computerBrands = '<option value="'+value+'" title="'+value+'">'+value+'</option>';
                    desktopForm.find('#computer-brand').append(computerBrands);
                    laptopForm.find('#laptop-brand').append(computerBrands);
                    tabletForm.find('#tablet-brand').append(computerBrands);
                });
                $.each(dropDownOptions.computer.ramSize, function (key, value) {
                    var computerRamSize = '<option value="'+value+'" title="'+value+'">'+value+'</option>';
                    desktopForm.find('#desktop-ram-size').append(computerRamSize);
                    laptopForm.find('#laptop-ram-size').append(computerRamSize);
                    tabletForm.find('#tablet-ram-size').append(computerRamSize);

                });
                $.each(dropDownOptions.computer.storageSize, function (k, v) {
                    var storageCapacity = '<option value="'+v[0]+'" title="'+v[1]+'">'+v[1]+'</option>';
                    desktopForm.find('#storage-capacity').append(storageCapacity);
                    laptopForm.find('#laptop-storage-capacity').append(storageCapacity);
                    tabletForm.find('#tablet-storage-capacity').append(storageCapacity);
                });
                $.each(dropDownOptions.computer.processorType, function (k, v) {
                    var processorType = '<option value="'+v+'" title="'+v+'">'+v+'</option>';
                    desktopForm.find('#desktop-processor').append(processorType);
                    laptopForm.find('#laptop-processor').append(processorType);
                    tabletForm.find('#tablet-processor').append(processorType);
                });
                $.each(dropDownOptions.computer.cpuCores, function (k, v) {
                    var cpuCores = '<option value="'+v+'" title="'+v+'">'+v+'</option>';
                    desktopForm.find('#cpu-cores').append(cpuCores);
                    laptopForm.find('#laptop-cpu-cores').append(cpuCores);
                    tabletForm.find('#tablet-cpu-cores').append(cpuCores);
                });

                $.each(dropDownOptions.computer.displaySize, function (k, v) {
                    var displaySize = '<option value="'+v+'" title="'+v+'">'+v+'</option>';
                    laptopForm.find('#laptop-display-size').append(displaySize);
                    tabletForm.find('#tablet-display-size').append(displaySize);
                });

                $.each(dropDownOptions.computer.os, function (k, v) {
                    var os = '<option value="'+v+'" title="'+v+'">'+v+'</option>';
                    laptopForm.find('#laptop-os').append(os);
                    tabletForm.find('#tablet-os').append(os);
                });


            }());

            // for tv drop downs
            (function () {
                $.each(dropDownOptions.tv.brands, function (key, value) {
                    tvForm.find('#television-brand').append('<option value="'+value+'" title="'+value+'">'+value+'</option>');
                });
                $.each(dropDownOptions.tv.types, function (key, value) {
                    tvForm.find('#television-type').append('<option value="'+value+'" title="'+value+'">'+value+'</option>');
                });
            }());

            // for monitor drop downs
            (function () {
                $.each(dropDownOptions.monitor.brands, function (key, value) {
                    monitorForm.find('#monitor-brand').append(
                        '<option value="'+value+'" title="'+value+'">'+value+'</option>'
                    );
                });
                $.each(dropDownOptions.monitor.displaySize, function (key, value) {
                    monitorForm.find('#monitor-display-size').append(
                        '<option value="'+value+'" title="'+value+'">'+value+'</option>'
                    );
                });
            }());

        },

        createNewItemRedirectFn: function () {
            var itemsCreateLoc = '/items/create';
            onClickCreateNewItems.click(function () {
               location.href = itemsCreateLoc;
            });
        }
    }; // end return
})();


$(document).ready(function () {
    FormFunctions.init();
});