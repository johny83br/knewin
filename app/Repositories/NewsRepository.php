<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\BaseRepository;
use Elasticsearch\ClientBuilder;

/**
 * Class NewsRepository
 * @package App\Repositories
 * @version August 19, 2022, 5:06 pm -03
 */

class NewsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['title', 'url', 'source', 'content', 'created_at'];

    /**
     * @var ClientBuilder $clientElasticsearch
     */

    private $clientElasticsearch = null;

    public function __construct()
    {
        $this->clientElasticsearch = ClientBuilder::create()->build();
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
        return News::class;
    }

    /**
     * Store a newly created resource in database and Elasticsearch.
     *
     * @param  array $input
     */

    public function create($input = null)
    {

        $news = News::create($input);

        $data_elastic = [
            'body' => $input,
            'index' => 'news',
            'id' => $news->id
        ];

        $this->clientElasticsearch->index($data_elastic);
    }

    /**
     * Display the specified resource of the Elasticsearch.
     *
     * @param int $id
     * @return json $input
     */

    public function getWithElasticsearch($id)
    {

        $input = $this->clientElasticsearch->get(['index' => 'news', 'id' => $id]);

        return $input;
    }

    /**
     * Update the specified resource in storage and in the Elasticsearch.
     *
     * @param int $id
     * @param array $input
     * @return boolean
     */

    public function updateWithElasticsearch($id, $input = null)
    {

        $data_elastic = [
            'body' => $input,
            'index' => 'news',
            'id' => $id
        ];

        $this->clientElasticsearch->index($data_elastic);

        return News::find($id)->updateOrFail($input);
    }

    /**
     * Remove the specified resource from storage and in the Elasticsearch.
     *
     * @param int $id
     * @return boolean
     */

    public function deleteWithElasticsearch($id)
    {

        $data_elastic = [
            'index' => 'news',
            'id' => $id
        ];

        $this->clientElasticsearch->delete($data_elastic);

        return News::destroy($id);
    }

    /**
     * Display a listing of the resource (Elasticsearch).
     *
     * @return json
     */

    public function getAllWithElasticsearch()
    {


        $data_elastic = [
            'index' => 'news'
        ];

        return $this->clientElasticsearch->search($data_elastic);
    }
}
