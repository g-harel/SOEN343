var dropDownOptions = {
    "computer": {
    "brands": [
        "HP",
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
        "intel®",
        "Other"
    ],
        "ramSize": [
        4,
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
        2,
        4,
        8,
        16,
        32,
        64,
        120,
        128,
        180,
        240,
        480,
        500,
        512,
        1000,
        2000
    ],
        "os": [
        "Windows 7",
        "Windows 10",
        "Windows 8.1",
        "Windows XP",
        "Mac OS X 10.12",
        "Linux",
        "Windows 8",
        "Mac OS X 10.11",
        "Macc OS X 10.10",
        "Other"
    ],
        "displaySize": [
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
}

};


var FormFunctions = (function () {

    var populateBrandsDropDown = {};
    var computerBrandSel = {};

    return {

        /**
         * All the elements required before an
         * event occurred must be in the init function.
         */
        init: function () {

            populateBrandsDropDown = null;
            computerBrandSel = $('#computer-brand');
            this.formFunctions();
        },
        formFunctions: function () {

            populateBrandsDropDown = function () {
                $.each(dropDownOptions.computer.brands, function (key, value) {
                    var h = '<option value="'+value+'" title="'+value+'">'+value+'</option>';
                    computerBrandSel.append(h);
                });
            };
            populateBrandsDropDown();

        }
    }; // end return
})();


$(document).ready(function () {
    FormFunctions.init();
});