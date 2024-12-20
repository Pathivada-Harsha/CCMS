// $(document).ready(function () {
//     // Fetch data once from the database
//     $.ajax({
//         url: window.location.href+"?fetch_buildings=true",
//         type: "GET",
//         dataType: "json",
//         success: function (data) {
//             // Get all dropdowns and update them
//             $('select[id^="building-dropdown"]').each(function () {
//                 const dropdown = $(this);
//                 dropdown.empty(); // Clear existing options
//                 dropdown.append('<option value="">Select from dropdown</option>');

//                 // Loop through the data and append options
//                 $.each(data, function (key, value) {
//                     dropdown.append('<option value="' + value.building_id + '">' + value.building_name + '</option>');
//                 });
//             });
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             console.log("AJAX Error: " + textStatus);
//         }
//     });
// });





