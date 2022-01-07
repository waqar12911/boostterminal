<?php


set_include_path(get_include_path() . PATH_SEPARATOR . 'phpsec');
include('phpsec/Net/SSH2.php');
include('phpsec/File/ANSI.php');
include('phpsec/Crypt/RSA.php');


if(isset($_REQUEST['type']) && !empty($_REQUEST['type'])){
    if(isset($_REQUEST['host']) && !empty($_REQUEST['host'])){
        if(isset($_REQUEST['port']) && !empty($_REQUEST['port'])){
            if(isset($_REQUEST['username']) && !empty($_REQUEST['username'])){
                if(isset($_REQUEST['password']) || $_FILES['key']){
                }else{
                    echo json_encode(array("code" =>400, "message" => "Password or key is Required"));
                    exit();

                }
                
            }else{
                echo json_encode(array("code" =>400, "message" => "Username Required"));
                exit();

            }
            
        }else{
            return json_encode(array("code" =>400, "message" => "Port Required"));
            exit();

        }
        
    }else{
        echo json_encode(array("code" =>400, "message" => "Host Required"));
        exit();

    }
    
}else{
    echo json_encode(array("code" =>400, "message" => "Type Required"));
    exit();
}
// $host = "98.226.215.246";
// $port = "41000";
// $username = "routing-node-1";
// $password = "bitcoin2020";
// $type = $_GET['type'];
$host = $_REQUEST['host'];
$port = $_REQUEST['port'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$type = $_REQUEST['type'];
$key = $_FILES['key'];
$sshkeypw = $_REQUEST['sshkeypw'];


if($type == 'upgrade'){
    
    
    $ansi = new File_ANSI();
    $ssh = new Net_SSH2($host,$port);
    
    if(!empty($password)){
        if (!$ssh->login($username, $password)) {
            echo json_encode(array("code" =>400, "message" => "Login Error"));
            exit();
        }
    }else{
        $k = new Crypt_RSA();
        $k->setPassword($sshkeypw);
        $k->loadKey(preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '',file_get_contents($_FILES["key"]["tmp_name"])));
        if (!$ssh->login($username, $k)) {
            echo json_encode(array("code" =>400, "message" => "Login Error key"));
            exit();
        }
    }
    
    
    $ssh->setTimeout(1);
    $ssh->read();
    $ssh->write("sudo upgrade\n");
    $ssh->setTimeout(1);
    $ansi->loadString($ssh->read());
    $output = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
    if(strpos($output, 'password for') !== false) {
        $ssh->write($password . "\n"); 
    }
    
    $ssh->setTimeout(5);
    $ansi->loadString($ssh->read());
    $output = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
    if(strpos($output, 'Do you want to continue?') !== false) {
        $ssh->write("Y" . "\n"); 
    }
    do {
        $ssh->setTimeout(5);
        $ansi->loadString($ssh->read());
        $res = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
    } while (strpos($res, 'Generating') !== false || strpos($res, 'newly installed') !== false);
    $ssh->setTimeout(5);
    $ssh->disconnect(); unset($ssh); 
    echo json_encode(array("code" =>200, "message" => "Upgrade done"));
    exit();

}
?>