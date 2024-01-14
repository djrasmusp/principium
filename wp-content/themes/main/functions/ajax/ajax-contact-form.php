<?php

add_action("wp_ajax_send_contact_form", "send_contact_form");
add_action("wp_ajax_nopriv_send_contact_form", "send_contact_form");
function send_contact_form()
{
    $to = get_field('contact_form_email', 'option');

    if (!($_REQUEST['_wpnonce']) && wp_verify_nonce($_REQUEST['_wpnonce'], 'send_send_contact_form')) {
        wp_send_json_error("Security Check", 500);
        wp_die();
    }

    if (!empty($_POST['firstname'])) {
        wp_die();
    }

    if (!$to) {
        wp_send_json_error("No E-mail set", 500);
        wp_die();
    }

    $name = sanitize_text_field($_POST["tn-name"]);
    $organizer = (isset($_POST['tn-organizer'])) ? sanitize_text_field($_POST["tn-organizer"]) : null;
    $email = sanitize_email($_POST["tn-email"]);
    $phone = sanitize_text_field($_POST["tn-phone"]);
    $artist = (isset($_POST['tn-artist'])) ? sanitize_text_field($_POST["tn-artist"]) : null;
    $date = (isset($_POST['tn-date'])) ? sanitize_text_field($_POST["tn-date"]) : null;
    $location = (isset($_POST['tn-location'])) ? sanitize_text_field($_POST["tn-location"]) : null;
    $comments = sanitize_text_field($_POST["tn-comments"]);

    $subject = ($date) ? $artist . " - Artist request - " . get_bloginfo('name') : 'Contact Form - ' . get_bloginfo('name');
    $headers[] = "Content-Type: text/html; charset=UTF-8";
    $headers[] = "From: " . $name . "<" . $email . ">";
    $headers[] = "Reply-To: " . $name . "<" . $email . ">";

    $body = '<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="x-apple-disable-message-reformatting">
	<title></title>
	<!--[if mso]> 
<noscript> 
<xml> 
<o:OfficeDocumentSettings> 
<o:PixelsPerInch>96</o:PixelsPerInch> 
</o:OfficeDocumentSettings> 
</xml> 
</noscript> 
<![endif]-->
</head>
<body>';

    $body .= "<p>This mail is from " . wp_get_theme()->get('Name') . ":</p>";

    $body .= "<p><strong>Artist:</strong> " . $artist . "</p>";

    $body .= "<p><strong>Name:</strong> " . $name . "</p>";

    if (!empty($organizer)) {
        $body .= "<p><strong>Organizer:</strong> " . $organizer . "</p>";
    }

    $body .= "<p><strong>Email:</strong> " . $email . "</p>";

    $body .= "<p><strong>Phone:</strong> " . $phone . "</p>";

    if (!empty($date)) {
        $body .= "<p><strong>Date:</strong> " . date_i18n("j. F Y", strtotime($date)) . "</p>";
    }

    if (!empty($location)) {
        $body .= "<p><strong>Location:</strong> " . $location . "</p>";
    }

    if (!empty($comments)) {
        $body .= "<p><strong>Comments:</strong> " . $comments . "</p>";
    }

    $body .= "</body></html>";

    $body = '<!DOCTYPE html PUBLIC " -//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" style="background:#f4f4f5!important"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width">';
    $body .= '<title>' . $subject . '</title>';
    $body .= '<style>@media only screen {
        html {
            min-height: 100%;
            background: #f4f4f5
        }
    }

    @media only screen and (max-width: 596px) {
        table.body img {
            width: auto;
            height: auto
        }

        table.body center {
            min-width: 0 !important
        }

        table.body .container {
            width: 95% !important
        }

        table.body .columns {
            height: auto !important;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding-left: 16px !important;
            padding-right: 16px !important
        }

        th.small-6 {
            display: inline-block !important;
            width: 50% !important
        }

        th.small-12 {
            display: inline-block !important;
            width: 100% !important
        }
    }</style>
</head>
<body style="-moz-box-sizing:border-box;-ms-text-size-adjust:100%;-webkit-box-sizing:border-box;-webkit-text-size-adjust:100%;Margin:0;background:#f4f4f5!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">
<span class="preheader"
      style="color:#f4f4f5;display:none!important;font-size:1px;line-height:1px;max-height:0;max-width:0;mso-hide:all!important;opacity:0;overflow:hidden;visibility:hidden"></span>
