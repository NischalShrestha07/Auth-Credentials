<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <h6>This item will be deleted permanently!</h6>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <!-- Delete Form -->
                <form id="delete-form" action="" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- View Details Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Item Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="d-flex">
                    <!-- Product Image (50% width) -->
                    <div class="flex-shrink-0" style="width: 50%;">
                        <img id="modal-image" src="" alt="Product Image" class="img-fluid" style="width: 100%; height: auto;">
                    </div>

                    <!-- Product Details (50% width) -->
                    <div class="ms-3" style="width: 50%;">
                        <table class="table">
                            <tbody>
                                <!-- Row 1: ID and Item Name -->
                                <tr>
                                    <td><strong>ID:</strong> <span id="modal-id"></span></td>
                                    <td><strong>Item Name:</strong> <span id="modal-item-name"></span></td>
                                </tr>
                                <!-- Row 2: Slug and Item Code -->
                                <tr>
                                    <td><strong>Slug:</strong> <span id="modal-slug"></span></td>
                                    <td><strong>Item Code:</strong> AP-<span id="modal-item-code"></span></td>
                                </tr>
                                <!-- Row 3: Item Model and Brand -->
                                <tr>
                                    <td><strong>Item Model:</strong> <span id="modal-item-model"></span></td>
                                    <td><strong>Brand:</strong> <span id="modal-brand"></span></td>
                                </tr>
                                <!-- Row 4: Unit and Sub Category -->
                                <tr>
                                    <td><strong>Unit:</strong> <span id="modal-unit"></span></td>
                                    <td><strong>Sub Category:</strong> <span id="modal-sub-category"></span></td>
                                </tr>
                                <!-- Row 5: Tax and Tax Type -->
                                <tr>
                                    <td><strong>Tax:</strong> <span id="modal-tax"></span></td>
                                    <td><strong>Tax Type:</strong> <span id="modal-tax-type"></span></td>
                                </tr>
                                <!-- Row 6: Status and Regular Price -->
                                <tr>
                                    <td><strong>Status:</strong> <span id="modal-status"></span></td>
                                    <td><strong>Regular Price:</strong> <span id="modal-regular-price"></span></td>
                                </tr>
                                <!-- Row 7: Discount and Selling Price -->
                                <tr>
                                    <td><strong>Discount:</strong> <span id="modal-discount"></span></td>
                                    <td><strong>Selling Price:</strong> <span id="modal-selling-price"></span></td>
                                </tr>
                                <!-- Row 8: Note -->
                                <tr>
                                    <td colspan="2"><strong>Note:</strong> <span id="modal-note"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

