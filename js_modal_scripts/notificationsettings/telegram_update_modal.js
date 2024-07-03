function selectAllDevices(type) {
    var selectAllCheckbox = document.getElementById(type === 'add' ? 'selectAllAddDevice' : 'selectAllRemoveDevice');
    var checkboxes = document.querySelectorAll(type === 'add' ? '#totalDeviceTableAdd input[type="checkbox"]' : '#totalDeviceTableRemove input[type="checkbox"]');
    var checked = selectAllCheckbox.checked;

    checkboxes.forEach(function(checkbox) {
        checkbox.checked = checked;
    });

    updateSelectedCount(type);
}

function clearAllDevices(type) {
    var checkboxes = document.querySelectorAll(type === 'add' ? '#totalDeviceTableAdd input[type="checkbox"]' : '#totalDeviceTableRemove input[type="checkbox"]');

    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });

    updateSelectedCount(type);
}

function updateSelectedCount(type) {
    var checkboxes = document.querySelectorAll(type === 'add' ? '#totalDeviceTableAdd input[type="checkbox"]' : '#totalDeviceTableRemove input[type="checkbox"]');
    var countElement = document.getElementById(type === 'add' ? 'selectedCountAddDevice' : 'selectedCountRemoveDevice');
    var selectedCount = 0;

    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            selectedCount++;
        }
    });

    countElement.innerText = selectedCount;
}