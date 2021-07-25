<?php
//Exception Class
$errorMessg=" ";
class customException extends Exception {
    public function errorMessage() {
        $errorMessg = ' In '.$this->getFile()
            .': <b>'.$this->getMessage().'</b> is not a valid E-Mail address';
        return $errorMsg;
    }
}

$email = "something@example...com";

try {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        throw new customException($email);
    }
}
catch (customException $e) {
    echo $e->errorMessage();
}
?>
<?php
$object = new customException();
echo $object->errorMessage();
?>