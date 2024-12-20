let error_message = document.getElementById('error-message');
let error_message_text = document.getElementById('error-message-text');
let success_message = document.getElementById('success-message');
let success_message_text = document.getElementById('success-message-text');

const error_toast= bootstrap.Toast.getOrCreateInstance(error_message);
const success_toast= bootstrap.Toast.getOrCreateInstance(success_message);


var group_name=localStorage.getItem("GroupNameValue")
if(group_name==""||group_name==null)
{
    group_name="ALL";
}
$("#pre-loader").css('display', 'block');
add_device_list(group_name);

let group_list = document.getElementById('group-list');

group_list.addEventListener('change', function() {
    let group_name = group_list.value;
    if (group_name !== "" && group_name !== null) {
        $("#pre-loader").css('display', 'block');
        add_device_list(group_name);
        
    }
});

setTimeout(refresh_data, 50);
setInterval(refresh_data, 20000);
function refresh_data() {
    /*if (typeof update_frame_time === "function") {
        device_id = document.getElementById('device_id').value;
        update_frame_time(device_id);
    } */
    let group_name = group_list.value;
    if (group_name !== "" && group_name !== null) {
        add_device_list(group_name);
    }
}


function add_device_list(group_id) {
   // var group_id = document.getElementById('group-list').value;

    if (group_id !== "" && group_id !== null) {

        $.ajax({
            type: "POST",
            url: '../device-list/code/device-list-table.php',
            traditional: true,
            data: { GROUP_ID: group_id },
            dataType: "json",
            success: function (data) {
                const device_list_table = document.getElementById('device_list_table');
                device_list_table.innerHTML = '';

                if (Object.keys(data).length) {


                    for (var i = 0; i < data.length; i++) {
                        if (data[i].ACTIVE_STATUS == 1) {
                            var newRow = document.createElement('tr');
                            newRow.innerHTML =
                            '<td>' + data[i].D_ID + '</td>' +
                            '<td>' + data[i].D_NAME + '</td>' +
                            '<td>' + data[i].INSTALLED_STATUS + '</td>' +
                            '<td>' + data[i].INSTALLED_DATE + '</td>' +
                            '<td>' + data[i].KW + '</td>' +
                            '<td class="col-size-1">' + data[i].DATE_TIME + '</td>' +
                            '<td>' + data[i].WORKING_STATUS + '</td>' +
                            '<td>' + data[i].LMARK + '</td>' +
                            '<td><i class="bi bi-trash-fill text-danger pointer h5" onclick="delete_device_id(this, \'' + data[i].REMOVE + '\')"></i></td>';
                            device_list_table.appendChild(newRow);
                        }

                    }
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].ACTIVE_STATUS == 0) {
                            var newRow = document.createElement('tr');
                            newRow.innerHTML =
                            '<td>' + data[i].D_ID + '</td>' +
                            '<td>' + data[i].D_NAME + '</td>' +
                            '<td>' + data[i].INSTALLED_STATUS + '</td>' +
                            '<td>' + data[i].INSTALLED_DATE + '</td>' +
                            '<td>' + data[i].KW + '</td>' +
                            '<td class="col-size-1">' + data[i].DATE_TIME + '</td>' +
                           '<td>' + data[i].WORKING_STATUS + '</td>' +
                            '<td>' + data[i].LMARK + '</td>' +
                            '<td><i class="bi bi-trash-fill text-danger pointer h5" onclick="delete_device_id(this, \'' + data[i].REMOVE + '\')"></i></td>';
                            device_list_table.appendChild(newRow);
                        }
                    }
                }
                else
                {
                    var newRow = document.createElement('tr');
                    newRow.innerHTML ='<td class="text-danger" colspan="12">Device List not found</td>';
                    device_list_table.appendChild(newRow); 
                }
                $("#pre-loader").css('display', 'none');
            },
            error: function (textStatus, errorThrown) {
                error_message_text.textContent="Error getting the data";
                error_toast.show();
                $("#pre-loader").css('display', 'none');
            },
            failure: function () {
             error_message_text.textContent="Failed to get the data";
             error_toast.show();

             error_message_text.textContent="Failed to get the data";
             error_toast.show();
             $("#pre-loader").css('display', 'none');
         }
     });
    }
}

function delete_device_id(element, device_id) {
    if(device_id!=""&&device_id!=null)
    {
        if (confirm('Confirm '+ device_id+' deletion: Deleting the device will remove it from your list. Proceed?')) {            
            $("#pre-loader").css('display', 'block');
            $(function(){
                $.ajax({
                    type: "POST",
                    url: '../device-list/code/remove-device.php',
                    traditional : true, 
                    data:{D_ID:device_id },
                    dataType: "json", 
                    success: function(data) {
                        if(data=="Device deleted successfully")
                        {
                            element.closest('tr').remove();
                            alert(data);
                        }

                        $("#pre-loader").css('display', 'none');
                    },
                    error: function (textStatus, errorThrown) {
                       error_message_text.textContent="Error getting the data";
                       error_toast.show();

                       $("#pre-loader").css('display', 'none');
                   },
                   failure: function()
                   {
                     error_message_text.textContent="Failed to get the data";
                     error_toast.show();
                     $("#pre-loader").css('display', 'none');
                 }
             });
            });
        }
    }
    else
    {
        alert("Please Enter Device ID");
    }
}

function addDevice() {
    var deviceName = document.getElementById('deviceName').value;
    var device_id = document.getElementById('deviceID').value;
    var activationCode = document.getElementById('activationCode').value;
   /* var groupArea = document.getElementById('groupArea').value;
    var capacity = document.getElementById('capacity').value;*/

    if(device_id!=""&&device_id!=null)
    {
        if (confirm('Do you want to proceed and add the device?')) {            
            $("#pre-loader").css('display', 'block');
            $(function(){
                $.ajax({
                    type: "POST",
                    url: '../device-list/code/add-device.php',
                    traditional : true, 
                    data:{D_ID:device_id,D_NAME: deviceName, ACTIVATION_CODE:activationCode },
                    dataType: "json", 
                    success: function(data) {
                        alert(data);
                        $("#pre-loader").css('display', 'none');
                    },
                    error: function (textStatus, errorThrown) {
                       error_message_text.textContent="Error getting the data";
                       error_toast.show();

                       $("#pre-loader").css('display', 'none');
                   },
                   failure: function()
                   {
                     error_message_text.textContent="Failed to get the data";
                     error_toast.show();

                     $("#pre-loader").css('display', 'none');
                 }
             });
            });
        }
    }
    else
    {
        alert("Please Enter Device ID");
    }
}

//Installed Lights Column Buttons Open Function


// Function to show the add lights form

// Function to add a new light 

    // Hide the add lights form


    // Reset the form

    


// Function to delete a light row

