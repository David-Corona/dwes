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

    public function __construct(string $table, string $classEntity)
    {
        $this->connection = APP::getConnection();
        $this->table = $table;
        $this->classEntity = $classEntity;
    }

    //nombre tabla de la que extraemos datos y nombre clase
    /**
     * @param string $table
     * @param string $classEntity
     * @return array
     * @throws QueryException
     */
    public function findAll() : array
    {
        $sql = "SELECT * from $this->table";

        $pdoStatement = $this->connection->prepare($sql);

        if ($pdoStatement->execute() === false)
        {
            throw new QueryException("No se ha podido ejecutar la query solicitada");
        }

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    public function save(IEntity $entity) : void
    {
        try
        {
            $parameters = $entity->toArray();
            $sql = sprintf(
                'INSERT into %s (%s) VALUES (%s)',
                $this->table,
                implode(', ', array_keys($parameters)),
                ':' . implode(', :', array_keys($parameters))
            );
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);
        }
        catch (PDOException $exception)
        {
            throw new QueryException('Error al insertar en la base de datos.');
        }
    }

}