<div class="modal fade" id="TotalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TotalModalLabel">Total Modes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" >
                <div class="col-12 p-0">
                    <div class="table-responsive-1 rounded mt-2 border ">
                        <table class="table table-striped table-type-1 w-100 text-center"id="totalDeviceTable">
                            <thead>
                                <tr>
                                    <th class="bg-logo-color text-white" scope="col" style="width: 30px !important;">Select</th>
                                    <th class="bg-logo-color text-white" scope="col">Device ID</th>
                                    <th class="bg-logo-color text-white" scope="col">Device Name</th>

                                    <th class="bg-logo-color text-white" scope="col">Status</th>
                                    <th class="bg-logo-color text-white" scope="col">Date</th> <!-- New column for date -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td ><input type="checkbox" name="selectedDevice" value="Device 1"></td>
                                    <td>Device 1</td>
                                    <td> CCMS 1</td>
                                    <td>installed</td>
                                    <td>2024-06-09</td> 
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="selectedDevice" value="Device 2"></td>
                                    <td>Device 2</td>
                                    <td> CCMS 1</td>
                                    <td>not installed</td>
                                    <td>2024-06-09</td> 
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="selectedDevice" value="Device 3"></td>
                                    <td>Device 3</td>
                                    <td> CCMS 1</td>
                                    <td>installed</td>
                                    <td>2024-06-09</td> 
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="selectedDevice" value="Device 1"></td>
                                    <td>Device 1</td>
                                    <td> CCMS 1</td>
                                    <td>installed</td>
                                    <td>2024-06-09</td> 
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="selectedDevice" value="Device 1"></td>
                                    <td>Device 1</td>
                                    <td> CCMS 1</td>
                                    <td>installed</td>
                                    <td>2024-06-09</td> 
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="selectedDevice" value="Device 1"></td>
                                    <td>Device 1</td>
                                    <td> CCMS 1</td>
                                    <td>installed</td>
                                    <td>2024-06-09</td> 
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="openBatchConfirmModal('install', 'totalDeviceTable')"> Install Selected</button>
                <button type="button" class="btn btn-danger" onclick="openBatchConfirmModal('uninstall', 'totalDeviceTable')">Uninstall Selected</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
