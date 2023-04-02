<?php
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
    if ( isset($_GET['leads']) && !empty($_GET['leads']) && $_GET['leads'] == 'unassigned' ) {
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
    if ( isset($_GET['leads']) && !empty($_GET['leads']) && $_GET['leads'] == 'assigned' ) {
        if ($_SESSION['rwUser'] == 'agent') {
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
                    ),
                    array(
                        'key' => 'agent',
                        'value' => get_current_user_id(),
                        'compare' => '=',
                    )
                )
            ]);
        } else {
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
    }
    if ( isset($_GET['leads']) && !empty($_GET['leads']) && $_GET['leads'] == 'deleted' ) {
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
<div class="realty-workstation-pro-agents-all">
    <?php if ($_SESSION['rwUser'] == 'agent') { ?>
        <h3>My Leads</h3>
    <?php } else { ?>
        <h3><?php echo ucfirst($_GET['leads']); ?> Leads</h3>
    <?php } ?>
    <?php if (isset($_GET['add-success']) && !empty($_GET['add-success']) && $_GET['add-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Lead has been added to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['update-success']) && !empty($_GET['update-success']) && $_GET['update-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Lead has been updated to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['delete-success']) && !empty($_GET['delete-success']) && $_GET['delete-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Lead has been deleted from the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['closed-success']) && !empty($_GET['closed-success']) && $_GET['closed-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Lead has been closed in the system successfully.</div>
    <?php } ?>
    <hr>
    <table id="example" class="table table-striped rw-dataTable" style="width:100%">
        <thead>
            <tr>
                <th>Client</th>
                <th>Type</th>
                <?php if ($_SESSION['rwUser'] != 'agent') { ?>
                    <th>Agent</th>
                <?php } ?>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($leads as $lead) { ?>
                <tr>
                    <td><?php echo get_post_meta( $lead->ID, 'fullname', true ); ?></td>
                    <td><?php echo get_post_meta( $lead->ID, 'type', true ); ?></td>
                    <?php if ($_SESSION['rwUser'] != 'agent') { ?>
                        <?php if (isset($_GET['leads']) && !empty($_GET['leads'] && $_GET['leads'] != 'unassigned')) { ?>
                            <td><?php echo get_user_by('ID', get_post_meta( $lead->ID, 'agent', true ))->first_name . ' ' . get_user_by('ID', get_post_meta( $lead->ID, 'agent', true ))->last_name; ?></td>
                        <?php } else { ?>
                            <td>Unassigned</td>
                        <?php } ?>
                    <?php } ?>
                    <td><?php echo date('d-m-Y', strtotime($lead->post_date)); ?></td>
                    <td>
                        <a href="<?php echo $rw_workstation . '?leads=edit&lead-id=' . $lead->ID; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <?php if (isset($_GET['leads']) && !empty($_GET['leads'] && $_GET['leads'] == 'deleted')) { ?>
                            <button type="button" class="btn btn-danger btn-sm btn-delete-lead" data-lead-id="<?php echo $lead->ID; ?>">Delete</button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-danger btn-sm btn-delete-lead-temporary" data-lead-id="<?php echo $lead->ID; ?>">Delete</button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>