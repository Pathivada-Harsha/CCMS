// function PhaseModal(value) {
//     const modalId = value === 1 ? 'rPhaseModal' : value === 2 ? 'yPhaseModal' : value === 3 ? 'bPhaseModal' : value === 4 ? 'rPhaseModal' : null;
//     if (modalId) new bootstrap.Modal(document.getElementById(modalId)).show();
// }
// window.PhaseModal = PhaseModal;


// function sinlePhaseModal(fname,Tname){
//     console.log(`at single phase Modals Transfomer Name ${Tname} and Floor Name ${fname}`);
//     let singlePhaseModals = new bootstrap.Modal(document.getElementById("singlePlaseModals")).show();
// }


// function sinlePhaseModal(fname, Tname) {

//     const singlePhaseModal = new bootstrap.Modal(document.getElementById("singlePlaseModals"));
//     singlePhaseModal.show();
//     console.log(fname,Tname);
// }


// function sinlePhaseModal(fname, tname) {
//     // Show modal
//     const singlePhaseModal = new bootstrap.Modal(document.getElementById("singlePlaseModal"));
//     singlePhaseModal.show();

//     // Fetch data based on the transformer name and floor
//     $.ajax({
//         url: 'energy-audit2.php', // PHP script to fetch data
//         type: 'POST',
//         data: { floor: fname, transformer: tname },
//         success: function(response) {
//             const data = JSON.parse(response);

//             // Populate the R Phase card
//             $('#rconnectedDevicesCount').text(data.r_phase.connected_devices);
//             $('#rPhaseOutgoingPower').text(data.r_phase.installed_load);

//             // Populate the Y Phase card
//             $('#yconnectedDevicesCount').text(data.y_phase.connected_devices);
//             $('#yPhaseOutgoingPower').text(data.y_phase.installed_load);

//             // Populate the B Phase card
//             $('#bconnectedDevicesCount').text(data.b_phase.connected_devices);
//             $('#bPhaseOutgoingPower').text(data.b_phase.installed_load);
//         },
//         error: function(xhr, status, error) {
//             console.error('AJAX Error:', error);
//         }
//     });
// }

// function PhaseModal(value) {
//     const modalId = value === 1 ? 'rPhaseModal' :
//                     value === 2 ? 'yPhaseModal' :
//                     value === 3 ? 'bPhaseModal' : null;

//     if (modalId) {
//         // Close the currently open modal to ensure the new one is on top
//         const currentlyOpenModal = bootstrap.Modal.getInstance(document.querySelector('.modal.show'));
//         if (currentlyOpenModal) {
//             currentlyOpenModal.hide(); // Close the currently open modal
//         }

//         // Show the new modal
//         const newModal = new bootstrap.Modal(document.getElementById(modalId));
//         newModal.show();
//     }
// }
// window.PhaseModal = PhaseModal;
// // Function to fetch and display transformer and floor data
// function fetchFloorsData(selectedTransformerName) {
//     document.getElementById('transformer_total_installed_load').innerHTML=0;
//     // Fetch data based on selected transformer name
//     fetch(window.location.href + '?fetch_transformerData&transformer_name=' + selectedTransformerName)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
//             // Clear previous floor data
//             let t_body = document.getElementById("transformerdata");
//             t_body.innerHTML = '';

//             if (data.floorsData) {
//                 // let floorData = {};  // Initialize the floor data object

//                 // Aggregate data by floor
//                 data.floorsData.forEach(rows => {
//                     var transformerName = rows.transformer_name;
//                     if (!floorData[rows.floor]) {
//                         floorData[rows.floor] = {
//                             total_installed_load: 0,
//                             total_consuming_load: 0,
//                             total_kW: 0,
//                             total_kVA: 0,
//                             devices: [],
//                             transformerName: transformerName
//                         };
//                     }

//                     // Add up the values for each floor
//                     floorData[rows.floor].total_installed_load += parseFloat(rows.installed_load);
//                     floorData[rows.floor].total_consuming_load += parseFloat(rows.consuming_load);
//                     floorData[rows.floor].total_kW += parseFloat(rows.kW);
//                     floorData[rows.floor].total_kVA += parseFloat(rows.kVA);
//                     floorData[rows.floor].devices.push(rows);
//                     floorData[rows.floor].transformerName = transformerName;
//                 });

//                 // Generate HTML for each floor and update the DOM
//                 Object.keys(floorData).forEach(floor => {
//                     let floorDetails = floorData[floor];
//                     let tableData = `
//                         <div class="card mt-2">
//                             <div class="card-head m-0">
//                                 <h5 class="text-center text-primary mt-2">${floor.charAt(0).toUpperCase() + floor.slice(1)} Floor</h5>
//                             </div>
//                             <div class="card-body pt-1 pb-4">
//                                 <div class="row text-center">
//                                     <div class="col-md-4 mt-2">
//                                         <div class="card shadow h-100">
//                                             <div class="card-body m-0 p-0">
//                                                 <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-file-arrow-down-fill text-success"></i> Consumed Load</p>
//                                                 <h6>KW <span id="${floor}_kw">${floorDetails.total_kW}</span></h6>
//                                                 <h6>KVA <span id="${floor}_kva">${floorDetails.total_kVA}</span></h6>
//                                             </div>
//                                         </div>
//                                     </div>
//                                     <div class="col-md-4 mt-2">
//                                         <div class="card shadow h-100">
//                                             <div class="card-body m-0 p-0">
//                                                 <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-file-arrow-up-fill text-danger"></i> Installed Load</p>
//                                                 <h6 class="card-title py-2"><span id="${floor}_installedload">${floorDetails.total_installed_load}</span> W</h6>
//                                             </div>
//                                         </div>
//                                     </div>
//                                     <div class="col-md-4 mt-2">
//                                         <div class="card shadow h-100">
//                                             <div class="card-body m-0 p-0">
//                                                 <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-diagram-3 text-danger"></i> Connected Devices</p>
//                                                 <h6 class="text-decoration-underline text-info pointer" onclick="threePhaseModal('${floor}','${floorDetails.transformerName}')">Three Phase: ${floorDetails.devices.length}</h6>
//                                                 <h6 class="text-decoration-underline text-info pointer" onclick="sinlePhaseModal('${floor}','${floorDetails.transformerName}')">Single Phase: 12</h6>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     `;
//                     t_body.innerHTML += tableData;
//                     console.log(tableData);
//                 });

//               //  Update summary details (e.g., total installed load and total devices count)
//                 let Three_Phase_Devices_Count = Object.keys(floorData).reduce((acc, floor) => acc + floorData[floor].devices.length, 0);
//                 let transformer_total_installed_load = Object.keys(floorData).reduce((acc, floor) => acc + floorData[floor].total_installed_load, 0);

//                 document.getElementById("transformer_total_installed_load").innerHTML = transformer_total_installed_load;
//                 document.getElementById("three_phase_total_devices_count").innerHTML = Three_Phase_Devices_Count;

//             } else {
//                 console.error("No data found for Three Phase Details");
//                 t_body.innerHTML = `<div class="alert alert-danger text-center" role="alert" style='font-weight:bold'>No Data Available for the selected transformer.</div>`;
//                 document.getElementById("transformer_total_installed_load").innerHTML = 0;
//                 document.getElementById("three_phase_total_devices_count").innerHTML = 0;
//                 document.getElementById("single_phase_total_devices_count").innerHTML = 0;
//             }
//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//             document.getElementById("transformerdata").innerHTML = "<p>Error fetching data. Please try again later.</p>";
//         });
// }



// // Function to create and show the three-phase modal
// function threePhaseModal(floor, tname) {
//     // Check if a modal with the same ID already exists, if yes, remove it
//     let existingModal = document.getElementById('threePhaseModal');
//     if (existingModal) {
//         existingModal.remove(); // Remove the previous modal
//     }

