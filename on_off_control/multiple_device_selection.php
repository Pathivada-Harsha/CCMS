<div class="modal fade" id="multiple" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TotalModalLabel">Devices List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 p-0">
                    <div class="card">
                        <div class="table-responsive rounded m-2 border" style="max-height: 200px; overflow-y: auto;">
                            <table class="table table-striped table-type-1 text-center" id="totalDeviceTable">
                                <thead>
                                    <tr>
                                        <th class="bg-logo-color text-white" style="width: 20%;" scope="col">Select</th>
                                        <th class="bg-logo-color text-white" style="width: 80%;" scope="col">Device ID</th>
                                        <th class="bg-logo-color text-white" scope="col">Device Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" name="selectedDevice" value="Device 1"></td>
                                        <td>Device 1</td>
                                        <td> CCMS 1</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="selectedDevice" value="Device 2"></td>
                                        <td>Device 2</td>
                                        <td> CCMS 1</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="selectedDevice" value="Device 2"></td>
                                        <td>Device 2</td>
                                        <td> CCMS 1</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="selectedDevice" value="Device 2"></td>
                                        <td>Device 2</td>
                                        <td> CCMS 1</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="selectedDevice" value="Device 2"></td>
                                        <td>Device 2</td>
                                        <td> CCMS 1</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="selectedDevice" value="Device 2"></td>
                                        <td>Device 2</td>
                                        <td> CCMS 1</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="selectedDevice" value="Device 2"></td>
                                        <td>Device 2</td>
                                        <td> CCMS 1</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="selectedDevice" value="Device 2"></td>
                                        <td>Device 2</td>
                                        <td> CCMS 1</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="selectedDevice" value="Device 2"></td>
                                        <td>Device 2</td>
                                        <td> CCMS 1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-2">
                    Selected Devices: <span id="selectedCount">0</span>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="selectAllDevices_deviceshandled()">Select all</button>
                <button type="button" class="btn btn-danger" onclick="selectAllDevices_devicescleared()">Clear</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>