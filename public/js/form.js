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
            "Microsoft Windows 7",
            "Microsoft Windows 8",
            "Microsoft Windows 8.1",
            "Microsoft Windows 10",
            "Microsoft Windows XP",
			"Microsoft Windows RT",
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
        "cpuCores": [2,3,4,8],
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

    var desktopBrandSel = {},
    desktopRamSizeSel = {},
    desktopStorageCapacitySel = {},
    desktopProcessorSel = {},
    desktopCpuCoresSel = {};

    // tv
    var brandTvSel = {},
    tvTypesSel = {};

    // laptop
    var laptopBrandSel = {},
    laptopRamSizeSel = {},
    laptopProcessorType = {},
    laptopStorageCapacitySel = {},
    laptopCpuCoresSel = {},
    laptopDisplaySizeSel = {},
    laptopOS_Sel = {};


    var
        tabletBrandSel = {},
    tabletRamSizeSel = {},
    tabletProcessorType = {},
    tabletStorageCapacitySel = {},
    tabletCpuCoresSel = {},
    tabletDisplaySizeSel = {},
    tabletOS_Sel = {};

    // click Add New redirect to Create Items
    var onClickCreateNewItems = {};

    return {

        /**
         * All the elements required before an
         * event occurred must be in the init function.
         */
        init: function () {

            desktopBrandSel = $('#computer-brand');
            desktopRamSizeSel = $("#desktop-ram-size");
            desktopStorageCapacitySel = $('#storage-capacity');
            desktopProcessorSel = $('#desktop-processor');
            desktopCpuCoresSel = $('#cpu-cores');

            // tv
            brandTvSel = $('#television-brand');
            tvTypesSel = $('#television-type');

            // laptop
            laptopBrandSel = $('#laptop-brand');
            laptopRamSizeSel = $('#laptop-ram-size');
            laptopCpuCoresSel = $('#laptop-cpu-cores');
            laptopProcessorType = $('#laptop-processor');
            laptopStorageCapacitySel = $('#laptop-storage-capacity');
            laptopDisplaySizeSel = $('#laptop-display-size');
            laptopOS_Sel = $('#laptop-os');

            // tablet
            tabletBrandSel = $('#tablet-brand');
            tabletRamSizeSel = $('#tablet-ram-size');
            tabletProcessorType = $('#tablet-processor');
            tabletStorageCapacitySel = $('#tablet-storage-capacity');
            tabletCpuCoresSel = $('#tablet-cpu-cores');
            tabletDisplaySizeSel = $('#tablet-display-size');
            tabletOS_Sel = $('#tablet-os');

            onClickCreateNewItems = $('.create-new-items');


            this.formFunctions();
            this.createNewItemRedirectFn();
        },
        formFunctions: function () {
            (function () {
                $.each(dropDownOptions.computer.brands, function (key, value) {
                    var computerBrands = '<option value="'+value+'" title="'+value+'">'+value+'</option>';
                    desktopBrandSel.append(computerBrands);
                    laptopBrandSel.append(computerBrands);
                    tabletBrandSel.append(computerBrands);
                });
                $.each(dropDownOptions.computer.ramSize, function (key, value) {
                    var computerRamSize = '<option value="'+value+'" title="'+value+'">'+value+'</option>';
                    desktopRamSizeSel.append(computerRamSize);
                    laptopRamSizeSel.append(computerRamSize);
                    tabletRamSizeSel.append(computerRamSize);
                });
                $.each(dropDownOptions.computer.storageSize, function (k, v) {
                    var storageCapacity = '<option value="'+v[0]+'" title="'+v[1]+'">'+v[1]+'</option>';
                    desktopStorageCapacitySel.append(storageCapacity);
                    laptopStorageCapacitySel.append(storageCapacity);
                    tabletStorageCapacitySel.append(storageCapacity);
                });
                $.each(dropDownOptions.computer.processorType, function (k, v) {
                    var processorType = '<option value="'+v+'" title="'+v+'">'+v+'</option>';
                    desktopProcessorSel.append(processorType);
                    laptopProcessorType.append(processorType);
                    tabletProcessorType.append(processorType);
                });
                $.each(dropDownOptions.computer.cpuCores, function (k, v) {
                    var cpuCores = '<option value="'+v+'" title="'+v+'">'+v+'</option>';
                    desktopCpuCoresSel.append(cpuCores);
                    laptopCpuCoresSel.append(cpuCores);
                    tabletCpuCoresSel.append(cpuCores);
                });

                $.each(dropDownOptions.computer.displaySize, function (k, v) {
                    var displaySize = '<option value="'+v+'" title="'+v+'">'+v+'</option>';
                    laptopDisplaySizeSel.append(displaySize);
                    tabletDisplaySizeSel.append(displaySize);
                });

                $.each(dropDownOptions.computer.os, function (k, v) {
                    var os = '<option value="'+v+'" title="'+v+'">'+v+'</option>';
                    laptopOS_Sel.append(os);
                    tabletOS_Sel.append(os);
                });


            }());
            (function () {
                $.each(dropDownOptions.tv.brands, function (key, value) {
                    brandTvSel.append('<option value="'+value+'" title="'+value+'">'+value+'</option>');
                });
                $.each(dropDownOptions.tv.types, function (key, value) {
                    tvTypesSel.append('<option value="'+value+'" title="'+value+'">'+value+'</option>');
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