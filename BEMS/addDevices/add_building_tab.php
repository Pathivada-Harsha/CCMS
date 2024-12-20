<div class="tab-pane fade" id="buildingid" role="tabpanel" aria-labelledby="Building">
                            <div class="container mt-2">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-primary bg-opacity-25 fw-bold">
                                                <span class="me-2">New Building / Floor</span>
                                                <a tabindex="0" role="button" data-bs-toggle="popover"
                                                    data-bs-trigger="focus" data-bs-title="Info"
                                                    data-bs-content="Create New Building id for new Building">
                                                    <i class="bi bi-info-circle"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <form class="new_building_details">
                                                    <div class="form-group" id="transformer-selection">
                                                        <label for="transformer-dropdown"
                                                            class="form-label text-primary">
                                                            <strong>Transformer Devices</strong>
                                                        </label>
                                                        <select class="form-select" id="transformer-dropdown-tab1">
                                                            <option value="">Select from dropdown</option>
                                                            <!-- <option value="tranformer-1">tranformer1</option>
                                                            <option value="tranformer-2">tranformer2</option>
                                                            <option value="tranformer-3">tranformer3</option> -->
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="new-building-id" class="form-label text-primary">
                                                            Enter New Building Id
                                                        </label>
                                                        <input type="text" class="form-control" id="new-building-id"
                                                            placeholder="Enter New Id">
                                                    </div>


                                                    <!-- Scrollable Floor Details Section -->
                                                    <div id="floorFields"
                                                        style="overflow-y: auto; overflow-x: hidden; max-height: 200px;   ">
                                                        <div class="row">
                                                            <div class="form-group  mt-2">
                                                                <label for="floorid"
                                                                    class="form-label text-primary "><strong>Floor
                                                                        Name/ID</strong></label>
                                                                <div class="d-flex align-items-center text-center ">
                                                                    <input type="text" class="form-control"
                                                                        name="floorid[]"
                                                                        placeholder="Enter Floor Number or ID...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Add more floors button -->
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button type="button" class="btn btn-secondary"
                                                            id="addfloors">Add
                                                            Another
                                                            Floor</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-footer d-flex justify-content-between align-items-center">
                                                <div class="w-100 text-center">
                                                    <button type="submit" class="btn btn-primary mb-2">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                    <!-- Next and Previous buttons -->
                                    <div class="d-flex justify-content-between mt-3">
                                        <button class="btn btn-secondary prev-tab"
                                            data-prev="#Transformer-device">Previous</button>
                                        <button class="btn btn-primary next-tab" data-next="#floor-device">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>