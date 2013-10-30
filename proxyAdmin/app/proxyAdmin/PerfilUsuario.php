<?php

class PerfilUsuario extends Eloquent {

	protected $primaryKey = ['id_usuario', 'id_perfil'];
	protected $connection = 'adm_user';
	protected $table = 'perfil_usuario';

}
