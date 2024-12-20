<div class="tab-pane fade show active" id="maindeviceid" role="tabpanel" aria-labelledby="main-supply-device">
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                        <span class="me-2">New Main Supply Device</span>
                        <a tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Info" data-bs-content="Create New Main Supply device id for new device "> <i class="bi bi-info-circle"></i></a>
                    </div>
                    <div class="card-body">
                        <form id="new-maindevice-details" class="form">
                            <div class="form-group">
                                <label for="new-maindevice-id" class="form-label text-primary">Enter New Main Supply ID</label>
                                <input type="text" class="form-control" name="new-maindevice-id" id="new-maindevice-id" placeholder="Enter new Main supply device ID" oninput="onChange()">
                                <!-- Display error message -->
                                <div class=" mt-2" id="main-device-status"></div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="w-100 text-center">
                            <!-- Place the submit button inside the form -->
                            <button type="button" onclick="addNewMainSupplyDevice()" form="new-maindevice-details" class="btn btn-primary mb-2">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
        <button class="btn btn-primary next-tab " data-next="#floor-device">Next</button>
    </div>
</div>
<script>
// function onChange(){
//     document.getElementById('main-device-status').innerHTML='';

// }

</script>