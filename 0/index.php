<?php
require_once 'config-path.php';
require '../session/session-manager.php';
SessionManager::checkSession();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
  <title>Dashboard</title>  
  <style>
.custom-card_increase {
  transition: all 0.3s ease;
  border-radius: 10px;
  overflow: hidden;
  border: 30px solid #0d6efd; /* Set initial border width and color */
  box-sizing: border-box; /* Ensures border doesn't affect element's size */
}

.custom-card_increase:hover {
  color:#14dcb8;
  letter-spacing: 2px;
  font-size: 20px;
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  outline: 5px solid transparent; /* Create a fake "border" with outline */
  outline-offset: 3px; /* Offset outline to avoid overlap */
  animation: borderColorChange 2s infinite; /* Animation for border color change */
}

@keyframes borderColorChange {
  0% {
    border-color: #0d6efd; /* Start color */
  }
  25% {
    border-color: #198754; /* Intermediate color 1 */
  }
  50% {
    border-color: #dc3545; /* Intermediate color 2 */
  }
  75% {
    border-color: #ffc107; /* Intermediate color 3 */
  }
  100% {
    border-color: #0d6efd; /* Back to start */
  }
}

</style> 
  <?php
  include(BASE_PATH."assets/html/start-page.php");  
  ?>
  <div class="d-flex flex-column flex-shrink-0 p-3 main-content">
    <div class="container-fluid">
      <div class="row d-flex align-items-center">
        <div class="col-12 p-0">
          <p class="m-0 p-0"><span class="text-body-tertiary">Pages / </span><span>Dashboard</span></p>
        </div>
      </div>
      <?php
      include(BASE_PATH."dropdown-selection/device-list.php");
      ?>
      <!-- <div class="row">
        <div class=""> -->
          
          <div class="row  mt-2" >
            <div class="col-12 rounded mt-2 p-0 ">
              <div class="row">
                <div class="col-4 pointer pointer">
                  <div class="card custom-card_increase text-center shadow h-100 w-100" data-bs-toggle="modal" data-bs-target="#TotalModal" id="total_device">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-bar-chart-fill h4"></i> Total</p>
                      <h3 class="card-title py-3 text-primary" id="total_devices">0</h3>
                    </div>
                  </div>
                </div>

                <div class="col-4 pointer pointer">
                  <div class="card custom-card_increase text-center shadow h-100 w-100" data-bs-toggle="modal" data-bs-target="#installedModal" id="installed_devices_list">
                    <div class="card-body m-0 p-0 ">
                      <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-check-circle-fill h4"></i> Installed</p>
                      <h3 class="card-title py-3 text-primary" id="installed_devices">0</h3>
                    </div>
                  </div>
                </div>
                <div class="col-4 pointer pointer">
                  <div class="card custom-card_increase text-center shadow h-100 w-100" data-bs-toggle="modal" data-bs-target="#notinstalledModal"  id="not_installed_devices_list">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold text-info-emphasis m-0 py-1"><i class="bi bi-x-circle-fill h4"></i> Not-installed</p>
                      <h3 class="card-title py-3 text-primary" id="not_installed_devices">0</h3>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-6 pointer mt-2">
                  <div class="card custom-card_increase text-center shadow h-100 w-100" data-bs-toggle="modal" data-bs-target="#activeModal" id="active_device_list">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1 text-success "><i class="bi bi-lightbulb-fill h4"></i> Active</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-3 text-success" id="active_devices">0</h3>
                    </div>
                  </div>
                </div>

                <div class="col-xl-3 col-6 pointer mt-2">
                  <div class="card custom-card_increase text-center shadow h-100 w-100" data-bs-toggle="modal" data-bs-target="#activePoorNetworkModal" id="poor_nw_device_list">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1 text-warning-emphasis"><i class="bi bi-exclamation-triangle-fill h4"></i> Poor N/W</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-3 text-warning-emphasis text-opacity-25" id="poornetwork">0</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-6 pointer  mt-2" >
                  <div class="card custom-card_increase text-center shadow h-100 w-100"data-bs-toggle="modal" data-bs-target="#powerfailureModal" id="power_failure_device_list">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1 text-body-tertiary"><i class="bi bi-power h4"></i> Input Power Fail</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-3 text-body-tertiary" id="input_power_fail">0</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-6 pointer  mt-2">
                  <div class="card custom-card_increase text-center shadow h-100 w-100" data-bs-toggle="modal" data-bs-target="#faultModal" id="faulty_device_list">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1 text-danger"><i class="bi bi-bug-fill h4"></i> Faulty</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-3 text-danger" id="faulty">0</h3>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- <div class="col-12 rounded mt-3 p-0">
              <div class="row">
                
                
              </div>
            </div> -->

            <!-- <div class="row ps-0 ps-lg-2 h-100"> -->
            <div class="col-12 rounded mt-3  p-0">
              <div class="card bg-light-subtle shadow">
                <div class="card-header fw-bold">
                  <i class="bi bi-chat-dots-fill"></i> Updates
                </div>
                <div class="card-body">
                  <div id="alerts_list" class="list-group overflow-y-auto" style=" height:300px;">
                  </div>
                </div>
              </div>
            </div>
          <!-- </div> -->
            <!-- <div class="col-12 rounded mt-3 p-0">
              <div class="row">
                <div class="col-4 pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#AutoOnModal" id="auto_on_devices_list">
                    <div class="card-body m-0 p-0 text-success">
                      <p class="card-text fw-semibold m-0 py-1"> <i class="bi bi-clock-fill h4"></i> Auto/System On</p>
                      
                      <h3 class="card-title py-3" id="auto_on">0</h3>
                    </div>
                  </div>
                </div>
                <div class="col-4 pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#manualOnModal" id="manual_on_devices_list">
                    <div class="card-body m-0 p-0 text-info-emphasis">
                      <p class="card-text fw-semibold m-0 py-1">  <i class="bi bi-hand-index-fill h4"></i> Manual On</p>
                      
                      <h3 class="card-title py-3" id="manual_on">0</h3>
                    </div>
                  </div>
                </div>
                <div class="col-4 pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#offModal" id="off_devices_list">
                    <div class="card-body m-0 p-0 text-danger">
                      <p class="card-text fw-semibold m-0 py-1"> <i class="bi bi-toggle-off h4"></i> OFF</p>
                      
                      <h3 class="card-title py-3" id="off">0</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- <div class="col-12 rounded mt-3 p-0 ">
              <div class="row">
                <div class="col-xl-6 ">
                  <div class="card h-100 shadow-sm text-left p-2">
                    <p class="d-flex align-items-center"> <i class="bi bi-lamp-fill h4"></i> Installed Lights: <span><span class="h3 ms-4 text-primary-emphasis" id="installed_lights"> 2562</span> </span>
                    </p>
                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" id="installed_lights_on">60%-ON</div>
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" id="installed_lights_off">40%-OFF</div>

                    </div>

                  </div>
                </div>
                <div class="col-xl-6 mt-lg-0 mt-3">
                  <div class="card h-100 shadow-sm text-left p-2">
                    <p class="d-flex align-items-center"><i class="bi bi-plug h4"></i> Cumulative Load (watts)</p>
                    <div class="progress" role="progressbar" aria-label="Primary example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar bg-primary" style="width: 100%" id="installed_load">Intalled load- 0</div>
                    </div>

                    <div class="progress mt-2" role="progressbar" aria-label="Animated striped example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar progress-bar-striped bg-info progress-bar-animated overflow-visible text-light-emphasis" style="width: 80%" id="active_load">Active - 0</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 rounded mt-3 p-0">
              <div class="row">
                <div class="col-6">
                  <div class="card text-center shadow">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"> <i class="bi bi-lightning-fill h4"></i> Total Consumption (Units)</p>
                      
                      
                      <h3 class="card-title py-3" id="total_consumption_units">0</h3>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="card text-center shadow">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"><i class="bi bi-graph-up-arrow h4"></i> Energy Saved (Units)</p>
                      
                      
                      <h3 class="card-title py-3" id="energy_saved_units">0</h3>
                    </div>
                  </div>
                </div>
                <div class="col-6 mt-3">
                  <div class="card text-center shadow">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"><i class="bi bi-currency-rupee h4"></i>Amount Saved(INR)</p>
                     
                      <h3 class="card-title py-3" id="amount_saved">0</h3>
                    </div>
                  </div>
                </div>

                <div class="col-6 mt-3">
                  <div class="card text-center shadow">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"><i class="bi bi-tree-fill h4"></i> Co2 Saved (Kg)</p>
                     
                      <h3 class="card-title py-3" id="co2_saved">224350</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

          <!-- </div>
        </div> -->
        <!-- <div class=" "> -->
          <!-- <div class="row ps-0 ps-lg-2 h-100">
            <div class="col-12 rounded mt-4 mt-lg-2 p-0">
              <div class="card bg-light-subtle shadow">
                <div class="card-header fw-bold">
                  <i class="bi bi-chat-dots-fill"></i> Updates
                </div>
                <div class="card-body">
                  <div id="alerts_list" class="list-group overflow-y-auto" style=" height:300px;">
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        <!-- </div> -->
      </div>
    </div>
  </div>
</div>

<?php
include(BASE_PATH."dashboard/dashboard_modals.php");
?>

</main>
<script src="<?php echo BASE_PATH;?>assets/js/sidebar-menu.js"></script>

<script src="<?php echo BASE_PATH;?>assets/js/project/dashboard.js"></script>

<?php
include(BASE_PATH."assets/html/body-end.php"); 
include(BASE_PATH."assets/html/html-end.php"); 
?>


