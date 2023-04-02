<?php
    $args = array(
        'role' => 'rw_agent',
        'orderby' => 'user_nicename',
        'order' => 'ASC'
    );
    $agents = get_users($args);
?>
<div class="realty-workstation-pro-agents-all">
    <h3>All Agents</h3>
    <?php if (isset($_GET['add-success']) && !empty($_GET['add-success']) && $_GET['add-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Agent has been added to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['update-success']) && !empty($_GET['update-success']) && $_GET['update-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Agent has been updated to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['delete-success']) && !empty($_GET['delete-success']) && $_GET['delete-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Agent has been deleted from the system successfully.</div>
    <?php } ?>
    <?php if ( count($agents) > 5 ) { ?>
        <hr>
        <div class="alert alert-danger" style="display: block;">Please upgrade your plugin to Pro version to add more users.</div>
    <?php } ?>
    <hr>
    <table id="example" class="table table-striped rw-dataTable" style="width:100%">
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
                    <td><?php echo $agent->first_name . ' ' . $agent->last_name; ?></td>
                    <td><?php echo $agent->user_email; ?></td>
                    <?php
                        $last_accessed = get_user_meta( $agent->ID , 'last_accessed', true);
                    ?>
                    <td><?php echo $last_accessed; ?></td>
                    <td>
                        <a href="<?php echo $rw_workstation . '?agents=edit&agent-id=' . $agent->ID ?>" class="btn btn-primary btn-sm">Edit</a>
                        <button type="button" class="btn btn-danger btn-sm btn-delete-agent" data-agent-id="<?php echo $agent->ID; ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>