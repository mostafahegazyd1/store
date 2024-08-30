<?php
include "crud.php";
class Products extends Crud
{
    public function moveUploadedFile($tmpName , $targetFile){
        if (move_uploaded_file($tmpName, $targetFile)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
?>