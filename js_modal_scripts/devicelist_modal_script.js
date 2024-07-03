

// Function to add a new device
     function addDevice() {
        // Get form data
        var deviceName = document.getElementById('deviceName').value;
        var deviceID = document.getElementById('deviceID').value;
        var groupArea = document.getElementById('groupArea').value;
        var capacity = document.getElementById('capacity').value;
        var activationCode = document.getElementById('activationCode').value;
    
        // Generate current date and time
        var now = new Date();
        var day = String(now.getDate()).padStart(2, '0');
        var month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-based
        var year = now.getFullYear();
        var date = day + '-' + month + '-' + year;
        var time = now.toLocaleTimeString('en-GB');
        var dateTime = time + ' ' + date;
    
        // Create new row
        var newRow = document.createElement('tr');
        newRow.innerHTML = 
        '<td>' + deviceName + '</td>' +
        '<td>' + deviceID + '</td>' +
        '<td>Installed</td>' +
        '<td>' + date + '</td>' +
        '<td>' + capacity + '</td>' +
        '<td class="col-size-1">' + dateTime + '</td>' +
        '<td>On</td>' +
        '<td>Automatic</td>' +
        '<td>Active</td>' +
        '<td><a href="https://www.google.com/maps?q=0,0" target="_blank">Location</a></td>' +
        '<td>' +
            '<button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">0</button>' +
        '</td>' +
        '<td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>';
    
    
        // Append new row to table
        document.getElementById('deviceTableBody').appendChild(newRow);
    
        // Clear form fields
        document.getElementById('addDeviceForm').reset();
    }
    
    function deleteRow(element) {
        element.closest('tr').remove();
    }


//Installed Lights Column Buttons Open Function
    function openLightsModal(element) {
        var row = element.closest('tr');
        var deviceName = row.cells[0].innerText;
        document.getElementById('lightsModalLabel').innerText = 'Installed Lights -' +deviceName;


        var lightsTableBody = document.getElementById('lightsTableBody');
    lightsTableBody.innerHTML = ''; // Clear existing rows


    var lightsData = [
        { brandName: 'Philips', wattage: 10, lights: 5, totalWatts: 50 },
        { brandName: 'Havells', wattage: 15, lights: 3, totalWatts: 45 }
        ];

    lightsData.forEach(light => {
        var row = lightsTableBody.insertRow();
        row.innerHTML = '<td>' + light.brandName + '</td><td>' + light.wattage + '</td><td>' + light.lights + '</td><td>' + (light.lights * light.wattage) + '</td><td><i class="bi bi-trash-fill text-danger" onclick="deleteLightRow(this)"></i></td>';

    });

    var lightsModal = new bootstrap.Modal(document.getElementById('lightsModal'));
    lightsModal.show();
}

// Function to show the add lights form
function showAddLightsForm() {
    var addLightModal = new bootstrap.Modal(document.getElementById('addLightModal'));
    addLightModal.show();
}

// Function to add a new light 
function addLight() {
    var brandName = document.getElementById('brandName').value;
    var wattage = document.getElementById('wattage').value;
    var lights = document.getElementById('lights').value;
    var totalWatts = lights * wattage;

    var lightsTableBody = document.getElementById('lightsTableBody');
    var newRow = lightsTableBody.insertRow();
    newRow.innerHTML = '<td>' + brandName + '</td><td>' + wattage + '</td><td>' + lights + '</td><td>' + totalWatts + '</td><td><i class="bi bi-trash-fill text-danger" onclick="deleteLightRow(this)"></i></td>';


    // Hide the add lights form
    var addLightModal = bootstrap.Modal.getInstance(document.getElementById('addLightModal'));
    addLightModal.hide();

    // Reset the form
    document.getElementById('addLightsForm').reset();
}

// Function to delete a light row
function deleteLightRow(element) {
    element.closest('tr').remove();
    
}
