<?php

namespace App\Repositories\base;

use App\Traits\Models\Findable;
use App\Traits\Models\Listable;
use App\Traits\Models\Paginatable;
use App\Traits\Models\Syncable;
use App\Traits\Models\Updatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{

    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     */
    public function __construct(protected Model $model)
    {
    }

    /**
     * @param  array  $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find entity by id.
     *
     * @param  int  $model
     * @return Model
     */
    public function find(int $model): Model
    {
        return $this->model->find($model);
    }

    /**
     * update given model
     *
     * @param  array  $payload
     * @param  Model  $model
     * @return Model
     */
    public function update(array $payload, Model $model): Model
    {
        $model->update($payload);

        return $model;
    }

    /**
     * delete model
     *
     * @param  Model  $model
     * @return bool
     */
    public function delete(Model $model): bool
    {
        return $model->delete();
    }


    /**
     * Returns the given model instance with relations
     *
     * @param  Model  $model
     * @param  array  $relations
     * @return Model
     */
    public function load(Model $model, array $relations): Model
    {
        return $model->load($relations);
    }
}
