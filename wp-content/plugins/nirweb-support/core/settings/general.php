<div id="box_1">
    <h2 class="nwallet_set_title">
        <span class="nwallet_set_title_icon"><span uk-icon="settings"></span></span>
        <strong><?php echo esc_html__('General settings', 'nirweb-support') ?></strong>
    </h2>
    <div class="uk-margin">
        <label class="uk-form-label"
               for="active_auto_partial"><strong><?php echo esc_html__('Display Icon', 'nirweb-support'); ?></strong></label>
        <div uk-form-custom="target: > * > span:first-child" class="uk-form-custom">
            <select name="display_icon_send_ticket">
                <option value="0" <?= get_option('display_icon_send_ticket') == '0' ? 'selected' : '' ?> ><?php echo esc_html__('deactivate', 'nirweb-support'); ?></option>
                <option value="1" <?= get_option('display_icon_send_ticket') == '1' ? 'selected' : '' ?> ><?php echo esc_html__('active', 'nirweb-support'); ?></option>
            </select>
            <button class="uk-button uk-button-default" type="button" tabindex="-1">
                <span></span>
                <span uk-icon="icon: chevron-down" class="uk-icon"></span>
            </button>
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label"
               for="select_page_ticket"><strong><?php echo esc_html__('If you do not have the WooCommerce plugin installed, select a Page', 'nirweb-support'); ?></strong></label>
        <div uk-form-custom="target: > * > span:first-child" class="uk-form-custom">
            <select name="select_page_ticket">
                <option value="0"><?php echo esc_html__('Please Select Page', 'nirweb-support'); ?></option>
                <?php foreach (get_pages() as $page): ?>
                    <option value="<?php echo esc_html($page->ID) ?>" <?= get_option('select_page_ticket') == $page->ID ? 'selected' : '' ?> ><?php echo esc_html($page->post_title) ?></option>
                <?php endforeach; ?>
            </select>
            <button class="uk-button uk-button-default" type="button" tabindex="-1">
                <span></span>
                <span uk-icon="icon: chevron-down" class="uk-icon"></span>
            </button>
        </div>
        <div class="set_description">
            <i uk-icon="info"></i>
            <?= esc_html__('short code : [nirweb_ticket]', 'nirweb-support') ?>
        </div>
    </div>
    <div class="uk-margin">

        <label class="uk-form-label pro_ver"
               for="select_page_ticket"><strong><?php echo esc_html__('Login Page', 'nirweb-support'); ?></strong>
            <div class="pro_ver_txt">   <i uk-icon="lock"></i> Pro</div>
        </label>
        <div uk-form-custom="target: > * > span:first-child" class="uk-form-custom">
            <select disabled>
                <option value="0"><?php echo esc_html__('Please Select Page', 'nirweb-support'); ?></option>
            </select>
            <button class="uk-button uk-button-default disabled" type="button" tabindex="-1">
                <span></span>
                <span uk-icon="icon: chevron-down" class="uk-icon"></span>
            </button>
        </div>

    </div>

    <div class="uk-margin">

        <label class="uk-form-label pro_ver"
               for="select_page_ticket"><strong><?php echo esc_html__('activate auto close ticket', 'nirweb-support'); ?></strong>
            <div class="pro_ver_txt">   <i uk-icon="lock"></i> Pro</div>
        </label>
        <div uk-form-custom="target: > * > span:first-child" class="uk-form-custom">
            <select disabled>
                <option value="0" >
                    <?php echo esc_html__('deactivate', 'nirweb-support'); ?>
                </option>
                <option value="1">
                    <?php echo esc_html__('active', 'nirweb-support'); ?>
                </option>
            </select>
            <button class="uk-button uk-button-default disabled" type="button" tabindex="-1">
                <span></span>
                <span uk-icon="icon: chevron-down" class="uk-icon"></span>
            </button>
        </div>

    </div>
    <div class="uk-margin">

        <label class="uk-form-label pro_ver"
               for="select_page_ticket"><strong><?php echo esc_html__('Display Info Support', 'nirweb-support'); ?></strong>
            <div class="pro_ver_txt">   <i uk-icon="lock"></i> Pro</div>
        </label>
        <div uk-form-custom="target: > * > span:first-child" class="uk-form-custom">
            <select disabled>
                <option value="0" >
                    <?php echo esc_html__('deactivate', 'nirweb-support'); ?>
                </option>
                <option value="1">
                    <?php echo esc_html__('active', 'nirweb-support'); ?>
                </option>
            </select>
            <button class="uk-button uk-button-default disabled" type="button" tabindex="-1">
                <span></span>
                <span uk-icon="icon: chevron-down" class="uk-icon"></span>
            </button>
        </div>

    </div>

    <div class="uk-margin">
        <label class="uk-form-label"
               for="icon_nirweb_ticket_front"><?= esc_html__('Enter the icon address', 'nirweb-support') ?></label>
        <div class="uk-form-controls">
            <input class="uk-input" name="icon_nirweb_ticket_front"
                   id="icon_nirweb_ticket_front"
                   value="<?= esc_html(get_option('icon_nirweb_ticket_front')) ?>">
        </div>
    </div>


    <div class="uk-margin">
        <label class="uk-form-label"
               for="position_icon_nirweb_ticket_front"><strong><?php echo esc_html__('Posotion Icon', 'nirweb-support'); ?></strong></label>
        <div uk-form-custom="target: > * > span:first-child" class="uk-form-custom">
            <select name="position_icon_nirweb_ticket_front">
                <option value="left" <?= get_option('position_icon_nirweb_ticket_front') == 'left' ? 'selected' : '' ?> ><?php echo esc_html__('Left', 'nirweb-support'); ?></option>
                <option value="right" <?= get_option('position_icon_nirweb_ticket_front') == 'right' ? 'selected' : '' ?> >
                    <?php echo esc_html__('Right', 'nirweb-support'); ?></option>
            </select>
            <button class="uk-button uk-button-default" type="button" tabindex="-1">
                <span></span>
                <span uk-icon="icon: chevron-down" class="uk-icon"></span>
            </button>
        </div>
    </div>

    <div class="uk-margin">

        <label class="uk-form-label pro_ver"
               for="select_page_ticket"><strong><?php echo esc_html__('Default Department', 'nirweb-support'); ?></strong>
            <div class="pro_ver_txt">   <i uk-icon="lock"></i> Pro</div>
        </label>
        <div uk-form-custom="target: > * > span:first-child" class="uk-form-custom">
            <select disabled>
                <option value="0" >
                    <?php echo esc_html__('Select Default Department', 'nirweb-support'); ?>
                </option>

            </select>
            <button class="uk-button uk-button-default disabled" type="button" tabindex="-1">
                <span></span>
                <span uk-icon="icon: chevron-down" class="uk-icon"></span>
            </button>
        </div>

    </div>




    <div class="uk-margin">

        <label class="uk-form-label pro_ver"
               for="select_page_ticket"><strong><?php echo esc_html__('Product support by the seller (for Dokan plugin)', 'nirweb-support'); ?></strong>
            <div class="pro_ver_txt">   <i uk-icon="lock"></i> Pro</div>
        </label>
        <div uk-form-custom="target: > * > span:first-child" class="uk-form-custom">
            <select disabled>
                <option value="0" >
                    <?php echo esc_html__('active', 'nirweb-support'); ?>
                </option>
            </select>
            <button class="uk-button uk-button-default disabled" type="button" tabindex="-1">
                <span></span>
                <span uk-icon="icon: chevron-down" class="uk-icon"></span>
            </button>
        </div>

    </div>



    <div class="uk-margin">

        <label class="uk-form-label pro_ver"
               for="select_page_ticket"><strong><?php echo esc_html__('Automatic response to the ticket sent', 'nirweb-support'); ?></strong>
            <div class="pro_ver_txt">   <i uk-icon="lock"></i> Pro</div>
        </label>
        <div uk-form-custom="target: > * > span:first-child" class="uk-form-custom">
            <select disabled>
                <option value="1">
                    <?php echo esc_html__('active', 'nirweb-support'); ?>
                </option>
            </select>
            <button class="uk-button uk-button-default disabled" type="button" tabindex="-1">
                <span></span>
                <span uk-icon="icon: chevron-down" class="uk-icon"></span>
            </button>
        </div>

    </div>

    <div class="uk-margin">
        <label class="uk-form-label"
               for="template_send_ticket_email"><strong><?php echo esc_html__('Email Template For Send Ticket By Admin', 'nirweb-support'); ?></strong></label>
        <div  class="uk-form-custom">
            <?php esc_html(wp_editor(get_option('template_send_ticket_email'), 'template_send_ticket_email')); ?>
        </div>
        <div class="set_description">
            <i uk-icon="info"></i>
            <?=  esc_html__('Receiver : {username}', 'nirweb-support') ?>
        </div>
    </div>


</div>