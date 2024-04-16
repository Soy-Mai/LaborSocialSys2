<?php
require_once "Conectar.php";

class ControlUsuario extends conectar
{
    public function __construct(){
        parent::__construct();
    }

    public function Buscar_Cedula($Cedula){
        if (($result = $this->_db->query("SELECT * FROM usuario  where cedula like '$Cedula'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function Buscar_Correo($Correo){
        if (($result = $this->_db->query("SELECT * FROM usuario  where email like '$Correo'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function Buscar_Usuario($Usuario){
        if (($result = $this->_db->query("SELECT * FROM usuario  where usuario like '$Usuario'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function Buscar_Telefono($Telefono){
        if (($result = $this->_db->query("SELECT * FROM usuario  where telefono like '$Telefono'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function Buscar_UsuarioClave($Usuario, $Clave)
    {
        if (($result = $this->_db->query("SELECT * FROM usuario  where usuario like '$Usuario' and clave like '$Clave' ")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function set_users($Cedula, $Nombre, $Usuario, $Correo, $Clave, $Tipo, $Telefono ){
        
        if (($result = $this->_db->query("INSERT into usuario (cedula, nombre, usuario, email, clave, tipoUsuario, telefono, foto) values ('$Cedula', '$Nombre', '$Usuario', '$Correo', '$Clave', '$Tipo', '$Telefono', '../Files/ima1.jpg')")) == false) {
            printf("Error en la insercion");
            return false;
        }
        $this->_db->commit(); 
        return true;
    }

    public function VerificarCorreoUsuario($Correo, $Usuario){
        if (($result = $this->_db->query("SELECT * FROM usuario  where email like '$Correo' and usuario like '$Usuario'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function ActualizaClave($Clave, $Usuario){
        if (($result = $this->_db->query("UPDATE usuario Set clave = '$Clave' WHERE  usuario = '$Usuario'")) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function get_users_unico($Usuario){
        if (($result = $this->_db->query("SELECT * FROM usuario where usuario like '$Usuario'" )) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function get_experiencia($Usuario){
        if (($result = $this->_db->query("SELECT * FROM datosextras 
                                        inner join usuario on datosextras.usuario = usuario.usuario where usuario.usuario = '$Usuario' " )) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    
    public function get_nivel($Usuario){
        if (($result = $this->_db->query("SELECT * FROM nivel 
                                        inner join usuario on nivel.usuario = usuario.usuario where usuario.usuario = '$Usuario' " )) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function ActualizarDatosPersonales($destino, $Nombre, $Telefono, $Nivel, $Usuario){
        if (($result = $this->_db->query("UPDATE usuario
                                         INNER JOIN nivel
                                         ON(usuario.usuario = nivel.usuario)
                                         SET usuario.nombre = '$Nombre', usuario.telefono = '$Telefono', 
                                             nivelEducativo = '$Nivel',
                                             usuario.foto = '$destino'
                                         WHERE usuario.usuario = '$Usuario'")) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function set_experiencia($Usuario, $experiencia){
        
        if (($result = $this->_db->query("INSERT into datosextras (usuario, experiencia) values ('$Usuario', '$experiencia')")) == false) {
            printf("Error en la insercion");
            return false;
        }
        $this->_db->commit(); 
        return true;
    }

    public function get_experiencia_unica($Usuario,$IDExtra){
        if (($result = $this->_db->query("SELECT * FROM datosextras 
                                        where usuario = '$Usuario' and IDExtra = '$IDExtra'" )) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function eliminar_experiencia($ids){
        if (($result = $this->_db->query("DELETE FROM datosextras where IDExtra = '$ids'")) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_experiencia($ids, $experiencia){
        if (($result = $this->_db->query("UPDATE datosextras Set experiencia = '$experiencia'
                                           WHERE  IDExtra = $ids")) == true) {
            return true;
        } else {
            return false;
        }
    }
}