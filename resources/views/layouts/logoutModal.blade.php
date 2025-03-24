<!-- Logout Confirmation Modal -->
<div class="modal fade" id="confirmLogout" tabindex="-1" aria-labelledby="confirmLogoutLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="confirmLogoutLabel">Are you sure?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>You will be logged out of your account.</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger border-0">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
