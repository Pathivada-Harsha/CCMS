<div class="modal fade" id="notinstalledModal" tabindex="-1" aria-labelledby="notinstalledModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notinstalledModalLabel">Not Installed Devices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="col-12 p-0">
                    <div class="table-responsive-1 rounded mt-2 border">
                        <table class="table table-striped table-type-1 w-100 text-center" id="notinstalledDeviceTable">
                            <thead>
                                <tr>
                                    <th class="bg-logo-color text-white"  style="width: 30px !important;">Select</th>
                                    <th class="bg-logo-color text-white" >Device ID</th>
                                    <th class="bg-logo-color text-white" >Device Name</th>

                                    <th class="bg-logo-color text-white" >Status</th>
                                    <th class="bg-logo-color text-white" >Location</th>
                                    <th class="bg-logo-color text-white" >Date</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="notinstalledDevice" value="Device 1"></td>
                                    <td>Device 1</td>
                                    <td> CCMS 1</td>
                                    <td>not installed</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>2024-06-09</td> 
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="notinstalledDevice" value="Device 2"></td>
                                    <td>Device 2</td>
                                    <td> CCMS 1</td>
                                    <td>not installed</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>2024-06-09</td> 
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="notinstalledDevice" value="Device 3"></td>
                                    <td>Device 3</td>
                                    <td> CCMS 1</td>
                                    <td>not installed</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>2024-06-09</td> 
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="notinstalledDevice" value="Device 3"></td>
                                    <td>Device 3</td>
                                    <td> CCMS 1</td>
                                    <td>not installed</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>2024-06-09</td> 
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="notinstalledDevice" value="Device 3"></td>
                                    <td>Device 3</td>
                                    <td> CCMS 1</td>
                                    <td>not installed</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>2024-06-09</td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="openBatchConfirmModal('install', 'notinstalledDeviceTable')">Install Selected</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>