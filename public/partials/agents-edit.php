<?php
    $agent = get_user_by('ID', $_GET['agent-id']);
?>
<div class="realty-workstation-pro-agents-all">
    <h3>Edit Agent</h3>
    <hr>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><?php _e( 'Agent Details', 'realty-workstation-pro' ); ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="agent_id" id="agent_id" value="<?php echo $agent->ID; ?>">
                <div class="alert alert-danger"></div>
                <div class="form-group mb-3">
                    <label for="first_name" class="form-label"><?php _e( 'First Name', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required value="<?php echo $agent->first_name; ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="last_name" class="form-label"><?php _e( 'Last Name', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required value="<?php echo $agent->last_name; ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label"><?php _e( 'Email Address', 'realty-workstation-pro' ); ?></label>
                    <input type="email" name="email" id="email" class="form-control" required value="<?php echo $agent->user_email; ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label"><?php _e( 'Password', 'realty-workstation-pro' ); ?></label>
                    <input type="password" name="password" id="password" class="form-control" required value="">
                </div>
                <div class="form-group mb-3">
                    <label for="commission" class="form-label"><?php _e( 'Commission (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="commission" id="commission" class="form-control" required value="<?php echo get_user_meta( $agent->ID, 'commission', true ); ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="lease" class="form-label"><?php _e( 'Broker Referral Payout for Lease (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="lease" id="lease" class="form-control" required value="<?php echo get_user_meta( $agent->ID, 'lease', true ); ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="sale_and_purchase" class="form-label"><?php _e( 'Broker Referral Payout for Sale and Purchase (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="sale_and_purchase" id="sale_and_purchase" class="form-control" required value="<?php echo get_user_meta( $agent->ID, 'sale_and_purchase', true ); ?>">
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-success w-25 edit-agent-btn">Update Agent</button>
                </div>
            </form>
        </div>
    </div>
</div>