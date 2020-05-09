<?php
        header('Access-Control-Allow-Origin: *');
        require_once 'mailer/class.phpmailer.php';
        $mail = new PHPMailer(true);
        if (isset($_GET['email'])) {
            if (isset($_GET['message'])) {
                $full_name = strip_tags($_GET['name']);
                $email = strip_tags($_GET['email']);
                $mobile = strip_tags($_GET['mobile']);
                $query = strip_tags($_GET['message']);
                $text_message = "<br /><br /> This e-mail was sent from a AU Grad School";
                $message = "<html><body>";
                $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
                $message .= "<tr><td>";
                $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
                $message .= "<thead>
						<tr height='80'>
							<th colspan='4' style='background-color:#113258; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >
							<img src='http://www.au.edu/images/logo/abac_logo_whiteL001.png' alt='AU Grad School' style='height:auto; width:auto;' />
							</th>
						</tr>
						</thead>";
                $message .= "<tbody><tr>
							<td colspan='4' style='padding:15px;border: 1px solid #ccc;'>
								<p style='font-size:15px;'><b>Name : </b>".$full_name."</p>
								<p style='font-size:15px;'><b>Email : </b>".$email."</p>
								<p style='font-size:15px;'><b>Mobile : </b>".$mobile."</p>
								<p style='font-size:15px;'><b>Message : </b>".$query."</p>
								<p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
							</td>
						</tr></tbody>";
                $message .= "</table>";
                $message .= "</td></tr>";
                $message .= "</table>";
                $message .= "</body></html>";
                try {
                    $mail->IsSMTP();
                    $mail->isHTML(true);
                    $mail->SMTPDebug = 0;
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = "ssl";
                    $mail->Host = "smtp.gmail.com";
                    $mail->Port = 465;
                    $mail->AddAddress('connect@rigpa.in');
                    $mail->AddAddress('vinoth@rigpa.in');
                    $mail->Username = "orvinothkumar@gmail.com";
                    $mail->Password = "vino15Raj@";
                    $mail->SetFrom('connect@rigpa.in', 'AU Grad School');
                    $mail->Subject = "Message from AU Grad School";
                    $mail->Body = $message;
                    $mail->AltBody = $message;
                    if ($mail->Send()) {
                        $msg = "Mail was successfully sent";
                        $status = "success";
                    }
                } catch (phpmailerException $ex) {
                    $msg = $ex->errorMessage();
                    $status = "error";
                }
                echo json_encode(array("status"=>$status,"msg"=>$msg));
            } else {
                $full_name  = strip_tags($_GET['name']);
                $email      = strip_tags($_GET['email']);
                $mobile    	= strip_tags($_GET['mobile']);
                $countrycode    = strip_tags($_GET['countrycode']);
                $countryname    = strip_tags($_GET['countryname']);
                $program    = strip_tags($_GET['program']);
                $text_message    = "<br /><br /> This e-mail was sent from a AU Grad School Mobile App";
                $message  = "<html><body>";

                $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";

                $message .= "<tr><td>";

                $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";

                $message .= "<thead>
						<tr height='80'>
							<th colspan='4' style='background-color:#113258; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >
							<img src='http://www.au.edu/images/logo/abac_logo_whiteL001.png' alt='AU Grad School' style='height:auto; width:auto;' />
							</th>
						</tr>
						</thead>";

                $message .= "<tbody>

						<tr>
							<td colspan='4' style='padding:15px;border: 1px solid #ccc;'>
								<p style='font-size:15px;'><b>Name : </b>".$full_name."</p>
								<p style='font-size:15px;'><b>Email : </b>".$email."</p>
								<p style='font-size:15px;'><b>Mobile : </b>".$mobile."</p>
								<p style='font-size:15px;'><b>Course interested in : </b>".$program."</p>
								<p style='font-size:15px;'><b>Country : </b>".$countryname."</p>
								<p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>".$text_message.".</p>
							</td>
						</tr>

						</tbody>";

                $message .= "</table>";

                $message .= "</td></tr>";
                $message .= "</table>";

                $message .= "</body></html>";
                try {
                    $mail->IsSMTP();
                    $mail->isHTML(true);
                    $mail->SMTPDebug  = 0;
                    $mail->SMTPAuth   = true;
                    $mail->SMTPSecure = "ssl";
                    $mail->Host       = "smtp.gmail.com";
                    $mail->Port       = 465;
                    if ($countrycode=='IN') {
                        $mail->AddAddress('connect@rigpa.in');
                        $mail->AddAddress('vinoth@rigpa.in');
                    } else {
                        $mail->AddAddress('gradadmission@au.edu');
                        $mail->AddAddress('grad@au.edu');
                        $mail->AddAddress('vinoth@rigpa.in');
                    }
                    $mail->Username   ="orvinothkumar@gmail.com";
                    $mail->Password   ="vino15Raj@";
                    $mail->SetFrom('connect@rigpa.in', 'AU Grad School');
                    $mail->Subject    = "Message from AU Grad School";
                    $mail->Body 	  = $message;
                    $mail->AltBody    = $message;
                    if ($mail->Send()) {
                        $msg = "Mail was successfully sent";
                        $status = "success";
                    }
                } catch (phpmailerException $ex) {
                    $msg = $ex->errorMessage();
                    $status = "error";
                }
                echo json_encode(array("status"=>$status,"msg"=>$msg));
            }
        } else {
            echo json_encode(array("status"=>"error","msg"=>"Invalid request"));
        }
