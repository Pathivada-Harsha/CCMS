<div class="modal fade" id="add_single_phase_device" tabindex="-1" aria-labelledby="add_single_phase_device" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_single_phase_device">New Device</h5>               
            </div>
            <div class="modal-body" id="add_single_phase_device_body">
                <form id="deviceForm">
                    <div>
                        <p><span>Transformer Name: </span><span id="single_phase_transformer_name"></span></p>
                        <p><span>Floor Name: <span id="single_phase_floor_name"></span> Floor</p>
                        <p><span>Phase Name: <span id="single_phase_phase_name"></span></p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <label class="form-label">Device Name</label>
                        <input class="form-control" type="text" id="single_device_name" placeholder="Enter Device Name..." oninput="onChange()">
                        <button type="button" class="btn btn-outline-primary" id="saveSinglePhaseDevice" style="margin-left: 5px;" onclick="SaveSinglePhaseNewDevice()">Save</button>
                        <div id="add_single_phase_device" style="margin-top: 10px; color: green;"></div> 
                    </div>
                    <div id="single_phase_response" style="margin-top: 10px; color: green;"></div> <!-- Response message area -->
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="toShowSinglePhaseDeviceTable()">Close</button>
            </div>
        </div>
    </div>
</div>