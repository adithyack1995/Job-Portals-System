<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        p {
            margin-top: 0;
            margin-bottom: 10px;
            word-break: break-word;
        }

        button:hover,
        button:focus {
            opacity: 0.8;
            transition: 0.3s ease all;
            cursor: pointer;
        }
    </style>
</head>

<body style="font-family: 'Montserrat', sans-serif; background-color: #F1F6F1; color: #2F2C5A; font-size: 14px; line-height: 24px; font-weight: 500;">
    <table width="700" style="max-width: 100%; margin-left: auto; margin-right: auto; background-color: #ffffff; border-radius: 16px;" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align: center; padding: 20px 30px 16px;">
            </td>
        </tr>
        <tr>
            <td style="text-align: center; padding: 30px 30px 20px;">
                <div style="border-radius: 16px; padding: 24px; color: #ffffff;
                background: rgb(84,173,109);
                background: -moz-linear-gradient(270deg, rgba(84,173,109,1) 0%, rgba(3,45,31,1) 100%);
                background: -webkit-linear-gradient(270deg, rgba(84,173,109,1) 0%, rgba(3,45,31,1) 100%);
                background: linear-gradient(270deg, rgba(84,173,109,1) 0%, rgba(3,45,31,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr= #032d1f,endcolorstr=#54ad6d,gradienttype=1);" &quot;>

                    <p style="margin-bottom: 4px; font-size: 15px; line-height: 22px;">Hello <span style="font-weight: 600;">{{$name}}</span>,</p>
                    <h3 style="margin-bottom: 0px; margin-top: 0; font-size: 20px; line-height: 24px; font-weight: 700;">Please verify your account.</h3>
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; padding: 0 30px 20px;">
                <div style="width: 100%; background-color: #fafafa; border-radius: 8px; text-align: left; box-shadow: 0px 2px 8px 0px rgba(0, 7, 72, 0.12);">
                    <div style="width: 100%; display: flex; flex-flow: row; flex-wrap: wrap; padding: 12px 0; border-bottom: 1px solid #eaedf1;">
                        <div style="padding:0 16px; width: auto;">
                            <a href="{{$verifyLink}}"><button>
                                <p style="font-size: 15px; margin: 0; color: #616161;">Verify Account</p>
                            </button></a>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; padding: 15px 30px; border-top: 1px solid #eaedf1;">
                <p style="font-size: 14px; line-height: 20px; color: #888888; margin-bottom: 0px;">&copy; Job Portals. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>