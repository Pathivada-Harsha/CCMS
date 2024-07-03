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
            <p class="m-0 p-0"><span class="text-body-tertiary">Pages / </span><span>IOT Settings</span></p>
            </div>
        </div>
        <?php
            include(BASE_PATH."dropdown-selection/group-device-list.php");
        ?>
        <div class="row mt-4">
            <div class="col-md-4 p-0">
                <div class="container ">
                    <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                       Device ID Change
                    </div>
                        <div class="card-body row">
                            <form class="col-md-12 " id="new_device_id">
                                <div class="mb-2 ms-2">
                                <label for="new_device_id" class="form-label">New ID:</label>
                                <input type="text" class="form-control" id="new_device_id" placeholder="Enter New ID">
                                
                                </div>
                            </form>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <p class="mb-0">*To Change the Device ID</p>
                            <button type="submit" class="btn btn-primary" onclick="">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-0">
                <div class="container ">
                    <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                       Device Serial ID 
                    </div>
                        <div class="card-body row">
                            <form class="col-md-12 " id="new_device_serial_id">
                                <div class="mb-2 ms-2">
                                <label for="new_device_id" class="form-label">New Serial ID:</label>
                                <input type="text" class="form-control" id="new_device_serial_id" placeholder="Enter New Serial ID">
                                
                                </div>
                            </form>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <p class="mb-0">*To change the IOT Serial ID.</p>
                            <button type="submit" class="btn btn-primary" onclick="">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-0">
                <div class="container ">
                    <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                       Reset
                    </div>
                        <div class="card-body row">
                            <form class="col-md-12 " id="reset">
                                <div class="mb-2 ms-2">
                                <label for="reset" class="form-label">Device ID:</label>
                                <input type="text" class="form-control" id="reser" placeholder="Enter Device ID">
                                
                                </div>
                            </form>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <p class="mb-0">*To Reset the Device</p>
                            <button type="submit" class="btn btn-primary" onclick="">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mt-4">
            <div class="col-md-4 p-0">
                <div class="container ">
                    <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                        Energy
                    </div>
                        <div class="card-body row">
                            <form class="col-md-12 " id="Energy">
                                <div class="mb-2 ms-2">
                                    <label for="pf_settings" class="form-label">KWH:</label>
                                    <input type="text" class="form-control" id="Energy_kwh" placeholder="0">
                                    <label for="pf_settings" class="form-label">KVAH:</label>
                                    <input type="text" class="form-control" id="Energy_Kwh" placeholder="0">
                                </div>
                            </form>
                            
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <p class="mb-0">*Change the Energy.</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#multiple">All Devices</button>
                            <button type="button" class="btn btn-primary" onclick="">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-0">
                <div class="container ">
                    <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                        Unbalanced Load(%)
                    </div>
                    <div class="card-body row">
                    <form class="col-md-12 " id="Energy">
                                <div class="mb-2 ms-2">
                                    <label for="pf_settings" class="form-label">Deviation:</label>
                                    <input type="text" class="form-control" id="Deviation" placeholder="0">
                                    <label for="pf_settings" class="form-label">Rated KVA:</label>
                                    <input type="text" class="form-control" id="Rated KVA" placeholder="0">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <p class="mb-0">*Change the deviation %.</p>
                            <button type="submit" class="btn btn-primary" onclick="">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-0">
                <div class="container">
                    <div class="card">
                    <div class="card-header bg-primary bg-opacity-25 fw-bold">
                       WIFI
                    </div>
                        <div class="card-body row">
                            <form class="col-md-12 " id="wifi">
                                <div class="mb-2 ms-2">
                                <label for="temperature" class="form-label">Access Point:</label>
                                <input type="text" class="form-control" id="Access_Point" placeholder="Enter Access Point">
                                <label for="pf_settings" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="Password" placeholder="Eneter Password">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <p class="mb-0">*Change wifi details.</p>
                            <button type="submit" class="btn btn-primary" onclick="">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mt-4">
            <div class="col-md-6 p-0">
                <div class="container ">
                   <div class="card">
                   <div class="card-header bg-primary bg-opacity-25 fw-bold">
                    Angle
                    </div>
                        <div class="card-body row">
                            <form class="col-md-5 " id="maxangle">
                                <div class="fw-bold m-0"> Angle(below) </div>
                                <div class="mb-2 mt-1 ms-3">
                                <label for="r_phaseangle" class="form-label text-danger" >R Phase:</label>
                                <input type="text" class="form-control " id="r_phaseangle" placeholder="Enter angle(0-9)">
                                <label for="y_phaseangle" class="form-label text-warning" >Y Phase:</label>
                                    <input type="text" class="form-control" id="y_phaseangle" placeholder="Enter angle(0-9)">
                                <label for="b_phaseangle" class="form-label text-primary">B Phase:</label>
                                    <input type="text" class="form-control" id="b_phaseangle" placeholder="Enter angle(0-9)">
                                </div>
                            </form>
                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <div class="vr"></div>
                            </div>
                            <form class="col-md-5 " id="minangle">
                                <div class="fw-bold m-0">  Angle(above) </div>
                                <div class="mb-2 mt-1 ms-3">
                                <label for="r_phaseangle" class="form-label text-danger" >R Phase:</label>
                                <input type="text" class="form-control" id="r_phaseangle" placeholder="Enter angle(0-9)">
                                <label for="y_phaseangle" class="form-label text-warning">Y Phase:</label>
                                    <input type="text" class="form-control" id="y_phaseangle" placeholder="Enter angle(0-9)">
                                <label for="b_phaseangle" class="form-label text-primary">B Phase:</label>
                                    <input type="text" class="form-control" id="b_phaseangle" placeholder="Enter angle(0-9)">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <p class="mb-0">*Angle for Calibration Factor</p>
                            <button type="submit" class="btn btn-primary" onclick="">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div >
                    <div class="container ">
                        <div class="card">
                        <div class="card-header bg-primary bg-opacity-25 fw-bold">
                        Read IOT Settings
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                                <p class="mb-0">*To Read IOT Settings</p>
                                <button type="submit" class="btn btn-primary" onclick="">Read</button>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
</div>
</div>
</div>

    <!-- Modals links -->
    <?php
    include("../on_off_control/multiple_device_selection.php");
    ?>
  </main>
  <script src="<?php echo BASE_PATH;?>js_modal_scripts/multiple_device_selection.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/js/sidebar-menu.js"></script>
  <?php
  include(BASE_PATH."assets/html/body-end.php"); 
  include(BASE_PATH."assets/html/html-end.php"); 
  ?>

