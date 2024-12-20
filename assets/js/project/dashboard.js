var group_name=localStorage.getItem("GroupNameValue")
//console.log(group_name);
if(group_name==""||group_name==null)
{
    
	group_name="ALL";
    //console.log(group_name);
}
if (group_name !== "" && group_name !== null) {
    //console.log(group_name);
	update_switchPoints_status(group_name);
	update_alerts(group_name);
	$("#pre-loader").css('display', 'block');
}

let group_list = document.getElementById('group-list');

group_list.addEventListener('change', function() {
    
    $("#total_devices").text(0);
    $("#installed_devices").text(0);
    $("#not_installed_devices").text(0);
    $("#active_devices").text(0);
    $("#poornetwork").text(0);
    $("#input_power_fail").text(0);
    $("#faulty").text(0);
   
	let group_name = group_list.value;
    //console.log(group_name);
	if (group_name !== "" && group_name !== null) {

		update_switchPoints_status(group_name);
		update_alerts(group_name);
		$("#pre-loader").css('display', 'block');
	}
});

document.addEventListener('DOMContentLoaded', function() {
    //refresh_data(); 
});
setInterval(refresh_data, 20000);
function refresh_data() {
    /*if (typeof update_frame_time === "function") {
        device_id = document.getElementById('device_id').value;
        update_frame_time(device_id);
    } */
    let group_name = group_list.value;
    if (group_name !== "" && group_name !== null) {
        update_switchPoints_status(group_name);
        update_alerts(group_name);
    }
}




function update_switchPoints_status(group_id){
    console.log(group_id);
	$.ajax({
            type: "POST", // Method type
            url: "../dashboard/code/switchpoint_details.php", // PHP script URL
            data: {
                GROUP_ID: group_id // Optional data to send to PHP script
            },
            dataType: "json", // Expected data type from PHP script
            success: function(response) {
              console.log("heloo:  "+ " "+response.user_devices); // Logging user_devices from the response
            
                //Update HTML elements with response data
                $("#total_devices").text(response.TOTAL_UNITS);
                $("#installed_devices").text(response.SWITCH_POINTS);
                $("#not_installed_devices").text(response.UNINSTALLED_UNITS); // Corrected from UNISTALLED_UNITS
                $("#active_devices").text(response.ACTIVE_SWITCH);
                $("#poornetwork").text(response.POOR_NW);
                $("#input_power_fail").text(response.POWER_FAILURE);
                $("#faulty").text(response.FAULTY_SWITCH);
            
            

            	

            	var activeLoad = response.ACTIVE_LOAD; // Assuming this key exists in your JSON response
                var installedLoad = response.INSTALLED_LOAD; // Assuming this key exists in your JSON response

                // Calculate the percentage for the active load
                var activeLoadPercentage = (activeLoad / installedLoad) * 100;

                // Update progress bar for installed lights ON
              

                // Update progress bar for active load
                $('#active_load').css('width', activeLoadPercentage + '%');
                $('#active_load').attr('aria-valuenow', activeLoadPercentage);
                $('#active_load').text('Active - ' + activeLoad);
            },
            error: function(xhr, status, error) {
                if(true)
                    {
                        //console.log("hi");
    
                    }
            	console.error("AJAX Error:", status, error);
            	$("#pre-loader").css('display', 'none');
            }
        });
}


function update_alerts(group_id){
console.log("alerts:"+group_id);
	$.ajax({
            type: "POST", // Method type
            url: "../dashboard/code/update_alerts.php", // PHP script URL
            data: {
                GROUP_ID: group_id // Optional data to send to PHP script
            },
            dataType: "json", // Expected data type from PHP script
            success: function(response) {
                // Update HTML elements with response data
            	$("#alerts_list").html(""); 
            	$("#alerts_list").html(response);     
            	//$("#pre-loader").css('display', 'none');       	
            },
            error: function(xhr, status, error) {
            	$("#alerts_list").html(""); 
            	console.error("Error:", status, error);
            	$("#pre-loader").css('display', 'none');
                // Handle errors here if necessary
            }
        });
}

document.getElementById('total_device').onclick = function() {

	let group_id = group_list.value;
	if (group_id !== "" && group_id !== null) {		
		get_devices_status( group_id, "ALL")
	}
};
document.getElementById('installed_devices_list').onclick = function() {


	let group_id = group_list.value;
	if (group_id !== "" && group_id !== null) {		
		get_devices_status( group_id, "INSTALLED")
	}
};


document.getElementById('not_installed_devices_list').onclick = function() {

	let group_id = group_list.value;
	if (group_id !== "" && group_id !== null) {		
		get_devices_status( group_id, "NOTINSTALLED")
	}
};

