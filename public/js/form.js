const dropDownOptions = {
    /**
     * Where do I get these data
     * http://www.rtings.com/tv/reviews/by-size/size-to-distance-relationship
     * https://www.thetoptens.com/best-television-brands/page1.asp
     * http://www.webopedia.com/TERM/O/operating_system.html
     * https://www.staples.ca/en/
     * https://en.wikipedia.org/wiki/List_of_computer_hardware_manufacturers
     */
    displaySizes: ['4.30', '5.00', '7.00', '7.90', '8.00', '12.00', '13.30',
        '14.00', '15.00', '15.40', '15.70', '19.55', '21.55', '23.00', '23.80', '27.00', '28.00', '34.00',
        '57.00'],
    computer: {
        brands: [
            'Acer',
            'Alienware',
            'Apple',
            'Asus',
            'CyberPowerPC',
            'Dell',
            'Hewlett Packard',
            'IBM',
            'iBuyPower',
            'InFocus',
            'Intel',
            'Lenovo',
            'Microcad',
            'Microsoft',
            'MSI',
            'Zotac',
            'Other',
        ],
        ramSize: [2, 4, 6, 8, 12, 16, 32],
        processorType: ['AMD', 'Intel', 'Rockchip', 'Other',
        ],
        storageSize: [4, 8, 16, 32, 64, 120, 128, 180, 240, 480, 500, 1000, 2000],
        os: [
            'Amazon Fire OS',
            'Apple iOS',
            'Google Android',
            'Linux',
            'Mac OS X 10.11',
            'Mac OS X 10.12',
            'Mac OS X 10.10',
            'Windows 10',
            'Windows 7',
            'Windows 8.1',
            'Windows 8',
            'Windows RT',
            'Windows XP',
            'Other',
        ],
        width: [70.9, 88.6, 95.3, 110.7, 121.7, 132.8, 144.0, 154.9, 166.1],
        height: [39.9, 49.8, 53.6, 62.2, 68.6, 74.7, 81.0, 87.1, 93.5],
        cpuCores: [2, 3, 4, 6, 8],
    },
    tv: {
        brands: [
            'Alba',
            'BPL',
            'Changhong',
            'Coby',
            'Devant',
            'Element',
            'Emerson',
            'Funai',
            'Haier',
            'Hisense',
            'Hitachi',
            'Hyundai',
            'Insignia',
            'JVC',
            'LG',
            'Lloyd',
            'Logik',
            'Maxwell',
            'Micromax',
            'Mitsubishi ',
            'Onida',
            'Panasonic',
            'Pensonic',
            'Philips',
            'Pioneer',
            'RCA',
            'Samsung',
            'Sansui',
            'Sanyo',
            'Seiki',
            'Sharp',
            'Skyworth',
            'Sony ',
            'Sylvania',
            'TCL',
            'Toshiba',
            'Videocon',
            'Vizio',
            'Vu',
            'Westinghouse',
        ],
        types: ['LCD', 'LED', 'OLED'],
        width: [70.9, 88.6, 95.3, 110.7, 121.7, 132.8, 144.0, 154.9, 166.1],
        height: [39.9, 49.8, 53.6, 62.2, 68.6, 74.7, 81.0, 87.1, 93.5],
    },
    monitor: {
        brands: [
            '3M',
            'Acer',
            'AOC Monitors',
            'AOpen',
            'Asus',
            'AU Optronics',
            'BenQ',
            'Biostar',
            'Compaq',
            'Dell',
            'Eizo',
            'Foxconn',
            'Fujitsu',
            'Gateway',
            'Hanns-G',
            'HP',
            'iZ3D',
            'LaCie',
            'Lenovo',
            'LG',
            'MAG Innovision',
            'NEC',
            'Philips',
            'Planar Systems',
            'Samsung',
            'Sceptre Incorporated',
            'Sharp',
            'Shuttle Inc.',
            'Sony',
            'Tatung Company',
            'ViewSonic',
            'Zalman',
        ],
    },
};

const itemsTable = {
    monitor: {
        link: '#monitorTable',
        scrollX: false,
        pageLength: 50,
    },
    tablet: {
        link: '#tabletTable',
        scrollX: true,
        pageLength: 50,
    },
    laptop: {
        link: '#laptopTable',
        scrollX: true,
        pageLength: 50,
    },
    desktop: {
        link: '#desktopTable',
        scrollX: true,
        pageLength: 50,
    },
};

/**
 * Populate select drop down field
 * @param dropDownOptionType
 * @param selectOptionType
 */
const populateDropDownWithOptions = (dropDownOptionType, selectOptionType) => {
    $.each(dropDownOptionType, (key, value) => {
        for (let i = 0; i < selectOptionType.length; i++) {
            selectOptionType[i].append(`<option value="${value}" title="${value}">${value}</option>`);
        }
    });
};

