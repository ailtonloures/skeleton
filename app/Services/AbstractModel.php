<?php
namespace App\Services;

use App\Services\DB;
use Cake\Database\Query;
use Cake\Database\StatementInterface;

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

    public function __set($name, $value)
    {
        $this->data[trim($name)] = $value;
    }

    /**
     * @return StatementInterface
     */
    public function save(): StatementInterface
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
     * @return StatementInterface
     */
    public function create(array $data, array $types = []): StatementInterface
    {
        return DB::instance()->insert($this->table, $data, $types);
    }

    /**
     * @param array $data
     * @param array $conditions
     * @param array $types
     * @return StatementInterface
     */
    public function update(array $data, array $conditions, array $types = []): StatementInterface
    {
        return DB::instance()->update($this->table, $data, $conditions, $types);
    }

    /**
     * @param array $conditions
     * @param array $types
     * @return StatementInterface
     */
    public function delete(array $conditions, array $types = []): StatementInterface
    {
        return DB::instance()->delete($this->table, $conditions, $types);
    }

    /**
     * @param mixed $id
     * @param array $data
     * @return StatementInterface
     */
    public function findByIdAndUpdate($id, array $data): StatementInterface
    {
        return $this->update($data, [$this->primaryKey => $id]);
    }

    /**
     * @param mixed $id
     * @return StatementInterface
     */
    public function findByIdAndDelete($id): StatementInterface
    {
        return $this->delete([$this->primaryKey => $id]);
    }

    /**
     * @return Query
     */
    public function query(): Query
    {   
        $query = DB::instance()->newQuery()->from($this->table);

        if (!empty($this->fields)) {
            return $query->select($this->fields);
        }

        return $query;
    }

    /**
     * @param integer $page
     * @param integer $limit
     * @return array
     */
    public function paginate(int $page = 1, int $limit = 20): array
    {   
        $query = $this->query();

        $prev = $page - 1;
        $next = $page + 1;
        $offset = $prev * $limit;
        $paginate = $query->limit($limit)->offset($offset)->execute();

        $results = $paginate->fetchAll('assoc');
        $totalPages = ceil($query->execute()->rowCount() / $limit);
        $totalResults = $paginate->rowCount();
        $previousPage = $prev == 0 ? null : $prev;
        $nextPage = $query->execute()->rowCount() > $limit ? $next : null;

        return [
            'page' => $page,
            'results' => $results,
            'total_pages' => $totalPages,
            'total_results' => $totalResults,
            'previous_page' => $previousPage,
            'next_page' => $nextPage,
        ];
    }
}