function get_devices_status(group_id, status)
{
	
	$("#pre-loader").css('display', 'block');		
	$.ajax({
            type: "POST", // Method type
            url: "../dashboard/code/dashboard_device_list.php", // PHP script URL
            data: {
                GROUP_ID: group_id, STATUS: status // Optional data to send to PHP script
            },
            dataType: "json", // Expected data type from PHP script
            success: function(response) {
                $("#pre-loader").css('display', 'none');   
                $("#not_installed_device_list_table").html(""); 
                $("#total_device_table").html("");
                $("#installed_device_list_table").html(""); 
                document.querySelectorAll('.select_all').forEach(el => el.checked = false);
                document.querySelectorAll('.selected_count').forEach(el => el.textContent = 0);
                if(status=="ALL")
                {
                    $("#total_device_table").html(response); 
                }
                else if(status=="INSTALLED")
                {
                    $("#installed_device_list_table").html(response); 
                }
                else
                {
                    $("#not_installed_device_list_table").html(response); 
                }

            },
            error: function(xhr, status, error) {
                $("#pre-loader").css('display', 'none');
                if(status=="ALL")
                {
                    $("#total_device_table").html(""); 
                }
                else if(status=="INSTALLED")
                {
                    $("#installed_device_list_table").html(""); 
                }
                else
                {
                    $("#not_installed_device_list_table").html(""); 
                }

                // Handle errors here if necessary
            }
        });
}

document.getElementById('active_device_list').onclick = function() {

    let group_id = group_list.value;
    if (group_id !== "" && group_id !== null) {     
        installed_devices_status( group_id, "ACTIVE_DEVICES")
    }
};

document.getElementById('poor_nw_device_list').onclick = function() {

    let group_id = group_list.value;
    if (group_id !== "" && group_id !== null) {     
        installed_devices_status( group_id, "POOR_NW_DEVICES")
    }
};
document.getElementById('power_failure_device_list').onclick = function() {

    let group_id = group_list.value;
    if (group_id !== "" && group_id !== null) {     
        installed_devices_status( group_id, "POWER_FAIL_DEVICES")
    }
};
document.getElementById('faulty_device_list').onclick = function() {

    let group_id = group_list.value;
    if (group_id !== "" && group_id !== null) {     
        installed_devices_status( group_id, "FAULTY_DEVICES")
    }
};

function installed_devices_status(group_id, status)
{

    $("#pre-loader").css('display', 'block');       
    $.ajax({
            type: "POST", // Method type
            url: "../dashboard/code/installed_devices_status.php", // PHP script URL
            data: {
                GROUP_ID: group_id, STATUS: status // Optional data to send to PHP script
            },
            dataType: "json", // Expected data type from PHP script
            success: function(response) {



                if(status=="ACTIVE_DEVICES")
                {
                    $("#active_device_list_update_table").html(""); 
                    $("#active_device_list_update_table").html(response); 
                }
                else if(status=="POOR_NW_DEVICES")
                {
                    $("#poor_nw_list_table").html("");
                    $("#poor_nw_list_table").html(response); 
                }
                else if(status=="POWER_FAIL_DEVICES")
                {
                    $("#power_fail_devices_table").html("");
                    $("#power_fail_devices_table").html(response); 
                }

                else if(status=="FAULTY_DEVICES")
                {
                    $("#faulty_device_list_table").html("");
                    $("#faulty_device_list_table").html(response); 
                }
                $("#pre-loader").css('display', 'none');        
            },
            error: function(xhr, status, error) {
                $("#total_device_table").html(""); 
                console.error("Error:", status, error);
                $("#pre-loader").css('display', 'none');
                // Handle errors here if necessary
            }
        });
}








function active_device_status(group_id, status)
{

    $("#pre-loader").css('display', 'block');       
    $.ajax({
            type: "POST", // Method type
            url: "../dashboard/code/active_device_lights_status.php", // PHP script URL
            data: {
                GROUP_ID: group_id, STATUS: status // Optional data to send to PHP script
            },
            dataType: "json", // Expected data type from PHP script
            success: function(response) {



                if(status=="ON_LIGHTS")
                {
                    $("#on_devices_table").html(""); 
                    $("#on_devices_table").html(response); 
                }
                else if(status=="OFF_LIGHTS")
                {
                    $("#off_device_table").html("");
                    $("#off_device_table").html(response); 
                }

                else if(status=="MANUAL_ON")
                {
                    $("#manual_on_devices_table").html("");
                    $("#manual_on_devices_table").html(response); 
                }
                $("#pre-loader").css('display', 'none');        
            },
            error: function(xhr, status, error) {
                $("#total_device_table").html(""); 
                console.error("Error:", status, error);
                $("#pre-loader").css('display', 'none');
                // Handle errors here if necessary
            }
        });
}