//     // Create the modal HTML structure dynamically
//     let modalHTML = `
//         <div class="modal fade" id="threePhaseModal" tabindex="-1" aria-labelledby="threePhaseModalLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
//             <div class="modal-dialog modal-xl modal-dialog-scrollable">
//                 <div class="modal-content">
//                     <div class="modal-header">
//                         <h5 class="modal-title" id="threeModalLabel">${floor.charAt(0).toUpperCase() + floor.slice(1)} Floor Data</h5>
//                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//                     </div>
//                     <div class="modal-body">
//                         <table class="table table-striped text-center border">
//                             <thead>
//                                 <tr>
//                                     <th>Device</th>
//                                     <th>Consuming Load(W)</th>
//                                     <th>Installed Load(W)</th>
//                                     <th>Current(A)</th>
//                                     <th>Voltage(V)</th>
//                                     <th>kW</th>
//                                     <th>kVA</th>
//                                     <th>kWh</th>
//                                     <th>kVAh</th>
//                                     <th>Power Factor(PF)</th>
//                                     <th>Action</th>
//                                 </tr>
//                             </thead>
//                             <tbody id="threePhaseeTableBodyData">
//                             </tbody>
//                             <tfoot>
//                                 <tr>
//                                     <th></th>
//                                     <th colspan="3">Consuming Load(W)</th>
//                                     <th id="threetotalConsumingLoad">0</th>
//                                     <th colspan="3">Total Installed Load (W)</th>
//                                     <th id="threetotalInstalledLoad">0</th>
//                                 </tr>
//                             </tfoot>
//                         </table>
//                     </div>
//                     <div class="modal-footer">
//                         <button type="button" class="btn btn-primary" onclick="addNewThreePhaseDevice('${floor}', '${tname}')">Add Device</button>
//                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     `;

//     // Inject the modal HTML into the body
//     document.body.insertAdjacentHTML('beforeend', modalHTML);

//     // Get the tbody element and clear the previous content (done automatically on modal creation)
//     let t_body = document.getElementById("threePhaseeTableBodyData");

//     // Reset totals to 0
//     let total_installed_load = 0;
//     let total_consuming_load = 0;

//     // Check if floor data exists for this transformer
//     if (floorData[floor] && floorData[floor][tname]) {
//         // Loop through the devices for this transformer
//         floorData[floor][tname].devices.forEach(device => {
//             let tableRow = `
//                 <tr>
//                     <td>${device.device || 'N/A'}</td>
//                     <td>${parseFloat(device.consuming_load) || 0}</td>
//                     <td>${parseFloat(device.installed_load) || 0}</td>
//                     <td>${device.current || 0}</td>
//                     <td>${device.voltage || 0}</td>
//                     <td>${device.kW || 0}</td>
//                     <td>${device.kVA || 0}</td>
//                     <td>${device.kWh || 0}</td>
//                     <td>${device.kVAh || 0}</td>
//                     <td>${device.pf || 0}</td>
//                     <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
//                 </tr>
//             `;
//             t_body.innerHTML += tableRow;

//             // Update totals
//             total_installed_load += parseFloat(device.installed_load);
//             total_consuming_load += parseFloat(device.consuming_load);
//         });

//         // Update total values in the footer
//         document.getElementById("threetotalInstalledLoad").textContent = total_installed_load;
//         document.getElementById("threetotalConsumingLoad").textContent = total_consuming_load;

//     } else {
//         // No data found for the selected transformer and floor
//         let emptyRow = `<tr><td colspan="11" class="text-danger">No data available for this transformer</td></tr>`;
//         t_body.innerHTML = emptyRow;
//     }

//     // Show the modal (if not already visible)
//     let modal = new bootstrap.Modal(document.getElementById("threePhaseModal"));
//     modal.show();

//     // Cleanup the modal after it's closed to avoid duplication
//     document.getElementById("threePhaseModal").addEventListener('hidden.bs.modal', function () {
//         this.remove();
//     });
// }

// // Example function to add a new device
// function addNewThreePhaseDevice(floor, tname) {
//     console.log(`Adding new device to ${floor} with transformer name ${tname}`);
//     // Your logic for adding a new device goes here
// }




// Function to fetch and display transformer and floor data
//  function fetchFloorsData(selectedTransformerName) {
//     
//     // Fetch data based on selected transformer name
//     fetch(window.location.href + '?fetch_transformerData&transformer_name=' + selectedTransformerName)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
//             // Clear previous floor data
//             let t_body = document.getElementById("transformerdata");
//             t_body.innerHTML = '';

//             if (data.floorsData) {
//                 // Initialize/reset floorData for the selected transformer
//                 floorData = {};
//                 let variable='';
//                 // Aggregate data by floor
//                 data.floorsData.forEach(rows => {
//                     if( variable !== rows.floor){
//                         window.location.href + `?fetch_RPhaseData&transformer_name=${selectedTransformerName}&floor_name=${rows.floor}`
//                     }
//                     var transformerName = rows.transformer_name;
//                     if (!floorData[rows.floor]) {
//                         floorData[rows.floor] = {
//                             total_installed_load: 0,
//                             total_consuming_load: 0,
//                             total_kW: 0,
//                             total_kVA: 0,
//                             devices: [],
//                             transformerName: transformerName
//                         };
//                     }

//                     // Add up the values for each floor
//                     floorData[rows.floor].total_installed_load += parseFloat(rows.installed_load);
//                     floorData[rows.floor].total_consuming_load += parseFloat(rows.consuming_load);
//                     floorData[rows.floor].total_kW += parseFloat(rows.kW);
//                     floorData[rows.floor].total_kVA += parseFloat(rows.kVA);
//                     floorData[rows.floor].devices.push(rows);
//                 });

//                 // Generate HTML for each floor and update the DOM
//                 Object.keys(floorData).forEach(floor => {
//                     let floorDetails = floorData[floor];
//                     let tableData = `
//                         <div class="card mt-2">
//                             <div class="card-head m-0">
//                                 <h5 class="text-center text-primary mt-2">${floor.charAt(0).toUpperCase() + floor.slice(1)} Floor</h5>
//                             </div>
//                             <div class="card-body pt-1 pb-4">
//                                 <div class="row text-center">
//                                     <div class="col-md-4 mt-2">
//                                         <div class="card shadow h-100">
//                                             <div class="card-body m-0 p-0">
//                                                 <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-file-arrow-down-fill text-success"></i> Consumed Load</p>
//                                                 <h6>KW <span id="${floor}_kw">${floorDetails.total_kW}</span></h6>
//                                                 <h6>KVA <span id="${floor}_kva">${floorDetails.total_kVA}</span></h6>
//                                             </div>
//                                         </div>
//                                     </div>
//                                     <div class="col-md-4 mt-2">
//                                         <div class="card shadow h-100">
//                                             <div class="card-body m-0 p-0">
//                                                 <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-file-arrow-up-fill text-danger"></i> Installed Load</p>
//                                                 <h6 class="card-title py-2"><span id="${floor}_installedload">${floorDetails.total_installed_load}</span> W</h6>
//                                             </div>
//                                         </div>
//                                     </div>
//                                     <div class="col-md-4 mt-2">
//                                         <div class="card shadow h-100">
//                                             <div class="card-body m-0 p-0">
//                                                 <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-diagram-3 text-danger"></i> Connected Devices</p>
//                                                 <h6 class="text-decoration-underline text-info pointer" onclick="threePhaseModal('${floor}','${floorDetails.transformerName}')">Three Phase: ${floorDetails.devices.length}</h6>
//                                                 <h6 class="text-decoration-underline text-info pointer" onclick="singlePhaseModal('${floor}','${floorDetails.transformerName}')">Single Phase:<span id='${floor}_totalConnectedDeicesCount'> 12</span></h6>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     `;
//                     t_body.innerHTML += tableData;
//                     console.log(tableData);
//                     SinglephaseDevicesCount(selectedTransformerName,` ${floor}`);

//                 });

//                 // Update summary details (e.g., total installed load and total devices count)
//                 let Three_Phase_Devices_Count = Object.keys(floorData).reduce((acc, floor) => acc + floorData[floor].devices.length, 0);
//                 let transformer_total_installed_load = Object.keys(floorData).reduce((acc, floor) => acc + floorData[floor].total_installed_load, 0);

//                 document.getElementById("transformer_total_installed_load").innerHTML = transformer_total_installed_load;
//                 document.getElementById("three_phase_total_devices_count").innerHTML = Three_Phase_Devices_Count;

//             } else {
//                 console.error("No data found for Three Phase Details");
//                 t_body.innerHTML = `<div class="alert alert-danger text-center" role="alert" style='font-weight:bold'>No Data Available for the selected transformer.</div>`;
//                 document.getElementById("transformer_total_installed_load").innerHTML = 0;
//                 document.getElementById("three_phase_total_devices_count").innerHTML = 0;
//                 document.getElementById("single_phase_total_devices_count").innerHTML = 0;
//             }
//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//             document.getElementById("transformerdata").innerHTML = "<p>Error fetching data. Please try again later.</p>";
//         });

