<?php
    $args = array(
        'role' => 'rw_agent',
        'orderby' => 'user_nicename',
        'order' => 'ASC'
    );
    $agents = get_users($args);
?>
<div class="wrap realty-workstation-pro-settings-div">
    <div class="wrap margin-bottom-1rem">
        <h1 class="wp-heading-inline"><?php _e( 'All Agents', 'realty-workstation-pro' ); ?></h1>
        <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-settings&new-agent=true') ?>" class="page-title-action">Add New Agent</a>
    </div>
    <?php if (isset($_GET['add-success']) && !empty($_GET['add-success']) && $_GET['add-success'] == 'true') { ?>
        <div class="alert alert-success">Agent has been added to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['update-success']) && !empty($_GET['update-success']) && $_GET['update-success'] == 'true') { ?>
        <div class="alert alert-success">Agent has been updated to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['delete-success']) && !empty($_GET['delete-success']) && $_GET['delete-success'] == 'true') { ?>
        <div class="alert alert-success">Agent has been deleted from the system successfully.</div>
    <?php } ?>
    <?php if ( count($agents) > 5 ) { ?>
        <div class="alert alert-danger" style="display: block;">Please upgrade your plugin to Pro version to add more users.</div>
    <?php } ?>
    <table id="example" class="display realty-workstation-pro-dataTable" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Last Accessed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agents as $agent) { ?>
                <tr>
                    <td><?php echo $agent->first_name . ', ' . $agent->last_name; ?></td>
                    <td><?php echo $agent->user_email; ?></td>
                    <?php
                        $last_accessed = get_user_meta( $agent->ID , 'last_accessed', true);
                    ?>
                    <td><?php echo $last_accessed; ?></td>
                    <td>
                        <a href="<?php echo admin_url('admin.php?page=realty-workstation-pro-settings&edit-agent=true&agent-id=' . $agent->ID) ?>" class="button button-primary">Edit</a>
                        <button type="button" class="button button-primary btn-delete btn-delete-agent" data-agent-id="<?php echo $agent->ID; ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>