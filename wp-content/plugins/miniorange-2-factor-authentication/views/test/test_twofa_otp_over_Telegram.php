<?php
function mo2f_test_otp_over_Telegram( $user ) {

	?>
    <h3><?php echo mo2f_lt( 'Test OTP Over Telegram' ); ?>
        <hr>
    </h3>
    <p><?php echo mo2f_lt( 'Enter the one time passcode sent to your registered mobile number of Telegram.' ); ?></p>


    <form name="f" method="post" action="" id="mo2f_test_token_form">
        <input type="hidden" name="option" value="mo2f_validate_otp_over_Telegram"/>
		<input type="hidden" name="mo2f_validate_otp_over_Telegram_nonce"
						value="<?php echo esc_attr(wp_create_nonce( "mo2f-validate-otp-over-Telegram-nonce" )) ?>"/>
						
        <input class="mo2f_table_textbox" style="width:200px;" autofocus="true" type="text" name="otp_token" required
               placeholder="<?php echo mo2f_lt( 'Enter OTP' ); ?>" style="width:95%;"/>
        <a href="#resendsmslink"><?php echo mo2f_lt( 'Resend OTP ?' ); ?></a>
        <br><br>
        <input type="button" name="back" id="go_back" class="button button-primary button-large"
               value="<?php echo mo2f_lt( 'Back' ); ?>"/>
        <input type="submit" name="validate" id="validate" class="button button-primary button-large"
               value="<?php echo mo2f_lt( 'Validate OTP' ); ?>"/>

    </form>
    <form name="f" method="post" action="" id="mo2f_go_back_form">
        <input type="hidden" name="option" value="mo2f_go_back"/>
		<input type="hidden" name="mo2f_go_back_nonce"
						value="<?php echo esc_attr(wp_create_nonce( "mo2f-go-back-nonce" )) ?>"/>
    </form>

    <form name="f" method="post" action="" id="mo2f_2factor_test_authentication_method_form">
        <input type="hidden" name="option" value="mo_2factor_test_authentication_method"/>
		<input type="hidden" name="mo_2factor_test_authentication_method_nonce"
							value="<?php echo esc_attr(wp_create_nonce( "mo-2factor-test-authentication-method-nonce" )) ?>"/>
        <input type="hidden" name="mo2f_configured_2FA_method_test" id="mo2f_configured_2FA_method_test"
               value="OTP Over Telegram"/>
    </form>
    


        <script>
            jQuery('#go_back').click(function () {
                jQuery('#mo2f_go_back_form').submit();
            });
            jQuery('a[href=\"#resendsmslink\"]').click(function (e) {
                jQuery('#mo2f_2factor_test_authentication_method_form').submit();
            });
        </script>

<?php } ?>