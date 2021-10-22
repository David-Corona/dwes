<?php
require_once __DIR__ . '/../exceptions/QueryException.php';
require_once __DIR__ . '/../core/App.php';

abstract class QueryBuilder
{
    /**
     * @var PDO
     */
    private $connection;
    /**
     * @var string
     */
    private $table;
    /**
     * @var string
     */
    private $classEntity;

    /**
     * @param string $table
     * @param string $classEntity
     * @throws AppException
     */
    public function __construct(string $table, string $classEntity)
    {
        $this->connection = APP::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }

    /**
     * @param string $sql
     * @return array
     * @throws QueryException
     */
    private function executeQuery(string $sql): array
    {
        $pdoStatement = $this->connection->prepare($sql);
        if ($pdoStatement->execute() === false)
        {
            throw new QueryException("No se ha podido ejecutar la query solicitada");
        }
        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    //nombre tabla de la que extraemos datos y nombre clase

    /**
     * @return array
     * @throws QueryException
     */
    public function findAll() : array
    {
        $sql = "SELECT * from $this->table";
        return $this->executeQuery($sql);
    }

    /**
     * @param int $id
     * @return IEntity
     * @throws NotFoundException
     * @throws QueryException
     */
    public function find(int $id): IEntity
    {
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        $result = $this->executeQuery($sql);
        if (empty($result))
            throw new NotFoundException("No se ha encontrado ningún elemento con id $id");
        return $result[0];
    }

    /**
     * @param IEntity $entity
     * @throws QueryException
     */
    public function save(IEntity $entity) : void
    {
        try
        {
            $parameters = $entity->toArray();
            print_r($parameters);
            $sql = sprintf(
                'INSERT into %s (%s) VALUES (%s)',
                $this->table,
                implode(', ', array_keys($parameters)),
                ':' . implode(', :', array_keys($parameters))
            );
            echo $sql;
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
        }
        catch (PDOException $exception)
        {
            throw new QueryException('Error al insertar en la base de datos.');
        }
    }

    /**
     * @param array $parameters
     * @return string
     */
    private function getUpdates(array $parameters)
    {
        $updates = '';
        foreach ($parameters as $key => $value) //recorrer los parametros
        {
            if ($key !== 'id') //siempre que no sea el id
            {
                if($updates !== '') //se une con comas siempre que no sea el primero
                    $updates .= ', ';
                $updates .= $key . '=:' . $key; //genera el parametro nombre=:nombre
            }
        }
        return $updates;
    }

    public function update(IEntity $entity):void
    {
        try
        {
            $parameters = $entity->toArray();
            $sql = sprintf(
                'UPDATE %s SET %s WHERE id=:id',
                $this->table,
                $this->getUpdates($parameters)
            );
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
        }
        catch (PDOException $pdoException)
        {
            throw new QueryException('Error al actualizar el elemento con id ' . $parameters['id']);
        }
    }

    //para que se ejecuten todas las queries, o ninguna. Si hay algun error, se irá al catch
    public function executeTransaction(callable $fnExecuteQuerys)
    {
        try
        {
            $this->connection->beginTransaction(); //inicia transacción
            $fnExecuteQuerys(); //ejecuta todos los queries
            $this->connection->commit(); //confirma los cambios
        }
        catch (PDOException $pdoException)
        {
            $this->connection->rollBack(); //deshace todos los cambios realizados desde beginTransaction. Si hay error, nada.
            throw new QueryException("No se ha podido realizar la operacion.");
        }
    }

}