let dropDownOptions = {
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
        "ramSize": [2, 4, 6, 8, 12, 16, 32],
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
        "cpuCores": [2, 3, 4, 6, 8],
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

let FormDropDownFields = (function () {
    let desktopForm = {};
    let laptopForm = {};
    let tabletForm = {};
    let tvForm = {};
    let monitorForm = {};

    return {
        init: function () {
            desktopForm = $('form#desktop');
            laptopForm = $('form#laptop');
            tabletForm = $('form#tablet');
            tvForm = $('form#television');
            monitorForm = $('form#monitor-form');
            this.bindFormDropDownFns();
        },
        bindFormDropDownFns: function () {
            computerDropDowns.brandsFn(
                [desktopForm.find('#computer-brand'),
                    laptopForm.find('#laptop-brand'),
                    tabletForm.find('#tablet-brand')]
            );
            computerDropDowns.ramSizeFn(
                [desktopForm.find('#desktop-ram-size'),
                laptopForm.find('#laptop-ram-size'),
                tabletForm.find('#tablet-ram-size')]
            );
            computerDropDowns.storageSizeFn(
                [desktopForm.find('#storage-capacity'),
                laptopForm.find('#laptop-storage-capacity'),
                tabletForm.find('#tablet-storage-capacity')]
            );
            computerDropDowns.processorTypeFn(
                [desktopForm.find('#desktop-processor'),
                laptopForm.find('#laptop-processor'),
                tabletForm.find('#tablet-processor')]
            );
            computerDropDowns.cpuCoresFn(
                [desktopForm.find('#cpu-cores'),
                laptopForm.find('#laptop-cpu-cores'),
                tabletForm.find('#tablet-cpu-cores')]
            );
            computerDropDowns.displaySizeFn(
                [laptopForm.find('#laptop-display-size'),
                tabletForm.find('#tablet-display-size')]
            );
            computerDropDowns.osFn(
                [laptopForm.find('#laptop-os'),
                tabletForm.find('#tablet-os')]
            );
            monitorDropDowns.brandsFn([monitorForm.find("#monitor-brand")]);
            monitorDropDowns.displaySizeFn([monitorForm.find("#monitor-display-size")]);
            tvDropDowns.brandsFn(tvForm);
            tvDropDowns.typesFn(tvForm);
        },
    };
})();

// for computer drop downs
let computerDropDowns = {
    brandsFn: function (formsArray) {
        $.each(dropDownOptions.computer.brands, function (key, value) {
            for(let i = 0; i < formsArray.length; i++) {
                formsArray[i].append(
                    '<option value="'+value+'" title="'+value+'">'+value+'</option>'
                );
            }
        });
    },
    ramSizeFn: function (formsArray) {
        $.each(dropDownOptions.computer.ramSize, function (key, value) {
            for(let i = 0; i < formsArray.length; i++) {
                formsArray[i].append(
                    '<option value="'+value+'" title="'+value+'">'+value+'</option>'
                );
            }

        });
    },
    storageSizeFn: function (formsArray) {
        $.each(dropDownOptions.computer.storageSize, function (k, v) {
            for(let i = 0; i < formsArray.length; i++) {
                formsArray[i].append(
                    '<option value="'+v[0]+'" title="'+v[1]+'">'+v[1]+'</option>'
                );
            }
        });
    },
    processorTypeFn: function (formsArray) {
        $.each(dropDownOptions.computer.processorType, function (k, v) {
            for(let i = 0; i < formsArray.length; i++) {
                formsArray[i].append(
                    '<option value="'+v+'" title="'+v+'">'+v+'</option>'
                );
            }
        });
    },
    cpuCoresFn: function (formsArray) {
        $.each(dropDownOptions.computer.cpuCores, function (k, v) {
            for(let i = 0; i < formsArray.length; i++) {
                formsArray[i].append(
                    '<option value="'+v+'" title="'+v+'">'+v+'</option>'
                );
            }
        });
    },
    displaySizeFn: function (formsArray) {
        $.each(dropDownOptions.computer.displaySize, function (k, v) {
            for(let i = 0; i < formsArray.length; i++) {
                formsArray[i].append(
                    '<option value="'+v+'" title="'+v+'">'+v+'</option>'
                );
            }
        });
    },
    osFn: function (formsArray) {
        $.each(dropDownOptions.computer.os, function (k, v) {
            for(let i = 0; i < formsArray.length; i++) {
                formsArray[i].append(
                    '<option value="'+v+'" title="'+v+'">'+v+'</option>'
                );
            }
        });
    }
};

// for monitor drop downs [only brands, and display size]
let monitorDropDowns = {
    brandsFn: function (formsArray) {
        $.each(dropDownOptions.monitor.brands, function (key, value) {
            for(let i = 0; i < formsArray.length; i++) {
                formsArray[i].append(
                    '<option value="'+value+'" title="'+value+'">'+value+'</option>'
                );
            }
        });
    },
    displaySizeFn: function (formsArray) {
        $.each(dropDownOptions.monitor.displaySize, function (key, value) {
            for(let i = 0; i < formsArray.length; i++) {
                formsArray[i].append(
                    '<option value="'+value+'" title="'+value+'">'+value+'</option>'
                );
            }
        });
    }
};

// for tv drop downs
let tvDropDowns = {
    brandsFn: function (tvForm) {
        $.each(dropDownOptions.tv.brands, function (key, value) {
            tvForm.find('#television-brand').append('<option value="'+value+'" title="'+value+'">'+value+'</option>');
        });
    },
    typesFn: function (tvForm) {
        $.each(dropDownOptions.tv.types, function (key, value) {
            tvForm.find('#television-type').append('<option value="'+value+'" title="'+value+'">'+value+'</option>');
        });
    }
};

$(document).ready(function () {
    let onClick_CreateNewItems = $('.create-new-items');
    let createNewItemRedirectFn = function () {
        let itemsCreateLoc = '/items/create';
        onClick_CreateNewItems.click(function () {
            location.href = itemsCreateLoc;
        });
    };
    createNewItemRedirectFn();
    FormDropDownFields.init();
});