<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $target_dir = "uploads/";  // Direktori lokal untuk menyimpan file sementara
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // File berhasil diunggah ke server lokal
        $ngrok_url = "https://8671-103-194-172-70.ngrok-free.app/predict";
        
        // Gunakan cURL untuk mengirim file ke endpoint Ngrok
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $ngrok_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'file' => new CURLFile($target_file)
            )
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
            echo "Error sending file to prediction service: " . $err;
        } else {
            echo "File sent successfully. Response: " . $response;
        }
        
        // Hapus file temporary jika diperlukan
        unlink($target_file);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
