<?php
    $rw_webpage = get_option( 'rw_webpage' );
    $rw_name = get_option( 'rw_name' );
    $rw_broker_email = get_option( 'rw_broker_email' );
    $rw_broker_password = get_option( 'rw_broker_password' );
    $rw_bank_name = get_option( 'rw_bank_name' );
    $rw_account_name = get_option( 'rw_account_name' );
    $rw_account_number = get_option( 'rw_account_number' );
    $rw_account_address = get_option( 'rw_account_address' );
    $rw_license_key = get_option( 'rw_license_key' );
?>
<div class="wrap realty-workstation-pro-settings-div">
    <div class="rw-card">
        <div class="rw-card-header">
            <h1 class="wp-heading-inline"><?php _e( 'Settings', 'realty-workstation-pro' ); ?></h1>
        </div>
        <div class="rw-card-body">
            <?php if (isset($_GET['success']) && !empty($_GET['success']) && $_GET['success'] == 'true') { ?>
                <div class="alert alert-success">Settings have been updated successfully.</div>
            <?php } ?>
            <div class="alert alert-danger"></div>
            <div class="rw-card">
                <div class="rw-card-header">
                    <h2 class="wp-heading-inline fs-larger"><?php _e( 'License Settings', 'realty-workstation-pro' ); ?></h2>
                </div>
                <div class="rw-card-body">
                    <div class="form-group">
                        <label for="rw_license_key">License Key</label>
                        <input type="text" id="rw_license_key" name="rw_license_key" value="<?php echo $rw_license_key; ?>">
                    </div>
                    <?php if ( ! $rw_license_key ) { ?>
                        <div class="button-group">
                            <button type="button" class="rw-button check-license-key-btn" data-website-url="<?php echo site_url(); ?>">Activate License</button>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="rw-card">
                <div class="rw-card-header">
                    <h2 class="wp-heading-inline fs-larger"><?php _e( 'Web Version Settings', 'realty-workstation-pro' ); ?></h2>
                </div>
                <div class="rw-card-body">
                    <div class="form-group wd-50">
                        <label for="rw_webpage">Select Web Version</label>
                        <select name="rw_webpage" id="rw_webpage">
                            <option value="">Select an option</option>
                            <?php foreach (get_pages() as $page) { ?>
                                <option value="<?php echo $page->ID; ?>" <?php echo ($rw_webpage && $rw_webpage == $page->ID) ? 'selected' : ''; ?>><?php echo $page->post_title; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group wd-50">
                        <label for="rw_name">Workstation Name</label>
                        <input type="text" id="rw_name" name="rw_name" value="<?php echo $rw_name; ?>">
                    </div>
                </div>
            </div>
            <div class="rw-card">
                <div class="rw-card-header">
                    <h2 class="wp-heading-inline fs-larger"><?php _e( 'Broker Username Settings', 'realty-workstation-pro' ); ?></h2>
                </div>
                <div class="rw-card-body">
                    <div class="form-group wd-50">
                        <label for="rw_broker_email">Email Address</label>
                        <input type="email" id="rw_broker_email" name="rw_broker_email" value="<?php echo $rw_broker_email; ?>">
                    </div>
                    <div class="form-group wd-50">
                        <label for="rw_broker_password">Password</label>
                        <input type="text" id="rw_broker_password" name="rw_broker_password" value="<?php echo $rw_broker_password; ?>">
                    </div>
                </div>
            </div>
            <div class="rw-card margin-bottom-1rem">
                <div class="rw-card-header">
                    <h2 class="wp-heading-inline fs-larger"><?php _e( 'Commission Deposits Bank Information', 'realty-workstation-pro' ); ?></h2>
                </div>
                <div class="rw-card-body">
                    <div class="form-group wd-50">
                        <label for="rw_bank_name">Bank Name</label>
                        <input type="text" id="rw_bank_name" name="rw_bank_name" value="<?php echo $rw_bank_name; ?>">
                    </div>
                    <div class="form-group wd-50">
                        <label for="rw_account_name">Account Name</label>
                        <input type="text" id="rw_account_name" name="rw_account_name" value="<?php echo $rw_account_name; ?>">
                    </div>
                    <div class="form-group wd-50">
                        <label for="rw_account_number">Account Number</label>
                        <input type="text" id="rw_account_number" name="rw_account_number" value="<?php echo $rw_account_number; ?>">
                    </div>
                    <div class="form-group wd-50">
                        <label for="rw_account_address">Account Address</label>
                        <input type="text" id="rw_account_address" name="rw_account_address" value="<?php echo $rw_account_address; ?>">
                    </div>
                </div>
            </div>
            <div class="button-group">
                <button type="button" class="rw-button save-general-settings-btn">Save</button>
            </div>
        </div>
    </div>
</div>