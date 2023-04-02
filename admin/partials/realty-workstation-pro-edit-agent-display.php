<div class="wrap realty-workstation-pro-settings-div">
    <div class="rw-card">
        <div class="rw-card-header">
            <h2 class="wp-heading-inline"><?php _e( 'Update Agent', 'realty-workstation-pro' ); ?></h2>
        </div>
        <div class="rw-card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="agent_id" id="agent_id" value="<?php echo $agent->ID; ?>">
                <div class="alert alert-danger"></div>
                <div class="form-group">
                    <label for="first_name"><?php _e( 'First Name', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="first_name" id="first_name" required value="<?php echo $agent->first_name; ?>">
                </div>
                <div class="form-group">
                    <label for="last_name"><?php _e( 'Last Name', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="last_name" id="last_name" required value="<?php echo $agent->last_name; ?>">
                </div>
                <div class="form-group">
                    <label for="email"><?php _e( 'Email Address', 'realty-workstation-pro' ); ?></label>
                    <input type="email" name="email" id="email" required value="<?php echo $agent->user_email; ?>">
                </div>
                <div class="form-group">
                    <label for="password"><?php _e( 'Password', 'realty-workstation-pro' ); ?></label>
                    <input type="password" name="password" id="password" required value="">
                </div>
                <div class="form-group">
                    <label for="commission"><?php _e( 'Commission (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="commission" id="commission" required value="<?php echo get_user_meta( $agent->ID, 'commission', true ); ?>">
                </div>
                <div class="form-group">
                    <label for="lease"><?php _e( 'Broker Referral Payout for Lease (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="lease" id="lease" required value="<?php echo get_user_meta( $agent->ID, 'lease', true ); ?>">
                </div>
                <div class="form-group">
                    <label for="sale_and_purchase"><?php _e( 'Broker Referral Payout for Sale and Purchase (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="sale_and_purchase" id="sale_and_purchase" required value="<?php echo get_user_meta( $agent->ID, 'sale_and_purchase', true ); ?>">
                </div>
                <div class="button-group">
                    <button type="button" class="rw-button edit-agent-btn">Update Agent</button>
                </div>
            </form>
        </div>
    </div>
</div>