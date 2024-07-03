
<!-- this is my index file -->

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
      <div class="row">
        <div class="col-lg-8">
          <div class="row pe-0 pe-lg-2 h-100">
            <div class="col-12 rounded mt-2 p-0 ">
              <div class="row">
                <div class="col-4 pointer pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#TotalModal">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"><i class="bi bi-bar-chart-fill h4"></i> Total</p>
                      <h3 class="card-title py-2">220</h3>
                    </div>
                  </div>
                </div>

                <div class="col-4 pointer pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#installedModal">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"><i class="bi bi-check-circle-fill h4"></i> Installed</p>
                      <h3 class="card-title py-2">160</h3>
                    </div>
                  </div>
                </div>
                <div class="col-4 pointer pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#notinstalledModal">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"><i class="bi bi-x-circle-fill h4"></i> Not-installed</p>
                      <h3 class="card-title py-2">60</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 rounded mt-3 p-0">
              <div class="row">
                <div class="col-xl-3 col-6 pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#activeModal">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1 text-success"><i class="bi bi-lightbulb-fill h4"></i> Active</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2 text-success">220</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-6 pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#activePoorNetworkModal">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1 text-danger-emphasis text-opacity-25"><i class="bi bi-exclamation-triangle-fill h4"></i> Poor N/W</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2 text-danger-emphasis text-opacity-25">160</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-6 pointer mt-3 mt-xl-0" >
                  <div class="card text-center shadow"data-bs-toggle="modal" data-bs-target="#powerfailureModal">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1 text-body-tertiary"><i class="bi bi-power h4"></i> Input Power Fail</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2 text-body-tertiary">60</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-6 pointer mt-3 mt-xl-0">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#faultModal">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1 text-danger"><i class="bi bi-bug-fill h4"></i> Faulty</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2 text-danger">60</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 rounded mt-3 p-0">
              <div class="row">
                <div class="col-4 pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#AutoOnModal">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"> <i class="bi bi-clock-fill h4"></i> Auto/System On</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2">100</h3>
                    </div>
                  </div>
                </div>
                <div class="col-4 pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#manualOnModal">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1">  <i class="bi bi-hand-index-fill h4"></i> Manual On</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2">30</h3>
                    </div>
                  </div>
                </div>
                <div class="col-4 pointer">
                  <div class="card text-center shadow" data-bs-toggle="modal" data-bs-target="#offModal">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"> <i class="bi bi-toggle-off h4"></i> OFF</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2">30</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 rounded mt-3 p-0 ">
              <div class="row">
                <div class="col-xl-6 ">
                  <div class="card h-100 shadow-sm text-left p-2">
                    <p class="d-flex align-items-center"> <i class="bi bi-lamp-fill h4"></i> Installed Lights: <span><span class="h3 ms-4 text-primary-emphasis"> 2562</span> </span>
                    </p>
                    <div class="progress">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">60%-ON</div>
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">40%-OFF</div>

                    </div>

                  </div>
                </div>
                <div class="col-xl-6 mt-lg-0 mt-3">
                  <div class="card h-100 shadow-sm text-left p-2">
                    <p class="d-flex align-items-center"><i class="bi bi-plug h4"></i> Cumulative Load (watts)</p>
                    <div class="progress" role="progressbar" aria-label="Primary example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar bg-primary" style="width: 100%">Intalled load- 187805</div>
                    </div>

                    <div class="progress mt-2" role="progressbar" aria-label="Animated striped example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar progress-bar-striped bg-info progress-bar-animated overflow-visible text-light-emphasis" style="width: 5%">Active - 5872</div>
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
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2">224353460</h3>
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="card text-center shadow">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"><i class="bi bi-graph-up-arrow h4"></i> Energy Saved (Units)</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2">224353460</h3>
                    </div>
                  </div>
                </div>
                <div class="col-6 mt-3">
                  <div class="card text-center shadow">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"><i class="bi bi-currency-rupee h4"></i>Amount Saved(INR)</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2">224353460</h3>
                    </div>
                  </div>
                </div>

                <div class="col-6 mt-3">
                  <div class="card text-center shadow">
                    <div class="card-body m-0 p-0">
                      <p class="card-text fw-semibold m-0 py-1"><i class="bi bi-tree-fill h4"></i> Co2 Saved (Kg)</p>
                      <!-- <hr class="mt-0"> -->
                      <h3 class="card-title py-2">224350</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="col-lg-4 ">
          <div class="row ps-0 ps-lg-2 h-100">
            <div class="col-12 rounded mt-4 mt-lg-2 p-0">
              <div class="card bg-light-subtle shadow">
                <div class="card-header">
                  <i class="bi bi-chat-dots-fill"></i> Messages
                </div>
                <div class="card-body">
                  <div class="list-group overflow-y-auto" style=" height:600px;">
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">BMC_CCMS_1(P(1) BAIRAGARH)</small>
                        <small class="text-body-secondary">06:49:39 29-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:BMC_CCMS_1(P(1) BAIRAGARH) Power Resumed TIME:06:48:39 29-04-2024 GPS: http://maps.google.com/?q=23.2791383,77.3370483.</small>

                    </a>
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">CCMS_13</small>
                        <small class="text-body-secondary">05:51:20 30-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:CCMS_13 MCB/Contactor Turned ON in R, Y & B TIME:00:00:53 30/04/2024.</small>

                    </a>
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">BMC_CCMS_1(P(1)</small>
                        <small class="text-body-secondary">05:47:59 29-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:BMC_CCMS_1(P(1) BAIRAGARH) Switched ON(MANUAL) Lights GPS: http://maps.google.com/?q=23.2791383,77.3370483.</small>

                    </a>
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">BMC_CCMS_92(P(92)_N2345043400_BAIRAGARH CHICHLI)</small>
                        <small class="text-body-secondary">05:52:52 23-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:BMC_CCMS_92(P(92)_N2345043400_BAIRAGARH CHICHLI) Switched ON(MANUAL) Lights GPS: http://maps.google.com/?q=23.150455,77.4102717</small>

                    </a>
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">BMC_CCMS_1(P(1) BAIRAGARH)</small>
                        <small class="text-body-secondary">06:49:39 29-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:BMC_CCMS_1(P(1) BAIRAGARH) Power Resumed TIME:06:48:39 29-04-2024 GPS: http://maps.google.com/?q=23.2791383,77.3370483.</small>

                    </a>
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">CCMS_13</small>
                        <small class="text-body-secondary">05:51:20 30-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:CCMS_13 MCB/Contactor Turned ON in R, Y & B TIME:00:00:53 30/04/2024.</small>

                    </a>
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">BMC_CCMS_1(P(1))</small>
                        <small class="text-body-secondary">05:47:59 29-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:BMC_CCMS_1(P(1) BAIRAGARH) Switched ON(MANUAL) Lights GPS: http://maps.google.com/?q=23.2791383,77.3370483.</small>

                    </a>
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">BMC_CCMS_92(P(92)_N2345043400_BAIRAGARH CHICHLI)</small>
                        <small class="text-body-secondary">05:52:52 23-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:BMC_CCMS_92(P(92)_N2345043400_BAIRAGARH CHICHLI) Switched ON(MANUAL) Lights GPS: http://maps.google.com/?q=23.150455,77.4102717</small>

                    </a><a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">BMC_CCMS_1(P(1) BAIRAGARH)</small>
                        <small class="text-body-secondary">06:49:39 29-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:BMC_CCMS_1(P(1) BAIRAGARH) Power Resumed TIME:06:48:39 29-04-2024 GPS: http://maps.google.com/?q=23.2791383,77.3370483.</small>

                    </a>
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">CCMS_13</small>
                        <small class="text-body-secondary">05:51:20 30-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:CCMS_13 MCB/Contactor Turned ON in R, Y & B TIME:00:00:53 30/04/2024.</small>

                    </a>
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <small class="mb-1 sub-sup-font-size">BMC_CCMS_1(P(1))</small>
                        <small class="text-body-secondary">05:47:59 29-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:BMC_CCMS_1(P(1) BAIRAGARH) Switched ON(MANUAL) Lights GPS: http://maps.google.com/?q=23.2791383,77.3370483.</small>

                    </a>
                    <a href="#" class="list-group-item list-group-item-action " aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">BMC_CCMS_92(P(92)_N2345043400_BAIRAGARH CHICHLI)</h6>
                        <small class="text-body-secondary">05:52:52 23-04-2024</small>
                      </div>
                      <small class="mb-1 font-small">ID:BMC_CCMS_92(P(92)_N2345043400_BAIRAGARH CHICHLI) Switched ON(MANUAL) Lights GPS: http://maps.google.com/?q=23.150455,77.4102717</small>

                    </a>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include(BASE_PATH."dashboard/dashboard_modals.php");
?>

</main>
<script src="<?php echo BASE_PATH;?>assets/js/sidebar-menu.js"></script>
<script src="<?php echo BASE_PATH;?>js_modal_scripts/dashboard_modals_script.js"></script>
<script src="<?php echo BASE_PATH;?>js_modal_scripts/viewbutton.js"></script>

<?php
include(BASE_PATH."assets/html/body-end.php"); 
include(BASE_PATH."assets/html/html-end.php"); 
?>


