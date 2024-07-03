function addUser() {
    const modal = new bootstrap.Modal(document.getElementById('adduser'));
    modal.show();
}

let userCount = document.querySelectorAll('.styled-table tbody tr').length;

function addNewUser(){
    const name = document.getElementById('userName').value;
    const userId = document.getElementById('userid').value; 
    const userRole = document.getElementById('UserRole').value;
    const email = document.getElementById('userEmail').value;
    const mobile = document.getElementById('userMobile').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmpassword').value;

    if (password !== confirmPassword) {
        showCustomAlert("Password and Confirm Password Should be Same.");
        return;
    }


    if (name && userId && userRole && email && mobile && password) {
        const table = document.querySelector('.styled-table tbody');
        const newRow = table.insertRow();
        newRow.innerHTML =
            '<td>' + (table.rows.length) + '</td>' +
            '<td>' + name + '</td>' +
            '<td>' + userId + '</td>' +
            '<td>' + userRole + '</td>' +
            '<td>' + email + '</td>' +
            '<td>' + mobile + '</td>' +
            '<td>' + password + '</td>' +
            '<td><button type="button" class="btn btn-primary btn-sm p-0 px-2" onclick="userview(this)">Devices</button></td>' +
            '<td> <div class="btn-group dropend"><button class="btn p-0" type="button" data-bs-toggle="dropdown" style="border:none"><i class="bi bi-three-dots-vertical"></i></button><ul class="dropdown-menu bg-white text-center" style="background:none;border:none;"><li><p class="mt-2 pointer pe-3"  onclick="editMainTableDetails(this)"><strong><i class="bi bi-pen-fill text-primary"></i>Edit</strong></p></li><li><i class="bi bi-trash-fill text-danger mb-5 pointer" onclick="deleteRow(this)"><strong>Delete</strong></i></li></ul></div></td>';

        clearForm();
        const modal = bootstrap.Modal.getInstance(document.getElementById('adduser'));
    } else {
        showCustomAlert("Please fill all the fields.");
    }
}


// Function to show custom alert
function showCustomAlert(message) {
    const customAlert = document.getElementById('customAlert');
    const customAlertMessage = document.getElementById('customAlertMessage');
    customAlertMessage.textContent = message;
    customAlert.style.display = 'flex';
}

// Function to hide custom alert
function hideCustomAlert() {
    const customAlert = document.getElementById('customAlert');
    customAlert.style.display = 'none';
}




function clearForm() {
    document.getElementById('addUserform').reset();
}

function deleteRow(button) {
    const row = button.closest('tr');
    row.remove();
    updateSerialNumbers();
}

function updateSerialNumbers() {
    const table = document.querySelector('.styled-table tbody');
    userCount = 0;
    Array.from(table.rows).forEach((row, index) => {
        row.cells[0].innerText = ++userCount;
    });
}

function userview(button) {
    const row = button.closest('tr');
    const cells = row.cells;
    const name = cells[1].innerText;
    const role = cells[2].innerText;
    const modalTitle = document.getElementById('addUserModalLabel');
    modalTitle.textContent = 'User Details';
    const userviewModal = new bootstrap.Modal(document.getElementById('userview'));
    userviewModal.show();
}

function updatedata(){
    var updatedata=new bootstrap.Modal(document.getElementById("updatebutton")).show();
}

//update button script

function openUpdateModal() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let selectedRow = null;

    checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
            selectedRow = checkbox.closest('tr');
        }
    });

    if (selectedRow) {
        const cells = selectedRow.cells;
        document.getElementById('deviceid').value = cells[1].innerText; // Device ID
        document.getElementById('devicename').value = cells[2].innerText; // Device Name
        document.getElementById('devicegroup').value = cells[3].innerText; // Group/Area

        const updateModal = new bootstrap.Modal(document.getElementById('updatebutton'));
        updateModal.show();
    } else {
        alert('Please select a row to update.');
    }
}

// Function to save the updated data
function saveUpdate() {
    const devicename = document.getElementById('devicename').value;
    const deviceid = document.getElementById('deviceid').value;
    const devicegroup = document.getElementById('devicegroup').value;

    if (devicename && deviceid && devicegroup) {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        let selectedRow = null;

        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                selectedRow = checkbox.closest('tr');
            }
        });

        if (selectedRow) {
            const cells = selectedRow.cells;
            cells[1].innerText = deviceid; // Update Device ID
            cells[2].innerText = devicename; // Update Device Name
            cells[3].innerText = devicegroup; // Update Group/Area

            const updateModal = bootstrap.Modal.getInstance(document.getElementById('updatebutton'));
            updateModal.hide();
        }
    } else {
        alert('Please fill in all fields.');
    }
}

