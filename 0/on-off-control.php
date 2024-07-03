<?php
require_once 'config-path.php';
require_once '../session/session-manager.php';
SessionManager::checkSession();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>

  <title>On-Off Control</title>  
  <?php
  include(BASE_PATH."assets/html/start-page.php");
  ?>
  <div class="d-flex flex-column flex-shrink-0 p-3 main-content ">
    <div class="container-fluid">

      <div class="row d-flex align-items-center">
        <div class="col-12 p-0">
          <p class="m-0 p-0"><span class="text-body-tertiary">Pages / </span><span>On-Off Control</span></p>
        </div>
      </div>
      <?php
       // include("dropdown-selection/device-list.php");
      include(BASE_PATH."dropdown-selection/group-device-list.php");
      ?>
      <div class="row">
        <div class="col-lg-6 p-0 m-0 pe-lg-2">
          <div class=" mt-2 h-100">
            <div class="card shadow ">
              <div class="card-body">
                <h3 class="card-title text-center">ON/OFF</h3>
                <p class="text-left">Door status will be updated</p>
                <div class="d-flex justify-content-center my-3">
                  <div class="input-group">
                    <input type="number" class="form-control" placeholder="Hrs" aria-label="Hours" min="0" max="23">
                    <span class="input-group-text">:</span>
                    <input type="number" class="form-control" placeholder="Mins" aria-label="Minutes" min="0" max="59">
                  </div>
                </div>
                <div class="d-flex justify-content-around my-4">
                  <div class="col-5 d-flex justify-content-center">
                    <button type="button" class="btn btn-success btn-lg w-100 py-3 fs-2 fw-bold">ON</button>
                  </div>
                  <div class="col-5 d-flex justify-content-center">
                    <button type="button" class="btn btn-danger btn-lg w-100 py-3 fs-2 fw-bold">OFF</button>
                  </div>
                </div>
                <h5 class="text-center my-3">ON-OFF Oprational Modes</h5>
                <div class="d-flex justify-content-center ">
                  <div class="btn-group overflow-x-auto" role="group ">
                    <button type="button" class="btn btn-outline-primary" onclick="openScheduleModal()">Schedule Time</button>
                    <button type="button" class="btn btn-outline-primary">Astronomical Time</button>
                    <button type="button" class="btn btn-outline-primary">Ambient/LDR</button>
                    <button type="button" class="btn btn-outline-primary">Ambient & Astronomical</button>
                  </div>
                </div>
                <p class="text-left text-muted mt-4">
                  <small>Note: The device follows any one of the above modes to turn on/off the lights. Not all modes operate simultaneously.</small>
                </p>
                <div class="d-flex justify-content-end mt-3">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#multiple">Multiple Device Selection</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 p-0 m-0 ps-lg-2 ">

          <div class=" mt-2 h-100">
            <div class="card shadow ">
              <div class="card-header">
                <i class="bi bi-toggles2"></i> Activity
              </div>
              <div class="card-body pt-0 pe-0">
                <div class="list-group overflow-y-auto" style=" height:400px; ">
                  <div class="w-100 p-0">
                   <table class="table table-hover text-center">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Device ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Operation Mode</th>
                        <th scope="col">Current Status</th>
                        <th scope="col">Date-Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Device A</td>
                        <td>Auto</td>
                        <td>Off</td>
                        <td>2024-06-06 10:00:00</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Device B</td>
                        <td>Manual</td>
                        <td>On</td>
                        <td>2024-06-06 11:00:00</td>
                      </tr> <tr>
                        <td>1</td>
                        <td>Device A</td>
                        <td>Auto</td>
                        <td>Off</td>
                        <td>2024-06-06 10:00:00</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Device B</td>
                        <td>Manual</td>
                        <td>On</td>
                        <td>2024-06-06 11:00:00</td>
                      </tr> <tr>
                        <td>1</td>
                        <td>Device A</td>
                        <td>Auto</td>
                        <td>Off</td>
                        <td>2024-06-06 10:00:00</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Device B</td>
                        <td>Manual</td>
                        <td>On</td>
                        <td>2024-06-06 11:00:00</td>
                      </tr> <tr>
                        <td>1</td>
                        <td>Device A</td>
                        <td>Auto</td>
                        <td>Off</td>
                        <td>2024-06-06 10:00:00</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Device B</td>
                        <td>Manual</td>
                        <td>On</td>
                        <td>2024-06-06 11:00:00</td>
                      </tr> <tr>
                        <td>1</td>
                        <td>Device A</td>
                        <td>Auto</td>
                        <td>Off</td>
                        <td>2024-06-06 10:00:00</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Device B</td>
                        <td>Manual</td>
                        <td>On</td>
                        <td>2024-06-06 11:00:00</td>
                      </tr> <tr>
                        <td>1</td>
                        <td>Device A</td>
                        <td>Auto</td>
                        <td>Off</td>
                        <td>2024-06-06 10:00:00</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Device B</td>
                        <td>Manual</td>
                        <td>On</td>
                        <td>2024-06-06 11:00:00</td>
                      </tr> <tr>
                        <td>1</td>
                        <td>Device A</td>
                        <td>Auto</td>
                        <td>Off</td>
                        <td>2024-06-06 10:00:00</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Device B</td>
                        <td>Manual</td>
                        <td>On</td>
                        <td>2024-06-06 11:00:00</td>
                      </tr> <tr>
                        <td>1</td>
                        <td>Device A</td>
                        <td>Auto</td>
                        <td>Off</td>
                        <td>2024-06-06 10:00:00</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Device B</td>
                        <td>Manual</td>
                        <td>On</td>
                        <td>2024-06-06 11:00:00</td>
                      </tr>
                      <!-- Add more rows as needed -->
                    </tbody>
                  </table>
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
</main>
<!-- Modal -->
 <?php
include("../on_off_control/multiple_device_selection.php");
?>
<script src="<?php echo BASE_PATH;?>js_modal_scripts/schedule_time_modal_script.js"></script>
<script src="<?php echo BASE_PATH;?>js_modal_scripts/multiple_device_selection.js"></script>
<?php


include(BASE_PATH."dashboard/modals/schedule_time_modal.php"); 
?>
<script src="<?php echo BASE_PATH;?>assets/js/sidebar-menu.js"></script>
<?php
include(BASE_PATH."assets/html/body-end.php"); 
include(BASE_PATH."assets/html/html-end.php"); 
?>

