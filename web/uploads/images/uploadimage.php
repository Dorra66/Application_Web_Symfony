<?php
 $imagename = $_POST['imagename'];
        $Imagecode =$_POST['image'];
        define('UPLOAD_DIR', 'C:/wamp/www/aloulou/web/images/users/tests/');
        $img = base64_decode($Imagecode);
        $uid = uniqid();
        $file = UPLOAD_DIR . $imagename . '.jpg';
        $success = file_put_contents($file, $img);
        if ($success) {
            echo json_encode(array('info' => $imagename . '.jpg'));
        } else {
            echo json_encode(array('info' => 'erreur'));
        }
		
		
?>		