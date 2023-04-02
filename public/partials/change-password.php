<div class="realty-workstation-pro-agents-all">
    <h3>Change Password</h3>
    <?php if (isset($_GET['success']) && !empty($_GET['success']) && $_GET['success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Password has been updated in the system successfully.</div>
    <?php } ?>
    <hr>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><?php _e( 'Change Password', 'realty-workstation-pro' ); ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <div class="alert alert-danger"></div>
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="password" class="form-label"><?php _e( 'Password', 'realty-workstation-pro' ); ?></label>
                            <input type="password" name="password" id="password" class="form-control" required value="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="confirm_password" class="form-label"><?php _e( 'Confirm Password', 'realty-workstation-pro' ); ?></label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required value="">
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-success w-25 change-password-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>