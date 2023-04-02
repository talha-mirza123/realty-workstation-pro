<?php
    $args = array(
        'role' => 'rw_agent',
        'orderby' => 'user_nicename',
        'order' => 'ASC'
    );
    $agents = get_users($args);
?>
<div class="realty-workstation-pro-agents-all">
    <h3>New Agent</h3>
    <hr>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><?php _e( 'Add New Agent', 'realty-workstation-pro' ); ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <div class="alert alert-danger"></div>
                <?php if ( count($agents) > 5 ) { ?>
                    <div class="alert alert-danger" style="display: block;">Please upgrade your plugin to Pro version to add more users.</div>
                <?php } ?>
                <div class="form-group mb-3">
                    <label for="first_name" class="form-label"><?php _e( 'First Name', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required value="">
                </div>
                <div class="form-group mb-3">
                    <label for="last_name" class="form-label"><?php _e( 'Last Name', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required value="">
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label"><?php _e( 'Email Address', 'realty-workstation-pro' ); ?></label>
                    <input type="email" name="email" id="email" class="form-control" required value="">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label"><?php _e( 'Password', 'realty-workstation-pro' ); ?></label>
                    <input type="password" name="password" id="password" class="form-control" required value="">
                </div>
                <div class="form-group mb-3">
                    <label for="commission" class="form-label"><?php _e( 'Commission (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="commission" id="commission" class="form-control" required value="">
                </div>
                <div class="form-group mb-3">
                    <label for="lease" class="form-label"><?php _e( 'Broker Referral Payout for Lease (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="lease" id="lease" class="form-control" required value="">
                </div>
                <div class="form-group mb-3">
                    <label for="sale_and_purchase" class="form-label"><?php _e( 'Broker Referral Payout for Sale and Purchase (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="sale_and_purchase" id="sale_and_purchase" class="form-control" required value="">
                </div>
                <div class="button-group">
                    <?php if ( count($agents) > 5 ) { ?>
                        <a href="https://www.realtyworkstation.com/" class="btn btn-success w-25">Buy Pro Version</a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-success w-25 add-new-agent-btn">Create New Agent</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>