var dropDownOptions = {
    /**
     * Where do I get these data
     * http://www.rtings.com/tv/reviews/by-size/size-to-distance-relationship
     * https://www.thetoptens.com/best-television-brands/page1.asp
     * http://www.webopedia.com/TERM/O/operating_system.html
     * https://www.staples.ca/en/
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
        "cpuCores": [2,3,4,8]
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
        ],
    }

};


var FormFunctions = (function () {

    var populateDesktopComputer_BrandsDropDown = {};
    var computerBrandSel = {};
    var ramSizeSel = {};
    var storageCapacitySel = {};
    var desktopProcessorSel = {};
    var cpuCoresSel = {};

    return {

        /**
         * All the elements required before an
         * event occurred must be in the init function.
         */
        init: function () {

            populateDesktopComputer_BrandsDropDown = null;
            computerBrandSel = $('#computer-brand');
            ramSizeSel = $("#desktop-ram-size");
            storageCapacitySel = $('#storage-capacity');
            desktopProcessorSel = $('#desktop-processor');
            cpuCoresSel = $('#cpu-cores');
            this.formFunctions();
        },
        formFunctions: function () {

            populateDesktopComputer_BrandsDropDown = function () {
                $.each(dropDownOptions.computer.brands, function (key, value) {
                    computerBrandSel.append('<option value="'+value+'" title="'+value+'">'+value+'</option>');
                });
                $.each(dropDownOptions.computer.ramSize, function (key, value) {
                    ramSizeSel.append('<option value="'+value+'" title="'+value+'">'+value+'</option>');
                });
                $.each(dropDownOptions.computer.storageSize, function (k, v) {
                    storageCapacitySel.append('<option value="'+v[0]+'" title="'+v[1]+'">'+v[1]+'</option>');
                });
                $.each(dropDownOptions.computer.processorType, function (k, v) {
                    desktopProcessorSel.append('<option value="'+v+'" title="'+v+'">'+v+'</option>');
                });
                $.each(dropDownOptions.computer.cpuCores, function (k, v) {
                    cpuCoresSel.append('<option value="'+v+'" title="'+v+'">'+v+'</option>');
                });

            };
            populateDesktopComputer_BrandsDropDown();

        }
    }; // end return
})();


$(document).ready(function () {
    FormFunctions.init();
});