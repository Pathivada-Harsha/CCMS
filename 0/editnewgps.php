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
            <div class="col-12 p-0">
            <p class="m-0 p-0"><span class="text-body-tertiary">Pages / </span><span>Edit Location</span></p>
            </div>
        </div>
        <?php
        include(BASE_PATH."dropdown-selection/group-device-list.php");
        ?>
        <div class="row mt-4">
            <div class="col-md-6 p-0">
                <div class="container ">
                  <div class="card mt-3">
                        <div class="card-header bg-primary bg-opacity-25 fw-bold">
                          GPS
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                          </svg>
                        </div>
                        <div class="card-body row">
                                <form class="col-md-12" id="Address">
                                    <div class="mb-2 mt-1 ms-3">
                                      <label for="Street" class="form-label " >Lat&Long:</label>
                                      <input type="text" class="form-control" id="street" placeholder="Enter coordinates">
                                      
                                    </div>
                                </form>
                          </div>
                          <div class="card-footer d-flex justify-content-between align-items-center">
                            <p class="mb-0">*Update static location</p>
                            <button type="submit" class="btn btn-primary" onclick="">Update</button>
                        </div>
                    </div>
                </div>
                <div class="container ">
                  <div class="card mt-3">
                        <div class="card-header bg-primary bg-opacity-25 fw-bold">
                          Static GPS
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                          </svg>
                        </div>
                        <div class="card-body row">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Enable/Disable</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input"  type="checkbox" id="setting1">
                                        <label class="form-check-label" for="setting1"></label>
                                    </div>
                                </div>
                          </div>
                          <div class="card-footer d-flex justify-content-between align-items-center">
                            <p class="mb-0">*Stop Update GPS location From Device and Enable the static GPS location</p>
                            
                        </div>
                    </div>
                </div>
              </div>
                <div class="col-lg-6">
                <div class="container ">
                    <div class="card mt-3">
                      <div class="card-header bg-primary bg-opacity-25 fw-bold">
                        Address
                        </div>
                          <div class="card-body row">
                              <form class="col-sm-12 col-md-12" id="Address">
                                  <div class="mb-2 mt-1 ms-3">
                                    <label for="Street" class="form-label " >Street/Line:</label>
                                    <input type="text" class="form-control" id="street" placeholder="Enter street">
                                    <label for="area" class="form-label " >Area:</label>
                                    <input type="text" class="form-control" id="area" placeholder="Enter Area">
                                    <label for="city" class="form-label " >City/Town:</label>
                                    <input type="text" class="form-control" id="city" placeholder="Enter City/Town">
                                    <label for="district" class="form-label " >District:</label>
                                    <input type="text" class="form-control" id="district" placeholder="Enter District">
                                    <label for="State" class="form-label " >State:</label>
                                    <input type="text" class="form-control" id="State" placeholder="Enter State">
                                    <label for="pincode" class="form-label " >Pincode:</label>
                                    <input type="text" class="form-control" id="pincode" placeholder="Enter Pincode">
                                    <label for="Country" class="form-label " >Country:</label>
                                    <input type="text" class="form-control" id="Country" placeholder="Enter Country">
                                  </div>
                              </form>
                          </div>
                          <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary" onclick="">Update</button>
                        </div>
                      </div>
                  </div>
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

