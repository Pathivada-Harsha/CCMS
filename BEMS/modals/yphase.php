<!-- Y Phase Modal -->
<!-- <div class="modal fade" id="yPhaseModal" tabindex="-1" aria-labelledby="yPhaseModalLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="yPhaseModalLabel">Y Phase Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped text-center border">
                    <thead>
                        <tr>
                            <th>Master Device</th>
                            <th>Consuming Load(W)</th>
                            <th>Installed Load(W)</th>
                            <th>Smart Power Hub</th>
                            <th>Current(A)</th>
                            <th>Voltage(V)</th>
                            <th>kW</th>
                            <th>kVA</th>
                            <th>kWh</th>
                            <th>kVAh</th>
                            <th>Power Factor(PF)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Device 1</td>
                        <td>150</td>
                        <td>200</td>
                        <td onclick="smartPowerHub('rphase')"><button class="btn bg-info">3</button></td>
                        <td>10</td>
                        <td>230</td>
                        <td>1.5</td>
                        <td>1.6</td>
                        <td>120</td>
                        <td>130</td>
                        <td>0.95</td>
                        <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
                    </tr>
                    <tr>
                        <td>Device 2</td>
                        <td>180</td>
                        <td>220</td>
                        <td onclick="smartPowerHub('rphase')"><button class="btn bg-info">3</button></td>
                        <td>12</td>
                        <td>240</td>
                        <td>1.8</td>
                        <td>1.9</td>
                        <td>150</td>
                        <td>160</td>
                        <td>0.92</td>
                        <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
                    </tr>
                    <tr>
                        <td>Device 3</td>
                        <td>200</td>
                        <td>250</td>
                        <td onclick="smartPowerHub('rphase')"><button class="btn bg-info">3</button></td>
                        <td>15</td>
                        <td>220</td>
                        <td>2.0</td>
                        <td>2.2</td>
                        <td>180</td>
                        <td>190</td>
                        <td>0.90</td>
                        <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
                    </tr>
                    <tr>
                        <td>Device 4</td>
                        <td>120</td>
                        <td>180</td>
                        <td onclick="smartPowerHub('rphase')"><button class="btn bg-info">3</button></td>
                        <td>8</td>
                        <td>230</td>
                        <td>1.2</td>
                        <td>1.4</td>
                        <td>100</td>
                        <td>110</td>
                        <td>0.97</td>
                        <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
                    </tr>
                    <tr>
                        <td>Device 5</td>
                        <td>250</td>
                        <td>300</td>
                        <td onclick="smartPowerHub('rphase')"><button class="btn bg-info">3</button></td>
                        <td>18</td>
                        <td>250</td>
                        <td>2.5</td>
                        <td>2.7</td>
                        <td>210</td>
                        <td>220</td>
                        <td>0.93</td>
                        <td><button type="button" class="btn text-danger"><i class="bi bi-trash-fill"></i></button></td>
                    </tr>
                    <tfoot>
                        <th></th>
                        <th colspan="4">Total Consuming Load(W)</th>
                        <th>900</th>
                        <th colspan="4">Total Installed Load(W)</th>
                        <th>862</th>
                        <th></th>
                    </tfoot>
                    
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end ">
                    <button type="button" class="btn btn-primary" onclick="">
                        Add Device
                    </button>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->
<!-- <div class="modal fade" id="yPhaseModal" tabindex="-1" aria-labelledby="yPhaseModalLabel" aria-hidden="true" style="background-color:rgba(0,0,0,0.8)">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="yPhaseModalLabel">Y Phase Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped text-center border">
                    <thead>
                        <tr>
                            <th>Master Device</th>
                            <th>Consuming Load(W)</th>
                            <th>Installed Load(W)</th>
                            <th>Smart Power Hub</th>
                            <th>Current(A)</th>
                            <th>Voltage(V)</th>
                            <th>kW</th>
                            <th>kVA</th>
                            <th>kWh</th>
                            <th>kVAh</th>
                            <th>Power Factor(PF)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="Yphase_Modal_Body">
                    
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end ">
                    <button type="button" class="btn btn-primary" onclick="">
                        Add Device
                    </button>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->
<div id="yPhaseModal" ></div>