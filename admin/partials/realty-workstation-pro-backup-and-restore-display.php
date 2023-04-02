<?php
    $rw_license_key = get_option( 'rw_license_key' );
?>
<div class="wrap realty-workstation-pro-settings-div">
    <?php if (isset($rw_license_key) && !empty($rw_license_key)) { ?>
        <div class="wrap margin-bottom-1rem">
            <h1 class="wp-heading-inline"><?php _e( 'Backup and Restore', 'realty-workstation-pro' ); ?></h1>
        </div>
        <div class="rw-card">
            <div class="rw-card-header">
                <h2 class="wp-heading-inline"><?php _e( 'Create Backup', 'realty-workstation-pro' ); ?></h2>
            </div>
            <div class="rw-card-body">
                <p><strong>This function will backup your entire workstation including all transactions data, files and agent profiles. Since data may be large, this function will create a series of numbered ZIP files. To restore you will have to upload those files in sequential order using the restore function.</strong></p>
                <button type="button" class="button button-primary create-backup">Create Backup Now</button>
            </div>
        </div>
        <div class="rw-card">
            <div class="rw-card-header">
                <h2 class="wp-heading-inline"><?php _e( 'Restore Workstation', 'realty-workstation-pro' ); ?></h2>
            </div>
            <div class="rw-card-body">
                <p><strong>Select the first file you would like to restore (ie: backup-1.zip, backup-2.zip, etc) and then press the restore button. Repeat this process in order until you have restored all the ZIP files which were created in the above backup function.</strong></p>
                <div id="hud" class="form-group">
                    <div id="file-upload-form" class="uploader">
                        <input id="backup" type="file" name="backup[]" accept=".zip" multiple="multiple">
                        <label for="backup" id="file-drag-0">
                            <img id="file-image" src="#" alt="Preview" class="hidden">
                            <div id="start">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <div><p class="help-block">Please select backed up zip files</p></div>
                                <div id="notimage" class="hidden">Please select an image</div>
                                <span id="file-upload-btn" class="btn btn-primary">Select and Restore</span>
                            </div>
                            <div id="response" class="hidden">
                                <div id="messages"></div>
                                <progress class="progress" id="file-progress" value="0">
                                    <span>0</span>%
                                </progress>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="wrap margin-bottom-1rem">
            <h1 class="wp-heading-inline"><?php _e( 'Backup and Restore', 'realty-workstation-pro' ); ?></h1>
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