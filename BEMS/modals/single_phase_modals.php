<!-- <div class="modal fade" id="singlePlaseModal" tabindex="-1" aria-labelledby="singlePlaseModals"
    aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="singlePlaseModals">Single Phase Modals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="singlePlaseModals_body">

            <div class="col-12 rounded mt-2 p-0 mb-2">
                        <div class="row">
                            <div class="col-12 col-md-4  mb-md-0 mb-2">
                                <div class="card text-center shadow pointer bg-danger" onclick="PhaseModal('RphaseModal')">
                                        <div class="card-body m-0 p-0">
                                            <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> R PHASE</p>
                                            <p class="card-title py-2 text-white">Connected Devices: <span id="rConnectedDevicesCount"></span></p>
                                            <div class="d-flex flex-column flex-md-row justify-content-center">
                                                <p class="text-white">Consuming Load: <span id="rphaseconsumingload">0</span></p>
                                                <p class="text-white">Installed Load: <span id="rphaseinstalledload">0</span></p>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4  mb-md-0 mb-2">
                                <div class="card text-center shadow pointer bg-warning bg-opacity-80" onclick="PhaseModal('YphaseModal')">
                                        <div class="card-body m-0 p-0">
                                            <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> Y PHASE</p>
                                            <p class="card-title py-2 text-white">Connected Devices: <span id="yConnectedDevicesCount"></span></p>
                                            <div class="d-flex flex-column flex-md-row justify-content-center">
                                                <p class="text-white">Consuming Load: <span id="yphaseconsumingload">0</span></p>
                                                <p class="text-white">Installed Load: <span id="yphaseinstalledload">0</span></p>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="card text-center shadow pointer bg-primary" onclick="PhaseModal('BphaseModal')">
                                        <div class="card-body m-0 p-0">
                                            <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> B PHASE</p>
                                            <p class="card-title py-2 text-white">Connected Devices: <span id="bConnectedDevicesCount"></span></p>
                                            <div class="d-flex flex-column flex-md-row justify-content-center">
                                                <p class="text-white">Consuming Load: <span id="bphaseconsumingload">0</span></p>
                                                <p class="text-white">Installed Load: <span id="bphaseinstalledload">0</span></p>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->

<!-- Placeholder for dynamically created modal -->
 <div id="dynamicModalContainer"></div>