// }


// function Total_installedLoad_AND_Consuming_Load(TransformerName, floor) {
//     console.log('TransformerName:' + TransformerName + " floor:" + floor);

//     fetch(window.location.href + "?fetch_Total_Consuming_Installed_loads&transformer_name=" + TransformerName + "&floor_name=" + floor)
//     .then(response => {
//         if (!response.ok) {
//             throw new Error('Network response was not ok');
//         }
//         return response.json();
//     })
//     .then(data => {
//         const loadData = data.Total_Consuming_Installed_loads[0]; // Access first element of the array

//         if (loadData) {
//             // Format KVA to 2 decimal places
//             const formattedKVA = parseFloat(loadData.Total_kva).toFixed(2);
//             console.log(`Installed Load: ${loadData.Total_Installed_Load}, KW: ${loadData.Total_kw}, KVA: ${formattedKVA}`);

//             // Get the existing installed load value from the element with ID 'transformer_total_installed_load'
//             const existingLoadElement = document.getElementById('transformer_total_installed_load');
//             let existingLoad = parseFloat(existingLoadElement.innerText) || 0; // Convert to number, default to 0 if not a number

//             // Add the new installed load to the existing load
//             const newInstalledLoad = parseFloat(loadData.Total_Installed_Load);
//             const updatedLoad = existingLoad + newInstalledLoad;

//             // Update the element with the new total installed load
//             existingLoadElement.innerText = updatedLoad.toFixed(2); // Update the UI and format to 2 decimal places

//         } else {
//             console.log("No data available for the given transformer and floor.");
//         }
//     })
//     .catch(error => {
//         console.error('Error fetching data:', error);
//     });
// }


// // Example function to add a new device
// function addNewThreePhaseDevice(floor, tname) {
//     console.log(`Adding new device to ${floor} floor with transformer name ${tname}`);

//     // Fixing the typo: Removed the extra quotation mark
//     document.getElementById('f_name').innerHTML = `${floor}`;
//     document.getElementById('t_name').innerHTML = `${tname}`; // Corrected ID

//     // Show the modal
//     let addNewThreePhaseModal = new bootstrap.Modal(document.getElementById('add_three_phase_device'));
//     addNewThreePhaseModal.show();
// }
// function addNewThreePhaseDevice(floor, tname) {
//     console.log(`Adding new device to ${floor} floor with transformer name ${tname}`);

//     // Update modal content dynamically based on the transformer and floor name
//     document.getElementById('f_name').innerHTML = `${floor}`;
//     document.getElementById('t_name').innerHTML = `${tname}`;

//     // Find the existing threePhaseModal and adjust its z-index
//     var threePhaseModal = document.getElementById('threePhaseModal');
//     if (threePhaseModal) {
//         // Adjust z-index to ensure the new modal is displayed above the current modal
//         threePhaseModal.style.zIndex = '1040'; // Default zIndex for Bootstrap modals is 1050, so keep the first one lower
//     }

//     // Show the add_three_phase_device modal on top
//     var addNewThreePhaseModal = new bootstrap.Modal(document.getElementById('add_three_phase_device'), {
//         backdrop: 'static', // Prevent closing by clicking outside
//         keyboard: false     // Disable closing via the Esc key
//     });

//     // Set a higher z-index for the new modal
//     var addThreePhaseDeviceModal = document.getElementById('add_three_phase_device');
//     if (addThreePhaseDeviceModal) {
//         addThreePhaseDeviceModal.style.zIndex = '1055'; // Set higher than the first modal
//     }

//     // Show the modal
//     addNewThreePhaseModal.show();

//     // Optionally, ensure that the backdrop of the new modal is managed well
//     document.body.classList.add('modal-open'); // Prevent backdrop issues
// }

// document.getElementById('saveDevice').addEventListener('click', function () {
//     var deviceName = document.getElementById('device_name').value;
//     var transformerName = document.getElementById('t_name').innerText;
//     var floorName = document.getElementById('f_name').innerText;

//     if (deviceName === '') {
//         document.getElementById('response').innerHTML = 'Device name cannot be empty!';
//         return;
//     }

//     var xhr = new XMLHttpRequest();
//     xhr.open('POST', '../energy-audit2.php', true); // Path to the same file
//     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//     xhr.onload = function () {
//         if (this.status === 200) {
//             document.getElementById('response').innerHTML = this.responseText; // Display the server response
//             // Optionally close the modal or refresh the table here
//             $('#add_three_phase_device').modal('hide');
//             window.location.href = 'energy-audit2.php'; // Refresh the page to reflect the new data
//         } else {
//             document.getElementById('response').innerHTML = 'Failed to save device';
//         }
//     };
//     xhr.send('device_name=' + encodeURIComponent(deviceName) + '&transformer_name=' + encodeURIComponent(transformerName) + '&floor_name=' + encodeURIComponent(floorName));
// });

// document.getElementById('saveDevice').addEventListener('click', function () {
//     var deviceName = document.getElementById('device_name').value;
//     var transformerName = document.getElementById('t_name').innerText;
//     var floorName = document.getElementById('f_name').innerText;

//     if (deviceName === '') {
//         document.getElementById('response').innerHTML = 'Device name cannot be empty!';
//         document.getElementById('response').style.color = 'red';
//         return;
//     }

//     var xhr = new XMLHttpRequest();

//     // Set the correct path to energy-audit2.php
//     xhr.open('POST', '/Projects/Newfolder/CCMS/0/energy-audit2.php', true); // Adjusted path
//     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//     xhr.onload = function () {
//         if (this.status === 200) {
//             document.getElementById('response').innerHTML = this.responseText; // Display the server response
//             // Optionally hide the modal after saving
//             //$('#threePhaseModal').modal('hide'); // Hide the modal after saving
//             // Optionally redirect to another page or refresh
//           //  window.location.href = '/Projects/Newfolder/CCMS/BEMS/modals/threephaseModal.php'; // Adjust if needed
//         } else {
//             document.getElementById('response').innerHTML = 'Failed to save device';
//             document.getElementById('response').style.color = 'red';
//         }
//     };
//     xhr.send('device_name=' + encodeURIComponent(deviceName) + 
//              '&transformer_name=' + encodeURIComponent(transformerName) + 
//              '&floor_name=' + encodeURIComponent(floorName) + 
//              '&consuming_load=0' + 
//              '&installed_load=0' + 
//              '&current=0' + 
//              '&voltage=0' + 
//              '&kW=0' + 
//              '&kVA=0' + 
//              '&kWh=0' + 
//              '&kVAh=0' + 
//              '&pf=0'); // Sending remaining values as 0
// });


// document.getElementById('saveDevice').addEventListener('click', function () {
//     var deviceName = document.getElementById('device_name').value;
//     var transformerName = document.getElementById('t_name').innerText;
//     var floorName = document.getElementById('f_name').innerText;

//     if (deviceName === '') {
//         document.getElementById('response').innerHTML = 'Device name cannot be empty!';
//         document.getElementById('response').style.color = 'red';
//         return;
//     }

//     var xhr = new XMLHttpRequest();

//     // Set the correct path to energy-audit2.php
//     xhr.open('POST', '/Projects/Newfolder/CCMS/0/energy-audit2.php', true); // Adjusted path
//     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//     xhr.onload = function () {
//         if (this.status === 200) {
//             document.getElementById('response').innerHTML = this.responseText; // Display the server response
//             document.getElementById('response').style.color = 'green';
//             // Optionally hide the modal
//             // $('#threePhaseModal').modal('hide'); 
//         } else {
//             document.getElementById('response').innerHTML = 'Failed to save device';
//             document.getElementById('response').style.color = 'red';
//         }
//     };

//     xhr.send('device_name=' + encodeURIComponent(deviceName) + 
//              '&transformer_name=' + encodeURIComponent(transformerName) + 
//              '&floor_name=' + encodeURIComponent(floorName) + 
//              '&consuming_load=0' + 
//              '&installed_load=0' + 
//              '&current=0' + 
//              '&voltage=0' + 
//              '&kW=0' + 
//              '&kVA=0' + 
//              '&kWh=0' + 
//              '&kVAh=0' + 
//              '&pf=0'); // Sending remaining values as 0
//             //    reloadTableData(floorName, transformerName);


// });  this is the code i am using right now

