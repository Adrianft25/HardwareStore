<?php
class Usuario {

     public function loginUsuarios ($usuariomailga,$passuga,$secret) {

          $BBDD = conexionBD();
          $passencrypt = hash('sha256', $passuga);

          $sqlga = $BBDD->prepare("SELECT idusuarioga FROM usuariosga WHERE nameuga=:usuarioga AND passuga=:hash_password");  
          
          $sqlga->bindParam("usuarioga", $usuariomailga,PDO::PARAM_STR) ;
          $sqlga->bindParam("hash_password", $passencrypt,PDO::PARAM_STR) ;
          
          $sqlga->execute();
          
          $count = $sqlga->rowCount();
          $data = $sqlga->fetch(PDO::FETCH_OBJ);
          
          $BBDD = null;
          
          if ($count) {
               $_SESSION['idusuarioga'] = $data->idusuarioga;
               $_SESSION['codigouga'] = $codigouga;
               return true;
          } else {
               return false;
          }    
     }

     public function registroUsuarios ($nameuga,$passuga,$mailuga,$teluga,$secret) {
          try {
               $BBDD = conexionBD();
               
               $sqlga = $BBDD->prepare("SELECT idusuarioga FROM usuariosga WHERE nameuga=:nameuga OR mailuga=:mailuga");  
               
               $sqlga->bindParam("nameuga", $nameuga,PDO::PARAM_STR);
               $sqlga->bindParam("mailuga", $mailuga,PDO::PARAM_STR);
               
               $sqlga->execute();
               
               $count = $sqlga->rowCount();
               
               if ($count < 1) {
                    $sqlga = $BBDD->prepare("INSERT INTO usuariosga (nameuga, passuga, mailuga, teluga, codigouga) VALUES (:nameuga,:hash_password,:mailuga,:teluga,:codigouga)");  
                    
                    $sqlga->bindParam("nameuga", $nameuga,PDO::PARAM_STR) ;
                    $passencrypt= hash('sha256', $passuga);
                    $sqlga->bindParam("hash_password", $passencrypt,PDO::PARAM_STR) ;
                    $sqlga->bindParam("mailuga", $mailuga,PDO::PARAM_STR) ;
                    $sqlga->bindParam("teluga", $teluga,PDO::PARAM_STR) ;
                    $sqlga->bindParam("codigouga", $secret,PDO::PARAM_STR) ;
                    
                    $sqlga->execute();
                    
                    $idusuarioga = $BBDD->lastInsertId();
                    
                    $BBDD = null;
                    
                    $_SESSION['idusuarioga'] = $idusuarioga;
                    
                    return true;

               } else {
                    $BBDD = null;
                    return false;
               }
          
         
          } catch (PDOException $e) {
               echo "Algo salió mal :(". $e->getMessage();
          }
     }
     
     public function detallesUsuarios($idusuarioga) {
          try {
               $BBDD = conexionBD();

               $sqlga = $BBDD->prepare("SELECT nameuga, mailuga, teluga, codigouga FROM usuariosga WHERE idusuarioga=:idusuarioga");

               $sqlga->bindParam("idusuarioga", $idusuarioga,PDO::PARAM_INT);
               
               $sqlga->execute();
               
               $data = $sqlga->fetch(PDO::FETCH_OBJ);
               
               return $data;
          } catch (PDOException $e) {
               echo "Algo salió mal :(". $e->getMessage();
          }
     }
}
?>