function openOpenviewModal(device_id) {

    $("#pre-loader").css('display', 'block');       
    $.ajax({
            type: "POST", // Method type
            url: "../dashboard/code/device_latest_values_update.php", // PHP script URL
            data: {
                DEVICE_ID: device_id // Optional data to send to PHP script
            },
            dataType: "json", // Expected data type from PHP script
            success: function(data) {
            //    $('total_light').text(data.LIGHTS);     
            //    $('#on_percentage').text(data.LIGHTS_ON);     
            //    $('#off_percentage').text(data.LIGHTS_OFF);     
            //    $('#on_off_status').html(data.ON_OFF_STATUS);    
               $('#v_r').text(data.V_PH1);     
               $('#v_y').text(data.V_PH2);     
               $('#v_b').text(data.V_PH3);    
               $('#i_r').text(data.I_PH1);    
               $('#i_y').text(data.I_PH2);     
               $('#i_b').text(data.I_PH3);    
               $('#watt_r').text(data.KW_R);     
               $('#watt_y').text(data.KW_Y);    
               $('#watt_b').text(data.KW_B);     
               $('#kwh').text(data.KWH);     
               $('#kvah').text(data.KVAH);    
               $('#record_date_time').text(data.DATE_TIME);   
               $("#pre-loader").css('display', 'none');  
               var openviewModal = document.getElementById('openview');
               var bootstrapModal = new bootstrap.Modal(openviewModal);
               bootstrapModal.show();    
                
           },
           error: function(xhr, status, error) {
            $("#total_device_table").html(""); 
            console.error("Error:", status, error);
            $("#pre-loader").css('display', 'none');
                // Handle errors here if necessary
        }
    });


}


function select_devices(select_all_id, count_id) {
    const isChecked = document.getElementById(select_all_id).checked;
    document.querySelectorAll('.selectedDevice').forEach(function(checkbox) {
        checkbox.checked = isChecked;
    });
    const allChecked = document.querySelectorAll('.selectedDevice:checked').length;
    document.getElementById(count_id).textContent = allChecked;
}

function check_uncheck_fun(element) {
    const allChecked = document.querySelectorAll('.selectedDevice:checked').length;
    const nearestCountElement = element.closest('.modal-body').querySelector('.selected_count');
    if (nearestCountElement) {
        nearestCountElement.textContent = allChecked;
    }
    const checkAll = element.closest('.modal-body').querySelector('.select_all');
    if (checkAll) {
        checkAll.checked = false;
    }
}

function openBatchConfirmModal(action, tableId) {
    const table = document.getElementById(tableId);

    if (!table) {
        alert(`Table with ID "${tableId}" not found.`);
        return false;
    }

    const selectedDevices = table.querySelectorAll('input[name$="Device"]:checked');

    if (selectedDevices.length === 0) {
        alert("Please select at least one device.");
        return false;
    }

    const selectedDeviceIds = [];
    
    selectedDevices.forEach((checkbox) => {
        const row = checkbox.closest('tr');
        const cellText = row.cells[1].textContent.trim(); // Adjust the index (1) based on the column
        selectedDeviceIds.push(cellText);
    });

    const actionText = action === 'install' ? 'install' : 'uninstall';
    document.getElementById('confirmActionText').innerText = `Are you sure you want to ${actionText} the following devices?`;
    const deviceList = document.getElementById('selectedDevicesList');
    deviceList.innerHTML = '';
    selectedDevices.forEach(device => {
        const li = document.createElement('li');
        li.textContent = device.parentElement.nextElementSibling.textContent; // Get the device ID from the next table cell
        deviceList.appendChild(li);
    });

    document.getElementById('confirmActionButton').onclick = function() {
        confirmAction(action, selectedDeviceIds, tableId, selectedDevices);
    };

    const confirmModal = new bootstrap.Modal(document.getElementById('confirmActionModal'));
    confirmModal.show();
}

function confirmAction(action, selectedDeviceIds, tableId, selectedDevices) {

    const actionDate = document.getElementById('actionDate').value;
    if (actionDate === "" || actionDate === null) {
        alert("Please select the action Date");
        document.getElementById('actionDate').focus();
        return false;
    }

    if (selectedDeviceIds.length <= 0) {
        alert("Please select Devices");
        return false;
    }

    // Convert the array to a JSON string
    const selectedDevicesJson = JSON.stringify(selectedDeviceIds);
    if(confirm("Please confirm ?"))
    {
        
        $.ajax({
            type: "POST",
            url: "../dashboard/code/update_installation_status.php",
            data: {
                DEVICES: selectedDevicesJson,
                ACTION_DATE: actionDate,
                STATUS:action
            },
            dataType: "json",
            success: function(response) {
                console.log("success");
                if (response.success) {
                    alert("Devices updated successfully!");
                    update_list(action, selectedDevices, tableId, actionDate);
                    update_switchPoints_status(group_name);
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
            }
        });
    }
}

function update_list(action, selectedDevices, tableId, actionDate)
{
    selectedDevices.forEach(device => {
        const row = device.closest('tr');
        const statusCell = row.querySelector('td:nth-child(4)');
            let dateCell = row.querySelector('td:nth-child(5)'); // Assuming date cell is the fourth column in Total Modal
            if (tableId === 'installedDeviceTable'|| tableId === 'notinstalledDeviceTable') {
              row.remove(); 

          }
          else
          {
            if (action === 'install') {
                statusCell.textContent = 'Installed';
                statusCell.classList.remove('text-danger');
                statusCell.classList.add('text-success');
                dateCell.textContent = actionDate; 
            } else if(action === 'uninstall') {
                statusCell.textContent = 'Not Installed';
                statusCell.classList.remove('text-success');
                statusCell.classList.add('text-danger');
            }
        }        
        device.checked = false;
    });

    /*const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmActionModal'));
    confirmModal.hide();*/
}



















