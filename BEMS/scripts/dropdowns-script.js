$(document).ready(function () {
    // Fetch main supply devices for both tabs on page load
    $.ajax({
        url: window.location.href+"?fetch_data=true", // URL for fetching data
        
        type: "GET",
        dataType: "json",
        success: function (data) {
            // Populate main supply devices dropdown for both tabs
            const mainSupplyDevices = data.mainSupplyDevice;
            $('select[id^="main-supply-device-dropdown"]').each(function () {
                const dropdown = $(this);
                dropdown.empty(); // Clear existing options
                dropdown.append('<option value="">Select from dropdown</option>'); // Default option

                // Append main supply devices as options
                $.each(mainSupplyDevices, function (key, value) {
                    dropdown.append('<option value="' + value.main_device_id + '">' + value.main_device_id + '</option>');
                });
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("AJAX Error: " + textStatus);
        }
    });

    // Event listener for changes in the Main Supply Device dropdown within the current tab
    $('select[id^="main-supply-device-dropdown"]').on('change', function () {
        const selectedMainDeviceId = $(this).val(); // Get selected main supply device
        const currentTab = $(this).closest('.tab-pane'); // Get the current tab
        const floorDropdown = currentTab.find('select[id^="floor-devices-dropdown"]'); // Target floor dropdown in current tab

        if (selectedMainDeviceId) {
            // Fetch floor devices based on selected main supply device
            $.ajax({
                url: window.location.href+"?get_floor_devices=true&main_device_id=" + selectedMainDeviceId, // URL with selected main device
                type: "GET",
                dataType: "json",
                success: function (floorData) {
                    if (floorData && floorData.floors) {
                        // Populate floor devices dropdown in the current tab
                        floorDropdown.empty(); // Clear existing options
                        floorDropdown.append('<option value="">Select from dropdown</option>'); // Default option

                        // Append new floor device options
                        $.each(floorData.floors, function (key, value) {
                            floorDropdown.append('<option value="' + value.floor_device_id + '">' + value.floor_device_id + '</option>');
                        });
                    } else {
                        console.log("No floors data found for the selected main supply device.");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("AJAX Error (Floor Devices): " + textStatus);
                }
            });
        } else {
            // Clear the floor devices dropdown if no main supply device is selected
            floorDropdown.empty();
            floorDropdown.append('<option value="">Select from dropdown</option>');
        }
    });
});
