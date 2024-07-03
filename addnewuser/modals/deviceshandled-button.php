<div class="modal fade" id="userview" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addUserModalLabel">User Managing Devices</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                        <div class="container mt-2 p-0 ">
                                <div class="row justify-content-end align-items-center mt-2 ">
                                    <div class="col-auto  mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search..." id="devicehandlesearch">
                                            <button class="btn btn-primary" type="button" onclick="devicehandleSearch()">
                                                <i class="bi bi-search"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                <div class="table-responsive rounded mt-2 border">
                    <table class="table table-striped styled-table table-type-1  w-100 text-center devicehandlesearch">
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
                                <td><input type="checkbox" id="checkbox1"></td>
                                <td>XYZ</td>
                                <td>Device1</td>
                                <td>Cherlapalli</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" id="checkbox2"></td>
                                <td>ABC</td>
                                <td>Device2</td>
                                <td>ECL</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-warning" onclick="openUpdateModal()">Update</button>
                <button type="button" class="btn btn-danger" onclick="deleteSelectedRows()">Delete</button>
                <button type="button" class="btn btn-primary" onclick="addnewDevice()">Add</button>
                <button type="button" class="btn btn-info" onclick="selectAllDevices_deviceshandled()">Select All</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<script src="<?php echo BASE_PATH;?>js_modal_scripts/searchbar.js"></script>