const FormDropDownFields = (() => {
    let formsObj = null;
    let forBrandDropDown = null;
    let forRamSizeDropDown = null;
    let forStorageSizeDropDown = null;
    let forProcessorTypeDropDown = null;
    let forCpuCoresDropDown = null;
    let forDisplaySizeDropDown = null;
    let forOsDropDown = null;

    return {
        init() {
            formsObj = {
                desktopFormSelector: $('form#desktop-form'),
                laptopFormSelector: $('form#laptop-form'),
                tabletFormSelector: $('form#tablet-form'),
                monitorFormSelector: $('form#monitor-form'),
            };
            forBrandDropDown = [
                formsObj.desktopFormSelector.find('select#desktop-brand'),
                formsObj.laptopFormSelector.find('select#laptop-brand'),
                formsObj.tabletFormSelector.find('select#tablet-brand'),
            ];
            forRamSizeDropDown = [
                formsObj.desktopFormSelector.find('select#desktop-ram-size'),
                formsObj.laptopFormSelector.find('select#laptop-ram-size'),
                formsObj.tabletFormSelector.find('select#tablet-ram-size'),
            ];
            forStorageSizeDropDown = [
                formsObj.desktopFormSelector.find('select#desktop-storage-capacity'),
                formsObj.laptopFormSelector.find('select#laptop-storage-capacity'),
                formsObj.tabletFormSelector.find('select#tablet-storage-capacity'),
            ];
            forProcessorTypeDropDown = [
                formsObj.desktopFormSelector.find('select#desktop-processor'),
                formsObj.laptopFormSelector.find('select#laptop-processor'),
                formsObj.tabletFormSelector.find('select#tablet-processor'),
            ];
            forCpuCoresDropDown = [
                formsObj.desktopFormSelector.find('select#cpu-cores'),
                formsObj.laptopFormSelector.find('select#laptop-cpu-cores'),
                formsObj.tabletFormSelector.find('select#tablet-cpu-cores'),
            ];
            forDisplaySizeDropDown = [
                formsObj.laptopFormSelector.find('select#laptop-display-size'),
                formsObj.tabletFormSelector.find('select#tablet-display-size'),
            ];
            forOsDropDown = [
                formsObj.laptopFormSelector.find('select#laptop-os'),
                formsObj.tabletFormSelector.find('select#tablet-os'),
            ];

            this.bindFormDropDownFns();
        },
        bindFormDropDownFns() {
            populateDropDownWithOptions(dropDownOptions.computer.brands, forBrandDropDown);
            populateDropDownWithOptions(dropDownOptions.computer.ramSize, forRamSizeDropDown);
            populateDropDownWithOptions(dropDownOptions.computer.storageSize, forStorageSizeDropDown);
            populateDropDownWithOptions(dropDownOptions.computer.processorType, forProcessorTypeDropDown);
            populateDropDownWithOptions(dropDownOptions.computer.cpuCores, forCpuCoresDropDown);
            populateDropDownWithOptions(dropDownOptions.displaySizes, forDisplaySizeDropDown);
            populateDropDownWithOptions(dropDownOptions.computer.os, forOsDropDown);
            populateDropDownWithOptions(
                dropDownOptions.monitor.brands,
                [formsObj.monitorFormSelector.find('select#monitor-brand')],
            );
            populateDropDownWithOptions(
                dropDownOptions.displaySizes,
                [formsObj.monitorFormSelector.find('select#monitor-display-size')],
            );
        },
    };
})();

$(document).ready(() => {
    FormDropDownFields.init();
    $(itemsTable.tablet.link).DataTable({
        pageLength: itemsTable.tablet.pageLength,
        scrollX: itemsTable.tablet.scrollX,
        searching: false,
    });
    $(itemsTable.monitor.link).DataTable({
        pageLength: itemsTable.monitor.pageLength,
        scrollX: itemsTable.monitor.scrollX,
        searching: false,
    });
    $(itemsTable.laptop.link).DataTable({
        pageLength: itemsTable.laptop.pageLength,
        scrollX: itemsTable.laptop.scrollX,
        searching: false,
    });
    $(itemsTable.desktop.link).DataTable({
        pageLength: itemsTable.desktop.pageLength,
        scrollX: itemsTable.desktop.scrollX,
        searching: false,
    });
});

/**
 * trigger onclick depending on which radio button checked
 */
function toggleOptions() {
    const itemContainer = [
        { radio: $('#type_Computer'), div_id: $('#nextSetOfComputerOptions') },
        { radio: $('#type_Laptop'), div_id: $('#nextSetOfLaptopOptions') },
        { radio: $('#type_Tablet'), div_id: $('#nextSetOfTabletOptions') },
        { radio: $('#type_Monitor'), div_id: $('#nextSetOfMonitorOptions') },
    ];
    for (let i = 0; i < itemContainer.length; i++) {
        if (itemContainer[i].radio.is(':checked')) {
            itemContainer[i].div_id.removeClass('hidden');
        } else {
            itemContainer[i].div_id.addClass('hidden');
        }
    }
}
