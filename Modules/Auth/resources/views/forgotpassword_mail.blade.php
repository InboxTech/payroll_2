<!DOCTYPE html>
<html>
    <body>
        <div style="height:100%;width:100%;" align="center">
            <div style="width:644px;padding:0px;text-align:left;height:auto;min-height:100px;border: 2px solid #3150a0;border-radius:5px;background-repeat: repeat;background:  #3150a01c;">
                <div align="center" style="margin-top:20px;text-align:center;padding: 0px 0px;">
                    <a href="javascript:void(0)">
                        <img style="width: 200px;" src="{{ asset(getImage(getSettingData('config_company_logo'))) }}">
                    </a>
                </div>
                <div align="center" style="border-radius:5px;margin:30px;margin-top:20px;min-height:150px;height:auto;padding:0 0 10px 0;color:#43494e;font-size:13px;font-family: Verdana, sans-serif;font-weight:400;">
                    <div style="text-align:center;text-transform:uppercase;font-size: 22px;color: #3150a0;font-weight: bold;margin:25px 0 50px 0;" align="center">Forgot Password Link</div>
                        <div style="font-size: 14px;color:#43494e;margin:15px 0 35px 0;text-align:justify;line-height: 1.5;padding:0 20px;">
                            <p style="color: #000; font-weight: 500; font-size: 14px;"><b style="color: #000;">Hello </b>{{ ucwords($data['first_name']).' '.ucwords($data['last_name']) }},</p>
                            <p>We Received your request for forgot password.</p>
                            <p>You can reset password from bellow link:</p>
                            <a href="{{ route('reset_password', $data['token']) }}">Reset Password</a>
                            <p><strong>Note:</strong> This link is valid for 10 Min. Only</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </body>
</html>