// Function to reload the table data
// function reloadTableData(floor, transformer) {
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', '/Projects/Newfolder/CCMS/0/get_three_phase_data.php?floor=' + encodeURIComponent(floor) + '&transformer=' + encodeURIComponent(transformer), true); // Adjust path for fetching updated data
//     xhr.onload = function () {
//         if (this.status === 200) {
//             var devices = JSON.parse(this.responseText); // Assuming JSON data is returned
//             var t_body = document.getElementById("threePhaseeTableBodyData");
//             var total_installed_load = 0;
//             var total_consuming_load = 0;

//             t_body.innerHTML = ''; // Clear the existing rows

//             // Loop through the devices and update the table
//             devices.forEach(device => {
//                 let tableRow = `
//                     <tr>
//                         <td>${device.device || 'N/A'}</td>
//                         <td>${parseFloat(device.consuming_load) || 0}</td>
//                         <td>${parseFloat(device.installed_load) || 0}</td>
//                         <td>${device.current || 0}</td>
//                         <td>${device.voltage || 0}</td>
//                         <td>${device.kW || 0}</td>
//                         <td>${device.kVA || 0}</td>
//                         <td>${device.kWh || 0}</td>
//                         <td>${device.kVAh || 0}</td>
//                         <td>${device.pf || 0}</td>
//                         <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
//                     </tr>
//                 `;
//                 t_body.innerHTML += tableRow;

//                 // Update totals
//                 total_installed_load += parseFloat(device.installed_load) || 0;
//                 total_consuming_load += parseFloat(device.consuming_load) || 0;
//             });

//             // Update total values in the footer
//             document.getElementById("threetotalInstalledLoad").textContent = total_installed_load;
//             document.getElementById("threetotalConsumingLoad").textContent = total_consuming_load;
//         } else {
//             console.error('Failed to load updated device data');
//         }
//     };
//     xhr.send();
// }


// document.getElementById('saveSinglePhaseDevice').addEventListener('click', function () {

//     var deviceName = document.getElementById('single_device_name').value;
//     var transformerName = document.getElementById('transformer_name').innerText;
//     var phaseName = document.getElementById('phase_name').innerText;
//     var floorName = document.getElementById('floor_name').innerText;

//     if (deviceName === '') {
//         document.getElementById('response').innerHTML = 'Device name cannot be empty!';
//         document.getElementById('response').style.color = 'red';
//         return;
//     }

//     var xhr = new XMLHttpRequest();

//     xhr.open('POST', '/Projects/Newfolder/CCMS/0/energy-audit2.php', true);
//     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

//     xhr.onload = function () {
//         if (this.status === 200) {
//             var responseText = this.responseText.trim();
//             if (responseText === 'Device successfully added!') {
//                 document.getElementById('response').innerHTML = responseText;
//                 document.getElementById('response').style.color = 'green';

//                 // Close the 'Add Device' modal
//                 var addDeviceModal = new bootstrap.Modal(document.getElementById('add_single_phase_device'));
//                 addDeviceModal.hide();

//                 // Update floorData manually with the new device
//                 if (!floorData[floorName]) {
//                     floorData[floorName] = { devices: [] }; // Create a floor entry if not exist
//                 }

//                 // Push the new device into the floorData array
//                 floorData[floorName].devices.push({
//                     device: deviceName,
//                     consuming_load: 0,
//                     installed_load: 0,
//                     current: 0,
//                     voltage: 0,
//                     kW: 0,
//                     kVA: 0,
//                     kWh: 0,
//                     kVAh: 0,
//                     pf: 0
//                 });

//                 // Refresh the threePhaseModal with updated data
//                 singlePhaseModal(floorName, transformerName,phaseName);
//             } else {
//                 document.getElementById('response').innerHTML = responseText;
//                 document.getElementById('response').style.color = 'red';
//             }
//         } else {
//             document.getElementById('response').innerHTML = 'Failed to save device';
//             document.getElementById('response').style.color = 'red';
//         }
//     };

//     // Send the data to the server (this happens asynchronously)
//     xhr.send('device_name=' + encodeURIComponent(deviceName) +
//         '&transformer_name=' + encodeURIComponent(transformerName) +
//         '&floor_name=' + encodeURIComponent(floorName) +
//         '&consuming_load=0' +
//         '&installed_load=0' +
//         '&current=0' +
//         '&voltage=0' +
//         '&kW=0' +
//         '&kVA=0' +
//         '&kWh=0' +
//         '&kVAh=0' +
//         '&pf=0'); // Sending remaining values as 0
// });

// // Handle the hidden event for the 'Add Device' modal
// $('#add_three_phase_device').on('hidden.bs.modal', function () {
//     // Remove the modal if it's still in the DOM to prevent black screen
//     var threePhaseModal = document.getElementById('threePhaseModal');
//     if (threePhaseModal) {
//         threePhaseModal.remove(); // Remove if exists
//     }
// });




// //Handle cancel button click event to hide the modal
// document.getElementById('cancelButton').addEventListener('click', function () {
//     $('#add_three_phase_modal').modal('hide'); // Hide the modal
//     // Optionally, reload the threePhaseModal after canceling
//     threePhaseModal(document.getElementById('f_name').innerText, document.getElementById('t_name').innerText);
//     window.location.reload();

// });



// function singlePhaseModal(transformerName, floorName) {
//     // Create modal elements dynamically
//     const modalHTML = `
//         <div class="modal fade" id="singlePhaseModal" tabindex="-1" aria-labelledby="singlePhaseModalLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
//             <div class="modal-dialog modal-lg">
//                 <div class="modal-content">
//                     <div class="modal-header">
//                         <h5 class="modal-title" id="singlePhaseModalLabel">Single Phase Modal</h5>
//                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//                     </div>
//                     <div class="modal-body" id="singlePhaseModalBody">
//                         <div class="col-12 rounded mt-2 p-0 mb-2">
//                             <div class="row">
//                                 <div class="col-12 col-md-4 mb-md-0 mb-2">
//                                     <div class="card text-center shadow pointer bg-danger" onclick="RPhaseModal( '${floorName}', '${transformerName}','R Phase')">
//                                         <div class="card-body m-0 p-0">
//                                             <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> R PHASE</p>
//                                             <p class="card-title py-2 text-white">Connected Devices: <span id="rConnectedDevicesCount"></span></p>
//                                             <div class="d-flex flex-column flex-md-row justify-content-center">
//                                                 <p class="text-white">Consuming Load: <span id="rphaseconsumingload">0</span></p>
//                                                 <p class="text-white">Installed Load: <span id="rphaseinstalledload">0</span></p>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>

//                                 <div class="col-12 col-md-4 mb-md-0 mb-2">
//                                     <div class="card text-center shadow pointer bg-warning bg-opacity-80" onclick="YPhaseModal('${floorName}', '${transformerName}','Y Phase')">
//                                         <div class="card-body m-0 p-0">
//                                             <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> Y PHASE</p>
//                                             <p class="card-title py-2 text-white">Connected Devices: <span id="yConnectedDevicesCount"></span></p>
//                                             <div class="d-flex flex-column flex-md-row justify-content-center">
//                                                 <p class="text-white">Consuming Load: <span id="yphaseconsumingload">0</span></p>
//                                                 <p class="text-white">Installed Load: <span id="yphaseinstalledload">0</span></p>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>

//                                 <div class="col-12 col-md-4">
//                                     <div class="card text-center shadow pointer bg-primary" onclick="BPhaseModal( '${floorName}', '${transformerName}','B Phase')">
//                                         <div class="card-body m-0 p-0">
//                                             <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> B PHASE</p>
//                                             <p class="card-title py-2 text-white">Connected Devices: <span id="bConnectedDevicesCount"></span></p>
//                                             <div class="d-flex flex-column flex-md-row justify-content-center">
//                                                 <p class="text-white">Consuming Load: <span id="bphaseconsumingload">0</span></p>
//                                                 <p class="text-white">Installed Load: <span id="bphaseinstalledload">0</span></p>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                     <div class="modal-footer d-flex justify-content-center">
//                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     `;

//     // Insert modal into the container
//     document.getElementById('dynamicModalContainer').innerHTML = modalHTML;
//     console.log(modalHTML);

//     // Show the modal using Bootstrap's modal API
//     const singlePhaseModal = new bootstrap.Modal(document.getElementById('singlePhaseModal'));
//     singlePhaseModal.show();

