<?php
namespace App\Services;

use App\Services\DB;
use Cake\Database\Query;

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
        return DB::instance()->insert($this->table, $data, $types);
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
     * @param array $data
     * @return mixed
     */
    public function findByIdAndUpdate($id, array $data)
    {
        return $this->update($data, [$this->primaryKey => $id]);
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
     * @return Query
     */
    public function query(): Query
    {
        $this->statement = DB::instance()->newQuery()->from($this->table);

        if (!empty($this->fields)) {
            return $this->statement->select($this->fields);
        }

        return $this->statement;
    }

    /**
     * @param callable $callback
     * @param integer $page
     * @param integer $limit
     * @return array
     */
    public function paginate(callable $callback = null, int $page = 1, int $limit = 20): array
    {   
        $statement = $this->statement ?: $this->query()->select("*");

        if ($callback != null) {
            $statement = call_user_func($callback, $statement);
        }

        $prev     = $page - 1;
        $next     = $page + 1;
        $offset   = $prev * $limit;
        $paginate = $statement->limit($limit)->offset($offset)->execute();

        $results      = $paginate->fetchAll('assoc');
        $totalPages   = ceil($statement->execute()->rowCount() / $limit);
        $totalResults = $paginate->rowCount();
        $previousPage = $prev == 0 ? null : $prev;
        $nextPage     = $statement->execute()->rowCount() > $limit ? $next : null;

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
