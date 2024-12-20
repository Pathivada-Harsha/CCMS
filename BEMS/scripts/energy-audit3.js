function smartPowerHub(data) {
    if (data === "rphase" || data === "yphase" || data === "bphase")
      var FloorModal = new bootstrap.Modal(
        document.getElementById("smartPowerHub")
      ).show();
  }
  
  function consumedLoadModal() {
    let consumedLoad = new bootstrap.Modal(
      document.getElementById("consumedLoadModal")
    ).show();
  }
  
  // document.addEventListener('DOMContentLoaded', function() {
  //     const groupListDropdown = document.getElementById('transformer-list');
  
  //     if (groupListDropdown) {
  //         // Function to fetch and update data
  //         function fetchData(selectedTransformerName) {
  //             localStorage.setItem('selectedTransformer', selectedTransformerName);
  
  //             fetchtransformerConsumedLoadData(selectedTransformerName);
  //             fetchFloorsData(selectedTransformerName);
  
  //             // Reset counts or other UI elements
  //             document.getElementById('floor_kw_total_load').innerHTML = 0;
  //             document.getElementById('floor_kvah_total_load').innerHTML = 0;
  //             document.getElementById('three_phase_total_devices_count').innerHTML = 0;
  //             document.getElementById('single_phase_total_devices_count').innerHTML = 0;
  //             single_phase_at_floor = 0;
  //             three_phase_at_floor = 0;
  //         }
  
  //         // Event listener for dropdown change
  //         groupListDropdown.addEventListener('change', function () {
  //             let selectedTransformerName = this.options[this.selectedIndex].textContent.trim();
  //             fetchData(selectedTransformerName);
  //         });
  
  //         // Set the selected dropdown value from localStorage on page load
  //         let storedTransformerName = localStorage.getItem('selectedTransformer');
  //         if (storedTransformerName) {
  //             // Set the dropdown to the stored value
  //             for (let i = 0; i < groupListDropdown.options.length; i++) {
  //                 if (groupListDropdown.options[i].textContent.trim() === storedTransformerName) {
  //                     groupListDropdown.selectedIndex = i;
  //                     break;
  //                 }
  //             }
  //             fetchData(storedTransformerName);
  //         }
  
  //         // Trigger data fetch on page load for the selected option (if already selected)
  //         setTimeout(function() {
  //             let selectedTransformerName = groupListDropdown.options[groupListDropdown.selectedIndex].textContent.trim();
  //             fetchData(selectedTransformerName);
  //         }, 200);
  //     } else {
  //         console.log("Dropdown not found, check the ID.");
  //     }
  // });
  
  document.addEventListener("DOMContentLoaded", function () {
    const groupListDropdown = document.getElementById("transformer-list");
  
    if (groupListDropdown) {
      // Function to fetch and update data
      function fetchData(selectedTransformerName) {
        localStorage.setItem("selectedTransformer", selectedTransformerName);
  
        fetchtransformerConsumedLoadData(selectedTransformerName);
        fetchFloorsData(selectedTransformerName);
  
        // Reset counts or other UI elements
        document.getElementById("floor_kw_total_load").innerHTML = 0;
        document.getElementById("floor_kvah_total_load").innerHTML = 0;
        document.getElementById("three_phase_total_devices_count").innerHTML = 0;
        document.getElementById("single_phase_total_devices_count").innerHTML = 0;
        single_phase_at_floor = 0;
        three_phase_at_floor = 0;
      }
  
      // Event listener for dropdown change
      groupListDropdown.addEventListener("change", function () {
        let selectedTransformerName =
          this.options[this.selectedIndex].textContent.trim();
        fetchData(selectedTransformerName);
      });
  
      // Set the selected dropdown value from localStorage on page load
      let storedTransformerName = localStorage.getItem("selectedTransformer");
      if (storedTransformerName) {
        // Set the dropdown to the stored value
        for (let i = 0; i < groupListDropdown.options.length; i++) {
          if (
            groupListDropdown.options[i].textContent.trim() ===
            storedTransformerName
          ) {
            groupListDropdown.selectedIndex = i;
            break;
          }
        }
        fetchData(storedTransformerName);
      } else {
        // Default to the first option if no stored value is found
        fetchData(groupListDropdown.options[0].textContent.trim());
      }
    } else {
      console.log("Dropdown not found, check the ID.");
    }
  });
  
  let floorData = {};
  // Function to fetch transformer list data and set previous selection or first option on page load
  function fetchtransformerListData() {
    fetch(window.location.href + "?fetch_transformerListData")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        if (data && data.transformerList) {
          let selectElement = document.getElementById("dataSelect");
          selectElement.innerHTML = ""; // Clear previous options
  
          let previouslySelected = localStorage.getItem("selectedTransformer"); // Get previous selection from localStorage
          let firstTransformerName = ""; // To store the first transformer's name
  
          data.transformerList.forEach((item, index) => {
            let option = document.createElement("option");
            option.value = item.id; // Use the ID as the value
            option.textContent = item.main_device_id; // Display name
  
            // Save the first transformer's name
            if (index === 0) {
              firstTransformerName = item.main_device_id;
            }
  
            // Check if this is the previously selected transformer
            if (item.main_device_id === previouslySelected) {
              option.selected = true; // Pre-select the previously selected option
            }
  
            selectElement.appendChild(option);
          });
  
          // If there was a previously selected transformer, fetch data for that
          if (previouslySelected) {
            fetchtransformerConsumedLoadData(previouslySelected);
            fetchFloorsData(previouslySelected);
          } else {
            // If no previous selection, use the first option and fetch data for that
            fetchtransformerConsumedLoadData(firstTransformerName);
            fetchFloorsData(firstTransformerName);
          }
        } else {
          console.error("No data found in Transformer List");
        }
  
        // If transformersData is not null, display or handle it as needed
        if (data.transformersData) {
          // Handle transformers data display if needed
        }
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  }
  
  function fetchtransformerConsumedLoadData(selectedTransformerName) {
    fetch(
      window.location.href +
        "?fetch_transformerData&transformer_name=" +
        selectedTransformerName
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        // Clear existing data from the table
        let tableBody = document.getElementById("consumedLoadData");
        tableBody.innerHTML = ""; // Clear previous data
  
        if (data) {
          if (data.transformersData && data.transformersData.length > 0) {
            // If we have transformer data, process it
            data.transformersData.forEach((row) => {
              let tableRow = `
                              <tr>
                                  <td> KW </td>
                                  <td>${row.kw_ph1}</td>
                                  <td>${row.kw_ph2}</td>
                                  <td>${row.kw_ph3}</td>
                                  <td>${
                                    parseFloat(row.kw_ph1) +
                                    parseFloat(row.kw_ph2) +
                                    parseFloat(row.kw_ph3)
                                  }</td>
                              </tr>
                              <tr>
                                  <td> KVA </td>
                                  <td>${row.kva_ph1}</td>
                                  <td>${row.kva_ph2}</td>
                                  <td>${row.kva_ph3}</td>
                                  <td>${
                                    parseFloat(row.kva_ph1) +
                                    parseFloat(row.kva_ph2) +
                                    parseFloat(row.kva_ph3)
                                  }</td>
                              </tr>
                              <tr>
                                  <td> PF </td>
                                  <td>${row.powerfactor_ph1}</td>
                                  <td>${row.powerfactor_ph2}</td>
                                  <td>${row.powerfactor_ph3}</td>
                                  <td>${row.pf_total}</td>
                              </tr>
                              <tr>
                                  <td> Voltage </td>
                                  <td>${row.voltage_ph1}</td>
                                  <td>${row.voltage_ph2}</td>
                                  <td>${row.voltage_ph3}</td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td> Current </td>
                                  <td>${row.current_ph1}</td>
                                  <td>${row.current_ph2}</td>
                                  <td>${row.current_ph3}</td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td> kWh </td>
                                  <td>${row.energy_kwh_ph1}</td>
                                  <td>${row.energy_kwh_ph2}</td>
                                  <td>${row.energy_kwh_ph3}</td>
                                  <td>${row.energy_kwh_total}</td>
                              </tr>
                              <tr>
                                  <td> kVAh </td>
                                  <td>${row.energy_kvah_ph1}</td>
                                  <td>${row.energy_kvah_ph2}</td>
                                  <td>${row.energy_kvah_ph3}</td>
                                  <td>${row.energy_kvah_total}</td>
                              </tr>
                          `;
              tableBody.innerHTML += tableRow;
              document.getElementById("transformer_kwh_total_load").innerHTML =
                parseFloat(`${row.energy_kwh_total}`).toFixed(2);
              document.getElementById("transformer_kvah_total_load").innerHTML =
                parseFloat(`${row.energy_kvah_total}`).toFixed(2);
            });
          } else {
            // No data found for the selected transformer
            tableBody.innerHTML =
              '<tr><td colspan="5" style="color:red;font-weight:bold;">No Data Available For The Selected Transformer</td></tr>';
            document.getElementById("transformer_kwh_total_load").innerHTML = 0;
            document.getElementById("transformer_kvah_total_load").innerHTML = 0;
          }
        }
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  }
  
  function fetchFloorsData(selectedTransformerName) {
    TotalSinglePhaseDevicesCount = 0;
    threePhaseCount = 0;
    single_phase_at_floor = 0;
    three_phase_at_floor = 0;
    // Fetch data based on selected transformer name
    fetch(
      window.location.href +
        "?fetch_FloorsData&transformer_name=" +
        selectedTransformerName
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        // Clear previous floor data
        let t_body = document.getElementById("transformerdata");
        t_body.innerHTML = "";
  
        if (data.floorsData) {
          // Initialize/reset floorData for the selected transformer
          floorData = {};
  
          // Aggregate data by floor
          data.floorsData.forEach((rows) => {
            var transformerName = selectedTransformerName;
            if (!floorData[rows.device_id]) {
              floorData[rows.device_id] = {
                total_installed_load: 0,
                total_consuming_load: 0,
                total_kW: 0,
                total_kVA: 0,
                devices: [],
                transformerName: transformerName,
              };
            }
  
            // Add up the values for each floor
            floorData[rows.device_id].total_installed_load += parseFloat(
              rows.installed_load
            );
            floorData[rows.device_id].total_consuming_load += parseFloat(
              rows.consuming_load
            );
            floorData[rows.device_id].total_kW += parseFloat(rows.kW);
            floorData[rows.device_id].total_kVA += parseFloat(rows.kVA);
            floorData[rows.device_id].devices.push(rows);
          });
  
          // Generate HTML for each floor and update the DOM
          const promises = []; // Array to hold promises for asynchronous calls
          Object.keys(floorData).forEach((floor) => {
            let floorDetails = floorData[floor];
            let tableData = `
                          <div class="card mt-2">
                              <div class="card-head me-2 ms-2 text-center">
                                  <div class="d-flex flex-column">
                                      <h6 class="text-primary mt-2 text-uppercase fw-bold">${
                                        floor.charAt(0).toUpperCase() +
                                        floor.slice(1)
                                      } Floor</h6>
                                      <h6 class="text-danger fw-bold">Phase Name: <span id="${floor}"></span></h6>
                                  </div>
                              </div>
  
                              <div class="card-body pt-1 pb-4">
                                  <div class="row text-center">
                                      <div class="col-md-4 mt-2">
                                          <div class="card shadow h-100 pointer" onclick="showFloorsConsumedData('${floor}','${
              floorDetails.transformerName
            }')">
                                              <div class="card-body m-0 p-0">
                                                  <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-file-arrow-down-fill text-success"></i> Consumed Load</p>
                                                  <h6>kWh <span id="${floor}_kw">0</span></h6>
                                                  <h6>kVAh <span id="${floor}_kva">${
              floorDetails.total_kVA
            }</span></h6>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-4 mt-2">
                                          <div class="card shadow h-100">
                                              <div class="card-body m-0 p-0">
                                                  <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-file-arrow-up-fill text-danger"></i> Installed Load</p>
                                                   <h6>kWh <span id="${floor}_kva_installed">0</span></h6>
                                                  <h6>kVAh <span id="${floor}_kw_installed">0</span></h6>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-4 mt-2">
                                          <div class="card shadow h-100">
                                              <div class="card-body m-0 p-0">
                                                  <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-diagram-3 text-danger"></i> Connected Devices</p>
                                                  <h6 class="text-decoration-underline text-info pointer" onclick="threePhaseModal('${floor}','${
              floorDetails.transformerName
            }')">Three Phase:<span id='${floor}_${
              floorDetails.transformerName
            }'> 0</span></h6>
                                                  <h6 class="text-decoration-underline text-info pointer" onclick="singlePhaseModal('${floor}','${
              floorDetails.transformerName
            }')">Single Phase:<span id='${floor}_totalConnectedDeicesCount'>0</span></h6>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      `;
            t_body.innerHTML += tableData;
            // console.log(tableData);
            total_kw = 0;
            tatal_kva = 0;
            floorsConsumedData(floor, floorDetails.transformerName);
            threePhaseDevicesCount(floorDetails.transformerName, floor);
            Total_installedLoad_Single_Phase_Devices(
              selectedTransformerName,
              floor
            );
            Total_installedLoad_Three_Phase_Devices(
              selectedTransformerName,
              floor
            );
            fetchTotalCountOfFloors(selectedTransformerName, floor);
            //singlePhaseData(floorDetails.transformerName,floor);
  
            // Call SinglephaseDevicesCount for each floor and store the promise
            const promise = new Promise((resolve) => {
              SinglephaseDevicesCount(
                selectedTransformerName,
                floor,
                function (deviceCount) {
                  count = deviceCount;
  
                  // Update the device count in the DOM
                  document.getElementById(
                    `${floor}_totalConnectedDeicesCount`
                  ).innerHTML = deviceCount;
                  resolve(deviceCount); // Resolve the promise with deviceCount
                }
              );
            });
            promises.push(promise); // Add the promise to the array
          });
          // Wait for all promises to resolve and then perform actions
          Promise.all(promises).then(() => {
            console.log("All device counts fetched and updated.");
          });
        } else {
          console.error("No data found for Three Phase Details");
          t_body.innerHTML = `
                  <div class="col-12 p-3">
                      <div class="alert alert-danger text-center mb-4" role="alert">
                          <strong>No Floor Devices Available for the Selected Transformer</strong>
                      </div>
                      <div class="text-center">
                          <button type="button" class="btn btn-danger" 
                              onclick="window.location.href='addnewtransformer1.php';">
                              <i class="bi bi-plus-circle"></i> Add Floor Device
                          </button>
                      </div>
                  </div>`;
        }
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
        document.getElementById("transformerdata").innerHTML =
          "<p>Error fetching data. Please try again later.</p>";
      });
  }
  
  function showFloorsConsumedData(floor, transformerName) {
    floorsConsumedData(floor, transformerName);
    new bootstrap.Modal(
      document.getElementById("floordeviceconsumedLoadModal")
    ).show();
  }
  
  var total_kw = 0;
  var tatal_kva = 0;
  function floorsConsumedData(floor, transformerName) {
    // console.log(floor+" "+transformerName);
    fetch(
      window.location.href +
        "?fetch_floor_consumed_Data&transformer_name=" +
        transformerName +
        "&floor_name=" +
        floor
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        // console.log(data);
        // Clear existing data from the table
        let tableBody = document.getElementById("floordeviceconsumedLoadData");
        tableBody.innerHTML = ""; // Clear previous data
  
        if (data) {
          if (data.floordevicesdata && data.floordevicesdata.length > 0) {
            // If we have transformer data, process it
            data.floordevicesdata.forEach((row) => {
              let tableRow = `
                          <tr>
                              <td> KW </td>
                              <td>${row.kw_ph1}</td>
                              <td>${row.kw_ph2}</td>
                              <td>${row.kw_ph3}</td>
                              <td>${
                                parseFloat(row.kw_ph1) +
                                parseFloat(row.kw_ph2) +
                                parseFloat(row.kw_ph3)
                              }</td>
                          </tr>
                          <tr>
                              <td> KVA </td>
                              <td>${row.kva_ph1}</td>
                              <td>${row.kva_ph2}</td>
                              <td>${row.kva_ph3}</td>
                              <td>${
                                parseFloat(row.kva_ph1) +
                                parseFloat(row.kva_ph2) +
                                parseFloat(row.kva_ph3)
                              }</td>
                          </tr>
                          <tr>
                              <td> PF </td>
                              <td>${row.powerfactor_ph1}</td>
                              <td>${row.powerfactor_ph2}</td>
                              <td>${row.powerfactor_ph3}</td>
                              <td>${row.pf_total}</td>
                          </tr>
                          <tr>
                              <td> Voltage </td>
                              <td>${row.voltage_ph1}</td>
                              <td>${row.voltage_ph2}</td>
                              <td>${row.voltage_ph3}</td>
                              <td></td>
                          </tr>
                          <tr>
                              <td> Current </td>
                              <td>${row.current_ph1}</td>
                              <td>${row.current_ph2}</td>
                              <td>${row.current_ph3}</td>
                              <td></td>
                          </tr>
                          <tr>
                              <td> kWh </td>
                              <td>${row.energy_kwh_ph1}</td>
                              <td>${row.energy_kwh_ph2}</td>
                              <td>${row.energy_kwh_ph3}</td>
                              <td>${row.energy_kwh_total}</td>
                          </tr>
                          <tr>
                              <td> kVAh </td>
                              <td>${row.energy_kvah_ph1}</td>
                              <td>${row.energy_kvah_ph2}</td>
                              <td>${row.energy_kvah_ph3}</td>
                              <td>${row.energy_kvah_total}</td>
                          </tr>
                      `;
              tableBody.innerHTML += tableRow;
  
              let floorkwTotal = parseFloat(row.energy_kwh_total);
              let floorkvaTotal = parseFloat(row.energy_kvah_total);
              total_kw += parseFloat(floorkwTotal);
              tatal_kva += parseFloat(floorkvaTotal);
              document.getElementById(`${floor}_kw`).innerText =
                floorkwTotal.toFixed(2);
              document.getElementById(`${floor}_kva`).innerText =
                floorkvaTotal.toFixed(2);
              document.getElementById("floor_kw_total_load").innerHTML =
                total_kw.toFixed(2);
              document.getElementById("floor_kvah_total_load").innerHTML =
                tatal_kva.toFixed(2);
            });
          } else {
            // No data found for the selected transformer
            tableBody.innerHTML =
              '<tr><td colspan="5" style="color:red;font-weight:bold;">No Data Available For The Selected Transformer</td></tr>';
            document.getElementById("transformer_kw_total_load").innerHTML = 0;
            document.getElementById("transformer_kvah_total_load").innerHTML = 0;
          }
        }
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  }
  
  //this script is used for calculating  total kw and kva values of Each Single Phase Devices
  function Total_installedLoad_Single_Phase_Devices(TransformerName, floor) {
    fetch(
      window.location.href +
        "?fetch_Total_Installed_loads&transformer_name=" +
        TransformerName +
        "&floor_name=" +
        floor
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        const loadData = data.Total_Installed_loads[0];
  
        if (loadData) {
          const rawKW = parseFloat(loadData.Total_kw);
          const rawKVA = parseFloat(loadData.Total_kva);
  
          // Update KW for the specific floor
          const existingKWElement = document.getElementById(
            `${floor}_kw_installed`
          );
          let existingKW = parseFloat(existingKWElement.innerText);
  
          // Treat NaN or null as 0
          const newKW = isNaN(rawKW) || rawKW === null ? 0 : rawKW;
          existingKW = isNaN(existingKW) || existingKW === null ? 0 : existingKW;
  
          existingKWElement.innerText = (existingKW + newKW).toFixed(2);
  
          // Update KVA for the specific floor
          const existingKVAElement = document.getElementById(
            `${floor}_kva_installed`
          );
          let existingKVA = parseFloat(existingKVAElement.innerText);
  
          // Treat NaN or null as 0
          const newKVA = isNaN(rawKVA) || rawKVA === null ? 0 : rawKVA;
          existingKVA =
            isNaN(existingKVA) || existingKVA === null ? 0 : existingKVA;
  
          existingKVAElement.innerText = (existingKVA + newKVA).toFixed(2);
        } else {
          console.log("No data available for the given transformer and floor.");
        }
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  }
  
  //this script is used for calculating  total kw and kva values of Each Three Phase Devices
  function Total_installedLoad_Three_Phase_Devices(TransformerName, floor) {
    fetch(
      window.location.href +
        "?Total_Installed_loads_Of_Three_Phase&transformer_name=" +
        TransformerName +
        "&floor_name=" +
        floor
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        const loadData = data.Total_Installed_loads[0];
  
        if (loadData) {
          const rawKW = parseFloat(loadData.Total_Three_phase_kw);
          const rawKVA = parseFloat(loadData.Total_Three_phase_kva);
  
          // Update KW for the specific floor
          const existingKWElement = document.getElementById(
            `${floor}_kw_installed`
          );
          let existingKW = parseFloat(existingKWElement.innerText);
  
          // Treat NaN or null as 0
          const newKW = isNaN(rawKW) || rawKW === null ? 0 : rawKW;
          existingKW = isNaN(existingKW) || existingKW === null ? 0 : existingKW;
  
          existingKWElement.innerText = (existingKW + newKW).toFixed(2);
  
          // Update KVA for the specific floor
          const existingKVAElement = document.getElementById(
            `${floor}_kva_installed`
          );
          let existingKVA = parseFloat(existingKVAElement.innerText);
  
          // Treat NaN or null as 0
          const newKVA = isNaN(rawKVA) || rawKVA === null ? 0 : rawKVA;
          existingKVA =
            isNaN(existingKVA) || existingKVA === null ? 0 : existingKVA;
  
          existingKVAElement.innerText = (existingKVA + newKVA).toFixed(2);
        } else {
          console.log("No data available for the given transformer and floor.");
        }
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  }
  
  function threePhaseModal(floor, tname) {
    // Check if a modal with the same ID already exists, if yes, remove it
    let existingModal = document.getElementById("threePhaseModal");
    if (existingModal) {
      existingModal.remove(); // Remove the previous modal
    }
  
    fetch(
      window.location.href +
        "?fetch_three_phase_devices_data&transformer_name=" +
        tname +
        "&floor_name=" +
        floor
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        // Create the modal HTML structure dynamically
        let modalHTML = `
              <div class="modal fade" id="threePhaseModal" tabindex="-1" aria-labelledby="threePhaseModalLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
                  <div class="modal-dialog modal-xl modal-dialog-scrollable">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="threeModalLabel">${
                                floor.charAt(0).toUpperCase() + floor.slice(1)
                              } Floor Three Phase Data</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <table class="table table-striped text-center border">
                                  <thead>
                                      <tr>
                                          <th>Device</th>
                                          <th>Current(A)</th>
                                          <th>Voltage(V)</th>
                                          <th>kW</th>
                                          <th>kVA</th>
                                          <th>kWh</th>
                                          <th>kVAh</th>
                                          <th>Power Factor(PF)</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody id="threePhaseeTableBodyData"></tbody>
                                  <tfoot>
                                      <tr>
                                          <th></th>
                                          <th colspan="3">Total Installed Load (W)</th>
                                          <th colspan="2">kWh <span id="threetotalInstalledLoad">0</span></th>
                                          <th colspan="2">kVAh <span id="threetotalConsumingLoad">0</span></th>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-primary" onclick="addNewThreePhaseDevice('${floor}', '${tname}')">Add Device</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                      </div>
                  </div>
              </div>
          `;
  
        // Inject the modal HTML into the body
        document.body.insertAdjacentHTML("beforeend", modalHTML);
  
        // Get the tbody element
        let t_body = document.getElementById("threePhaseeTableBodyData");
  
        // Reset totals to 0
        let total_installed_load = 0;
        let total_consuming_load = 0;
  
        if (data.switchthreephasedata && data.switchthreephasedata.length > 0) {
          data.switchthreephasedata.forEach((device) => {
            let tableRow = `
                      <tr>
                          <td>${device.device_id}</td>
                          <td>${device.current_ph1}</td>
                          <td>${device.voltage_ph1}</td>
                          <td>${device.kw_ph1}</td>
                          <td>${device.kva_ph1}</td>
                          <td>${device.energy_kwh_total}</td>
                          <td>${device.energy_kvah_total}</td>
                          <td>${device.pf_total}</td>
                          <td><button type="button" class="btn text-danger" onClick="deleteThreePhaseRow('${floor}','${tname}','${device.device_id}')"><i class="bi bi-trash-fill"></i></button></td>
                      </tr>
                  `;
            t_body.innerHTML += tableRow;
            // Update totals
            total_installed_load += parseFloat(device.energy_kwh_total);
            total_consuming_load += parseFloat(device.energy_kvah_total);
          });
  
          // Update total values in the footer
          document.getElementById("threetotalInstalledLoad").textContent =
            total_installed_load.toFixed(2);
          document.getElementById("threetotalConsumingLoad").textContent =
            total_consuming_load.toFixed(2);
        } else {
          let emptyRow = `<tr><td colspan="11" class="text-danger" style='font-weight:bold'>No data available for this transformer</td></tr>`;
          t_body.innerHTML = emptyRow;
        }
  
        // Show the modal
        let modal = new bootstrap.Modal(
          document.getElementById("threePhaseModal")
        );
        modal.show();
  
        // Cleanup the modal after it's closed to avoid duplication
        document
          .getElementById("threePhaseModal")
          .addEventListener("hidden.bs.modal", function () {
            this.remove();
          });
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  }
  
  function addNewThreePhaseDevice(floor, tname) {
    // Update modal content dynamically based on the transformer and floor name
    document.getElementById("f_name").innerHTML = `${floor}`;
    document.getElementById("t_name").innerHTML = `${tname}`;
  
    // Adjust z-index for the existing threePhaseModal (if it exists)
    var threePhaseModal = document.getElementById("threePhaseModal");
    if (threePhaseModal) {
      threePhaseModal.style.zIndex = "1040"; // Lower the z-index for the first modal
    }
  
    // Create and show the second modal (add_three_phase_device)
    var addNewThreePhaseModal = new bootstrap.Modal(
      document.getElementById("add_three_phase_device"),
      {
        backdrop: "static", // Prevent closing by clicking outside
        keyboard: false, // Disable closing via the Esc key
      }
    );
  
    // Set a higher z-index for the second modal (if necessary)
    var addThreePhaseDeviceModal = document.getElementById(
      "add_three_phase_device"
    );
    if (addThreePhaseDeviceModal) {
      addThreePhaseDeviceModal.style.zIndex = "1055"; // Set a higher z-index for the new modal
    }
  
    // Show the modal
    addNewThreePhaseModal.show();
  
    // Proper cleanup of z-index and modal behavior
    // Handle 'Cancel' button functionality
    document
      .getElementById("cancelButton")
      .addEventListener("click", function () {
        addNewThreePhaseModal.hide(); // Hide the modal using Bootstrap's hide method
      });
  
    // Listen for when the modal is hidden
    document
      .getElementById("add_three_phase_device")
      .addEventListener("hidden.bs.modal", function () {
        // Reset the z-index of the first modal (threePhaseModal)
        if (threePhaseModal) {
          threePhaseModal.style.zIndex = ""; // Reset z-index of previous modal
        }
  
        // Ensure the backdrop is properly removed
        document.querySelectorAll(".modal-backdrop").forEach((el) => el.remove());
      });
  }
  
  document
    .getElementById("saveThreePhaseDevice")
    .addEventListener("click", function () {
      var deviceName = document.getElementById("device_name").value;
      var transformerName = document.getElementById("t_name").innerText;
      var floorName = document.getElementById("f_name").innerText;
  
      if (deviceName === "") {
        document.getElementById("response").innerHTML =
          "Device Name cannot be empty!";
        document.getElementById("response").style.color = "red";
        return;
      }
  
      var xhr = new XMLHttpRequest();
      xhr.open("POST", window.location.href, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
      xhr.onload = function () {
        if (this.status === 200) {
          var responseText = this.responseText.trim();
          if (responseText === "Device successfully added!") {
            document.getElementById(
              "response"
            ).innerHTML = `${deviceName} successfully added!`;
            document.getElementById("response").style.color = "green";
            fetchFloorsData(transformerName);
            // Total_installedLoad_Single_Phase_Devices(transformerName, floorName);
            // Total_installedLoad_Three_Phase_Devices(transformerName, floorName);
  
            refreshThreePhaseTable(floorName, transformerName);
            document.getElementById("device_name").value = ""; // Clear input field
            updateThreePhaseDevicesCount(transformerName, floorName, "Add");
            var addDeviceModal = new bootstrap.Modal(
              document.getElementById("add_three_phase_device")
            );
            addDeviceModal.hide(); // Close the modal
  
            // Update UI dynamically if needed
            if (!floorData[floorName]) {
              floorData[floorName] = { devices: [] };
            }
  
            floorData[floorName].devices.push({
              device: deviceName,
              consuming_load: 0,
              installed_load: 0,
              current: 0,
              voltage: 0,
              kW: 0,
              kVA: 0,
              kWh: 0,
              kVAh: 0,
              pf: 0,
            });
          } else {
            document.getElementById("response").innerHTML =
              deviceName + responseText;
            document.getElementById("response").style.color = "red";
            document.getElementById("response").style.fontWeight = "bold";
          }
        } else {
          document.getElementById("response").innerHTML = "Failed to save device";
          document.getElementById("response").style.color = "red";
        }
      };
  
      xhr.send(
        "device_name=" +
          encodeURIComponent(deviceName) +
          "&transformer_name=" +
          encodeURIComponent(transformerName) +
          "&floor_name=" +
          encodeURIComponent(floorName)
      );
    });
  
  //function to Show the table after added new Device for three phase
  function toShowThreePhaseTable() {
    let transformerName = document.getElementById("t_name").innerText;
    let floorName = document.getElementById("f_name").innerText;
    refreshThreePhaseTable(floorName, transformerName);
    document.getElementById("response").innerHTML = "";
    document.getElementById("device_name").value = "";
  }
  
  //Delete the Three Phase Device
  function deleteThreePhaseRow(floor, tname, device) {
    if (confirm("Are you sure you want to delete the device: " + device + "?")) {
      fetch(
        window.location.href +
          "?delete_three_phase_row&transformer_name=" +
          tname +
          "&floor_name=" +
          floor +
          "&device=" +
          device
      )
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((data) => {
          // Show a message based on the server's response
          alert(data.status);
  
          // If the deletion was successful, refresh the modal content
          if (data.status === "Device Deleted Successfully!") {
            refreshThreePhaseTable(floor, tname);
            updateThreePhaseDevicesCount(tname, floor, "Delete");
            fetchFloorsData(tname);
            // Total_installedLoad_Single_Phase_Devices(tname, floor);
            // Total_installedLoad_Three_Phase_Devices(tname, floor);
          }
        })
        .catch((error) => {
          console.error("There was a problem with the fetch operation:", error);
          alert("Error occurred while deleting the device.");
        });
    } else {
      // Action canceled by the user
      alert("Deletion canceled.");
    }
  }
  //Refresh The Table after the row is deleted
  function refreshThreePhaseTable(floor, tname) {
    // Fetch updated data for the modal (replace with your actual endpoint or query to get updated device data)
    fetch(
      window.location.href +
        "?get_three_phase_data&transformer_name=" +
        tname +
        "&floor_name=" +
        floor
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json(); // Assuming server returns updated data as JSON
      })
      .then((data) => {
        let t_body = document.getElementById("threePhaseeTableBodyData");
        t_body.innerHTML = ""; // Clear the previous table content
  
        let total_installed_load = 0;
        let total_consuming_load = 0;
  
        // Populate the table with updated data
        if (data.devices && data.devices.length > 0) {
          data.devices.forEach((device) => {
            let tableRow = `
                      <tr>
                          <td>${device.device_id}</td>
                          <td>${device.current_ph1}</td>
                          <td>${device.voltage_ph1}</td>
                          <td>${device.kw_ph1}</td>
                          <td>${device.kva_ph1}</td>
                          <td>${device.energy_kwh_total}</td>
                          <td>${device.energy_kvah_total}</td>
                          <td>${device.pf_total}</td>
                          <td><button type="button" class="btn text-danger" onClick="deleteThreePhaseRow('${floor}','${tname}','${device.device_id}')"><i class="bi bi-trash-fill"></i></button></td>
                      </tr>
                  `;
            t_body.innerHTML += tableRow;
  
            // Update totals
            total_installed_load += parseFloat(device.energy_kwh_total);
            total_consuming_load += parseFloat(device.energy_kvah_total);
          });
  
          // Update total values in the footer
          document.getElementById("threetotalInstalledLoad").textContent =
            total_installed_load.toFixed(2);
          document.getElementById("threetotalConsumingLoad").textContent =
            total_consuming_load.toFixed(2);
        } else {
          // If no data is found, show a message
          t_body.innerHTML = `<tr><td colspan="11" class="text-danger" style='font-weight:bold'>No data available for this transformer</td></tr>`;
          document.getElementById("threetotalInstalledLoad").textContent = 0;
          document.getElementById("threetotalConsumingLoad").textContent = 0;
        }
      })
      .catch((error) => {
        console.error("There was a problem with fetching updated data:", error);
        alert("Error occurred while fetching updated data.");
      });
  }
  
  //this function will increase or decrease the three phase devices count when new device added or Existed device Deleted
  function updateThreePhaseDevicesCount(tname, fname, message) {
    let element = document.getElementById(fname + "_" + tname).innerHTML;
    if (message === "Add") {
      single_phase_at_floor = 0;
      three_phase_at_floor = 0;
      document.getElementById(fname + "_" + tname).innerHTML =
        parseInt(element) + 1;
      //threePhaseCount++;
      document.getElementById("three_phase_total_devices_count").innerHTML =
        threePhaseCount;
    } else if (message === "Delete") {
      single_phase_at_floor = 0;
      three_phase_at_floor = 0;
      document.getElementById(fname + "_" + tname).innerHTML =
        parseInt(element) - 1;
      threePhaseCount--;
      document.getElementById("three_phase_total_devices_count").innerHTML =
        threePhaseCount;
    }
  }
  
  var threePhaseCount = 0;
  //function for calculate three phase Devices Count
  function threePhaseDevicesCount(tname, floor) {
    fetch(
      window.location.href +
        "?three_phase_devices_count&transformer_name=" +
        tname +
        "&floor_name=" +
        floor
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        let number = data.switchedThreePhaseDevicesCount[0];
        if (number) {
          threePhaseCount += number.count;
          document.getElementById(floor + "_" + tname).innerHTML = number.count;
          document.getElementById("three_phase_total_devices_count").innerHTML =
            threePhaseCount;
        }
      });
  }
  
  function singlePhaseModal(transformerName, floorName) {
    // Create modal elements dynamically
    const modalHTML = `
          <div class="modal fade" id="singlePhaseModal" tabindex="-1" aria-labelledby="singlePhaseModalLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="singlePhaseModalLabel">Single Phase Connections</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body" id="singlePhaseModalBody">
                          <div class="col-12 rounded mt-2 p-0 mb-2">
                              <div class="row">
                                  <div class="col-12 col-md-4 mb-md-0 mb-2">
                                      <div class="card text-center shadow pointer bg-danger" onclick="phaseModal('${floorName}', '${transformerName}', 'R Phase')">
                                          <div class="card-body m-0 p-0">
                                              <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> R PHASE</p>
                                              <p class="card-title py-2 text-white">Connected Devices: <span id="rConnectedDevicesCount"></span></p>                                            
                                                  <h6 class="text-white">Installed Load</h6>
                                                  <div  class="d-flex flex-column flex-md-row justify-content-center">
                                                  <p class="text-white"> <strong>kWh </strong><span id="rphaseconsumingload">0</span></p> 
                                                  <p class="text-white" style="padding-left:10px"><strong>kVAh</strong> <span id="rphaseinstalledload">0</span></p>
                                                 </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-4 mb-md-0 mb-2">
                                      <div class="card text-center shadow pointer bg-warning bg-opacity-80" onclick="phaseModal('${floorName}', '${transformerName}', 'Y Phase')">
                                          <div class="card-body m-0 p-0">
                                              <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> Y PHASE</p>
                                              <p class="card-title py-2 text-white">Connected Devices: <span id="yConnectedDevicesCount"></span></p>
                                              <h6 class="text-white">Installed Load</h6>
                                              <div class="d-flex flex-column flex-md-row justify-content-center">
                                                  <p class="text-white"> <strong>kWh</strong> <span id="yphaseconsumingload">0</span></p>
                                                  <p class="text-white" style="padding-left:10px"><strong>kVAh</strong> <span id="yphaseinstalledload">0</span></p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-4">
                                  <div class="card text-center shadow pointer bg-primary" onclick="phaseModal('${floorName}', '${transformerName}', 'B Phase')">
                                          <div class="card-body m-0 p-0">
                                              <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> B PHASE</p>
                                              <p class="card-title py-2 text-white">Connected Devices: <span id="bConnectedDevicesCount"></span></p>
                                              <h6 class="text-white">Installed Load</h6>
                                              <div class="d-flex flex-column flex-md-row justify-content-center">
                                                  <p class="text-white"><strong> kWh</strong> <span id="bphaseconsumingload">0</span></p>
                                                  <p class="text-white" style="padding-left:10px"><strong>kVAh</strong> <span id="bphaseinstalledload">0</span></p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer d-flex justify-content-center">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
      `;
  
    // Insert modal into the container
    document.getElementById("dynamicModalContainer").innerHTML = modalHTML;
  
    // Show the modal using Bootstrap's modal API
    const singlePhaseModal = new bootstrap.Modal(
      document.getElementById("singlePhaseModal")
    );
    singlePhaseModal.show();
    singlePhaseData(transformerName, floorName);
  }
  
  //Using this script the devices count ,Consuming load and Installed Load Will be calculated when single phase Modal opened
  function singlePhaseData(floorName, transformerName) {
    let rTotal_consumingLoad = 0;
    let rTotal_installedLoad = 0;
    let rconnectedDevicesCount = 0;
    let yTotal_consumingLoad = 0;
    let yTotal_installedLoad = 0;
    let yconnectedDevicesCount = 0;
    let bTotal_consumingLoad = 0;
    let bTotal_installedLoad = 0;
    let bconnectedDevicesCount = 0;
  
    fetch(
      window.location.href +
        `?fetch_singlePhaseModalData&transformer_name=${transformerName}&floor_name=${floorName}`
    )
      .then((response) => {
        if (!response.ok) throw new Error("Network response was not ok");
        return response.text(); // Get response as text for debugging
      })
      .then((text) => {
        const data = JSON.parse(text); // Parse the JSON
  
        if (data.RPhaseData && data.RPhaseData.length > 0) {
          data.RPhaseData.forEach((device) => {
            rTotal_consumingLoad =
              parseFloat(device.rPhaseDevicesConsumingLoad) || 0; // Set 0 if null or NaN
            rTotal_installedLoad =
              parseFloat(device.rPhaseDevicesInstalledLoad) || 0;
            rconnectedDevicesCount = parseInt(device.rPhaseDevicesCount) || 0;
          });
        } else {
          rTotal_consumingLoad = 0;
          rTotal_installedLoad = 0;
          rconnectedDevicesCount = 0;
        }
  
        if (data.YPhaseData && data.YPhaseData.length > 0) {
          data.YPhaseData.forEach((device) => {
            yTotal_consumingLoad =
              parseFloat(device.yPhaseDevicesConsumingLoad) || 0;
            yTotal_installedLoad =
              parseFloat(device.yPhaseDevicesInstalledLoad) || 0;
            yconnectedDevicesCount = parseInt(device.yPhaseDevicesCount) || 0;
          });
        } else {
          yTotal_consumingLoad = 0;
          yTotal_installedLoad = 0;
          yconnectedDevicesCount = 0;
        }
  
        if (data.BPhaseData && data.BPhaseData.length > 0) {
          data.BPhaseData.forEach((device) => {
            bTotal_consumingLoad =
              parseFloat(device.bPhaseDevicesConsumingLoad) || 0;
            bTotal_installedLoad =
              parseFloat(device.bPhaseDevicesInstalledLoad) || 0;
            bconnectedDevicesCount = parseInt(device.bPhaseDevicesCount) || 0;
          });
        } else {
          bTotal_consumingLoad = 0;
          bTotal_installedLoad = 0;
          bconnectedDevicesCount = 0;
        }
  
        // Update DOM elements with safe values (fallback to 0 if necessary)
        document.getElementById("rphaseconsumingload").innerHTML =
          rTotal_consumingLoad.toFixed(2);
        document.getElementById("rphaseinstalledload").innerHTML =
          rTotal_installedLoad.toFixed(2);
        document.getElementById("rConnectedDevicesCount").innerHTML =
          rconnectedDevicesCount;
  
        document.getElementById("yphaseconsumingload").innerHTML =
          yTotal_consumingLoad.toFixed(2);
        document.getElementById("yphaseinstalledload").innerHTML =
          yTotal_installedLoad.toFixed(2);
        document.getElementById("yConnectedDevicesCount").innerHTML =
          yconnectedDevicesCount;
  
        document.getElementById("bphaseconsumingload").innerHTML =
          bTotal_consumingLoad.toFixed(2);
        document.getElementById("bphaseinstalledload").innerHTML =
          bTotal_installedLoad.toFixed(2);
        document.getElementById("bConnectedDevicesCount").innerHTML =
          bconnectedDevicesCount;
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  }
  
  function phaseModal(transformerName, floorName, phaseName) {
    // Modal ID will be based on the phase to avoid conflicts
    const phaseId = phaseName.toLowerCase().charAt(0); // "r", "y", "b"
    const modalId = `${phaseId}PhaseModal`;
  
    // Check if a modal with the same ID already exists, if yes, remove it
    let existingModal = document.getElementById(modalId);
    if (existingModal) {
      existingModal.remove(); // Remove the previous modal
    }
  
    // Capitalize the phase name for display
    const capitalizedPhaseName =
      phaseName.charAt(0).toUpperCase() + phaseName.slice(1);
  
    // Create the modal HTML structure dynamically
    let modalHTML = `
          <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="${modalId}Label">${
      floorName.charAt(0).toUpperCase() + floorName.slice(1)
    } Floor ${capitalizedPhaseName} Data</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <table class="table table-striped text-center border">
                              <thead>
                                  <tr>
                                      <th>Master Device</th>
                                      <th>Smart Power Hub</th>
                                      <th>Current(A)</th>
                                      <th>Voltage(V)</th>
                                      <th>kW</th>
                                      <th>kVA</th>
                                      <th>kWh</th>
                                      <th>kVAh</th>
                                      <th>Power Factor(PF)</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody id="${phaseId}Phase_Modal_Body">
                              </tbody>
                              <tfoot>
                                  <th></th>
                                  <th colspan="3">Total Installed Load</th>
                                  <th colspan="2">kWh <span id='${phaseId}phasetotalconsumingload'></span></th>                                
                                  <th colspan="2">kVAh <span id='${phaseId}phasetotalinstalledload'></span></th>
                              </tfoot>
                          </table>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" onclick="addNewSinglePhaseDevice('${floorName}', '${transformerName}', '${capitalizedPhaseName}')">Add Device</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
      `;
    // Inject the modal HTML into the body
    document.body.insertAdjacentHTML("beforeend", modalHTML);
  
    // Get the modal element for this phase
    const phaseModalElement = document.getElementById(modalId);
  
    // Handle z-index for related modals
    const singlePhaseModal = document.getElementById("singlePhaseModal");
    if (singlePhaseModal) {
      singlePhaseModal.style.zIndex = "1040"; // Lower z-index for the singlePhaseModal
    }
  
    // Adjust z-index for the phase modal
    phaseModalElement.style.zIndex = "1055"; // Higher z-index for the Phase Modal
  
    const addNewDevice = document.getElementById("add_single_phase_device");
    if (addNewDevice) {
      addNewDevice.style.zIndex = "1065"; // Higher z-index for addNewDevice modal
    }
  
    const smartPowerHub = document.getElementById("smartPowerHub");
    if (smartPowerHub) {
      smartPowerHub.style.zIndex = "1065"; // Highest z-index for smartPowerHub modal
    }
  
    // Open the modal
    $(phaseModalElement).modal("show");
    $(document.getElementById(`${phaseId}Phase_Modal_Body`)).empty(); // Clear previous table body data
    // console.log(transformerName + ""+ floorName + "" + phaseName);
    // Fetch data from the server using AJAX
    fetch(
      window.location.href +
        `?fetch_phaseData&transformer_name=${transformerName}&floor_name=${floorName}&phase_name=${phaseName}`
    )
      .then((response) => {
        if (!response.ok) throw new Error("Network response was not ok");
        return response.text(); // Get response as text for debugging
      })
      .then((text) => {
        const data = JSON.parse(text); // Parse the JSON
  
        let Total_consumingLoad = 0;
        let Total_installedLoad = 0;
        let connectedDevicesCount = 0;
  
        if (data.phaseData && data.phaseData.length > 0) {
          data.phaseData.forEach((device) => {
            const row = `
                          <tr>
                          <td>${device.device_id}</td>
                          <td onclick="smartPowerHub('${phaseId}phase')"><button class="btn bg-info">${device.phase.length}</button></td>
                          <td>${device.current_ph1}</td>
                          <td>${device.voltage_ph1}</td>
                          <td>${device.kw_ph1}</td>
                          <td>${device.kva_ph1}</td>
                          <td>${device.energy_kwh_total}</td>
                          <td>${device.energy_kvah_total}</td>
                          <td>${device.powerfactor_ph1}</td>
                          <td><button type="button" class="btn text-danger" onclick="deleteSinglePhaseRow('${floorName}','${transformerName}','${phaseName}','${device.device_id}')"><i class="bi bi-trash-fill"></i></button></td>
                      </tr>
                             
                      `;
            $(`#${phaseId}Phase_Modal_Body`).append(row);
            // Update totals
            Total_consumingLoad += parseFloat(device.energy_kwh_total);
            Total_installedLoad += parseFloat(device.energy_kvah_total);
            connectedDevicesCount += 1;
          });
        } else {
          $(`#${phaseId}Phase_Modal_Body`).append(
            '<tr><td colspan="12" style="color:red;font-weight:bold">No data available</td></tr>'
          );
          document.getElementById(
            `${phaseId}phasetotalconsumingload`
          ).innerHTML = 0;
          document.getElementById(
            `${phaseId}phasetotalinstalledload`
          ).innerHTML = 0;
        }
  
        // Update totals in the modal
        document.getElementById(`${phaseId}phasetotalconsumingload`).innerHTML =
          Total_consumingLoad.toFixed(2);
        document.getElementById(`${phaseId}phasetotalinstalledload`).innerHTML =
          Total_installedLoad.toFixed(2);
        document.getElementById(`${phaseId}ConnectedDevicesCount`).innerHTML =
          connectedDevicesCount;
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
        $(`#${phaseId}Phase_Modal_Body`).append(
          '<tr><td colspan="12">Error fetching data</td></tr>'
        );
      });
    // Reset z-index when the modal is hidden
    $(phaseModalElement).on("hidden.bs.modal", function () {
      if (singlePhaseModal) {
        singlePhaseModal.style.zIndex = ""; // Reset z-index of singlePhaseModal
      }
      phaseModalElement.style.zIndex = ""; // Reset z-index of the Phase Modal
    });
  }
  
  var TotalSinglePhaseDevicesCount = 0;
  // //using this script we can count of Single Phase Devices Count (each phase  R,Y and B Phase Total) when floors data is fetched or fetchFloorsData(selectedTransformerName) function called.
  function SinglephaseDevicesCount(transformerName, floorName) {
    //console.log(transformerName+floorName);
    $.ajax({
      url: "energy-audit2.php", // Replace with your actual PHP file path
      type: "GET",
      data: {
        SinglephaseDevicesCount: true,
        transformer_name: transformerName,
        floor_name: floorName,
      },
      success: function (response) {
        // console.log('Raw response:', response); // Print raw response for debugging
        try {
          const data = JSON.parse(response);
          TotalSinglePhaseDevicesCount += parseInt(data.device_count);
          document.getElementById(
            floorName + "_totalConnectedDeicesCount"
          ).innerHTML = data.device_count;
          document.getElementById("single_phase_total_devices_count").innerHTML =
            TotalSinglePhaseDevicesCount + parseInt(single_phase_at_floor);
        } catch (e) {
          console.error("Error parsing JSON:", e, response);
        }
      },
      error: function (error) {
        console.log("Error:", error);
      },
    });
  }
  
  function addNewSinglePhaseDevice(floorName, transformerName, phaseName) {
    document.getElementById("single_phase_transformer_name").innerHTML =
      transformerName;
    document.getElementById("single_phase_floor_name").innerHTML = floorName;
    document.getElementById("single_phase_phase_name").innerHTML = phaseName;
  
    let sowModal = new bootstrap.Modal(
      document.getElementById("add_single_phase_device")
    ).show();
  }
  
  function SaveSinglePhaseNewDevice() {
    TotalSinglePhaseDevicesCount++;
    console.log("Entered Into Single Phase Save Function");
    var transformer_name = document.getElementById(
      "single_phase_transformer_name"
    ).innerText;
    var floor_name = document.getElementById("single_phase_floor_name").innerText;
    var phase = document.getElementById("single_phase_phase_name").innerText;
    var device_name = document.getElementById("single_device_name").value;
  
    // Check if the device name is empty
    if (device_name === "") {
      document.getElementById("single_phase_response").innerHTML =
        "Device name cannot be empty!";
      document.getElementById("single_phase_response").style.color = "red";
      return;
    }
  
    // Sending data via fetch
    fetch(
      window.location.href +
        "?insert_single_phase_device&transformer_name=" +
        transformer_name +
        "&floor_name=" +
        floor_name +
        "&phase=" +
        phase +
        "&device_name=" +
        device_name
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        if (data.status === "Device successfully added!") {
          single_phase_at_floor = 0;
          three_phase_at_floor = 0;
          document.getElementById(
            "single_phase_response"
          ).innerHTML = `${device_name} successfully added!`;
          document.getElementById("single_phase_response").style.color = "green";
          document.getElementById("single_device_name").value = "";
          singlePhaseData(floor_name, transformer_name);
          fetchFloorsData(transformer_name);
          // Total_installedLoad_Single_Phase_Devices(transformer_name, floor_name);
          // Total_installedLoad_Three_Phase_Devices(transformer_name, floor_name);
        } else {
          document.getElementById("single_phase_response").innerHTML =
            data.status;
          document.getElementById("single_phase_response").style.color = "red";
          document.getElementById("single_phase_response").style.fontWeight =
            "bold";
        }
      });
  
    const singlePhaseModal = document.getElementById("singlePhaseModal");
    if (singlePhaseModal) {
      singlePhaseModal.style.zIndex = ""; // Lower z-index for the singlePhaseModal
    }
  }
  
  function toShowSinglePhaseDeviceTable() {
    var transformer_name = document.getElementById(
      "single_phase_transformer_name"
    ).innerText;
    var floor_name = document.getElementById("single_phase_floor_name").innerText;
    var phase = document.getElementById("single_phase_phase_name").innerText;
    refreshSinglePhaseTable(floor_name, transformer_name, phase);
    document.getElementById("single_phase_response").innerText = "";
    document.getElementById("single_device_name").value = "";
  }
  
  function refreshSinglePhaseTable(floorName, transformerName, phaseName) {
    // Fetch updated data for the phase modal
    fetch(
      window.location.href +
        `?fetch_phaseData&transformer_name=${transformerName}&floor_name=${floorName}&phase_name=${phaseName}`
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json(); // Assuming server returns updated data as JSON
      })
      .then((data) => {
        const phaseId = phaseName.toLowerCase().charAt(0); // Get phase identifier
        let t_body = document.getElementById(`${phaseId}Phase_Modal_Body`);
        t_body.innerHTML = ""; // Clear the previous table content
  
        let total_consumingLoad = 0;
        let total_installedLoad = 0;
  
        // Populate the table with updated data
        if (data.phaseData && data.phaseData.length > 0) {
          data.phaseData.forEach((device) => {
            let tableRow = `
                     <tr>
                          <td>${device.device_id}</td>
                          <td onclick="smartPowerHub('${phaseId}phase')"><button class="btn bg-info">${device.phase.length}</button></td>
                          <td>${device.current_ph1}</td>
                          <td>${device.voltage_ph1}</td>
                          <td>${device.kw_ph1}</td>
                          <td>${device.kva_ph1}</td>
                          <td>${device.energy_kwh_total}</td>
                          <td>${device.energy_kvah_total}</td>
                          <td>${device.powerfactor_ph1}</td>
                          <td><button type="button" class="btn text-danger" onclick="deleteSinglePhaseRow('${floorName}','${transformerName}','${phaseName}','${device.device_id}')"><i class="bi bi-trash-fill"></i></button></td>
                      </tr>
                  `;
            t_body.innerHTML += tableRow;
  
            // Update totals
            total_consumingLoad += parseFloat(device.energy_kwh_total);
            total_installedLoad += parseFloat(device.energy_kvah_total);
          });
  
          // Update total values in the footer
          document.getElementById(
            `${phaseId}phasetotalconsumingload`
          ).textContent = total_consumingLoad.toFixed(2);
          document.getElementById(
            `${phaseId}phasetotalinstalledload`
          ).textContent = total_installedLoad.toFixed(2);
        } else {
          // If no data is found, show a message
          t_body.innerHTML = `<tr><td colspan="12" style="color:red;font-weight:bold">No data available for this transformer</td></tr>`;
        }
      })
      .catch((error) => {
        console.error("There was a problem with fetching updated data:", error);
        alert("Error occurred while fetching updated data.");
      });
  }
  
  //script for Delete the Single Phase Device
  function deleteSinglePhaseRow(floor, tname, phase, device) {
    TotalSinglePhaseDevicesCount--;
    if (confirm("Are you sure you want to delete the device: " + device + "?")) {
      fetch(
        window.location.href +
          "?delete_single_phase_row&transformer_name=" +
          tname +
          "&floor_name=" +
          floor +
          "&device=" +
          device +
          "&phase=" +
          phase
      )
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((data) => {
          // Show a message based on the server's response
          alert(data.status);
  
          // If the deletion was successful, refresh the modal's table content
          if (data.status === "Device Deleted Successfully!") {
            refreshSinglePhaseTable(floor, tname, phase); // Refresh only the table body
            singlePhaseData(floor, tname);
            fetchFloorsData(tname);
            single_phase_at_floor = 0;
            three_phase_at_floor = 0;
            // Total_installedLoad_Single_Phase_Devices(tname, floor);
            // Total_installedLoad_Three_Phase_Devices(tname, floor);
          }
        })
        .catch((error) => {
          console.error("There was a problem with the fetch operation:", error);
          alert("Error occurred while deleting the device.");
        });
    } else {
      // Action canceled by the user
      alert("Deletion canceled.");
    }
  }
  
  function onChange() {
    document.getElementById("response").innerHTML = "";
    document.getElementById("single_phase_response").innerHTML = "";
  }
  
  var single_phase_at_floor = 0;
  var three_phase_at_floor = 0;
  function fetchTotalCountOfFloors(tname, fname) {
    console.log("tname:" + tname + " fname:" + fname);
  
    fetch(
      window.location.href +
        "?fetchTotalCountOfFloors&tname=" +
        tname +
        "&fname=" +
        fname
    )
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((result) => {
        single_phase_at_floor += parseInt(result.floorsCompleteSingleCount);
        three_phase_at_floor += parseInt(result.floorsCompleteThreeCount);
  
        let three = document.getElementById(
          "three_phase_total_devices_count"
        ).innerHTML;
        let single = document.getElementById(
          "single_phase_total_devices_count"
        ).innerHTML;
  
        document.getElementById("three_phase_total_devices_count").innerHTML =
          parseInt(three) + three_phase_at_floor;
        document.getElementById("single_phase_total_devices_count").innerHTML =
          parseInt(single) + single_phase_at_floor;
  
        // Determine the phase type
        let phaseDisplayText = "";
  
        if (
          result.phasesSingle &&
          result.phasesSingle.some(
            (phase) =>
              phase === "R phase" || phase === "Y phase" || phase === "B phase"
          )
        ) {
          phaseDisplayText = "Single Phase";
        } else if (result.phasesThree && result.phasesThree.length > 0) {
          phaseDisplayText = "Three Phase";
        } else {
          phaseDisplayText = "Phase Not Found";
        }
  
        const targetElement = document.getElementById(fname);
        if (targetElement) {
          targetElement.innerHTML = phaseDisplayText;
        } else {
          console.warn("Element with ID '" + fname + "' not found.");
        }
      })
      .catch((error) => {
        console.error("Error fetching phase data:", error);
      });
  }
  