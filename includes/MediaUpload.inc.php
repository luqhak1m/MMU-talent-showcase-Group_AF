<?php

function uploadMedia(string $user_id, ?string $input_name){

    if(!$input_name){
        $input_name=array_key_first($_FILES);
    }

    if(!isset($_FILES[$input_name]) || empty($_FILES[$input_name]['name'])){
        return null;
    }

    $upload_dir=__DIR__.'/../public/uploads/';
    $filename=$_FILES[$input_name]['name'];
    $extension=pathinfo($filename, PATHINFO_EXTENSION);
    $unique_name=$user_id.'_'.date('YmdHis').'.'.$extension;
    $target_file=$upload_dir.$unique_name;

    if(move_uploaded_file($_FILES[$input_name]['tmp_name'], $target_file)){
        return $unique_name;
    }else{
        error_log("[ERROR] Failed to upload file: $filename for user: $user_id");
        return null;
    }
}

?>