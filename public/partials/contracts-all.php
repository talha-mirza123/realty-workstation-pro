<?php
    $contracts = get_posts([
        'post_type' => 'rw-contract',
        'post_status' => 'publish',
        'numberposts' => -1
    ]);
?>
<div class="realty-workstation-pro-agents-all">
    <h3><?php echo ucfirst($_GET['contracts']); ?> Contracts</h3>
    <?php if (isset($_GET['add-success']) && !empty($_GET['add-success']) && $_GET['add-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Contract has been added to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['update-success']) && !empty($_GET['update-success']) && $_GET['update-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Contract has been updated to the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['delete-success']) && !empty($_GET['delete-success']) && $_GET['delete-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Contract has been deleted from the system successfully.</div>
    <?php } ?>
    <?php if (isset($_GET['closed-success']) && !empty($_GET['closed-success']) && $_GET['closed-success'] == 'true') { ?>
        <hr>
        <div class="alert alert-success">Contract has been closed in the system successfully.</div>
    <?php } ?>
    <hr>
    <table id="example" class="table table-striped rw-dataTable" style="width:100%">
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
                    <?php if ($_SESSION['rwUser'] == 'agent') { ?>
                        <td>
                            <a href="<?php echo $rw_workstation . '?contracts=view&contract-id=' . $contract->ID; ?>" class="btn btn-primary btn-sm">View</a>
                            <a href="<?php echo get_post_meta( $contract->ID, 'documentURL', true ); ?>" target="_blank" class="btn btn-primary btn-sm">Download</a>
                        </td>
                    <?php } else { ?>
                        <td>
                            <a href="<?php echo $rw_workstation . '?contracts=view&contract-id=' . $contract->ID; ?>" class="btn btn-primary btn-sm">View</a>
                            <a href="<?php echo $rw_workstation . '?contracts=edit&contract-id=' . $contract->ID; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm btn-delete-contract" data-contract-id="<?php echo $contract->ID; ?>">Delete</button>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>