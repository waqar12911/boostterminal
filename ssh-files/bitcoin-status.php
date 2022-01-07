<?php


set_include_path(get_include_path() . PATH_SEPARATOR . 'phpsec');
include('phpsec/Net/SSH2.php');
include('phpsec/File/ANSI.php');
include('phpsec/Crypt/RSA.php');


if(isset($_REQUEST['host']) && !empty($_REQUEST['host'])){
    if(isset($_REQUEST['port']) && !empty($_REQUEST['port'])){
        if(isset($_REQUEST['username']) && !empty($_REQUEST['username'])){
             if(isset($_REQUEST['password']) || $_FILES['key']){
                if(isset($_REQUEST['rpcusername']) && !empty($_REQUEST['rpcusername'])){
                    if(isset($_REQUEST['rpcpassword']) && !empty($_REQUEST['rpcpassword'])){
                    }else{
                        echo json_encode(array("code" =>400, "message" => "RPC Password is required"));
                        exit();
        
                    }
                }else{
                    echo json_encode(array("code" =>400, "message" => "RPC Username Required"));
                    exit();
    
                }
            }else{
                echo json_encode(array("code" =>400, "message" => "Password or key is required"));
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
$rpcusername = $_REQUEST['rpcusername'];
$rpcpassword = $_REQUEST['rpcpassword'];
$host = $_REQUEST['host'];
$port = $_REQUEST['port'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$key = $_FILES['key'];
$sshkeypw = $_REQUEST['sshkeypw'];


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
$ssh->write("bitcoin-cli -rpcuser=$rpcusername -rpcpassword=$rpcpassword -getinfo\n");
$ssh->setTimeout(1);
$ansi->loadString($ssh->read());
$output = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
if(strpos($output, 'version') !== false) {
    $res = 'up';
}else{
    $res = 'down';
}
$ssh->disconnect(); unset($ssh);
echo json_encode(array("code" =>200, "message" => $res));
exit(); 

    
?>