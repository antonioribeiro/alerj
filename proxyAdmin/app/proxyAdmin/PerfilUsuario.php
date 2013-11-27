<?php

class PerfilUsuario extends BaseModel {

	protected $primaryKey = ['id_usuario', 'id_perfil'];
	protected $connection = 'adm_user';
	protected $table = 'perfil_usuario';

}
