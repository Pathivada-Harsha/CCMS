<?php
require_once 'config-path.php';
require_once '../session/session-manager.php';
SessionManager::checkSession();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <title>Device List</title>
    <?php
    include(BASE_PATH."assets/html/start-page.php");
    ?>
    <div class="d-flex flex-column flex-shrink-0 p-3 main-content ">
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <div class="col-12 p-0">
                    <p class="m-0 p-0"><span class="text-body-tertiary">Pages / </span><span>Device List</span></p>
                </div>
            </div>
            <?php
            include(BASE_PATH."dropdown-selection/device-list.php");
            ?>

            <div class="row justify-content-end align-items-center mt-3 p-0">
                <div class="col-auto p-0 mb-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." id="deviceListInput">
                        <button class="btn btn-primary" type="button" onclick="deviceListSearch()">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </div>
                <div class="col-auto p-0 mb-2 ms-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeviceModal">
                        Add Device
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-0">
                <div class="table-responsive rounded border">
                    <table class="table table-striped table-type-1 w-100 text-center deviceListSearch">
                        <thead>
                            <tr>
                                <th class="bg-logo-color text-white">Device-Name</th>
                                <th class="bg-logo-color text-white">Device-ID</th>
                                <th class="bg-logo-color text-white">Installation Status</th>
                                <th class="bg-logo-color text-white">Installed Date</th>
                                <th class="bg-logo-color text-white">Capacity(kW)</th>
                                <th class="bg-logo-color text-white col-size-1">Last Update</th>
                                <th class="bg-logo-color text-white">On/Off Status</th>
                                <th class="bg-logo-color text-white">Operation Mode</th>
                                <th class="bg-logo-color text-white">Active Status</th>
                                <th class="bg-logo-color text-white">Location</th>
                                <th class="bg-logo-color text-white">Installed Lights</th>
                                <th class="bg-logo-color text-white">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="deviceTableBody">
                            <tr>
                                <td>Device 1</td>
                                <td>ID001</td>
                                <td>Installed</td>
                                <td>29-05-2024</td>
                                <td>25</td>
                                <td class="col-size-1">15:25:23 29-05-2024</td>
                                <td>On</td>
                                <td>Automatic</td>
                                <td>Active</td>
                                <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                <td>
                                    <button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">10</button>
                                </td>
                                <td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>
                            </tr>

                            <tr>
                                    <td>Device 2</td>
                                    <td>ID002</td>
                                    <td>Installed</td>
                                    <td>29-05-2024</td>
                                    <td>15</td>
                                    <td class="col-1">15:25:23 29-05-2024</td>
                                    <td>Off</td>
                                    <td>Manual</td>
                                    <td>Inactive</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>
                                        <button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">15</button>
                                    </td>
                                    <td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>
                                </tr>

                                <tr>
                                    <td>Device 1</td>
                                    <td>ID001</td>
                                    <td>Installed</td>
                                    <td>29-05-2024</td>
                                    <td>25</td>
                                    <td class="col-1">15:25:23 29-05-2024</td>
                                    <td>On</td>
                                    <td>Automatic</td>
                                    <td>Active</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>
                                        <button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">10</button>
                                    </td>
                                    <td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>
                                </tr>
                                <tr>
                                    <td>Device 2</td>
                                    <td>ID002</td>
                                    <td>Installed</td>
                                    <td>29-05-2024</td>
                                    <td>15</td>
                                    <td class="col-1">15:25:23 29-05-2024</td>
                                    <td>Off</td>
                                    <td>Manual</td>
                                    <td>Inactive</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>
                                        <button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">15</button>
                                    </td>
                                    <td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>
                                </tr>

                                <tr>
                                    <td>Device 1</td>
                                    <td>ID001</td>
                                    <td>Installed</td>
                                    <td>29-05-2024</td>
                                    <td>25</td>
                                    <td class="col-1">15:25:23 29-05-2024</td>
                                    <td>On</td>
                                    <td>Automatic</td>
                                    <td>Active</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>
                                        <button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">10</button>
                                    </td>
                                    <td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>
                                </tr>
                                <tr>
                                    <td>Device 2</td>
                                    <td>ID002</td>
                                    <td>Installed</td>
                                    <td>29-05-2024</td>
                                    <td>15</td>
                                    <td class="col-1">15:25:23 29-05-2024</td>
                                    <td>Off</td>
                                    <td>Manual</td>
                                    <td>Inactive</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>
                                        <button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">15</button>
                                    </td>
                                    <td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>
                                </tr>

                                <tr>
                                    <td>Device 1</td>
                                    <td>ID001</td>
                                    <td>Installed</td>
                                    <td>29-05-2024</td>
                                    <td>25</td>
                                    <td class="col-1">15:25:23 29-05-2024</td>
                                    <td>On</td>
                                    <td>Automatic</td>
                                    <td>Active</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>
                                        <button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">10</button>
                                    </td>
                                    <td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>
                                </tr>
                                <tr>
                                    <td>Device 2</td>
                                    <td>ID002</td>
                                    <td>Installed</td>
                                    <td>29-05-2024</td>
                                    <td>15</td>
                                    <td class="col-1">15:25:23 29-05-2024</td>
                                    <td>Off</td>
                                    <td>Manual</td>
                                    <td>Inactive</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>
                                        <button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">15</button>
                                    </td>
                                    <td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>
                                </tr>

                                <tr>
                                    <td>Device 1</td>
                                    <td>ID001</td>
                                    <td>Installed</td>
                                    <td>29-05-2024</td>
                                    <td>25</td>
                                    <td class="col-1">15:25:23 29-05-2024</td>
                                    <td>On</td>
                                    <td>Automatic</td>
                                    <td>Active</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>
                                        <button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">10</button>
                                    </td>
                                    <td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>
                                </tr>
                                <tr>
                                    <td>Device 2</td>
                                    <td>ID002</td>
                                    <td>Installed</td>
                                    <td>29-05-2024</td>
                                    <td>15</td>
                                    <td class="col-1">15:25:23 29-05-2024</td>
                                    <td>Off</td>
                                    <td>Manual</td>
                                    <td>Inactive</td>
                                    <td><a href="https://www.google.com/maps?q=17.467754,%2078.603072" target="_blank">Location</a></td>
                                    <td>
                                        <button class="btn btn-info btn-sm p-0 px-2" onclick="openLightsModal(this)">15</button>
                                    </td>
                                    <td><i class="bi bi-trash-fill text-danger" onclick="deleteRow(this)"></i></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div></div>
</div>
</main>

<?php
include(BASE_PATH."devicelist/modals/adddevice_modal.php");
include(BASE_PATH."devicelist/modals/installedlights_modal.php");
include(BASE_PATH."devicelist/modals/addlight_modal.php");

?>
<script src="<?php echo BASE_PATH;?>assets/js/sidebar-menu.js"></script>
<script src="<?php echo BASE_PATH;?>js_modal_scripts/devicelist_modal_script.js"></script>
<script src="<?php echo BASE_PATH;?>js_modal_scripts/searchbar.js"></script>
<?php
include(BASE_PATH."assets/html/body-end.php");
include(BASE_PATH."assets/html/html-end.php");
?>
