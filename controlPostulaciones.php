<?php
require_once "Conectar.php";

class controlPostulaciones extends conectar
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_postulaciones($Usuario){
        if (($result = $this->_db->query("SELECT * FROM postulaciones, usuario where 
                                        postulaciones.usuario  = '$Usuario' and 
                                        usuario.usuario = postulaciones.UserOrganizacion")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function get_postulacionesAceptadas($Usuario){
        if (($result = $this->_db->query("SELECT * FROM postulaciones, usuario where 
                                        postulaciones.usuario  = '$Usuario' and 
                                        usuario.usuario = postulaciones.UserOrganizacion and
                                        status = 'Aceptada'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function get_postulacionesRechazadas($Usuario){
        if (($result = $this->_db->query("SELECT * FROM postulaciones, usuario where 
                                        postulaciones.usuario  = '$Usuario' and 
                                        usuario.usuario = postulaciones.UserOrganizacion and
                                        status = 'Rechazada'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function get_postulados($Usuario){
        if (($result = $this->_db->query("SELECT * FROM usuario, postulaciones where 
                                         usuario.usuario = postulaciones.usuario and 
                                         postulaciones.UserOrganizacion  = '$Usuario' and status = 'Pendiente'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function get_postuladosLista(){
        if (($result = $this->_db->query("SELECT * FROM usuario where tipoUsuario = 'Voluntario'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function get_postuladosAceptados($Usuario){
        if (($result = $this->_db->query("SELECT * FROM postulaciones, usuario where 
                                         usuario.usuario = postulaciones.usuario and 
                                         postulaciones.UserOrganizacion  = '$Usuario' and
                                        status = 'Aceptada'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function get_postuladosRechazados($Usuario){
        if (($result = $this->_db->query("SELECT * FROM postulaciones, usuario where 
                                         usuario.usuario = postulaciones.usuario and 
                                         postulaciones.UserOrganizacion  = '$Usuario' and
                                        status = 'Rechazada'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function get_postulacion_unica($Usuario,$IDPostulaciones){
        if (($result = $this->_db->query("SELECT * FROM postulaciones, usuario 
                                        where postulaciones.usuario = '$Usuario' and 
                                              IDPostulaciones= '$IDPostulaciones' and
                                              usuario.usuario = postulaciones.UserOrganizacion" )) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function actualizar_fechaPostulacion($IDPostulaciones, $FechaIn, $FechaFin){
        if (($result = $this->_db->query("UPDATE postulaciones 
                                           Set fechaIn = '$FechaIn', fechafin = '$FechaFin'
                                           WHERE  IDPostulaciones = $IDPostulaciones")) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminar_postulacion($ids){
        if (($result = $this->_db->query("DELETE FROM postulaciones where IDPostulaciones = '$ids'")) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function get_organizaciones(){
        if (($result = $this->_db->query("SELECT * FROM usuario where tipoUsuario  = 'Organizacion'")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }

    public function get_organizacion_unica($Usuario){
        if (($result = $this->_db->query("SELECT * FROM usuario 
                                        where usuario = '$Usuario'" )) == true) {
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

     public function set_postulacion($Usuario, $FechaIn, $FechaFin, $Status, $UsuarioOrg){
        
        if (($result = $this->_db->query("INSERT into postulaciones (usuario, fechaIn, fechafin, status, UserOrganizacion) 
                                            values ('$Usuario', '$FechaIn', '$FechaFin', '$Status', '$UsuarioOrg')")) == false) {
            printf("Error en la insercion");
            return false;
        }
        $this->_db->commit(); 
        return true;
    }

    public function actualizar_statusPostulacionAceptada($IDPost){
        if (($result = $this->_db->query("UPDATE postulaciones Set status = 'Aceptada' 
                                            WHERE  IDPostulaciones = $IDPost")) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_statusPostulacionRechazada($IDPost){
        if (($result = $this->_db->query("UPDATE postulaciones Set status = 'Rechazada' 
                                            WHERE  IDPostulaciones = $IDPost")) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function get_postulacionLista(){
        if (($result = $this->_db->query("SELECT * FROM postulaciones ")) == true) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return false;
        }
    }
}