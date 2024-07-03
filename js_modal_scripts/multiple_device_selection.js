
  function selectAllDevices_deviceshandled() {
    var checkboxes = document.querySelectorAll('#multiple input[type="checkbox"]');
    var checked = true;

    checkboxes.forEach(function(checkbox) {
        if (!checkbox.checked) {
            checked = false;
        }
    });
    
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = !checked;
});
updateSelectedCount()
}
function selectAllDevices_devicescleared() {
      var checkboxes = document.querySelectorAll('#multiple input[type="checkbox"]');
      
      checkboxes.forEach(function(checkbox) {
          checkbox.checked = false;
      });
      updateSelectedCount()
  }
  function updateSelectedCount() {
      var checkboxes = document.querySelectorAll('#multiple input[type="checkbox"]');
      var selectedCount = 0;

      checkboxes.forEach(function(checkbox) {
          if (checkbox.checked) {
              selectedCount++;
          }
      });

      document.getElementById('selectedCount').innerText = selectedCount;
  }
  document.getElementById('multiple').addEventListener('shown.bs.modal', function () {
      var checkboxes = document.querySelectorAll('#multiple input[type="checkbox"]');
      
      checkboxes.forEach(function(checkbox) {
          checkbox.addEventListener('click', updateSelectedCount);
      });
  });