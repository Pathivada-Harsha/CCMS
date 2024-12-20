<div class="tab-pane fade" id="New-switched-device" role="tabpanel" aria-labelledby="switched-device">
    <div class="container">
        <div class="row">
            <div class="col-md-1">

            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                        <span class="me-2">Add New Switched Devices</span>
                        <a tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus"
                            data-bs-title="Info"
                            data-bs-content="Create New switched Device id for new devices which work under the floor device">
                            <i class="bi bi-info-circle"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <form id="new-switched-devices" method="post"
                            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="form-group" id="main-supply-device-selection">
                                <label for="main-supply-devices-dropdown" class="form-label text-primary">
                                    <strong>Main Supply Devices</strong>
                                </label>
                                <select class="form-select" id="main-supply-device-dropdown-tab">
                                    <option value="">Select from dropdown</option>

                                </select>
                            </div>

                            <div class="form-group" id="floor-selection">
                                <label for="floor-dropdown" class="form-label text-primary">
                                    <strong>Floor Device Selection</strong>
                                </label>
                                <select class="form-select" id="floor-devices-dropdown-switch">
                                    <option value="">Select from dropdown</option>

                                </select>
                            </div>

                            <div class="form-group" id="floor-devices-selection">
                                <div class="row" id="multiple-floors-devices-selection">
                                    <!-- Floor Selection -->


                                    <!-- Phase Selection -->
                                    <div class="col-md-6">
                                        <label for="phase-switch-dropdown" class="form-label text-primary">
                                            <strong>Phase Selection</strong>
                                        </label>
                                        <select class="form-select" id="phase-switch-dropdown">
                                            <option value="">Select from dropdown</option>
                                            <option value="single">Single Phase</option>
                                            <option value="three">Three Phase</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="single-phase-switch-options" style="display: none;">
                                        <label for="single-phase-switch-dropdown" class="form-label text-primary">
                                            <strong>Single Phase Selection</strong>
                                        </label>
                                        <select class="form-select" id="single-phase-switch-dropdown"
                                            name="single-phase-switch-dropdown">
                                            <option value="">Select Phase</option>
                                            <option value="R phase">R Phase</option>
                                            <option value="Y phase">Y Phase</option>
                                            <option value="B phase">B Phase</option>
                                        </select>
                                    </div>
                                    <!-- Create New Floor Device ID -->
                                    <div class="col-md-6">
                                        <label for="new-switch-device" class="text-primary form-label">
                                            <strong>Create New Floor Device ID</strong>
                                        </label>
                                        <input id="new-switch-device" class="form-control" name="new-switch-device-id"
                                            placeholder="Enter new id"  oninput="onChange()">
                                    </div>

                                    <!-- Save Button -->
                                    <!-- <div class="col-md-2 d-flex align-items-center justify-content-center">
                                        <button type="button" class="btn btn-success me-2" id="switch-btn">Save</button>
                                    </div> -->
                                </div>
                                <div class="mt-2">
                                    <h6  id="switched-device-status"></h6>
                                </div>
                            </div>
                        </form>
                        <!-- <div class="mt-3">
                            <h5 class="text-primary">Saved Devices</h5>
                            <div id="switched-devices-box" class="border p-3"
                                style="max-height: 200px; overflow-y: auto;">
                                Saved data will be appended here dynamically
                            </div>
                        </div> -->
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="w-100 text-center">
                            <button type="button" onclick="update_switched_devices_data()" form="new-switched-devices"
                                class="btn btn-primary mb-2">Update</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-1">

            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-3">
        <button class="btn btn-secondary prev-tab" data-prev="#floor-device">Previous</button>

    </div>

</div>
<script>
    document.getElementById('phase-switch-dropdown').addEventListener('change', function () {
        var selectedValue = this.value;
        var singlePhaseOptions = document.getElementById('single-phase-switch-options');
        
        if (selectedValue === 'single') {
            singlePhaseOptions.style.display = 'block';
        } else {
            singlePhaseOptions.style.display = 'none';
        }
    });

   
</script>