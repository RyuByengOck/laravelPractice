<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\ArticlesRequest;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $articles = \App\Article::latest()->paginate(3);
//        dd($articles);

//        지연로드 : 즉시로드하지 않고, 나중에 필요할 때 관계를 로드해야할 때가 있다.
//        $articles = \App\Article::get();
////
//        $articles->load('user');
//        dd($articles);
        return view('articles.create');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlesRequest $request)
    {
        $rules = [
           'title' => ['required'],
           'content' => ['required', 'min:10'],
        ];

        $messages = [
          'title.required' => '제목은 필수 입력사항 입니다.',
          'content.required' => '본문은 필수 입력 항목 입니다.',
          'content.min' => '본문은 최소 :min 글자 이상이 필요합니다.',
        ];

        $this->validate($request, $rules, $messages);



        $article = \App\User::find(1)->articles()->create($request->all());

        if (! $article) {
            return back()->with('flash_message', '글이 저장되지 않았습니다.')->withInput();
        }
//            dd($article);
        event(new \App\Events\ArticlesEvent($article));


        return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return __METHOD__ . '은 다음 기본키를 가진 Article 모델을 조회 합니다.'. $id;
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return __METHOD__ . '은 다음 기본키를 가진 Article 모델을 수정하기 위한 폼을 담은 뷰를 반환합니다.'. $id;
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return __METHOD__ . '은 다음 기본키를 가진 Article 모델을 삭제 합니다.'. $id;

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
