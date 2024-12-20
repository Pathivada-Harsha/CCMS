document.getElementById('addfloors').addEventListener('click', function () {
    addFloorGroup();
});

function addFloorGroup() {
    const floorGroup = document.querySelector('.floor-group');

    let newFloorGroup;
    if (floorGroup) {
        newFloorGroup = floorGroup.cloneNode(true); // Clone the existing group
        newFloorGroup.querySelectorAll('input').forEach(input => input.value = ''); // Clear input fields
    } else {
        // If no existing group, create a new one
        newFloorGroup = document.createElement('div');
        newFloorGroup.classList.add('row', 'g-2', 'floor-group');
        newFloorGroup.innerHTML = `
<div class="col-md-12 " >
<div class="d-flex align-items-center text-center mt-2">
    <input type="text" class="form-control" name="floorid[]" placeholder="Enter New Floor Number or ID...">
    <button type="button" class="btn btn-danger btn-sm remove-floor" style="margin-left:10px;">X</button>
</div>
</div>

`;
    }

    document.getElementById('floorFields').appendChild(newFloorGroup); // Append new group
}

// Function to remove a floor input group
document.getElementById('floorFields').addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-floor')) {
        const group = event.target.closest('.floor-group');
        group.remove();
    }
});



