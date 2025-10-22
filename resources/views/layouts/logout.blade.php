<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="border-0 rounded-lg shadow-lg modal-content">

            <div class="text-white border-0 modal-header" style="background: #1E3A8A;">
                <h5 class="modal-title" id="logoutModalLabel">
                    <i class="mr-2 fas fa-exclamation-triangle"></i> Logout Confirmation
                </h5>
                <button type="button" class="text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="py-4 text-center modal-body">
                <p class="mb-3">You are about to log out from your account. <br>Are you sure you want to continue?</p>
                <i class="mb-2 fas fa-sign-out-alt fa-3x text-primary"></i>
            </div>

            <div class="border-0 modal-footer justify-content-center">
                <button class="px-4 btn btn-outline-secondary rounded-pill" type="button" data-dismiss="modal">
                    <i class="mr-1 fas fa-times"></i> Cancel
                </button>

                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="px-4 btn rounded-pill logout-btn">
                        <i class="mr-1 fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .logout-btn {
        background: linear-gradient(135deg, #1D4ED8, #3B82F6);
        color: #fff;
        border: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, color 0.2s ease;
    }

    .logout-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        color: #fff;

    }
</style>
