<?php
namespace App\Services\Database;

use App\Services\Database\DB;
use Cake\Database\Query;
use Cake\Database\Statement\StatementDecorator;

abstract class AbstractModel
{
    /** @var string $table */
    protected $table;

    /** @var string $primaryKey */
    protected $primaryKey = "id";

    /** @var array $fields  */
    protected $fields;

    /** @var array $data */
    private $data;

    /** @var Query $statement */
    private $statement;

    public function __set($name, $value)
    {
        $this->data[trim($name)] = $value;
    }

    public function __call($name, $arguments)
    {
        $scopeMethodName = "scope" . ucfirst($name);

        if (method_exists($this, $scopeMethodName)) {
            return $this->$scopeMethodName($this->statement ?: $this->query(), ...$arguments);
        }
    }

    /**
     * @return mixed
     */
    public function save()
    {
        if (isset($this->data[$this->primaryKey])) {
            $primaryKey = $this->data[$this->primaryKey];

            return $this->findByIdAndUpdate($primaryKey, $this->data);
        }

        return $this->create($this->data);
    }

    /**
     * @param array $data
     * @param array $types
     * @return mixed
     */
    public function create(array $data, array $types = [])
    {
        $insertedData = DB::instance()->insert($this->table, $data, $types);
        $driver       = DB::instance()->getDriver();
        $decorator    = new StatementDecorator($insertedData, $driver);
        $id           = $decorator->lastInsertId($this->table, $this->primaryKey);
        return $this->findById($id, "*");
    }

    /**
     * @param array $data
     * @param array $conditions
     * @param array $types
     * @return mixed
     */
    public function update(array $data, array $conditions, array $types = [])
    {
        return DB::instance()->update($this->table, $data, $conditions, $types);
    }

    /**
     * @param array $conditions
     * @param array $types
     * @return mixed
     */
    public function delete(array $conditions, array $types = [])
    {
        return DB::instance()->delete($this->table, $conditions, $types);
    }

    /**
     * @param mixed $id
     * @param string|array $fields
     * @return mixed
     */
    public function findById($id, $fields = null)
    {
        $statement = $this->query(empty($fields));

        if (!empty($fields)) {
            $statement->select($fields);
        }

        return $statement
            ->where([$this->primaryKey => $id])
            ->execute()
            ->fetch("assoc");
    }

    /**
     * @param mixed $conditions
     * @param array $types
     * @param string|array $fields
     * @return mixed
     */
    public function findOne($conditions = null, array $types = [], $fields = null)
    {
        $statement = $this->query(empty($fields));

        if (!empty($fields)) {
            $statement->select($fields);
        }

        return $statement
            ->where($conditions, $types)
            ->execute()
            ->fetch("assoc");
    }

    /**
     * @param mixed $conditions
     * @param array $types
     * @param string|array $fields
     * @param callable $query
     * @return array
     */
    public function getAll($conditions = null, array $types = [], $fields = null, callable $query = null): array
    {
        $statement = $this->query(empty($fields))->where($conditions, $types);

        if (!empty($fields)) {
            $statement->select($fields);
        }

        if (!empty($query)) {
            $statement = call_user_func($query, $statement);
        }

        return $statement->execute()->fetchAll("assoc");
    }

    /**
     * @param mixed $id
     * @param array $data
     * @return mixed
     */
    public function findByIdAndUpdate($id, array $data)
    {
        $this->update($data, [$this->primaryKey => $id]);
        return $this->findById($id, "*");
    }

    /**
     * @param mixed $id
     * @return mixed
     */
    public function findByIdAndDelete($id)
    {
        return $this->delete([$this->primaryKey => $id]);
    }

    /**
     * @param bool $useFields
     * @return Query
     */
    public function query(bool $useFields = true): Query
    {
        $this->statement = DB::instance()->newQuery()->from($this->table);

        if (!empty($this->fields) && $useFields === true) {
            return $this->statement->select($this->fields);
        }

        return $this->statement;
    }

    /**
     * @param integer $page
     * @param integer $limit
     * @param string|array $fields
     * @param callable $callback
     * @return array
     */
    public function paginate(int $page = 1, int $limit = 20, $fields = null, callable $callback = null): array
    {
        $statement = $this->statement ?: $this->query(empty($fields));

        if (!empty($fields)) {
            $statement->select($fields);
        }

        if ($callback != null) {
            $statement = call_user_func($callback, $statement);
        }

        $prev     = $page - 1;
        $next     = $page + 1;
        $offset   = $prev * $limit;
        $rowCount = $statement->execute()->rowCount();
        $paginate = $statement->limit($limit)->offset($offset)->execute();

        $totalPages   = ceil($rowCount / $limit);
        $results      = $paginate->fetchAll('assoc');
        $totalResults = $paginate->rowCount();
        $previousPage = $prev == 0 ? null : $prev;
        $nextPage     = $rowCount > $limit && $next <= $totalPages ? $next : null;

        return [
            'page'          => $page,
            'results'       => $results,
            'total_pages'   => $totalPages,
            'total_results' => $totalResults,
            'previous_page' => $previousPage,
            'next_page'     => $nextPage,
        ];
    }
}
