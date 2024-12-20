let savedDevices = [];

// Function to update the display box
// function updateSavedDevicesBox() {
//     const savedDevicesBox = document.getElementById('saved-devices-box');
//     savedDevicesBox.innerHTML = ''; // Clear existing data

//     savedDevices.forEach((device, index) => {
//         const deviceEntry = document.createElement('div');
//         deviceEntry.classList.add('mb-2');
//         deviceEntry.innerHTML = `
//         <div><strong>New Floor Name:</strong> ${device.newFloorName}
//         <strong>Phase:</strong> ${device.phase}
//         <strong>New Device ID:</strong> ${device.deviceId}</div>
//         <button class="btn btn-danger btn-sm mt-2" onclick="removeDevice(${index})">Remove</button>
//         <hr>
//     `;
//         savedDevicesBox.appendChild(deviceEntry);
//     });
// }

// // Function to handle the Save button click
// document.getElementById('save-btn').addEventListener('click', () => {
//     const mainSupplyDeviceDropdown = document.getElementById('main-supply-device-dropdown-tab1');
//     const newFloorNameInput = document.getElementById('new-floor-name');
//     const newDeviceInput = document.getElementById('new-floor-device');
//     const phaseDropdown = document.getElementById('phase-dropdown');

//     const mainSupplyDevice = mainSupplyDeviceDropdown.value;
//     const phase = phaseDropdown.value;
//     const deviceId = newDeviceInput.value;
//     const newFloorName = newFloorNameInput.value;

//     // Validate inputs
//     if (!mainSupplyDevice|| !phase || !deviceId || !newFloorName) {
//         alert('Please fill out all fields.');
//         return;
//     }

//     // Add the new device to the savedDevices array
//     savedDevices.push({
//         mainSupplyDevice: mainSupplyDevice,
//         phase: phase,
//         deviceId: deviceId,
//         newFloorName: newFloorName
//     });

//     // Update the display box
//     updateSavedDevicesBox();

//     // Clear the form fields
//     newFloorNameInput.value='';
//     phaseDropdown.value = '';
//     newDeviceInput.value = '';

    
// });

// // Function to remove a device from the savedDevices array
// function removeDevice(index) {
//     savedDevices.splice(index, 1);
//     updateSavedDevicesBox();
// }

//Function to handle the Update button click
//document.querySelector('button[type="submit"]').addEventListener('click', () => {
    function update_floor_devices_data(){
        const mainSupplyDeviceDropdown = document.getElementById('main-supply-device-dropdown-tab1');
        const newFloorNameInput = document.getElementById('new-floor-name');
        const newDeviceInput = document.getElementById('new-floor-device');
        const phaseDropdown = document.getElementById('phase-dropdown');
        const singlephaseDropdown = document.getElementById('single-phase-floor-dropdown');
        document.getElementById("floor-device-status").innerHTML ="";
        const mainSupplyDevice = mainSupplyDeviceDropdown.value;
        const phase = phaseDropdown.value;
        const singlephase=singlephaseDropdown.value;
        const deviceId = newDeviceInput.value;
        const newFloorName = newFloorNameInput.value;
        // if (phase == "singlephase")
        // {
        //     const singlephaseDropdown = document.getElementById('single-phase-floor-dropdown');
        //     const singlephase=singlephaseDropdown.value;
        // }
    
        // Validate inputs
        if (!mainSupplyDevice|| !phase || !deviceId || !newFloorName ) {
            document.getElementById("floor-device-status").innerHTML = "Please fill out all fields";
            document.getElementById("floor-device-status").style.color = "red";
                
            // alert('Please fill out all fields.');
            //return;
        }
    
        // Add the new device to the savedDevices array
        else{
        savedDevices.push({
            mainSupplyDevice: mainSupplyDevice,
            phase: phase,
            singlephase:singlephase,
            deviceId: deviceId,
            newFloorName: newFloorName
        });
      newFloorNameInput.value='';
    //    phaseDropdown.value = '';
        newDeviceInput.value = '';
        //singlephaseDropdown.value='';
    
        if (savedDevices.length === 0) {
            document.getElementById("floor-device-status").innerHTML = "No devices to update";
            document.getElementById("floor-device-status").style.color = "red";
                
        }
        console.log(phase+" "+singlephase);
        // Send the data to the PHP script for insertion
        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ type: 'floor_devices', devices: savedDevices }),
        })
        
       
            .then(response => response.json())
            .then(data => {
               
                document.getElementById("floor-device-status").innerHTML = deviceId+" "+ data.message;
    
    // Change color based on the message
                if (data.status === "success") {
                    document.getElementById("floor-device-status").style.color = "green";
                    savedDevices = [];
                } else  {
                    document.getElementById("floor-device-status").style.color = "red";
                    savedDevices = [];
                }
    
            })
        }
        
    };
  