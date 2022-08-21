<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NewsRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{

    /** @var NewsRepository $newsRepository*/
    private $newsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $news = [];
        $query = null;

        if (!empty($request->get('query'))) {

            $perPage = $request->get('limit', 10);
            $from = ($request->get('page', 1) - 1) * $perPage;

            $newsRepository = $this->newsRepository->getAllWithElasticsearch($request->post('query'), $perPage, $from);

            $news = $this->paginate($newsRepository, $perPage);
            $query = $request->post('query');
        }

        return view('dashboard.home')->with('query', $query)->with('news', $news);
    }

    /**
     * Pagination
     * @param array $items
     * @param int $perPage
     * @var array
     */
    public function paginate($items, $perPage = 5)
    {
        return new LengthAwarePaginator(
            $items['hits']['hits'],
            $items['hits']['total']['value'],
            $perPage,
            Paginator::resolveCurrentPage(),
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function login()
    {
        return view('auth.login');
    }
}
