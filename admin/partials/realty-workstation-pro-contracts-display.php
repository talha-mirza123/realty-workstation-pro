<?php
    $rw_license_key = get_option( 'rw_license_key' );
    $contracts = get_posts([
        'post_type' => 'rw-contract',
        'post_status' => 'publish',
        'numberposts' => -1
    ]);
?>
<div class="wrap realty-workstation-pro-settings-div">
    <?php if (isset($rw_license_key) && !empty($rw_license_key)) { ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php _e( 'All Contracts', 'realty-workstation-pro' ); ?></h1>
            <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-contracts-settings&new-contract=true') ?>" class="page-title-action">Add New Contract</a>
        </div>
        <?php if (isset($_GET['add-success']) && !empty($_GET['add-success']) && $_GET['add-success'] == 'true') { ?>
            <br>
            <div class="alert alert-success">Contract has been added to the system successfully.</div>
        <?php } ?>
        <?php if (isset($_GET['update-success']) && !empty($_GET['update-success']) && $_GET['update-success'] == 'true') { ?>
            <br>
            <div class="alert alert-success">Contract has been updated to the system successfully.</div>
        <?php } ?>
        <?php if (isset($_GET['delete-success']) && !empty($_GET['delete-success']) && $_GET['delete-success'] == 'true') { ?>
            <br>
            <div class="alert alert-success">Contract has been deleted from the system successfully.</div>
        <?php } ?>
        <?php if (isset($_GET['closed-success']) && !empty($_GET['closed-success']) && $_GET['closed-success'] == 'true') { ?>
            <br>
            <div class="alert alert-success">Contract has been closed in the system successfully.</div>
        <?php } ?>
        <div style="margin-bottom: 1rem;"></div>
        <table id="example" class="display realty-workstation-pro-dataTable" style="width:100%">
            <thead>
                <tr>
                    <th>Contract Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contracts as $contract) { ?>
                    <tr>
                        <td><?php echo get_post_meta( $contract->ID, 'name', true ); ?></td>
                        <td><?php echo get_post_meta( $contract->ID, 'description', true ); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($contract->post_date)); ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-contracts-settings&view-contract=true&contract-id=' . $contract->ID) ?>" class="button button-primary">View</a>
                            <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-contracts-settings&edit-contract=true&contract-id=' . $contract->ID) ?>" class="button button-primary">Edit</a>
                            <button type="button" class="button button-primary btn-delete btn-delete-contract" data-contract-id="<?php echo $contract->ID; ?>">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="wrap margin-bottom-1rem">
            <h1 class="wp-heading-inline"><?php _e( 'All Contracts', 'realty-workstation-pro' ); ?></h1>
        </div>
        <div class="card">
            <div class="card-body">
                <h2>Upgrade to PRO <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-general-settings'); ?>" style="margin-top: -5px; margin-left: 10px;" class="button button-primary">Click to Enter License Key</a></h2>
                <ul>Features</ul>
                <li style="list-style: none;">1. Leads</li>
                <li style="list-style: none;">2. Contracts</li>
                <li style="list-style: none;">3. Backup and Restore</li>
            </div>
        </div>
    <?php } ?>
</div>