// }

// Example usage: Call this function with appropriate transformer name and floor name
// singlePhaseModal('Transformer 1', 'Floor 2');


// function PhaseModal(phaseName, floorName, transformerName) {
//     const modalId = 'phaseModal'; // Unique ID for the modal

//     // Create the modal structure dynamically
//     const modalHTML = `
//     <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
//         <div class="modal-dialog modal-lg">
//             <div class="modal-content">
//                 <div class="modal-header">
//                     <h5 class="modal-title" id="${modalId}Label">${phaseName} Modal</h5>
//                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//                 </div>
//                 <div class="modal-body" id="${modalId}_body">
//                     <p>Transformer: ${transformerName}</p>
//                     <p>Floor: ${floorName}</p>
//                     <div id="phaseData"></div>
//                 </div>
//                 <div class="modal-footer d-flex justify-content-center">
//                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
//                 </div>
//             </div>
//         </div>
//     </div>`;

//     // Append modal to the body
//     document.body.insertAdjacentHTML('beforeend', modalHTML);

//     // Show the modal
//     const phaseModal = new bootstrap.Modal(document.getElementById(modalId));
//     phaseModal.show();

//     // Fetch phase data from the server
//     fetch(window.location.href + `?fetch_phaseData&transformer_name=${transformerName}&floor_name=${floorName}&phase_name=${phaseName}`)
//         .then(response => response.json())
//         .then(data => {
//             // Handle the response from the server
//             document.getElementById('phaseData').innerHTML = `
//                 <p>Connected Devices: ${data.connectedDevicesCount || 0}</p>
//                 <p>Installed Load: ${data.installedLoad || 'N/A'}</p>
//             `;
//         })
//         .catch(error => console.error('Error fetching phase data:', error));
// }


// function RPhaseModal(phaseName, floorName, transformerName) {
//     const modalId = 'rPhaseModal'; // Use this ID to find the modal

//     // Show the modal
//     const modalElement = document.getElementById(modalId);
//     const phaseModal = new bootstrap.Modal(modalElement);
//     phaseModal.show();

//     // Fetch phase data from the server
//     fetch(window.location.href + `?fetch_phaseData&transformer_name=${transformerName}&floor_name=${floorName}&phase_name=${phaseName}`)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
//             // Clear existing data from the table
//             let tableBody = document.getElementById('Rphase_Modal_Body');
//             tableBody.innerHTML = ''; // Clear previous data

//             if (data) {
//                 console.log(data);
//                 if (data.PhaseData && data.PhaseData.length > 0) {
//                     // If we have transformer data, process it
//                     data.PhaseData.forEach(row => {
//                         let tableRow = `
//                             <tr>
//                                 <td>${row.device}</td>
//                                 <td>${row.consuming_load}</td>
//                                 <td>${row.installed_load}</td>
//                                 <td onclick="smartPowerHub('rphase')"><button class="btn bg-info">${row.smart_power_hub_count}</button></td>
//                                 <td>${row.current}</td>
//                                 <td>${row.voltage}</td>
//                                 <td>${row.kw}</td>
//                                 <td>${row.kva}</td>
//                                 <td>${row.kwh}</td>
//                                 <td>${row.kvah}</td>
//                                 <td>${row.power_factor}</td>
//                                 <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
//                             </tr>
//                         `;
//                         tableBody.innerHTML += tableRow;
//                     });
//                 } else {
//                     // No data found for the selected transformer
//                     tableBody.innerHTML = '<tr><td colspan="12" style="color:red;font-weight:bold;">No Data Available For The Selected Phase</td></tr>';
//                 }
//             }
//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//         });
// }

// function RPhaseModal(transformerName, floorName, phaseName) {
//     let Total_consumingLoad=0;
//     let Total_installedLoad=0;
//     // Clean the phase name
//     phaseName = phaseName.trim(); // Trim any whitespace characters
//     console.log("Floor Name: " + floorName + " | Transformer Name: " + transformerName + " | Phase Name: " + phaseName);
//     // Open the modal
//     $('#rPhaseModal').modal('show');
//     // Clear previous table body data
//     $('#Rphase_Modal_Body').empty();
//     // Fetch data from the database using AJAX
//     fetch(window.location.href + `?fetch_RPhaseData&transformer_name=${transformerName}&floor_name=${floorName}&phase_name=${phaseName}`)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.text(); // Get response as text for debugging
//         })
//         .then(text => {
//             console.log("Raw response:", text); // Log the raw response for debugging
//             const data = JSON.parse(text); // Parse the JSON

//             if (data.RPhaseData && data.RPhaseData.length > 0) {
//                 // Populate the modal with data
//                 data.RPhaseData.forEach(device => {
//                     const row = `
//                         <tr>
//                             <td>${device.device}</td>
//                             <td>${device.consumed_load}</td>
//                             <td>${device.installed_load}</td>
//                             <td onclick="smartPowerHub('rphase')"><button class="btn bg-info">${device.phase.length}</button></td>
//                             <td>${device.current}</td>
//                             <td>${device.voltage}</td>
//                             <td>${device.kw}</td>
//                             <td>${device.kva}</td>
//                             <td>${device.kwh}</td>
//                             <td>${device.kvah}</td>
//                             <td>${device.power_factor}</td>
//                             <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
//                         </tr>
//                     `;
//                     $('#Rphase_Modal_Body').append(row);
//                     Total_consumingLoad +=parseFloat(`${device.consumed_load}`);
//                     Total_installedLoad +=parseFloat(`${device.installed_load}`);
//                 });
//             } else {
//                 $('#Rphase_Modal_Body').append('<tr><td colspan="12">No data available</td></tr>');
//             }
//             document.getElementById('rphaseconsumingload').innerHTML=Total_consumingLoad;
//             document.getElementById('rphaseinstalledload').innerHTML=Total_installedLoad;
//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//             $('#Rphase_Modal_Body').append('<tr><td colspan="12">Error fetching data</td></tr>');
//         });
// }

// function YPhaseModal(transformerName, floorName, phaseName) {
//     let Total_consumingLoad=0;
//     let Total_installedLoad=0;
//     // Clean the phase name
//     phaseName = phaseName.trim(); // Trim any whitespace characters
//     console.log("Floor Name: " + floorName + " | Transformer Name: " + transformerName + " | Phase Name: " + phaseName);
//     // Open the modal
//     $('#yPhaseModal').modal('show');
//     // Clear previous table body data
//     $('#Yphase_Modal_Body').empty();
//     // Fetch data from the database using AJAX
//     fetch(window.location.href + `?fetch_YPhaseData&transformer_name=${transformerName}&floor_name=${floorName}&phase_name=${phaseName}`)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.text(); // Get response as text for debugging
//         })
//         .then(text => {
//             console.log("Raw response:", text); // Log the raw response for debugging
//             const data = JSON.parse(text); // Parse the JSON

//             if (data.YPhaseData && data.YPhaseData.length > 0) {
//                 // Populate the modal with data
//                 data.YPhaseData.forEach(device => {
//                     const row = `
//                         <tr>
//                             <td>${device.device}</td>
//                             <td>${device.consumed_load}</td>
//                             <td>${device.installed_load}</td>
//                             <td onclick="smartPowerHub('yphase')"><button class="btn bg-info">${device.phase.length}</button></td>
//                             <td>${device.current}</td>
//                             <td>${device.voltage}</td>
//                             <td>${device.kw}</td>
//                             <td>${device.kva}</td>
//                             <td>${device.kwh}</td>
//                             <td>${device.kvah}</td>
//                             <td>${device.power_factor}</td>
//                             <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
//                         </tr>
//                     `;
//                     $('#Yphase_Modal_Body').append(row);
//                     Total_consumingLoad +=parseFloat(`${device.consumed_load}`);
//                     Total_installedLoad +=parseFloat(`${device.installed_load}`);
//                 });
//             } else {
//                 $('#Yphase_Modal_Body').append('<tr><td colspan="12">No data available</td></tr>');
//             }
//             document.getElementById('yphaseconsumingload').innerHTML=Total_consumingLoad;
//             document.getElementById('yphaseinstalledload').innerHTML=Total_installedLoad;
//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//             $('#Yphase_Modal_Body').append('<tr><td colspan="12">Error fetching data</td></tr>');
//         });
// }

