 <!-- Confirm Delete Modal (OUTSIDE THE LOOP) -->
 <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="confirmDeleteLabel">Are you sure?</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <h6>All products for this category will be deleted!</h6>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                 <form id="deleteForm" action="" method="POST" style="display: inline;">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger border-0">
                         Yes
                     </button>
                 </form>
             </div>
         </div>
     </div>
 </div>


 <!-- Category Details Modal -->
 <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="viewModalLabel">Category Details</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <!-- Priority Information (First Column) -->
                     <div class="col-md-6">
                         <p><strong>ID:</strong> <span id="modal-id"></span></p>
                         <p><strong>Code:</strong> APC-<span id="modal-code"></span></p>
                         <p><strong>Status:</strong> <span id="modal-status"></span></p>
                     </div>
                     <!-- Other Information (Second Column) -->
                     <div class="col-md-6">
                         <p><strong>Name:</strong> <span id="modal-name"></span></p>
                         <p><strong>Slug:</strong> <span id="modal-slug"></span></p>
                         <p><strong>Note:</strong> <span id="modal-note"></span></p>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
