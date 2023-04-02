<?php
    $args = array(
        'role' => 'rw_agent',
        'orderby' => 'user_nicename',
        'order' => 'ASC'
    );
    $agents = get_users($args);
?>
<div class="wrap realty-workstation-pro-settings-div">
    <div class="rw-card">
        <div class="rw-card-header">
            <h2 class="wp-heading-inline"><?php _e( 'Add New Agent', 'realty-workstation-pro' ); ?></h2>
        </div>
        <div class="rw-card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <div class="alert alert-danger"></div>
                <?php if ( count($agents) > 5 ) { ?>
                    <div class="alert alert-danger" style="display: block;">Please upgrade your plugin to Pro version to add more users.</div>
                <?php } ?>
                <div class="form-group">
                    <label for="first_name"><?php _e( 'First Name', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="first_name" id="first_name" required value="">
                </div>
                <div class="form-group">
                    <label for="last_name"><?php _e( 'Last Name', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="last_name" id="last_name" required value="">
                </div>
                <div class="form-group">
                    <label for="email"><?php _e( 'Email Address', 'realty-workstation-pro' ); ?></label>
                    <input type="email" name="email" id="email" required value="">
                </div>
                <div class="form-group">
                    <label for="password"><?php _e( 'Password', 'realty-workstation-pro' ); ?></label>
                    <input type="password" name="password" id="password" required value="">
                </div>
                <div class="form-group">
                    <label for="commission"><?php _e( 'Commission (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="commission" id="commission" required value="">
                </div>
                <div class="form-group">
                    <label for="lease"><?php _e( 'Broker Referral Payout for Lease (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="lease" id="lease" required value="">
                </div>
                <div class="form-group">
                    <label for="sale_and_purchase"><?php _e( 'Broker Referral Payout for Sale and Purchase (As Decimal e.g. 50% = 0.50)', 'realty-workstation-pro' ); ?></label>
                    <input type="text" name="sale_and_purchase" id="sale_and_purchase" required value="">
                </div>
                <div class="button-group">
                    <?php if ( count($agents) > 5 ) { ?>
                        <a href="https://www.realtyworkstation.com/" class="rw-button">Buy Pro Version</a>
                    <?php } else { ?>
                        <button type="button" class="rw-button add-new-agent-btn">Add New Agent</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>