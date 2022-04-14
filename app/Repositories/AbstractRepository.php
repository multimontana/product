<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as DBBuilder;
use Illuminate\Support\Facades\DB;

abstract class AbstractRepository
{
    /**
     * @var Model
     */
    protected Model $model;
    protected DB $db;

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->model->getTable();
    }

    /**
     * @param string $tableName
     * @return DBBuilder
     */
    public function getDb(string $tableName): DBBuilder
    {
        return DB::table($tableName);
    }

    /**
     * @param string $query
     * @return object
     */
    public function raw(string $query): object
    {
        return DB::raw($query);
    }

    /**
     * @return Builder
     */
    public function newQuery(): Builder
    {
        return $this->model
            ->newQuery();
    }

    /**
     * @param array $queryOptions
     * @return array
     */
    public function get(array $queryOptions): array
    {
        $query = $this->newQuery();

        $count = count($query->get()) ?? 0;

        if (isset($queryOptions['category_id'])) {
            $category_id = $queryOptions['category_id'];
            $query = $query->whereHas(
                'categories',
                function ($q) use ($category_id) {
                    $q->where('category_id', $category_id);
                }
            );
            $count = count($query->get());
        }

        if (isset($queryOptions['category_name'])) {
            $name = $queryOptions['category_name'];
            $query = $query->whereHas(
                'categories',
                function ($q) use ($name) {
                    $q->where('title', 'LIKE', "%{$name}%");
                }
            );
            $count = count($query->get());
        }

        if (isset($queryOptions['price_from']) || isset($queryOptions['price_to'])) {
            $from = $queryOptions['price_from'] ? $queryOptions['price_from'] : 0;
            $to = $queryOptions['price_to'] ? $queryOptions['price_to'] : 9999999999999;
            $query = $query->whereBetween('price', [$from, $to]);
            $count = count($query->get());
        }

        if (isset($queryOptions['q'])) {
            $query = $query->where($this->getTableName() . '.title', 'LIKE', "%{$queryOptions['q']}%");
            $count = count($query->get());
        }

        if (isset($queryOptions['is_published'])) {
            $status = $queryOptions['is_published'] === "да" ? true : false;
            $query = $query->where("is_published", $status);
            $count = count($query->get());
        }

        if (isset($queryOptions['offset']) && isset($queryOptions['limit'])) {
            $query = $query
                ->offset($queryOptions['offset'] - 1)
                ->limit($queryOptions['limit']);
        }

        return [
            'count' => $count,
            'result' => $query->get()
        ];
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findOneById(int $id): ?Model
    {
        return $this
            ->newQuery()
            ->find($id);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getOneById(int $id): Model
    {
        return $this->model
            ->query()
            ->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model
            ->create($data);
    }

    /**
     * @param array $options
     * @param array $data
     * @return Model|null
     */
    public function firstOrCreate(array $options, array $data): ?Model
    {
        return $this->model
            ->firstOrCreate($options, $data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $query = $this->model
            ->newQuery()
            ->find($id);

        if ($query) {
            return $query->update($data);
        }

        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model
            ->where('id', $id)
            ->delete();
    }
}
