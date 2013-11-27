<?php

class DepartamentosController extends BaseController {

	private $departamento;

	public function __construct(Departamento $departamento)
	{
		$this->departamento = $departamento;
	}

	public function index($parent = null, $child = null)
	{
		if ($parent == null and $child == null)
		{
			$departamento = Usuario::find( Auth::user()->codigo_usuario )->departamento;

			if($departamento->sigla_departamento !== 'SDGI')
			{
				$parent = $departamento->codigo_departamento;
				$child = 'all';
			}
		}

		return $this->index2($parent, $child);
	}

	public function index2($parent = null, $child = null)
	{
		if($parent === 'all' and $child === 'all')
		{
			return Redirect::route('proxy', ['all','all']);
		}

		$departamentos = $this->departamento->getAll();

		$departamento = $this->departamento->findChildOrParent($parent, $child);

		if(is_null($parent))
		{
			$departamentos = $this->departamento->getAll();

			// kk($departamentos);

			return View::make('site.departamentos.index')
					->with('parent', $parent ?: 'all')
					->with('departamento', $departamento)
					->with('departamentos', $departamentos);
		}
		else
		{
			$departamentos = $this->departamento->getList($parent, $child);

			if(count($departamentos) > 0 and $child)
			{	
				return Redirect::route('usuarios', $child);
			}
		}

		if($departamento)
		{
			$parent = $departamento->codigo_departamento;
		}
		else
		{
			$parent = 'all';
		}

		return View::make('site.usuarios.index')
				->with('parent', $parent ?: 'all')
				->with('departamento', null)
				->with('departamentos', $departamentos);	
	}

}

// drop procedure dbo.hierarquia_departamental;

// execute dbo.hierarquia_departamental 1;

// CREATE PROCEDUER dbo.hierarquia_departamental

// ALTER PROC dbo.hierarquia_departamental
// (
// 	@Root int
// )
// AS
// BEGIN
// 	SET NOCOUNT ON
// 	DECLARE @codigo_departamento_atual int, @codigo_departamento int, @nome_departamento varchar(255), @sigla_departamento varchar(20)

// 	SET @codigo_departamento_atual = (SELECT codigo_departamento FROM dbo.departamento WHERE codigo_departamento = @Root and status = 'A')
// 	SET @sigla_departamento = (SELECT sigla_departamento FROM dbo.departamento WHERE codigo_departamento = @Root and status = 'A')
// 	SET @nome_departamento = (SELECT nome_departamento FROM dbo.departamento WHERE codigo_departamento = @Root and status = 'A')
	
// 	SELECT @codigo_departamento_atual as codigo_departamento, @sigla_departamento as sigla_departamento, @nome_departamento as nome_departamento, @@NESTLEVEL as nivel

// 	SET @codigo_departamento = (SELECT MIN(codigo_departamento) FROM dbo.departamento WHERE departamento_superior_id = @Root and status = 'A')

// 	WHILE @codigo_departamento IS NOT NULL
// 	BEGIN
// 		EXEC dbo.hierarquia_departamental @codigo_departamento
// 		SET @codigo_departamento = (SELECT MIN(codigo_departamento) FROM dbo.departamento WHERE departamento_superior_id = @Root AND codigo_departamento > @codigo_departamento and status = 'A')
// 	END
// END
// GO


// execute dbo.hierarquia_departamental 1;

// IF OBJECT_ID('tempdb..#tmp', 'U') IS NOT NULL DROP TABLE #tmp;
// CREATE TABLE #tmp (codigo_departamento int, sigla_departamento varchar(20), nome_departamento varchar(255), nivel int);

// INSERT INTO  #tmp (codigo_departamento, sigla_departamento, nome_departamento, nivel) EXEC dbo.hierarquia_departamental 1;

// select * from #TMP;


// select * from usuario where nome_windows_usuario = 'rschneid'

// select * from usuario where nome_windows_usuario = 'mcmachado'

// select * from usuario where nome_windows_usuario = 'afaria'

// mauro = 3515
// schneider = 447
// afaria = 23

// select * from perfil_funcao order by data_atribuicao desc

// select * from perfil_usuario order by data_atribuicao desc

// select * from perfil order by data_atribuicao desc

// insert into perfil_usuario (id_usuario, id_perfil, ID_USUARIO_ATRIBUICAO, DATA_ATRIBUICAO) values (447, 48, 23, CURRENT_TIMESTAMP)
// insert into perfil_usuario (id_usuario, id_perfil, ID_USUARIO_ATRIBUICAO, DATA_ATRIBUICAO) values (3515, 48, 23, CURRENT_TIMESTAMP)