<table class="body"
       style="Margin:0;background:#f4f4f5!important;border-collapse:collapse;border-spacing:0;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;height:100%;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
    <tr style="padding:0;text-align:left;vertical-align:top">
        <td class="center" align="center" valign="top"
            style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
            <center style="width:100%">
                <table align="center" class="spacer float-center"
                       style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                    <tbody>
                    <tr style="padding:0;text-align:left;vertical-align:top">
                        <td height="16"
                            style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:16px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                            &nbsp;
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table align="center" class="container header float-center"
                       style="Margin:0 auto;background:#222;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px">
                    <tbody>
                    <tr style="padding:0;text-align:left;vertical-align:top">
                        <td style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                            <table class="row"
                                   style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <th class="small-6 large-6 columns first" valign="middle"
                                        style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0 auto;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0 auto;padding:0;padding-bottom:32px;padding-left:16px;padding-right:16px;padding-top:32px;text-align:left;vertical-align:middle;width:274px;word-wrap:break-word">
                                        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                            <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">';
    $body .= '<h1 style="Margin:0;Margin-bottom:10px;color:#fefefe;font-family:Helvetica,Arial,sans-serif;font-size:34px;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left;word-wrap:normal">' . get_bloginfo('name') . '</h1>';
    $body .= '</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </th>
                                    <th class="logo small-6 large-6 columns last" valign="middle"
                                        style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0 auto;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0 auto;padding:0;padding-bottom:32px;padding-left:16px;padding-right:16px;padding-top:32px;text-align:left;vertical-align:middle;width:274px;word-wrap:break-word">
                                        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                            <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;float:right;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">';
    $body .= '<img src="' . wp_get_attachment_url(get_field("logo", "option"), "medium") . '" height="64px"
                                                         style="-ms-interpolation-mode:bicubic;clear:both;display:block;max-width:100%;outline:0;text-decoration:none;width:auto">';
    $body .= '</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table align="center" class="container float-center"
                       style="Margin:0 auto;background:#fefefe;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:580px">
                    <tbody>
                    <tr style="padding:0;text-align:left;vertical-align:top">
                        <td style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                            <table class="spacer"
                                   style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <td height="32"
                                        style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:32px;font-weight:400;hyphens:auto;line-height:32px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                        &nbsp;
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="row"
                                   style="border-collapse:collapse;border-spacing:0;display:table;padding:0;position:relative;text-align:left;vertical-align:top;width:100%">
                                <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <th class="small-12 large-12 columns first last"
                                        style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0 auto;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0 auto;padding:0;padding-bottom:16px;padding-left:16px;padding-right:16px;text-align:left;vertical-align:top;width:564px;word-wrap:break-word">
                                        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                            <tbody>
                                            <tr style="padding:0;text-align:left;vertical-align:top">
                                                <th style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">';
    $body .= '<p class="text-center small"
                                                       style="Margin:0;Margin-bottom:10px;color:#cacaca;font-family:Helvetica,Arial,sans-serif;font-size:80%;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:center">
                                                        This mail is from ' . get_bloginfo('name') . '</p>';
    $body .= '<p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                        <strong>Name :</strong> ' . $name . '</p>';
    $body .= '<p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                        <strong>E-mail :</strong> <a href="mailto:' . $email . '" style="Margin:default;color:#2199e8;font-family:Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:default;padding:0;text-align:left;text-decoration:none">' . $email . '</a></p>';
    $body .= '<p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                        <strong>Phone :</strong> ' . $phone . '</p>';

    if ($artist){
        $body .= '<table class="spacer"
                                                           style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="16"
                                                                style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:16px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>';
        $body .= '<p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                        <strong>Regarding artist :</strong> '. $artist .'</p>';
        $body .= '<table class="spacer"
                                                           style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="8"
                                                                style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:8px;font-weight:400;hyphens:auto;line-height:8px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>';
    }

    if ($date){
        $body .= '<p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                        <strong>Date :</strong> '. $date .'</p>';
    }

    if($organizer){
        $body .= '<p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                        <strong>Organizer :</strong> '. $organizer .'</p>';
    }

    if($location){
        $body .= '<p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                        <strong>Location :</strong><br>'. nl2br($location) .'</p>';
    }

    $body .= '<table class="spacer" style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="8"
                                                                style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:8px;font-weight:400;hyphens:auto;line-height:8px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>';

    $body .= '<p style="Margin:0;Margin-bottom:10px;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:1.3;margin:0;margin-bottom:10px;padding:0;text-align:left">
                                                        <strong>Comment :</strong><br>' . nl2br($comments) . '</p>';

    $body .= '<table class="spacer"
                                                           style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                        <tbody>
                                                        <tr style="padding:0;text-align:left;vertical-align:top">
                                                            <td height="16"
                                                                style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:16px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                                                                &nbsp;
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </th>
                                                <th class="expander"
                                                    style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:1.3;margin:0;padding:0!important;text-align:left;vertical-align:top;visibility:hidden;width:0;word-wrap:break-word"></th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table align="center" class="spacer float-center"
                       style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                    <tbody>
                    <tr style="padding:0;text-align:left;vertical-align:top">
                        <td height="16"
                            style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:16px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                            &nbsp;
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table align="center" class="spacer float-center"
                       style="Margin:0 auto;border-collapse:collapse;border-spacing:0;float:none;margin:0 auto;padding:0;text-align:center;vertical-align:top;width:100%">
                    <tbody>
                    <tr style="padding:0;text-align:left;vertical-align:top">
                        <td height="16"
                            style="-moz-box-sizing:border-box;-moz-hyphens:auto;-webkit-box-sizing:border-box;-webkit-hyphens:auto;Margin:0;border-collapse:collapse!important;box-sizing:border-box;color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;hyphens:auto;line-height:16px;margin:0;mso-line-height-rule:exactly;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                            &nbsp;
                        </td>
                    </tr>
                    </tbody>
                </table>
            </center>
        </td>
    </tr>
</table><!-- prevent Gmail on iOS font size manipulation -->
<div style="display:none;white-space:nowrap;font:15px courier;line-height:0">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
</div>
</body>
</html>';


    wp_mail($to, $subject, $body, $headers);

    wp_send_json_success("<p class='mt-2 text-sm text-page-text'>" . __("Tak for din henvendelse. Du hører snart fra os.", "main-theme") . "</p>");
    wp_die();

}