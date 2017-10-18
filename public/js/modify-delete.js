let ModifyDelete = (function () {
    let editDeleteMonitor = null;
    let editDeleteDesktop = null;
    let editDeleteTablet = null;
    let editDeleteLaptop = null;
    let radioCheckerFn = null;
    return {
        init: function () {
            editDeleteMonitor = {
                editLink: $('.edit-monitor-link'),
                modal: $('.bs-edit-monitor-modal-lg'),
                deleteLink: $('#delMonitorLink')
            };
            editDeleteDesktop = {
                editLink: $('.edit-desktop-link'),
                modal: $('.bs-edit-desktop-modal-lg'),
                deleteLink: $('#delDesktopLink')
            };
            editDeleteTablet = {
                editLink: $('.edit-tablet-link'),
                modal: $('.bs-edit-tablet-modal-lg'),
                deleteLink: $('#delTabletLink')
            };
            editDeleteLaptop = {
                editLink: $('.edit-laptop-link'),
                modal: $('.bs-edit-laptop-modal-lg'),
                deleteLink: $('#delLaptopLink')
            };
            this.bindModifyActions();
            this.bindDeleteActions();
        },
        bindModifyActions: function () {
            radioCheckerFn = function (adminChoice, choices) {
                if(adminChoice === "Yes") {
                    choices.eq(0).prop("checked", "checked"); // Yes
                } else {
                    choices.eq(1).prop("checked", "checked"); // No
                }
            } ;
            editDeleteMonitor.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let monitorElements = [];
                rowElements.each(function () {
                    monitorElements.push($(this).text());
                });
                let form = editDeleteMonitor.modal.find('.modal-body > form');
                $.each(form.find("#monitor-brand"), function () {
                    let brandOption = $(this).find("option");
                    for (let i = 0; i < brandOption.length; i++) {
                        if (brandOption.eq(i).attr("title") === monitorElements[1]) {
                            brandOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#monitor-display-size"), function () {
                    let displaySizeOption = $(this).find("option");
                    for (let i = 0; i < displaySizeOption.length; i++) {
                        if (displaySizeOption.eq(i).attr("title") === monitorElements[4]) {
                            displaySizeOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                form.find("#monitor-id").val(monitorElements[0]);
                form.find("#monitor-price").val(monitorElements[2]);
                form.find("#monitor-weight").val(monitorElements[5]);
                $(editDeleteMonitor.modal).modal('show');
                event.preventDefault();
                return false;
            });
            editDeleteDesktop.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let desktopElements = [];
                rowElements.each(function () {
                    desktopElements.push($(this).text());
                });
                let form = editDeleteDesktop.modal.find('.modal-body > form');
                $.each(form.find("#computer-brand"), function () {
                    let brandOption = $(this).find("option");
                    for(let i = 0; i < brandOption.length; i++) {
                        if(brandOption.eq(i).attr("title")===desktopElements[1]) {
                            brandOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#desktop-processor"), function () {
                    let desktopProcessorOption = $(this).find("option");
                    for(let i = 0; i < desktopProcessorOption.length; i++) {
                        if(desktopProcessorOption.eq(i).attr("title") === desktopElements[4]) {
                            desktopProcessorOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#desktop-ram-size"), function () {
                    let desktopRamSizeOption = $(this).find("option");
                    for(let i = 0; i < desktopRamSizeOption.length; i++) {
                        if(desktopRamSizeOption.eq(i).attr("title") === desktopElements[5]) {
                            desktopRamSizeOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#storage-capacity"), function () {
                    let desktopStorageSizeOption = $(this).find("option");
                    for(let i = 0; i < desktopStorageSizeOption.length; i++) {
                        if(desktopStorageSizeOption.eq(i).val() === desktopElements[7]) {
                            desktopStorageSizeOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#cpu-cores"), function () {
                    let desktopCpuOption = $(this).find("option");
                    for(let i = 0; i < desktopCpuOption.length; i++) {
                        if(desktopCpuOption.eq(i).attr("title") === desktopElements[6]) {
                            desktopCpuOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                form.find("#desktop-price").val(desktopElements[2]);
                form.find("#desktop-weight").val(desktopElements[8]);
                form.find("#desktop-height").val(desktopElements[9]);
                form.find("#desktop-width").val(desktopElements[10]);
                form.find("#desktop-thickness").val(desktopElements[11]);
                $(editDeleteDesktop.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDeleteTablet.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let tabletElements = [];
                rowElements.each(function () {
                    tabletElements.push($(this).text());
                });
                console.log(tabletElements);
                let form = editDeleteTablet.modal.find('.modal-body > form');
                $.each(form.find("#tablet-brand"), function () {
                    let brandOption = $(this).find("option");
                    for (let i = 0; i < brandOption.length; i++) {
                        if (brandOption.eq(i).attr("title") === tabletElements[1]) {
                            brandOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#tablet-processor"), function () {
                    let processorOption = $(this).find("option");
                    for (let i = 0; i < processorOption.length; i++) {
                        if (processorOption.eq(i).attr("title") === tabletElements[4]) {
                            processorOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#tablet-ram-size"), function () {
                    let ramOption = $(this).find("option");
                    for (let i = 0; i < ramOption.length; i++) {
                        if (ramOption.eq(i).attr("title") === tabletElements[5]) {
                            ramOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#tablet-storage-capacity"), function () {
                    let storageOption = $(this).find("option");
                    for (let i = 0; i < storageOption.length; i++) {
                        if (storageOption.eq(i).val() === tabletElements[8]) {
                            storageOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#tablet-cpu-cores"), function () {
                    let cpuOption = $(this).find("option");
                    for (let i = 0; i < cpuOption.length; i++) {
                        if (cpuOption.eq(i).attr("title") === tabletElements[7]) {
                            cpuOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#tablet-os"), function () {
                    let osOption = $(this).find("option");
                    for (let i = 0; i < osOption.length; i++) {
                        if (osOption.eq(i).attr("title") === tabletElements[14]) {
                            osOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#tablet-display-size"), function () {
                    let displayOption = $(this).find("option");
                    for (let i = 0; i < displayOption.length; i++) {
                        if (displayOption.eq(i).attr("title") === tabletElements[9]) {
                            displayOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                let cameraChoice = form.find("[name=tablet-camera]");
                radioCheckerFn(tabletElements[15], cameraChoice);
                let touchscreenChoice = form.find("[name=tablet-touchscreen]");
                radioCheckerFn(tabletElements[16], touchscreenChoice);
                form.find("#tablet-id").val(tabletElements[0]);
                form.find("#tablet-price").val(tabletElements[2]);
                form.find("#tablet-weight").val(tabletElements[6]);
                form.find("#tablet-height").val(tabletElements[10]);
                form.find("#tablet-thickness").val(tabletElements[12]);
                form.find("#tablet-battery").val(tabletElements[13]);
                $(editDeleteTablet.modal).modal('show');
                event.preventDefault();
                return false;
            });

            editDeleteLaptop.editLink.click(function (event){
                let tableRow = $(this).parentsUntil('table');
                let rowElements = tableRow.find('td');
                let laptopElements = [];
                rowElements.each(function () {
                    laptopElements.push($(this).text());
                });
                let form = editDeleteLaptop.modal.find('.modal-body > form');
                $.each(form.find("#laptop-brand"), function () {
                    let brandOption = $(this).find("option");
                    for (let i = 0; i < brandOption.length; i++) {
                        if (brandOption.eq(i).attr("title") === laptopElements[1]) {
                            brandOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#laptop-processor"), function () {
                    let processorOption = $(this).find("option");
                    for (let i = 0; i < processorOption.length; i++) {
                        if (processorOption.eq(i).attr("title") === laptopElements[4]) {
                            processorOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#laptop-ram-size"), function () {
                    let ramOption = $(this).find("option");
                    for (let i = 0; i < ramOption.length; i++) {
                        if (ramOption.eq(i).attr("title") === laptopElements[5]) {
                            ramOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#laptop-cpu-cores"), function () {
                    let cpuOption = $(this).find("option");
                    for (let i = 0; i < cpuOption.length; i++) {
                        if (cpuOption.eq(i).attr("title") === laptopElements[7]) {
                            cpuOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#laptop-storage-capacity"), function () {
                    let storageOption = $(this).find("option");
                    for (let i = 0; i < storageOption.length; i++) {
                        if (storageOption.eq(i).val() === laptopElements[8]) {
                            storageOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#laptop-display-size"), function () {
                    let displayOption = $(this).find("option");
                    for (let i = 0; i < displayOption.length; i++) {
                        if (displayOption.eq(i).attr("title") === laptopElements[9]) {
                            displayOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                $.each(form.find("#laptop-os"), function () {
                    let osOption = $(this).find("option");
                    for (let i = 0; i < osOption.length; i++) {
                        if (osOption.eq(i).attr("title") === laptopElements[11]) {
                            osOption.eq(i).prop("selected", "selected");
                        }
                    }
                });
                let cameraChoice = form.find("[name=laptop-camera]");
                radioCheckerFn(laptopElements[12], cameraChoice);
                let touchscreenChoice = form.find("[name=laptop-touchscreen]");
                radioCheckerFn(laptopElements[13], touchscreenChoice);
                form.find("#laptop-price").val(laptopElements[2]);
                form.find("#laptop-weight").val(laptopElements[6]);
                form.find("#laptop-battery").val(laptopElements[10]);
                $(editDeleteLaptop.modal).modal('show');
                event.preventDefault();
                return false;
            });
        },
        bindDeleteActions: function () {
            let delete_links = [
                editDeleteLaptop.deleteLink,
                editDeleteTablet.deleteLink,
                editDeleteDesktop.deleteLink,
                editDeleteMonitor.deleteLink
            ];
            for(let i = 0; i < delete_links.length; i++) {
                delete_links[i].on('show.bs.modal', function (event) {
                    let link = $(event.relatedTarget);
                    let qty = link.data('qty');
                    let itemId = link.data('id');
                    let modal = $(this);
                    modal.find('.modal-body input[type=number]').val(1);
                    modal.find('.modal-body input[type=hidden]').val(itemId);
                    modal.find('.modal-body input[type=number]').attr('max', (qty - 1));
                });
            }
        }
    };
})();

$(document).ready(function () {
    ModifyDelete.init();
});
