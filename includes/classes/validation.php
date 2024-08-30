
<?php

class Validation
{
    // static array for allowed image extensions
    public static $allowedExtensions = [
        "jpg",
        "jpeg",
        "png",
        "gif",
        "txt",
    ];
    // Main function 
    public static function validate($values, $rules){
        $errors = array();
        $userdata = array();
        foreach ($rules as $dataName => $validation) {
            if (!is_array($values[$dataName])) {
                $valueOfDataName = htmlspecialchars($values[$dataName]);
            } else {
                $valueOfDataName = $values[$dataName];
            }
            foreach ($validation as $validateType => $value) {
                $methodName = 'validate' . ucfirst($validateType); 
                if (method_exists(__CLASS__, $methodName)) {
                    $data = self::$methodName($valueOfDataName, $value , $dataName);
                    if ($data) {
                        $errors[$dataName] = $data;
                    }   
                    else {
                        $datareturned[$dataName] = $valueOfDataName;  
                    }
                }
            }
        }
        if (!empty($errors)){
            return ['errors' => $errors];
        }
        else{
            return ['data' => $datareturned];
        }
    }
    // check if the value not empty
    public static function validateRequired($value , $ruleValue , $dataName){
        if ($ruleValue && mb_strlen($value) < 1):
            return "This field ( ". $dataName ." ) is required";
        endif;
    }
    public static function validateMin($value , $ruleValue , $dataName){
        if (mb_strlen($value) < $ruleValue){
            return "This field ( ".$dataName." ) has less than " . $ruleValue . " characters";
        }
    }
    public static function validateEmail($value , $ruleValue){
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)):
            return $value . " is not a valid email address";
        endif;
    }
    public static function validateMax($value , $ruleValue , $dataName){
        if (mb_strlen($value) > $ruleValue):
            return "This field (" .$dataName. ") has more than " . $ruleValue . " characters";
        endif;
    }
    public static function validateNumber($value , $ruleValue , $dataName){
        if (!is_numeric($value)){
            return $dataName . " value is not a number";
        }
    }
    // public function to validate unique values
    public static function validateUnique($connection , $tableName , $condition , $value){
        $checkValue = $connection -> prepare("SELECT * FROM $tableName $condition");
        $checkValue -> execute($value);
        if (($checkValue -> rowCount()) > 0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    /*
        ################################
        ## functions below for images ##
        ################################
        - validateUpload => to validate if there is file uploaded
        - validateExtension => to validate the image uploaded has an allowed extension
        - validateSize => to validate the image uploaded has a size less than allowed size
    */
    public static function validateUpload($value , $ruleValue , $dataName){
        if ($value['error'] != "0"){
            return "There was an error occured while uploading the file";
        }
    }
    public static function validateExtension($value , $ruleValue , $dataName){
        $fileInfo = pathinfo($value['name']);
        if (!isset($fileInfo['extension'])) {
            return "No extension found for the file.";
        }
        $imgExtension = strtolower($fileInfo['extension']);
        if (!in_array($imgExtension, self::$allowedExtensions)) {
            return "This extension ( " . $imgExtension . " ) is not allowed.";
        }
    }
    public static function validateSize($value , $ruleValue , $dataName){
        $imageSize = $value['size'];
        if (($imageSize / (1024 * 1024)) > $ruleValue){
            return "The image size is more than allowed, the size of image uploaded -> ( " . $ruleValue . " ).";
        }
    }
}
?>