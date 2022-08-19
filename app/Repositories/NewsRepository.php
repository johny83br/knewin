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

    public function create($data = null)
    {

        $news = News::create($data);

        $data_elastic = [
            'body' => $data,
            'index' => 'news',
            'id' => $news->id
        ];

        $this->clientElasticsearch->index($data_elastic);
    }

    public function getWithElasticsearch($id = null)
    {

        $data = $this->clientElasticsearch->get(['index' => 'news', 'id' => $id]);

        return $data;
    }

    public function updateWithElasticsearch($id, $data = null)
    {

        $data_elastic = [
            'body' => $data,
            'index' => 'news',
            'id' => $id
        ];

        $this->clientElasticsearch->index($data_elastic);

        return News::find($id)->updateOrFail($data);
    }

    public function deleteWithElasticsearch($id = null)
    {

        $data_elastic = [
            'index' => 'news',
            'id' => $id
        ];

        $this->clientElasticsearch->delete($data_elastic);

        return News::destroy($id);
    }

    public function getAllWithElasticsearch($search = null)
    {


        $data_elastic = [
            'index' => 'news'
        ];

        return $this->clientElasticsearch->search($data_elastic);
    }
}
