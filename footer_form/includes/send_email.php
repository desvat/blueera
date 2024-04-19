<?php
    header('Content-Type: application/json');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $fromEmail = $_POST["email"];
        $fromMessage = $_POST["message"];
        
        $message  = '<div style="padding: 50px;">';
        $message .= '<div style="margin-bottom: 10px;">';
        $message .= 'Od: ' . $fromEmail;
        $message .= '</div>';
        $message .= '<div>';
        $message .= 'Správa: ' . $fromMessage;
        $message .= '</div>';
        $message .= '</div>';
        
        $to = "info@tramy.sk";
        $subject = "Máte novú správu [Tramy.sk]";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <info@tramy.sk>' . "\r\n";


        mail($to,$subject,$message,$headers);
        
        echo json_encode(["message" => "E-mail bol úspešne odoslaný"]);
        
    } else {
        http_response_code(405);
        echo json_encode(["error" => "Chyba: Nesprávny typ požiadavky"]);
    }
?>