// function BPhaseModal(transformerName, floorName, phaseName) {
//     let Total_consumingLoad=0;
//     let Total_installedLoad=0;
//     // Clean the phase name
//     phaseName = phaseName.trim(); // Trim any whitespace characters
//     console.log("Floor Name: " + floorName + " | Transformer Name: " + transformerName + " | Phase Name: " + phaseName);
//     // Open the modal
//     $('#bPhaseModal').modal('show');
//     // Clear previous table body data
//     $('#Bphase_Modal_Body').empty();
//     // Fetch data from the database using AJAX
//     fetch(window.location.href + `?fetch_BPhaseData&transformer_name=${transformerName}&floor_name=${floorName}&phase_name=${phaseName}`)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.text(); // Get response as text for debugging
//         })
//         .then(text => {
//             console.log("Raw response:", text); // Log the raw response for debugging
//             const data = JSON.parse(text); // Parse the JSON

//             if (data.BPhaseData && data.BPhaseData.length > 0) {
//                 // Populate the modal with data
//                 data.BPhaseData.forEach(device => {
//                     const row = `
//                         <tr>
//                             <td>${device.device}</td>
//                             <td>${device.consumed_load}</td>
//                             <td>${device.installed_load}</td>
//                             <td onclick="smartPowerHub('bphase')"><button class="btn bg-info">${device.phase.length}</button></td>
//                             <td>${device.current}</td>
//                             <td>${device.voltage}</td>
//                             <td>${device.kw}</td>
//                             <td>${device.kva}</td>
//                             <td>${device.kwh}</td>
//                             <td>${device.kvah}</td>
//                             <td>${device.power_factor}</td>
//                             <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
//                         </tr>
//                     `;
//                     $('#Bphase_Modal_Body').append(row);
//                     Total_consumingLoad +=parseFloat(`${device.consumed_load}`);
//                     Total_installedLoad +=parseFloat(`${device.installed_load}`);
//                 });
//             } else {
//                 $('#Bphase_Modal_Body').append('<tr><td colspan="12">No data available</td></tr>');
//             }
//             document.getElementById('bphaseconsumingload').innerHTML=Total_consumingLoad;
//             document.getElementById('bphaseinstalledload').innerHTML=Total_installedLoad;
//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//             $('#Bphase_Modal_Body').append('<tr><td colspan="12">Error fetching data</td></tr>');
//         });
// }
// Listen for when the modal is hidden and reset z-index if necessary
// document.getElementById('add_single_phase_device').addEventListener('hidden.bs.modal', function () {
//     if (rPhaseModal) {
//         rPhaseModal.style.zIndex = '1055'; // Reset the z-index after adding a new device
//     }
//     if (yPhaseModal) {
//         yPhaseModal.style.zIndex = '1055'; // Reset the z-index after adding a new device
//     }
//     if (bPhaseModal) {
//         bPhaseModal.style.zIndex = '1055'; // Reset the z-index after adding a new device
//     }
// });

// Listen for form submission and perform actions to add a new device
// document.getElementById('addSinglePhaseDeviceForm').addEventListener('submit', function (e) {
//     e.preventDefault();

//     // Collect form data
//     const formData = new FormData(this);

//     // Add additional data to formData if needed
//     formData.append('transformer_name', transformerName);
//     formData.append('floor_name', floorName);
//     formData.append('phase_name', phaseName);

//     // Send data using AJAX or Fetch API to save new device to the server
//     fetch(window.location.href + '?addSinglePhaseDevice', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             // Successfully added the device
//             alert('Device added successfully');
//             addNewSinglePhaseModal.hide(); // Hide the modal after submission
//             // Optionally refresh data or update the UI
//             RPhaseModal(transformerName, floorName, phaseName); // Refresh the modal data
//         } else {
//             // Handle failure
//             alert('Failed to add device');
//         }
//     })
//     .catch(error => {
//         console.error('Error adding device:', error);
//         alert('An error occurred while adding the device');
//     });
// });



// function RPhaseModal(transformerName, floorName, phaseName) {

//     // Check if a modal with the same ID already exists, if yes, remove it
//     let existingModal = document.getElementById('rPhaseModal');
//     if (existingModal) {
//         existingModal.remove(); // Remove the previous modal
//     }

//     // Create the modal HTML structure dynamically
//     let modalHTML = `
//             <div class="modal fade" id="rPhaseModal" tabindex="-1" aria-labelledby="rPhaseModalLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
//                 <div class="modal-dialog modal-xl modal-dialog-scrollable">
//                     <div class="modal-content">
//                          <div class="modal-header">
//                             <h5 class="modal-title" id="rPhaseModalLabel">${floorName.charAt(0).toUpperCase() + floorName.slice(1)} Floor ${phaseName}  Data</h5>
//                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//                         </div>
//                         <div class="modal-body">
//                 <table class="table table-striped text-center border">
//                     <thead>
//                         <tr>
//                             <th>Master Device</th>
//                             <th>Consuming Load(W)</th>
//                             <th>Installed Load(W)</th>
//                             <th>Smart Power Hub</th>
//                             <th>Current(A)</th>
//                             <th>Voltage(V)</th>
//                             <th>kW</th>
//                             <th>kVA</th>
//                             <th>kWh</th>
//                             <th>kVAh</th>
//                             <th>Power Factor(PF)</th>
//                             <th>Action</th>
//                         </tr>
//                     </thead>
//                                 <tbody id="Rphase_Modal_Body">
                                
//                     </tbody>
//                     <tfoot>
//                             <th></th>
//                             <th colspan="3">Total Consuming Load</th>
//                             <th id='rphasetotalconsumingload'></th>
//                             <th colspan="3">Total Installed Load</th>
//                             <th id='rphasetotalinstalledload'></th>
//                     </tfoot>
//                 </table>
                        
//                         </div>
//                         <div class="modal-footer">
//                             <button type="button" class="btn btn-primary" onclick="addNewSinglePhaseDevice('${floorName}', '${transformerName}','${phaseName}')">Add Device</button>
//                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         `;

//     // Inject the modal HTML into the body
//     document.body.insertAdjacentHTML('beforeend', modalHTML);

//     // Get the tbody element and clear the previous content (done automatically on modal creation)
//     let t_body = document.getElementById("Rphase_Modal_Body");

//     // Reset totals to 0
//     let Total_consumingLoad = 0;
//     let Total_installedLoad = 0;
//     let connectedDevicesCount = 0
//     phaseName = phaseName.trim();

//     // Check if floor data exists for this transformer
//     const singlePhaseModal = document.getElementById('singlePhaseModal');
//     if (singlePhaseModal) {
//         singlePhaseModal.style.zIndex = '1040'; // Lower z-index for the singlePhaseModal
//     }

//     const rPhaseModal = document.getElementById('rPhaseModal');
//     if (rPhaseModal) {
//         rPhaseModal.style.zIndex = '1055'; // Higher z-index for the R Phase Modal
//     }
//     const addNewDevice = document.getElementById('add_single_phase_device');
//     if (addNewDevice) {
//         addNewDevice.style.zIndex = '1065';
//     }
//     const smartPowerHub = document.getElementById('smartPowerHub');
//     if (smartPowerHub) {
//         smartPowerHub.style.zIndex = '1065';
//     }
//     // Open the modal
//     $(rPhaseModal).modal('show');
//     $('#Rphase_Modal_Body').empty(); // Clear previous table body data

//     // Fetch data from the database using AJAX
//     fetch(window.location.href + `?fetch_RPhaseData&transformer_name=${transformerName}&floor_name=${floorName}&phase_name=${phaseName}`)
//         .then(response => {
//             if (!response.ok) throw new Error('Network response was not ok');
//             return response.text(); // Get response as text for debugging
//         })
//         .then(text => {
//             const data = JSON.parse(text); // Parse the JSON

