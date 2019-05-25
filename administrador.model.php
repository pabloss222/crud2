<?php
class AdministradorModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost:3306;dbname=acad', 'utec', 'utec');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM administrador");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$vo = new Administrador();

				$vo->__SET('id', $r->id);
				$vo->__SET('nombre', $r->nombre);
				$vo->__SET('login', $r->login);
				$vo->__SET('clave', $r->clave);

				$result[] = $vo;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM administrador WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$vo = new Administrador();

			$vo->__SET('id', $r->id);
			$vo->__SET('nombre', $r->nombre);
			$vo->__SET('Login', $r->Login);
			$vo->__SET('Clave', $r->Clave);
			

			return $vo;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM administrador WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Administrador $data)
	{
		try 
		{
			$sql = "UPDATE administrador SET 
			            nombre         =?,
						Login          = ?, 
						Clave        = ?	 
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('nombre'),
					$data->__GET('Login'), 
					$data->__GET('Clave'), 
					$data->__GET('id')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Administrador $data)
	{
		try 
		{
		$sql = "INSERT INTO administrador (nombre,Login,Clave) 
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('nombre'),
				$data->__GET('Login'), 
				$data->__GET('Clave') 
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

?>