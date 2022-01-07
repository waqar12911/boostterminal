<?php


set_include_path(get_include_path() . PATH_SEPARATOR . 'phpsec');
include('phpsec/Net/SSH2.php');
include('phpsec/File/ANSI.php');
include('phpsec/Crypt/RSA.php');
include('phpsec/Net/SCP.php');

if(isset($_REQUEST['type']) && !empty($_REQUEST['type'])){
    if(isset($_REQUEST['host']) && !empty($_REQUEST['host'])){
        if(isset($_REQUEST['port']) && !empty($_REQUEST['port'])){
            if(isset($_REQUEST['username']) && !empty($_REQUEST['username'])){
                if(isset($_REQUEST['password']) && !empty($_REQUEST['password'])){
                }else{
                    echo json_encode(array("code" =>400, "message" => "Password Required"));
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





$type = $_REQUEST['type'];
$host = $_REQUEST['host'];
$port = $_REQUEST['port'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$sshkeypw = $_REQUEST['sshkeypw'];


// $type = 'start';
// $host = '98.226.215.246';
// $port = '41000';
// $username = 'routing-node-1';
// $password = 'bitcoin2020';
// $type = 'start';

if($type == 'start'){
    
    $ansi = new File_ANSI();
    $ssh = new Net_SSH2("$host", "$port");
    $scp = new Net_SCP($ssh);
    
    if (!$ssh->login("$username", "$password")) {
        echo json_encode(array("code" =>400, "message" => "Login Error"));
    }
    
     /** Generating public/private rsa key pair. */
    $ssh->setTimeout(1);
    $ssh->read();
    $ssh->write("ssh-keygen -t rsa -m pem\n");
    $ssh->setTimeout(1);
    $ansi->loadString($ssh->read());
    $first = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
        
        /** Enter in which to save the key, (home/routing-node-1/.ssh/id_rsa): */
        $ssh->setTimeout(1);
        $ssh->read();
        $ssh->write("\n");
        $ssh->setTimeout(3);
        $ansi->loadString($ssh->read());
        $sec = htmlspecialchars_decode(strip_tags($ansi->getScreen()));

         if(strpos($sec, 'already exists') !== false) {
             
                /** if key already exist then press y/n: */
                $ssh->write("y\n");
                $ssh->setTimeout(1);
                $ansi->loadString($ssh->read());
                $thir = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
                
               
        
                /** enter the passphrase or enter for empty: */
                 $ssh->write($sshkeypw . "\n");
                $ssh->setTimeout(1);
                $ansi->loadString($ssh->read());
                $forth = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
            
                 /** Enter same passphrase again: */
                $ssh->write($sshkeypw . "\n");
                $ssh->setTimeout(1);
                $ansi->loadString($ssh->read());
                $fifth = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
                
               /** our identification has been saved in ssh-keygen -t rsa -b 4096
                    Your public key has been saved in ssh-keygen -t rsa -b 4096.pub */
                //Now  
                /** copy the public private keys to the client system */
                $ssh->setTimeout(1);
                $ssh->read();
                $ssh->write("sudo ssh-copy-id -i ~/.ssh/id_rsa.pub $username@$host -p $port\n");
                $ssh->setTimeout(1);
                $ansi->loadString($ssh->read());
                $six = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
           
             /** Passoword for this user */
                $ssh->write($password . "\n");
                $ssh->setTimeout(1);
                $ansi->loadString($ssh->read());
                $seven = htmlspecialchars_decode(strip_tags($ansi->getScreen()));  
                
                 /** Passoword for this user */
                $ssh->write($password . "\n");
                $ssh->setTimeout(1);
                $ansi->loadString($ssh->read());
                $eight = htmlspecialchars_decode(strip_tags($ansi->getScreen()));  
              
              
                 /**Downlaodign the private public key*/
                $data = $scp->get("/home/".$username."/.ssh/id_rsa");
                $file= "private-key";
                file_put_contents($file, $data);
                header("Content-Type: text/html; charset=ISO-8859-1");
                header("Content-Disposition: attachment; filename={$file}");
                readfile($file);
                
         }else{
             
        /** enter the passphrase or enter for empty: */
        $ssh->write($sshkeypw . "\n");
        $ssh->setTimeout(1);
        $ansi->loadString($ssh->read());
        $third = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
        
      /** Enter same passphrase again: */
         $ssh->write($sshkeypw . "\n");
        $ssh->setTimeout(1);
        $ansi->loadString($ssh->read());
        $fourth = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
        
       
        /** copy the public private keys to the client system */
        $ssh->setTimeout(1);
        $ssh->read();
        $ssh->write("sudo ssh-copy-id -i ~/.ssh/id_rsa.pub $username@$host -p $port\n");
        $ssh->setTimeout(1);
        $ansi->loadString($ssh->read());
        $fifth = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
        
        if(strpos($fifth, 'YES/NO') !== false){
            
             /** Enter yes/No */
            $ssh->write("Yes\n");
            $ssh->setTimeout(1);
            $ansi->loadString($ssh->read());
            $c_p = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
        
        }
        $ssh->setTimeout(2);
        if(strpos($c_p, 'password:') !== false){
            
             /** Passoword for this user */
            $ssh->write($password . "\n");
            $ssh->setTimeout(1);
            $ansi->loadString($ssh->read());
            $c_pp = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
        
        }
        $ssh->setTimeout(2);
        if(strpos($c_pp, 'password for') !== false){
            
             /** Passoword for this user */
            $ssh->write($password . "\n");
            $ssh->setTimeout(1);
            $ansi->loadString($ssh->read());
            $six = htmlspecialchars_decode(strip_tags($ansi->getScreen()));
            $ssh->setTimeout(1);
        
        }
        
       
        /**Downlaodign the private public key*/
        $data = $scp->get("/home/".$username."/.ssh/id_rsa");
        $file= "private-key";
        file_put_contents($file, $data);
        header("Content-Type: text/html; charset=ISO-8859-1");
        header("Content-Disposition: attachment; filename={$file}");
        readfile($file);
       
        }

        
}else{
     echo json_encode(array("code" =>400, "message" => "Enter the Correct Type"));
     exit();
}


    
?>