//             if (data.RPhaseData && data.RPhaseData.length > 0) {
//                 data.RPhaseData.forEach(device => {
//                     const row = `
//                         <tr>
//                             <td>${device.device}</td>
//                             <td>${device.consumed_load}</td>
//                             <td>${device.installed_load}</td>
//                             <td onclick="smartPowerHub('rphase')"><button class="btn bg-info">${device.phase.length}</button></td>
//                             <td>${device.current}</td>
//                             <td>${device.voltage}</td>
//                             <td>${device.kw}</td>
//                             <td>${device.kva}</td>
//                             <td>${device.kwh}</td>
//                             <td>${device.kvah}</td>
//                             <td>${device.power_factor}</td>
//                             <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
//                         </tr>
//                     `;
//                     $('#Rphase_Modal_Body').append(row);
//                     Total_consumingLoad += parseFloat(`${device.consumed_load}`);
//                     Total_installedLoad += parseFloat(`${device.installed_load}`);
//                     connectedDevicesCount += 1;
//                 });
//             } else {
//                 $('#Rphase_Modal_Body').append('<tr><td colspan="12">No data available</td></tr>');
//             }
//             document.getElementById('rphaseconsumingload').innerHTML = Total_consumingLoad;
//             document.getElementById('rphaseinstalledload').innerHTML = Total_installedLoad;
//             document.getElementById('rphasetotalconsumingload').innerHTML = Total_consumingLoad;
//             document.getElementById('rphasetotalinstalledload').innerHTML = Total_installedLoad;
//             document.getElementById('rConnectedDevicesCount').innerHTML = connectedDevicesCount;
//             transformer_total_installed_load += Total_installedLoad;

//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//             $('#Rphase_Modal_Body').append('<tr><td colspan="12">Error fetching data</td></tr>');
//         });

//     // Reset z-index when the modal is hidden
//     $(rPhaseModal).on('hidden.bs.modal', function () {
//         singlePhaseModal.style.zIndex = ''; // Reset z-index of singlePhaseModal
//         rPhaseModal.style.zIndex = ''; // Reset z-index of the R Phase Modal
//     });
// }

// function YPhaseModal(transformerName, floorName, phaseName) {

//     // Check if a modal with the same ID already exists, if yes, remove it
//     let existingModal = document.getElementById('yPhaseModal');
//     if (existingModal) {
//         existingModal.remove(); // Remove the previous modal
//     }

//     // Create the modal HTML structure dynamically
//     let modalHTML = `
//             <div class="modal fade" id="yPhaseModal" tabindex="-1" aria-labelledby="yPhaseModalLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
//                 <div class="modal-dialog modal-xl modal-dialog-scrollable">
//                     <div class="modal-content">
//                          <div class="modal-header">
//                             <h5 class="modal-title" id="yPhaseModalLabel">${floorName.charAt(0).toUpperCase() + floorName.slice(1)} Floor ${phaseName}  Data</h5>
//                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//                         </div>
//                         <div class="modal-body">
//                 <table class="table table-striped text-center border">
//                     <thead>
//                         <tr>
//                             <th>Master Device</th>
//                             <th>Consuming Load(W)</th>
//                             <th>Installed Load(W)</th>
//                             <th>Smart Power Hub</th>
//                             <th>Current(A)</th>
//                             <th>Voltage(V)</th>
//                             <th>kW</th>
//                             <th>kVA</th>
//                             <th>kWh</th>
//                             <th>kVAh</th>
//                             <th>Power Factor(PF)</th>
//                             <th>Action</th>
//                         </tr>
//                     </thead>
//                     <tbody id="Yphase_Modal_Body"></tbody>
//                     <tfoot>
//                             <th></th>
//                             <th colspan="3">Total Consuming Load</th>
//                             <th id='yphasetotalconsumingload'></th>
//                             <th colspan="3">Total Installed Load</th>
//                             <th id='yphasetotalinstalledload'></th>
//                     </tfoot>

//                 </table>
                        
//                         </div>
//                         <div class="modal-footer">
//                             <button type="button" class="btn btn-primary" onclick="addNewSinglePhaseDevice('${floorName}', '${transformerName}','${phaseName}')">Add Device</button>
//                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         `;

//     // Inject the modal HTML into the body
//     document.body.insertAdjacentHTML('beforeend', modalHTML);

//     // Get the tbody element and clear the previous content (done automatically on modal creation)
//     let t_body = document.getElementById("Yphase_Modal_Body");

//     // Reset totals to 0
//     let Total_consumingLoad = 0;
//     let Total_installedLoad = 0;
//     let connectedDevicesCount = 0
//     phaseName = phaseName.trim();

//     // Check if floor data exists for this transformer
//     const singlePhaseModal = document.getElementById('singlePhaseModal');
//     if (singlePhaseModal) {
//         singlePhaseModal.style.zIndex = '1040'; // Lower z-index for the singlePhaseModal
//     }

//     const yPhaseModal = document.getElementById('yPhaseModal');
//     if (yPhaseModal) {
//         yPhaseModal.style.zIndex = '1055'; // Higher z-index for the R Phase Modal
//     }
//     const addNewDevice = document.getElementById('add_single_phase_device');
//     if (addNewDevice) {
//         addNewDevice.style.zIndex = '1065';
//     }
//     const smartPowerHub = document.getElementById('smartPowerHub');
//     if (smartPowerHub) {
//         smartPowerHub.style.zIndex = '1065';
//     }
//     // Open the modal
//     $(yPhaseModal).modal('show');
//     $('#Yphase_Modal_Body').empty(); // Clear previous table body data

//     // Fetch data from the database using AJAX
//     fetch(window.location.href + `?fetch_YPhaseData&transformer_name=${transformerName}&floor_name=${floorName}&phase_name=${phaseName}`)
//         .then(response => {
//             if (!response.ok) throw new Error('Network response was not ok');
//             return response.text(); // Get response as text for debugging
//         })
//         .then(text => {
//             const data = JSON.parse(text); // Parse the JSON

//             if (data.YPhaseData && data.YPhaseData.length > 0) {
//                 data.YPhaseData.forEach(device => {
//                     const row = `
//                         <tr>
//                             <td>${device.device}</td>
//                             <td>${device.consumed_load}</td>
//                             <td>${device.installed_load}</td>
//                             <td onclick="smartPowerHub('rphase')"><button class="btn bg-info">${device.phase.length}</button></td>
//                             <td>${device.current}</td>
//                             <td>${device.voltage}</td>
//                             <td>${device.kw}</td>
//                             <td>${device.kva}</td>
//                             <td>${device.kwh}</td>
//                             <td>${device.kvah}</td>
//                             <td>${device.power_factor}</td>
//                             <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
//                         </tr>
//                     `;
//                     $('#Yphase_Modal_Body').append(row);
//                     Total_consumingLoad += parseFloat(`${device.consumed_load}`);
//                     Total_installedLoad += parseFloat(`${device.installed_load}`);
//                     connectedDevicesCount += 1;
//                 });
//             } else {
//                 $('#Yphase_Modal_Body').append('<tr><td colspan="12">No data available</td></tr>');
//             }
//             document.getElementById('yphaseconsumingload').innerHTML = Total_consumingLoad;
//             document.getElementById('yphaseinstalledload').innerHTML = Total_installedLoad;
//             document.getElementById('yphasetotalconsumingload').innerHTML = Total_consumingLoad;
//             document.getElementById('yphasetotalinstalledload').innerHTML = Total_installedLoad;
//             document.getElementById('yConnectedDevicesCount').innerHTML = connectedDevicesCount;
//             transformer_total_installed_load += Total_installedLoad;

//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//             $('#Yphase_Modal_Body').append('<tr><td colspan="12">Error fetching data</td></tr>');
//         });

//     // Reset z-index when the modal is hidden
//     $(yPhaseModal).on('hidden.bs.modal', function () {
//         singlePhaseModal.style.zIndex = ''; // Reset z-index of singlePhaseModal
//         yPhaseModal.style.zIndex = ''; // Reset z-index of the R Phase Modal
//     });
// }

// function BPhaseModal(transformerName, floorName, phaseName) {

//     // Check if a modal with the same ID already exists, if yes, remove it
//     let existingModal = document.getElementById('bPhaseModal');
//     if (existingModal) {
//         existingModal.remove(); // Remove the previous modal
//     }

