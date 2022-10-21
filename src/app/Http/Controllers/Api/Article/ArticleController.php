<?php

namespace App\Http\Controllers\Api\Article;

use App\Action\StoreAction;
use App\Action\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Artical\ArticalRequest;
use App\Http\Requests\Article\ArticleRequest;
use App\Models\Article\Article;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        return $this->response(Article::all());
    }

    /**
     * @param  ArticleRequest  $request
     * @return JsonResponse
     */
    public function store(ArticleRequest $request) :JsonResponse
    {
        //
        DB::beginTransaction();
        try {
            $article = new Article();
            if ((new StoreAction($request->toArray(), $article))->action()) {
                DB::commit();
                return $this->response($article->refresh(), 204, 'Публикация успешно создана');
            }
            throw new Exception('Не удалось создать публикацию');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param  Article $article
     * @return JsonResponse
     */
    public function show(Article $article) :JsonResponse
    {
        return $this->response($article);
    }

    /**
     * @param  ArticleRequest  $request
     * @param  Article $article
     * @return JsonResponse
     */
    public function update(ArticleRequest $request, Article $article) :JsonResponse
    {
        DB::beginTransaction();
        try {
            if ((new UpdateAction($request->toArray(), $article))->action()) {
                DB::commit();
                return $this->response($article->refresh(), 204, 'Публикация успешно обновлена');
            }
            throw new Exception('Не удалось обновить публикацию');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param  Article $article
     * @return JsonResponse
     */
    public function destroy(Article $article) :JsonResponse
    {
        $article->delete();

        return $this->response(null, 200, 'Публикация удалена');
    }
}
