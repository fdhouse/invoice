<?php


namespace App\Http\Controllers\api\news;

use App\Http\Controllers\api\BaseController;
use App\Module\News\Service\NewsService;
use Dingo\Blueprint\Annotation\Method\Get;
use Dingo\Blueprint\Annotation\Resource;

/**
 * Class NewsController
 *
 * @Resource("News", uri = "/news")
 *
 * @package App\Http\Controllers\api\news
 */
class NewsController extends BaseController
{
    private $newsService;

    function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * get news with paginate
     *
     * @Get("/list")
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNews()
    {
        $data = $this->newsService->newsList();

        return $data;
    }

}