//     // Create the modal HTML structure dynamically
//     let modalHTML = `
//             <div class="modal fade" id="bPhaseModal" tabindex="-1" aria-labelledby="bPhaseModalLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
//                 <div class="modal-dialog modal-xl modal-dialog-scrollable">
//                     <div class="modal-content">
//                          <div class="modal-header">
//                             <h5 class="modal-title" id="bPhaseModalLabel">${floorName.charAt(0).toUpperCase() + floorName.slice(1)} Floor ${phaseName} Data</h5>
//                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//                         </div>
//                         <div class="modal-body">
//                 <table class="table table-striped text-center border">
//                     <thead>
//                         <tr>
//                             <th>Master Device</th>
//                             <th>Consuming Load(W)</th>
//                             <th>Installed Load(W)</th>
//                             <th>Smart Power Hub</th>
//                             <th>Current(A)</th>
//                             <th>Voltage(V)</th>
//                             <th>kW</th>
//                             <th>kVA</th>
//                             <th>kWh</th>
//                             <th>kVAh</th>
//                             <th>Power Factor(PF)</th>
//                             <th>Action</th>
//                         </tr>
//                     </thead>
//                     <tbody id="Bphase_Modal_Body"></tbody>
//                     <tfoot>
//                             <th></th>
//                             <th colspan="3">Total Consuming Load</th>
//                             <th id='bphasetotalconsumingload'></th>
//                             <th colspan="3">Total Installed Load</th>
//                             <th id='bphasetotalinstalledload'></th>
//                     </tfoot>
//                 </table>
                        
//                         </div>
//                         <div class="modal-footer">
//                             <button type="button" class="btn btn-primary" onclick="addNewSinglePhaseDevice('${floorName}', '${transformerName}','${phaseName}')">Add Device</button>
//                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         `;

//     // Inject the modal HTML into the body
//     document.body.insertAdjacentHTML('beforeend', modalHTML);

//     // Get the tbody element and clear the previous content (done automatically on modal creation)
//     let t_body = document.getElementById("Bphase_Modal_Body");

//     // Reset totals to 0
//     let Total_consumingLoad = 0;
//     let Total_installedLoad = 0;
//     let connectedDevicesCount = 0
//     phaseName = phaseName.trim();

//     // Check if floor data exists for this transformer
//     const singlePhaseModal = document.getElementById('singlePhaseModal');
//     if (singlePhaseModal) {
//         singlePhaseModal.style.zIndex = '1040'; // Lower z-index for the singlePhaseModal
//     }

//     const bPhaseModal = document.getElementById('bPhaseModal');
//     if (bPhaseModal) {
//         bPhaseModal.style.zIndex = '1055'; // Higher z-index for the R Phase Modal
//     }
//     const addNewDevice = document.getElementById('add_single_phase_device');
//     if (addNewDevice) {
//         addNewDevice.style.zIndex = '1065';
//     }
//     const smartPowerHub = document.getElementById('smartPowerHub');
//     if (smartPowerHub) {
//         smartPowerHub.style.zIndex = '1065';
//     }
//     // Open the modal
//     $(bPhaseModal).modal('show');
//     $('#Bphase_Modal_Body').empty(); // Clear previous table body data

//     // Fetch data from the database using AJAX
//     fetch(window.location.href + `?fetch_BPhaseData&transformer_name=${transformerName}&floor_name=${floorName}&phase_name=${phaseName}`)
//         .then(response => {
//             if (!response.ok) throw new Error('Network response was not ok');
//             return response.text(); // Get response as text for debugging
//         })
//         .then(text => {
//             const data = JSON.parse(text); // Parse the JSON

//             if (data.BPhaseData && data.BPhaseData.length > 0) {
//                 data.BPhaseData.forEach(device => {
//                     const row = `
//                         <tr>
//                             <td>${device.device}</td>
//                             <td>${device.consumed_load}</td>
//                             <td>${device.installed_load}</td>
//                             <td onclick="smartPowerHub('rphase')"><button class="btn bg-info">${device.phase.length}</button></td>
//                             <td>${device.current}</td>
//                             <td>${device.voltage}</td>
//                             <td>${device.kw}</td>
//                             <td>${device.kva}</td>
//                             <td>${device.kwh}</td>
//                             <td>${device.kvah}</td>
//                             <td>${device.power_factor}</td>
//                             <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
//                         </tr>
//                     `;
//                     $('#Bphase_Modal_Body').append(row);
//                     Total_consumingLoad += parseFloat(`${device.consumed_load}`);
//                     Total_installedLoad += parseFloat(`${device.installed_load}`);
//                     connectedDevicesCount += 1;
//                 });
//             } else {
//                 $('#Bphase_Modal_Body').append('<tr><td colspan="12">No data available</td></tr>');
//             }
//             document.getElementById('bphaseconsumingload').innerHTML = Total_consumingLoad;
//             document.getElementById('bphaseinstalledload').innerHTML = Total_installedLoad;
//             document.getElementById('bphasetotalconsumingload').innerHTML = Total_consumingLoad;
//             document.getElementById('bphasetotalinstalledload').innerHTML = Total_installedLoad;
//             document.getElementById('bConnectedDevicesCount').innerHTML = connectedDevicesCount;
//             transformer_total_installed_load += Total_installedLoad;

//         })
//         .catch(error => {
//             console.error('Error fetching data:', error);
//             $('#Bphase_Modal_Body').append('<tr><td colspan="12">Error fetching data</td></tr>');
//         });

//     // Reset z-index when the modal is hidden
//     $(bPhaseModal).on('hidden.bs.modal', function () {
//         singlePhaseModal.style.zIndex = ''; // Reset z-index of singlePhaseModal
//         bPhaseModal.style.zIndex = ''; // Reset z-index of the R Phase Modal
//     });
// }

// function floorDevicesCount(transformerName, floorName) {
//     console.log("at floor Devices Count Function Transformer Name:"+transformerName+" Floor Name:"+floorName);
//     fetch(window.location.href + `?fetch_singlePhaseTotalDevicesCount&transformer_name=${transformerName}&floor_name=${floorName}`)
//     .then(response => {
//         if (!response.ok) throw new Error('Network response was not ok');
//         return response.text(); // Get response as text for debugging
//     })
//     .then(text => {
//         try {
//             const data = JSON.parse(text); // Parse the JSON
//             if (data.floorDevicesCount) {
//                 console.log("Device Count Data:", data.floorDevicesCount);
//             } else if (data.error) {
//                 console.error("Error:", data.error);
//             }
//         } catch (e) {
//             console.error('Error parsing JSON:', e);
//             console.log('Response Text:', text); // Log raw response for debugging
//         }
//     })
//     .catch(error => {
//         console.error('Error fetching data:', error);
//     });
// }

//adding new devices to a single phase using floor Name ,Transformer Name and Phase 
// function addNewSinglePhaseDevice(floorName, transformerName, phaseName) {
//     console.log(`Adding new device to ${floorName} floor with transformer name ${transformerName} with ${phaseName}`);

//     // Update modal content dynamically based on the transformer and floor name
//     document.getElementById('floor_name').innerHTML = `${floorName}`;
//     document.getElementById('transformer_name').innerHTML = `${transformerName}`;
//     document.getElementById('phase_name').innerHTML = `${phaseName}`;

//     // Adjust z-index for the existing threePhaseModal (if it exists)
//     var rPhaseModal = document.getElementById('rPhaseModal');
//     if (rPhaseModal) {
//         rPhaseModal.style.zIndex = '1040'; // Lower the z-index for the first modal
//     }

//     var yPhaseModal = document.getElementById('yPhaseModal');
//     if (yPhaseModal) {
//         yPhaseModal.style.zIndex = '1040'; // Lower the z-index for the first modal
//     }

//     var bPhaseModal = document.getElementById('bPhaseModal');
//     if (bPhaseModal) {
//         bPhaseModal.style.zIndex = '1040'; // Lower the z-index for the first modal
//     }

//     // Show the add_three_phase_device modal with correct z-index
//     var addNewSinglePhaseModal = new bootstrap.Modal(document.getElementById('add_single_phase_device'), {
//         backdrop: 'static', // Prevent closing by clicking outside
//         keyboard: false     // Disable closing via the Esc key
//     });

//     var addSinglePhaseDeviceModal = document.getElementById('add_single_phase_device');
//     if (addSinglePhaseDeviceModal) {
//         addSinglePhaseDeviceModal.style.zIndex = '1055'; // Set a higher z-index for the new modal
//     }

//     // Show the modal
//     addNewSinglePhaseModal.show();

//     // Add event listener to properly hide the modal on cancel
//     document.getElementById('cancelButton').addEventListener('click', function () {
//         addNewSinglePhaseModal.hide(); // Hide the modal using Bootstrap's hide method
//     });

//     // Listen for when the modal is hidden and reset z-index if necessary
//     document.getElementById('add_single_phase_device').addEventListener('hidden.bs.modal', function () {
//         if (addSinglePhaseDeviceModal) {
//             addSinglePhaseDeviceModal.style.zIndex = ''; // Reset z-index of previous modal

//         }
//     });
// }

