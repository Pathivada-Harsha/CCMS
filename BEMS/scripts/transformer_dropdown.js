

// $(document).ready(function () {
//     // Fetch data once from the database
//     $.ajax({
//         url: "/projects/CCMS2/0/addnewtransformer1.php?fetch_data=true",
//         type: "GET",
//         dataType: "json",
//         success: function (data) {
//             // Access the mainSupplyDevice array inside the data object
//             const mainSupplyDevices = data.mainSupplyDevice;

//             // Get all dropdowns and update them
//             $('select[id^="main-supply-device-dropdown"]').each(function () {
//                 const dropdown = $(this);
//                 dropdown.empty(); // Clear existing options
//                 dropdown.append('<option value="">Select from dropdown</option>');

//                 // Loop through the data and append options
//                 $.each(mainSupplyDevices, function (key, value) {
//                     dropdown.append('<option value="' + value.main_device_id + '">' + value.main_device_id + '</option>');
//                 });
//             });
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             console.log("AJAX Error: " + textStatus);
//         }
//     });
// });
