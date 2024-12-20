function addNewMainSupplyDevice() {
    let device_input = document.getElementById("new-maindevice-id");
    let device_id = device_input.value.trim(); // Trim whitespace
    console.log(device_id);
    
    if (!device_id) {
        document.getElementById("main-device-status").innerHTML = "Device ID cannot be empty.";
        document.getElementById("main-device-status").style.color = "red";
        return; // Exit early if the device ID is empty
    }
    
    fetch(window.location.href + '?new_Main_Supply_Device&maindeviceId=' + encodeURIComponent(device_id))
        .then(response => response.json())
        .then(data => {
            document.getElementById("main-device-status").innerHTML = device_id + " " + data.message;

            // Change color based on the message
            if (data.status === "success") {
                document.getElementById("main-device-status").style.color = "green";
            } else {
                document.getElementById("main-device-status").style.color = "red";
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById("main-device-status").innerHTML = "An error occurred.";
            document.getElementById("main-device-status").style.color = "red";
        });
}
