<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersRepository
 * @package App\Repositories
 * @version August 19, 2022, 5:06 pm -03
 */

class UsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['name', 'email', 'password',];

    public function __construct()
    {
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Model
     */

    public function create($input = null)
    {
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }
        return User::create($input);
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */

    public function find($id, $columns = ['*'])
    {
        return User::find($id, $columns);
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */

    public function update($input = null, $id = null)
    {
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }
        return User::find($id)->update($input);
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     */

    public function delete($id = null)
    {
        return User::find($id)->delete();
    }

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */

    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        return User::all($search, $skip, $limit, $columns);
    }
}
