<?php

namespace App\Module..\Http\Controllers\Module\News;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Module\Applications\websites\shenglan\site1\appRepositories\Module\News\NewsRepository;
use App\Module\Applications\websites\shenglan\site1\appValidators\Module\News\NewsValidator;

/**
 * Class NewsController.
 *
 * @package namespace App\Module..\Http\Controllers\Module\News;
 */
class NewsController extends Controller
{
    /**
     * @var NewsRepository
     */
    protected $repository;

    /**
     * @var NewsValidator
     */
    protected $validator;

    /**
     * NewsController constructor.
     *
     * @param NewsRepository $repository
     * @param NewsValidator $validator
     */
    public function __construct(NewsRepository $repository, NewsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $news = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $news,
            ]);
        }

        return view('news.index', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NewsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(NewsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $news = $this->repository->create($request->all());

            $response = [
                'message' => 'News created.',
                'data'    => $news->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $news,
            ]);
        }

        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = $this->repository->find($id);

        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  NewsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(NewsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $news = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'News updated.',
                'data'    => $news->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'News deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'News deleted.');
    }
}