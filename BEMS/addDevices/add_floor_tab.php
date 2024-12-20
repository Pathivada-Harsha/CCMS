<div class="tab-pane fade" id="New-floor-device" role="tabpanel" aria-labelledby="floor-device">
    <div class="container">
        <div class="row">
            <div class="col-md-1">

            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                        <span class="me-2">Add New Devices</span>
                        <a tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus"
                            data-bs-title="Info"
                            data-bs-content="Create New Device id for new devices which work under the transformer device">
                            <i class="bi bi-info-circle"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <form id="new-floor-device-details" method="post"
                            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="form-group" id="main-supply-device-selection">
                                <label for="main-supply-devices-dropdown" class="form-label text-primary">
                                    <strong>Main Supply Devices</strong>
                                </label>
                                <select class="form-select" name="main-supply-device-dropdown-tab1"
                                    id="main-supply-device-dropdown-tab1">
                                    <option value="">Select from dropdown</option>

                                </select>

                            </div>

                            <div class="form-group" id="new-floor">
                                <div class="row" id="new-floor">
                                    <!-- Floor Selection -->
                                    <div class="col-md-4">
                                        <label for="new-floor-name" class="form-label text-primary">
                                            <strong>Add new floor</strong>
                                        </label>
                                        <input id="new-floor-name" class="form-control" name="new-floor-name"
                                            placeholder="Enter New Floor Name" oninput="onChange()">

                                    </div>

                                    <!-- Phase Selection -->

                                    <div class="col-md-4">
                                        <label for="phase-dropdown" class="form-label text-primary">
                                            <strong>Phase Selection</strong>
                                        </label>
                                        <select class="form-select" id="phase-dropdown" name="phase-dropdown">
                                            <option value="">Select from dropdown</option>
                                            <option value="single">Single Phase</option>
                                            <option value="three">Three Phase</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4" id="single-phase-floor-options" style="display: none;">
                                        <label for="single-phase-floor-dropdown" class="form-label text-primary">
                                            <strong>Single Phase Selection</strong>
                                        </label>
                                        <select class="form-select" id="single-phase-floor-dropdown"
                                            name="single-phase-floor-dropdown">
                                            <option value="">Select Phase</option>
                                            <option value="R phase">R Phase</option>
                                            <option value="Y phase">Y Phase</option>
                                            <option value="B phase">B Phase</option>
                                        </select>
                                    </div>


                                    <!-- Create New Floor Device ID -->
                                    <div class="col-md-4">
                                        <label for="new-floor-device" class="text-primary form-label">
                                            <strong>Create New Floor Device ID</strong>
                                        </label>
                                        <input id="new-floor-device" class="form-control" name="new-floor-device"
                                            placeholder="Enter new Floor Device Id" oninput="onChange()">

                                    </div>

                                    <!-- Save Button -->
                                    <!-- <div class="col-md-2 d-flex align-items-center justify-content-center">
                                        <button type="button" class="btn btn-success me-2" id="save-btn">Save</button>
                                    </div> -->

                                </div>
                                <div class="mt-2">
                                    <h6  id="floor-device-status"></h6>
                                </div>
                            </div>

                        </form>
                        <!-- Display saved devices in a scrollable box -->
                        <!-- <div class="mt-3">
                            <h5 class="text-primary">Saved Devices</h5>
                            <div id="saved-devices-box" class="border p-3" style="max-height: 200px; overflow-y: auto;">
                                Saved data will be appended here dynamically
                            </div>
                        </div> -->
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="w-100 text-center">
                            <button type="button" onclick="update_floor_devices_data()" form="new-floor-device-details"
                                class="btn btn-primary mb-2">Update</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-1">

            </div>
            <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-secondary prev-tab" data-prev="#main-device">Previous</button>
                <button class="btn btn-primary next-tab" data-next="#switched-device">Next</button>
            </div>
        </div>
    </div>

</div>


<script>
    document.getElementById('phase-dropdown').addEventListener('change', function () {
        var selectedValue = this.value;
        var singlePhaseOptions = document.getElementById('single-phase-floor-options');
        
        if (selectedValue === 'single') {
            singlePhaseOptions.style.display = 'block';
        } else {
            singlePhaseOptions.style.display = 'none';
        }
    });

    // function onChange(){
    //         document.getElementById('floor-device-status').innerHTML='';
    // }
   
</script>