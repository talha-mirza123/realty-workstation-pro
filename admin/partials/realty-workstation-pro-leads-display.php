<?php
    $rw_license_key = get_option( 'rw_license_key' );
    $leads = get_posts([
        'post_type' => 'rw-lead',
        'post_status' => 'publish',
        'numberposts' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'status',
                'value' => 'unassigned',
                'compare' => '=',
            )
        )
    ]);
    $unassignedLeads = (isset($_GET['unassigned-leads']) && !empty($_GET['unassigned-leads'])) ? $_GET['unassigned-leads'] : '';
    $assignedLeads = (isset($_GET['assigned-leads']) && !empty($_GET['assigned-leads'])) ? $_GET['assigned-leads'] : '';
    $deletedLeads = (isset($_GET['deleted-leads']) && !empty($_GET['deleted-leads'])) ? $_GET['deleted-leads'] : '';
    if ( isset($unassignedLeads) && !empty($unassignedLeads) && $unassignedLeads == 'true' ) {
        $leads = get_posts([
            'post_type' => 'rw-lead',
            'post_status' => 'publish',
            'numberposts' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'status',
                    'value' => 'unassigned',
                    'compare' => '=',
                )
            )
        ]);
    }
    if ( isset($assignedLeads) && !empty($assignedLeads) && $assignedLeads == 'true' ) {
        $leads = get_posts([
            'post_type' => 'rw-lead',
            'post_status' => 'publish',
            'numberposts' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'status',
                    'value' => 'assigned',
                    'compare' => '=',
                )
            )
        ]);
    }
    if ( isset($deletedLeads) && !empty($deletedLeads) && $deletedLeads == 'true' ) {
        $leads = get_posts([
            'post_type' => 'rw-lead',
            'post_status' => 'publish',
            'numberposts' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'status',
                    'value' => 'deleted',
                    'compare' => '=',
                )
            )
        ]);
    }
?>
<div class="wrap realty-workstation-pro-settings-div">
    <?php if (isset($rw_license_key) && !empty($rw_license_key)) { ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php _e( 'All Leads', 'realty-workstation-pro' ); ?></h1>
            <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&new-lead=true') ?>" class="page-title-action">Add New Lead</a>
        </div>
        <?php if (isset($_GET['add-success']) && !empty($_GET['add-success']) && $_GET['add-success'] == 'true') { ?>
            <br>
            <div class="alert alert-success">Lead has been added to the system successfully.</div>
        <?php } ?>
        <?php if (isset($_GET['update-success']) && !empty($_GET['update-success']) && $_GET['update-success'] == 'true') { ?>
            <br>
            <div class="alert alert-success">Lead has been updated to the system successfully.</div>
        <?php } ?>
        <?php if (isset($_GET['delete-success']) && !empty($_GET['delete-success']) && $_GET['delete-success'] == 'true') { ?>
            <br>
            <div class="alert alert-success">Lead has been deleted from the system successfully.</div>
        <?php } ?>
        <?php if (isset($_GET['closed-success']) && !empty($_GET['closed-success']) && $_GET['closed-success'] == 'true') { ?>
            <br>
            <div class="alert alert-success">Lead has been closed in the system successfully.</div>
        <?php } ?>
        <div class="tablenav top margin-bottom-1rem" style="float: left">
            <div class="alignleft actions bulkactions">
                <?php if (isset($unassignedLeads) && !empty($unassignedLeads) && $unassignedLeads == 'true') { ?>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&unassinged-leads=true') ?>" class="button action active"><i class="fa fa-folder-open-o"></i> Unassigned</a>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&assigned-leads=true') ?>" class="button action "><i class="fa fa-folder-o"></i> Assigned</a>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&deleted-leads=true') ?>" class="button action "><i class="fa fa-trash"></i> Deleted</a>
                <?php } else if (isset($assignedLeads) && !empty($assignedLeads) && $assignedLeads == 'true') { ?>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&unassinged-leads=true') ?>" class="button action"><i class="fa fa-folder-open-o"></i> Unassigned</a>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&assigned-leads=true') ?>" class="button action active"><i class="fa fa-folder-o"></i> Assigned</a>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&deleted-leads=true') ?>" class="button action"><i class="fa fa-trash"></i> Deleted</a>
                <?php } else if (isset($deletedLeads) && !empty($deletedLeads) && $deletedLeads == 'true') { ?>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&unassinged-leads=true') ?>" class="button action"><i class="fa fa-folder-open-o"></i> Unassigned</a>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&assigned-leads=true') ?>" class="button action"><i class="fa fa-folder-o"></i> Assigned</a>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&deleted-leads=true') ?>" class="button action active"><i class="fa fa-trash"></i> Deleted</a>
                <?php } else { ?>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&unassinged-leads=true') ?>" class="button action active"><i class="fa fa-folder-open-o"></i> Unassigned</a>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&assigned-leads=true') ?>" class="button action "><i class="fa fa-folder-o"></i> Assigned</a>
                    <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&deleted-leads=true') ?>" class="button action "><i class="fa fa-trash"></i> Deleted</a>
                <?php } ?>
                
            </div>
        </div>
        <table id="example" class="display realty-workstation-pro-dataTable" style="width:100%">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Agent</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads as $lead) { ?>
                    <tr>
                        <td><?php echo get_post_meta( $lead->ID, 'fullname', true ); ?></td>
                        <td><?php echo get_post_meta( $lead->ID, 'type', true ); ?></td>
                        <?php if ((isset($assignedLeads) && !empty($assignedLeads)) || (isset($deletedLeads) && !empty($deletedLeads))) { ?>
                            <td><?php echo get_user_by('ID', get_post_meta( $lead->ID, 'agent', true ))->first_name . ' ' . get_user_by('ID', get_post_meta( $lead->ID, 'agent', true ))->last_name; ?></td>
                        <?php } else { ?>
                            <td>Unassigned</td>
                        <?php } ?>
                        <td><?php echo date('d-m-Y', strtotime($lead->post_date)); ?></td>
                        <td>
                            <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-leads-settings&edit-lead=true&lead-id=' . $lead->ID) ?>" class="button button-primary">Edit</a>
                            <?php if ((isset($deletedLeads) && !empty($deletedLeads))) { ?>
                                <button type="button" class="button button-primary btn-delete btn-delete-lead" data-lead-id="<?php echo $lead->ID; ?>">Delete</button>
                            <?php } else { ?>
                                <button type="button" class="button button-primary btn-delete btn-delete-lead-temporary" data-lead-id="<?php echo $lead->ID; ?>">Delete</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="wrap margin-bottom-1rem">
            <h1 class="wp-heading-inline"><?php _e( 'All Leads', 'realty-workstation-pro' ); ?></h1>
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