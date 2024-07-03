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
                <p class="m-0 p-0"><span class="text-body-tertiary">Pages / </span><span>Alert Settings</span></p>
            </div>
        </div>
        <?php
        include(BASE_PATH."dropdown-selection/group-device-list.php");
        ?>
        <div class="row mt-4">
            <div class="col-12 p-0">             
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#multiple">Multiple Device Selection</button>
                        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#telegram_modal">Update Telegram Group</button>
                    </div>   
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-4 p-0 pe-lg-2">
                <div class="card ">
                    <div class="card-header bg-primary bg-opacity-25  bg-opacity-25 fw-bold">
                        Voltage
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Enable/Disable</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="setting1">
                                <label class="form-check-label" for="setting1"></label>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Telegram Updates</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="telegramUpdates">
                                <label class="form-check-label" for="telegramUpdates"></label>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <form class="col-12 " id="frame_update_time">
                                <div class="mb-2 ms-2">
                                    <label for="frame_update_time" class="form-label">Interval Times(Hrs):</label>
                                    <?php
                                    include("../dropdown-selection/notification_interval_time.php")
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>            
                    <div class="card-footer text-end">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div> 
            </div>
            <div class="col-lg-4 p-0 px-lg-2 mt-2 mt-lg-0">
                <div class="card">
                    <div class="card-header bg-primary bg-opacity-25  fw-bold">
                        Overload
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Enable/Disable</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="setting1">
                                <label class="form-check-label" for="setting1"></label>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Telegram Updates</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="telegramUpdates">
                                <label class="form-check-label" for="telegramUpdates"></label>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <form class="col-12 " id="frame_update_time">
                                <div class="mb-2 ms-2">
                                    <label for="frame_update_time" class="form-label">Interval Times(Hrs):</label>
                                    <?php
                                    include("../dropdown-selection/notification_interval_time.php")
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>            
                    <div class="card-footer text-end">
                        <button class="btn btn-primary">update</button>
                    </div>
                </div> 
            </div>
            <div class="col-lg-4 p-0 ps-lg-2 mt-2 mt-lg-0">

                <div class="card">
                    <div class="card-header bg-primary bg-opacity-25  fw-bold">
                     SMPS
                 </div>
                 <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Enable/Disable</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="setting1">
                            <label class="form-check-label" for="setting1"></label>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Telegram Updates</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="telegramUpdates">
                            <label class="form-check-label" for="telegramUpdates"></label>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <form class="col-12 " id="frame_update_time">
                            <div class="mb-2 ms-2">
                                <label for="frame_update_time" class="form-label">Interval Times(Hrs):</label>
                                <?php
                                include("../dropdown-selection/notification_interval_time.php")
                                ?>
                            </div>
                        </form>
                    </div>
                </div>            
                <div class="card-footer text-end">
                    <button class="btn btn-primary">update</button>
                </div>
            </div> 
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-4 p-0 pe-lg-2">

            <div class="card ">
                <div class="card-header bg-primary bg-opacity-25  fw-bold">
                    On/Off
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Enable/Disable</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="setting1">
                            <label class="form-check-label" for="setting1"></label>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Telegram Updates</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="telegramUpdates">
                            <label class="form-check-label" for="telegramUpdates"></label>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <form class="col-12 " id="frame_update_time">
                            <div class="mb-2 ms-2">
                                <label for="frame_update_time" class="form-label">Interval Times(Hrs):</label>
                                <?php
                                include("../dropdown-selection/notification_interval_time.php")
                                ?>
                            </div>
                        </form>
                    </div>
                </div>            
                <div class="card-footer text-end">
                    <button class="btn btn-primary">Update</button>
                </div>
            </div> 
        </div>
        <div class="col-lg-4 p-0 mt-2 mt-lg-0 px-lg-2" >

            <div class="card">
                <div class="card-header bg-primary bg-opacity-25  fw-bold">
                    MCB Tripping
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Enable/Disable</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="setting1">
                            <label class="form-check-label" for="setting1"></label>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Telegram Updates</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="telegramUpdates">
                            <label class="form-check-label" for="telegramUpdates"></label>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <form class="col-12 " id="frame_update_time">
                            <div class="mb-2 ms-2">
                                <label for="frame_update_time" class="form-label">Interval Times(Hrs):</label>
                                <?php
                                include("../dropdown-selection/notification_interval_time.php")
                                ?>
                            </div>
                        </form>
                    </div>
                </div> 
                <div class="card-footer text-end">
                    <button class="btn btn-primary">update</button>
                </div>
            </div> 
        </div> 
    </div>
</div>
</div>
</div>
</div>

<?php
include("../notificationsettings/telegramupdate_modal.php");
include("../on_off_control/multiple_device_selection.php");
?>

<script src="<?php echo BASE_PATH;?>js_modal_scripts/multiple_device_selection.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/sidebar-menu.js"></script>
<script src="<?php echo BASE_PATH;?>js_modal_scripts/notificationsettings/telegram_update_modal.js"></script>
<?php
include(BASE_PATH."assets/html/body-end.php"); 
include(BASE_PATH."assets/html/html-end.php"); 
?>

