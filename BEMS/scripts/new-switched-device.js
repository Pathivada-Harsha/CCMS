let switcheddevices = [];

// // Function to update the display box
// function updateswitcheddevicesBox() {
//     const switcheddevicesBox = document.getElementById('switched-devices-box');
//     switcheddevicesBox.innerHTML = ''; // Clear existing data

//     switcheddevices.forEach((device, index) => {
//         const deviceEntry = document.createElement('div');
//         deviceEntry.classList.add('mb-2');
//         deviceEntry.innerHTML = `
//         <div><strong>Floor:</strong> ${device.floorDevice}
//         <strong>Phase:</strong> ${device.phase}
//         <strong>Device ID:</strong> ${device.deviceId}</div>
//         <button class="btn btn-danger btn-sm mt-2" onclick="removeDevice1(${index})">Remove</button>
//         <hr>
//     `;
//         switcheddevicesBox.appendChild(deviceEntry);
//     });
// }

// Function to handle the Save button click
// document.getElementById('switch-btn').addEventListener('click', () => {
//     const mainSupplyDeviceDropdown = document.getElementById('main-supply-device-dropdown-tab');
//     const floorDeviceDropdown = document.getElementById('floor-devices-dropdown-switch');
//     const newDeviceInput = document.getElementById('new-switch-device');
//     const phaseDropdown = document.getElementById('phase-switch-dropdown');

//     const mainSupplyDevice = mainSupplyDeviceDropdown.value;
//     const phase = phaseDropdown.value;
//     const deviceId = newDeviceInput.value;
//     const floorDevice = floorDeviceDropdown.value;
   
   
//     // Validate inputs
//     if (!mainSupplyDevice || !floorDevice || !phase || !deviceId ) {
        
//         console.log(mainSupplyDevice);
//         console.log(phase);
//         console.log(deviceId);
//         console.log(floorDevice);
//         alert('Please fill out all fields.');
//         return;
//     }

//     // Add the new device to the switcheddevices array
//     switcheddevices.push({
//         mainSupplyDevice:mainSupplyDevice,
//         floorDevice: floorDevice,
//         phase: phase,
//         deviceId: deviceId,
       
//     });


//     // Update the display box
//     updateswitcheddevicesBox();

//     // Clear the form fields
    

//     floorDeviceDropdown.value = '';
//     phaseDropdown.value = '';
//     newDeviceInput.value = '';

    
// });

// // Function to remove a device from the switcheddevices array
// function removeDevice1(index) {
//     switcheddevices.splice(index, 1);
//     updateswitcheddevicesBox();
// }

//Function to handle the Update button click

function update_switched_devices_data(){
    const mainSupplyDeviceDropdown = document.getElementById('main-supply-device-dropdown-tab');
    const floorDeviceDropdown = document.getElementById('floor-devices-dropdown-switch');
    const newDeviceInput = document.getElementById('new-switch-device');
    const phaseDropdown = document.getElementById('phase-switch-dropdown');
    const singlephaseDropdown = document.getElementById('single-phase-switch-dropdown');
   
    const mainSupplyDevice = mainSupplyDeviceDropdown.value;
    const phase = phaseDropdown.value;
    const deviceId = newDeviceInput.value;
    const floorDevice = floorDeviceDropdown.value;
    const singlephase=singlephaseDropdown.value;
    console.log(singlephase);
   
   
    // Validate inputs
    if (!mainSupplyDevice || !floorDevice || !phase || !deviceId ) {
        
        document.getElementById("switched-device-status").innerHTML = "Please fill out all fields";
        document.getElementById("switched-device-status").style.color = "red";
    }

    // Add the new device to the switcheddevices array
    switcheddevices.push({
        mainSupplyDevice:mainSupplyDevice,
        floorDevice: floorDevice,
        phase: phase,
        deviceId: deviceId,
        singlephase:singlephase,
    });


    

    // Clear the form fields
    

    // floorDeviceDropdown.value = '';
    // phaseDropdown.value = '';
    newDeviceInput.value = '';
    // singlephaseDropdown.value='';
    if (switcheddevices.length === 0) {
        document.getElementById("switched-device-status").innerHTML = "No devices to update";
        document.getElementById("switched-device-status").style.color = "red";
    }

    // Send the data to the PHP script for insertion
    fetch(window.location.href, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ type: 'switch_devices', devices: switcheddevices }),
    })
    
   
        .then(response => response.json())
        .then(data => {
            document.getElementById("switched-device-status").innerHTML = deviceId+" "+data.message;


            if (data.status === "success") {
                document.getElementById("switched-device-status").style.color = "green";
                switcheddevices = [];
            } else  {
                document.getElementById("switched-device-status").style.color = "red";
                switcheddevices = [];
            }

        })
        
};