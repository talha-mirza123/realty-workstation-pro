<?php
    $contract = get_post((int) $_GET['contract-id']);
?>
<div class="realty-workstation-pro-agents-all edit-contract-container">
    <h3>New Contract</h3>
    <hr>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><?php _e( 'Add New Contract', 'realty-workstation-pro' ); ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="contract_id" id="contract_id" value="<?php echo $contract->ID; ?>">
                <div class="alert alert-danger"></div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Contract', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3 wd-50">
                            <label for="name" class="form-label">Contract Name</label>
                            <input type="text" id="name" class="form-control" name="name" value="<?php echo get_post_meta( $contract->ID, 'name', true ); ?>">
                        </div>
                        <div class="form-group mb-3 wd-50">
                            <label for="company" class="form-label">Contract Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"><?php echo get_post_meta( $contract->ID, 'description', true ); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0 fs-larger"><?php _e( 'Documents', 'realty-workstation-pro' ); ?></h6>
                    </div>
                    <div class="card-body">
                        <div id="hud" class="form-group">
                            <label>Contract Document</label>
                            <div id="file-upload-form" class="uploader" style="display: none;">
                                <input id="document" type="file" name="document" accept="image/jpeg, image/png, application/pdf" multiple="multiple">
                                <label for="document" id="file-drag-0">
                                    <img id="file-image" src="#" alt="Preview" class="hidden">
                                    <div id="start">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <div><p class="help-block">.jpg / .png / .pdf (If you are uploading multiple pages in seperate files. Please number the files e.g. 'title of document 1of4.jpg'</p></div>
                                        <div id="notimage" class="hidden">Please select an image</div>
                                        <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                    </div>
                                    <div id="response" class="hidden">
                                        <div id="messages"></div>
                                        <progress class="progress" id="file-progress" value="0">
                                            <span>0</span>%
                                        </progress>
                                    </div>
                                </label>
                            </div>
                            <table id="example" class="table table-responsive mt-3" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Filename</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo get_post_meta( $contract->ID, 'documentName', true ); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm delete-contract-document-btn">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-success w-25 update-contract-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>