<div class="modal fade" id="addnewdevice" tabindex="-1" aria-labelledby="addnewdeviceM" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addnewdeviceH">User Managing Devices</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                        <div class="container mt-2 p-0 ">
                                <div class="row justify-content-end align-items-center mt-2 ">
                                    <div class="col-auto  mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search..." id="addButtonSearch">
                                            <button class="btn btn-primary" type="button" onclick="addButtonSearch()">
                                                <i class="bi bi-search"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                <div class="table-responsive rounded mt-2 border">
                    <table class="table table-striped table-type-1 table-sticky-header w-100 text-center addButtonSearch">
                        <thead>
                            <tr>
                                <th class="bg-logo-color text-white">Select</th>
                                <th class="bg-logo-color text-white">Device ID</th>
                                <th class="bg-logo-color text-white">Device Name</th>
                                <th class="bg-logo-color text-white">Group/Area</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>1234</td>
                                <td>Device4</td>
                                <td>Cherlapalli</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>2412234</td>
                                <td>Device5</td>
                                <td>ECL</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>2134313</td>
                                <td>Device6</td>
                                <td>Cherlapalli</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>1431343</td>
                                <td>Device7</td>
                                <td>ECL</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>1431</td>
                                <td>Device8</td>
                                <td>Cherlapalli</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>1432</td>
                                <td>Device9</td>
                                <td>ECL</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>1344</td>
                                <td>Device10</td>
                                <td>Cherlapalli</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>134134</td>
                                <td>Device11</td>
                                <td>ECL</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary" onclick="addSelectedDevices()">Add Device</button>
                <button type="button" class="btn btn-info" onclick="selectAllDevicesaddbutton()">Select All</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_PATH;?>js_modal_scripts/searchbar.js"></script>
