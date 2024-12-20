<!-- smart power hub Modal --> 
<div class="modal fade" id="smartPowerHub" tabindex="-1" aria-labelledby="smartPowerHubLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smartPowerHubLabel">Smart Power Hub</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-end mb-2">
                    <button type="button" class="btn btn-primary" onclick="fetchDeviceDetails();">
                        Add Device
                    </button>
                </div>
                <table class="table table-striped text-center border">
                    <thead>
                        <tr>
                            <th>Device</th>
                            <th>Quantity</th>
                            <th>Capacity(W)</th>
                            <th>Consuming Load</th>
                            <th>Installed Load</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="smartPowerHub_Table_Data">
                        <!-- Data will be loaded here dynamically -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Consuming Load(W)</th>
                            <th id="totalConsumingLoad">0</th>
                            <th colspan="2">Total Installed Load (W)</th>
                            <th id="totalInstalledLoad">0</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>