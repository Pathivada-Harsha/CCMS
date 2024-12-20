<!-- Modal For singlePhases --> 
<div class="modal fade" id="singlePhaseModalView" tabindex="-1" aria-labelledby="singlePhaseModalViewLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="singlePhaseModalViewLabel">Single Phase View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="col-12 rounded mt-2 p-0 mb-2">
                        <div class="row">
                            <div class="col-12 col-md-4  mb-md-0 mb-2">
                                <div class="card text-center shadow pointer bg-danger" onclick="PhaseModal(1)">
                                    <div class="card-body m-0 p-0">
                                        <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> R PHASE</p>
                                        <!-- <p class="text-white" >Consuming Load <span id="rConsuming"></span>W</p>
                                        <p class="text-white" >Installed  Load <span id="rInstalled"></span>W</p>
                                        <p class="text-white" >Connected Devices <span id="rConnected"></span></p> -->
                                        <p class="text-white" >Consuming Load <span>245</span>W</p>
                                        <p class="text-white" >Installed  Load <span>233</span>W</p>
                                        <p class="text-white" >Connected Devices <span>5</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4  mb-md-0 mb-2">
                                <div class="card text-center shadow pointer bg-warning bg-opacity-80" onclick="PhaseModal(2)">
                                    <div class="card-body m-0 p-0">
                                        <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill"></i> Y PHASE</p>
                                        <!-- <p class="text-white" >Consuming Load <span id="yConsuming"></span>W</p>
                                        <p class="text-white" >Installed  Load <span id="yInstalled"></span>W</p>
                                        <p class="text-white" >Connected Devices <span id="yConnected"></span></p> -->
                                        <p class="text-white" >Consuming Load <span>261</span>W</p>
                                        <p class="text-white" >Installed  Load <span>198</span>W</p>
                                        <p class="text-white" >Connected Devices <span>5</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 ">
                                <div class="card text-center shadow pointer bg-primary" onclick="PhaseModal(3)">
                                    <div class="card-body m-0 p-0 ">
                                        <p class="card-text fw-bold text-white m-0 py-1"><i class="bi bi-lightning-charge-fill "></i> B PHASE</p>
                                        <!-- <p class="text-white" >Consuming Load <span id="bConsuming"></span>W</p>
                                        <p class="text-white" >Installed  Load <span id="bInstalled"></span>W</p>
                                        <p class="text-white" >Connected Devices <span id="bConnected"></span></p> -->
                                        <p class="text-white" >Consuming Load <span>264</span>W</p>
                                        <p class="text-white" >Installed  Load <span>253</span>W</p>
                                        <p class="text-white" >Connected Devices <span>5</span></p>
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
</div>