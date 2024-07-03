<?php
require_once 'config-path.php';
require_once '../session/session-manager.php';
SessionManager::checkSession();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <title>Dashboard</title>

  <?php
  include(BASE_PATH."assets/html/start-page.php");
  ?>
  <div class="d-flex flex-column flex-shrink-0 p-3 main-content ">
    <div class="container-fluid">
        <div class="row d-flex align-items-center">
            <div class="col-lg-12 p-0">
                <p class="m-0 p-0"><span class="text-body-tertiary">Pages / </span><span>Threshold Settings</span></p>
            </div>
        </div>
        <?php
        include(BASE_PATH."dropdown-selection/group-device-list.php");
        ?>
        <div class="row">
            <div class="col-md-6 p-0 pe-md-2 mt-2">
                <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                        Voltage
                    </div>
                    <div class="card-body row">
                        <div class="col-md-6 border-end" id="maxvoltage">
                            <div class="fw-bold m-0"> Min Voltage (V) </div>
                            <div class="mb-2 mt-1 ms-3">
                                <label for="r_phasevoltage" class="form-label text-danger" >R Phase:</label>
                                <input type="text" class="form-control " id="r_phasevoltage" placeholder="Enter voltage">
                                <label for="y_phasevoltage" class="form-label text-warning" >Y Phase:</label>
                                <input type="text" class="form-control" id="y_phasevoltage" placeholder="Enter voltage">
                                <label for="b_phasevoltage" class="form-label text-primary">B Phase:</label>
                                <input type="text" class="form-control" id="b_phasevoltage" placeholder="Enter voltage">
                            </div>
                        </div>
                        <div class="col-md-6 " id="minvoltage">
                            <div class="fw-bold m-0"> Min Voltage (V) </div>
                            <div class="mb-2 mt-1 ms-3">
                                <label for="r_phasevoltage" class="form-label text-danger" >R Phase:</label>
                                <input type="text" class="form-control" id="r_phasevoltage" placeholder="Enter voltage">
                                <label for="y_phasevoltage" class="form-label text-warning">Y Phase:</label>
                                <input type="text" class="form-control" id="y_phasevoltage" placeholder="Enter voltage">
                                <label for="b_phasevoltage" class="form-label text-primary">B Phase:</label>
                                <input type="text" class="form-control" id="b_phasevoltage" placeholder="Enter voltage">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="mb-0">*Update the max-min voltage thresholds for each phase</p>
                        <button type="submit" class="btn btn-primary" onclick="">Update</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-0 ps-md-2  mt-md-2 mt-3">

                <div class="card h-100">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                        Current
                    </div>
                    <div class="card-body row">
                        <div class="col-md-12" id="maxcurrent">
                            <div class="fw-bold m-0"></div>
                            <div class="fw-bold m-0"> Max Current(A) </div>
                            <div class="mb-1  ms-2">
                                <label for="r_phasecurrent" class="form-label  text-danger" >R Phase:</label>
                                <input type="text" class="form-control" id="r_phasecurrent" placeholder="Enter Current">
                            </div>
                            <div class="mb-1 ms-2">
                                <label for="y_phasecurrent" class="form-label text-warning">Y Phase:</label>
                                <input type="text" class="form-control " id="y_phasecurrent" placeholder="Enter Current">
                            </div>
                            <div class="mb-1 ms-2">
                                <label for="b_phasecurrent" class="form-label text-primary" >B Phase:</label>
                                <input type="text" class="form-control" id="b_phasecurrent" placeholder="Enter Current">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="mb-0">*Update the max current thresholds for each phase</p>
                        <button type="submit" class="btn btn-primary" onclick="">Update</button>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mt-3">
            <div class="col-md-6 p-0 pe-md-2">
                <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                       CT settings(A)
                   </div>
                   <div class="card-body row">
                    <div class="col-md-12 " id="ct_ratio">
                        <div class="mb-2 ms-2">
                            <label for="ctratio" class="form-label">CT Ratio:</label>
                            <input type="text" class="form-control" id="ctratio" placeholder="Enter CT ratio">

                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <p class="mb-0">*To change the CT ratio value in the device.</p>
                    <button type="submit" class="btn btn-primary" onclick="">Update</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-0 ps-md-2 mt-md-0 mt-3">
            <div class="card">
                <div class="card-header bg-primary bg-opacity-25 fw-bold">
                    Frame Update Time
                </div>
                <div class="card-body row">
                    <div class="col-md-12 " id="frame_update_time">
                        <div class="mb-2 ms-2">
                            <label for="frame_update_time" class="form-label">Update Time:</label>
                            <select class="form-select" id="time">
                                <option value="10 sec">10 sec</option>
                                <option value="15 sec">15 sec</option>
                                <option value="20 sec">20 sec</option>
                                <option value="30 sec">30 sec</option>
                                <option value="40 sec">40 sec</option>
                                <option value="50 sec">50 sec</option>
                                <option value="60 sec">1 min</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <p class="mb-0">*To Update the frame Time</p>
                    <button type="submit" class="btn btn-primary" onclick="">Update</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4 p-0 pe-md-2">

            <div class="card">
                <div class="card-header bg-primary bg-opacity-25 fw-bold">
                    Temperature 
                </div>
                <div class="card-body row">
                    <div class="col-md-12 " id="temperature">
                        <div class="mb-2 ms-2">
                            <label for="temperature" class="form-label">Temp(*C):</label>
                            <input type="text" class="form-control" id="temperature" placeholder="Enter Temperature">

                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <p class="mb-0">*To establish the temperature threshold for all sensors</p>
                    <button type="submit" class="btn btn-primary" onclick="">Update</button>
                </div>
            </div>

        </div>
        <div class="col-md-4 p-0 px-md-2 mt-md-0 mt-3">

            <div class="card">
                <div class="card-header bg-primary bg-opacity-25 fw-bold">
                    PF Settings:
                </div>
                <div class="card-body row">
                    <div class="col-md-12 " id="pf_settings">
                        <div class="mb-2 ms-2">
                            <label for="pf_settings" class="form-label">PF:</label>
                            <input type="text" class="form-control" id="pf_settings" placeholder="Enter Pf 0.1 to 0.99">

                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <p class="mb-0">*To receive PF alerts, update PF value.</p>
                    <button type="submit" class="btn btn-primary" onclick="">Update</button>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-0 ps-md-2 mt-md-0 mt-3">

            <div class="card">
                <div class="card-header bg-primary bg-opacity-25 fw-bold">
                    Unit Capacity
                </div>
                <div class="card-body row">
                    <div class="col-md-12 " id="unit_capacity">
                        <div class="mb-2 ms-2">
                            <label for="unit_capacity" class="form-label">Capacity(KW):</label>
                            <input type="text" class="form-control" id="unit_capacity" placeholder="Enter Capacity(KW):">

                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <p class="mb-0">*Update the capacity of the installed unit.</p>
                    <button type="submit" class="btn btn-primary" onclick="">Update</button>
                </div>
            </div>
        </div>
        

    </div>


    <!-- Modals links -->
</main>
<script src="<?php echo BASE_PATH;?>assets/js/sidebar-menu.js"></script>
<?php
include(BASE_PATH."assets/html/body-end.php"); 
include(BASE_PATH."assets/html/html-end.php"); 
?>