// Rows delete button script for device handled modal
function deleteSelectedRows() {
    const checkboxes = document.querySelectorAll('#userview input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            const row = checkbox.closest('tr');
            const deviceId = row.querySelector('td:nth-child(2)').textContent; 
            const deviceName = row.querySelector('td:nth-child(3)').textContent;
            if (confirm('Are you sure you want to delete device '+deviceName+' with ID '+deviceId+'?')) {
                row.remove();
            }
        }
    });
}

function addnewDevice(){
    var addnewDevice=new bootstrap.Modal(document.getElementById("addnewdevice")).show();
}

//add device button script

function addSelectedDevices() {
    const checkboxes = document.querySelectorAll('#addnewdevice input[type="checkbox"]:checked');
    const tableBody = document.querySelector('#userview table tbody');
    const rowsToRemove = [];
    checkboxes.forEach(checkbox => {
        const row = checkbox.closest('tr');
        const newRow = document.createElement('tr');
        for (let i = 1; i < row.cells.length; i++) {
            const cell = document.createElement('td');
            cell.textContent = row.cells[i].textContent;
            newRow.appendChild(cell);
        }
        const selectCell = document.createElement('td');
        const newCheckbox = document.createElement('input');
        newCheckbox.type = 'checkbox';
        selectCell.appendChild(newCheckbox);
        newRow.insertBefore(selectCell, newRow.firstChild);
        tableBody.appendChild(newRow);
        rowsToRemove.push(row);
    });
    rowsToRemove.forEach(row => {
        row.remove();
    });
    const addNewDeviceModal = bootstrap.Modal.getInstance(document.getElementById('addnewdevice'));
    addNewDeviceModal.hide();
}

//select all button for deviceshandled modal
function selectAllDevices_deviceshandled() {
    var checkboxes = document.querySelectorAll('#userview input[type="checkbox"]');
    var checked = true;

    checkboxes.forEach(function(checkbox) {
        if (!checkbox.checked) {
            checked = false;
        }
    });
    
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = !checked;
    });

}
//select all button for add button modal
function selectAllDevicesaddbutton(){
var checkboxes1 = document.querySelectorAll('#addnewdevice input[type="checkbox"]');
var checked = true;
checkboxes1.forEach(function(checkbox) {
    if (!checkbox.checked) {
        checked = false;
    }
});

checkboxes1.forEach(function(checkbox) {
    checkbox.checked = !checked;
});

}

//edit user Script
let currentRow = null;

function editMainTableDetails(element) {
    if (!element) {
        console.error('No element provided to editMainTableDetails');
        return;
    }

    currentRow = element.closest('tr');
    if (!currentRow) {
        console.error('No row found for the provided element');
        return;
    }
    document.getElementById('edituserName').value = currentRow.cells[1].innerText;
    document.getElementById('edituserid').value = currentRow.cells[2].innerText;
    document.getElementById('editUserRole').value = currentRow.cells[3].innerText;
    document.getElementById('edituserEmail').value = currentRow.cells[4].innerText;
    document.getElementById('edituserMobile').value = currentRow.cells[5].innerText;
    document.getElementById('editpassword').value = currentRow.cells[6].innerText;
    var editmodal = new bootstrap.Modal(document.getElementById('edit'));
    editmodal.show();
}

function saveUserDetails() {
    if (currentRow) {
     
        const edituserName = document.getElementById('edituserName').value;
        const edituserid = document.getElementById('edituserid').value;
        const editUserRole = document.getElementById('editUserRole').value;
        const edituserEmail = document.getElementById('edituserEmail').value;
        const edituserMobile = document.getElementById('edituserMobile').value;
        const editpassword = document.getElementById('editpassword').value;
        currentRow.cells[1].innerText = edituserName;
        currentRow.cells[2].innerText = edituserid;
        currentRow.cells[3].innerText = editUserRole;
        currentRow.cells[4].innerText = edituserEmail;
        currentRow.cells[5].innerText = edituserMobile;
        currentRow.cells[6].innerText = editpassword;

        document.getElementById('Usereditform').reset();
        var modal = bootstrap.Modal.getInstance(document.getElementById('edit'));
        if (modal) {
            modal.hide();
        }

        currentRow = null;
    }
}

function deleteRow(element) {
    if (!element) {
        console.error('No element provided to deleteRow');
        return;
    }
    const row = element.closest('tr');
    if (row) {
        row.remove();
    } else {
        console.error('No row found for the provided element');
    }
}
