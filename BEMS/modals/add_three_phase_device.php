<!-- 
<div class="modal fade" id="add_three_phase_device" tabindex="-1" aria-labelledby="add_three_phase_device"
    aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_three_phase_device">New Device</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="add_three_phase_device_body">
                <form class="form">
                    <div class="">
                        <div>
                            <p><span>Transformer Name: </span><span id="t_name"></span> </p> 
                        </div>
                        <div>
                            <p><span>Floor Name: <span id="f_name"></span></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-item-center">
                        <label class="form-label ">Device Name</label>
                        <input class="form-control" type="text" placeholder="Enter Device Name...">
                        <button type="submit" class="btn btn-outline-primary" style="margin-left:5px" id="">Save</button>
                    </div>
                    <div id="response"></div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center" >
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->


<div class="modal fade" id="add_three_phase_device" tabindex="-1" aria-labelledby="add_three_phase_device"
    aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_three_phase_device">New Device</h5>               
            </div>
            <div class="modal-body" id="add_three_phase_device_body">
                <form id="deviceForm">
                    <div>
                        <p><span>Transformer Name: </span><span id="t_name">Transformer 1</span></p>
                        <p><span>Floor Name: <span id="f_name">1</span> Floor</p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <label class="form-label">Device Name</label>
                        <input class="form-control" type="text" id="device_name" placeholder="Enter Device Name..." oninput="onChange()">
                        <button type="button" class="btn btn-outline-primary" id="saveThreePhaseDevice" style="margin-left: 5px;">Save</button>
                    </div>
                    <div id="response" style="margin-top: 10px; color: green;"></div> 
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelButton" onclick="toShowThreePhaseTable()">Close</button>
            </div>
        </div>
    </div>
</div>