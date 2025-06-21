<?php

function uploadMedia(string $user_id, ?string $input_name){ // params: user_id and htmp input id
    echo "[INFO] Uploading file <br>";

    if(!$input_name){
        echo "[INFO] No input name <br>";
        $input_name=array_key_first($_FILES);
    }

    if(!isset($_FILES[$input_name]) || empty($_FILES[$input_name]['name'])){
        echo '[INFO] No $_FILES[$input_name] <br>';
        return null;
    }

    $upload_dir=__DIR__.'/../public/uploads/';
    if(!is_dir($upload_dir)){
        if(!mkdir($upload_dir, 0755, true)) {
            echo "[ERROR] Failed to create upload directory: $upload_dir<br>";
            return null;
        }
    }

    if(!is_writable($upload_dir)){ // double check file permisison
        echo "[ERROR] Upload directory is not writable: $upload_dir<br>";
        return null;
    }

    $filename=$_FILES[$input_name]['name'];
    $extension=pathinfo($filename, PATHINFO_EXTENSION);
    $unique_name=$user_id.'_'.date('YmdHis').'.'.$extension;
    $target_file=$upload_dir.$unique_name;

    echo $target_file."<br>";

    if(move_uploaded_file($_FILES[$input_name]['tmp_name'], $target_file)){
        echo "[INFO] File uploaded yeay <br>";
        return $unique_name;
    }else{
        echo "[ERROR] Failed to upload file: $filename for user: $user_id <br>";
        return null;
    }
}

?>