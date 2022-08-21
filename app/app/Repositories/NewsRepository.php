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

        if (!empty($input['created_at'])) {
            list($date, $hour) = explode(' ', $input['created_at']);
            list($a, $m, $d) = explode('-', $date);
            $input['created_at'] = $a . '/' . $m . '/' . $d . ' ' . $hour;
        }

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
        $register = News::find($id)->updateOrFail($input);

        if (!empty($input['created_at'])) {
            list($date, $hour) = explode(' ', $input['created_at']);
            list($a, $m, $d) = explode('-', $date);
            $input['created_at'] = $a . '/' . $m . '/' . $d . ' ' . $hour;
        }

        $data_elastic = [
            'body' => $input,
            'index' => 'news',
            'id' => $id
        ];

        $this->clientElasticsearch->index($data_elastic);

        return $register;
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
     * @param string $query_string
     * @param int $per_page
     * @param int $from
     * @return json
     */

    public function getAllWithElasticsearch($query_string = "", $per_page = null, $from = null)
    {


        $data_elastic = [
            'index' => 'news'
        ];

        if (!empty($query_string)) {
            $data_elastic = array_merge($data_elastic, [
                'size' => $per_page,
                'from' => $from,
                'body' => [
                    'query' => [
                        'query_string' => [
                            'query' => $query_string
                        ]
                    ],
                    'sort' => [
                        'created_at' => [
                            'order' => 'desc'
                        ]
                    ],
                ]
            ]);
        }

        return $this->clientElasticsearch->search($data_elastic);
    }
}
