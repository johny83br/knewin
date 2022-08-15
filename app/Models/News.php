<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Elasticsearch\ClientBuilder;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'url', 'source', 'content', 'created_at'];

    public static function createWithElasticsearch($d)
    {

        $register = parent::create($d);

        $data = [
            'body' => $d,
            'index' => 'news_' . $register->id,
        ];

        $client = ClientBuilder::create()->build();
        $client->index($data);

        return $register;
    }
}
