<!-- <html>
<body>
	<h1><?php echo sprintf(lang('email_forgot_password_heading'), $identity);?></h1>
	<p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></p>
</body>
</html> -->
<html>
<body style="background-color: #FFF; color: #555555; font-family: Arial, Calibri, Verdana; font-size: 14px; font-weight: normal">
    <div style="width: 600px; border-radius: 4px; background-color: #FFFFFF; border: 1px solid #EEE; margin: 0 auto">
        <div style="display: block; padding: 20px; background-color: #F5F5F5; text-align: center; border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom: 1px solid #EEE">
        	<div style="display: table-cell; vertical-align: middle">
        	<a href="http://deliverymates.co.uk/dev"><img src="http://deliverymates.co.uk/dev/assets/img/logo-client.png" style="width: 168px; height: auto" /></a>
        </div>
       		<div style="display: table-cell; vertical-align: middle; padding-left: 268px">
        	<a href="http://deliverymates.co.uk/dev" style="display: inline-block; padding: 6px 12px; font-size: 16px; line-height: 1.42857143; text-align: center; white-space: nowrap; vertical-align: middle; border-radius: 4px; color: #5cb85c; background-color: #FFF; text-decoration: none; display:block; width: 100px; border: 1px solid #EEE;">Login</a>
    	</div>
    	</div>
        <div style="padding: 20px">
            <h1 style="text-align: center; font-weight: normal; color: #5cb85c">Password Reset</h1>
            <p>Dear user,</p>
            <p>To proceed with your password reset for Delivery Mates account, please click the following link.</p>
            <p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></p>
            <!--<p><a href="#" style="display: inline-block; padding: 12px; font-size: 16px; line-height: 1.42857143; text-align: center; white-space: nowrap; vertical-align: middle; border-radius: 4px; color: #fff; background-color: #5cb85c; text-decoration: none; margin: 40px auto; display:block; width: 200px" >Confirm Password Reset</a></p>-->
            <p><strong>Important:</strong> If you did not request a password reset, please notify to <a href="security:contacts@deliverymates.co.uk/" style="color: #5cb85c">security@deliverymates.co.uk.</a></p><p>Thank you for choosing Delivery Mates!</p>
            Delivery Mates Support team<br>
            <a href="mailto:support@deliverymates.co.uk/" style="color: #5cb85c">contacts@deliverymates.co.uk</a>
        </div>
    </div>
    <p style="text-align: center; font-size: 12px">Add <a href="mailto:contacts@deliverymates.co.uk/" style="color: #5cb85c">contacts@deliverymates.co.uk</a> to your secure mailing list.</p>
</body>
</html>
