<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->get();
        return view('back.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $article = new Article();

        $article->title         = $request->title;
        $article->category_id   = $request->category;
        $article->content       = $request->post('content');
        $article->slug          = \Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = \Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/' . $imageName;
        }

        if ($article->save()) {
            toastr()->success('Makale Başarıyla Oluşturuldu.', 'Başarılı');
            return redirect()->route('admin.makaleler.index');
        } else {
            toastr()->error('Makale Oluşturulurken Bir Hata Oluştu!', 'Hata');
            return redirect()->route('admin.makaleler.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('back.articles.update', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $article = Article::findOrFail($id);

        $article->title         = $request->title;
        $article->category_id   = $request->category;
        $article->content       = $request->post('content');
        $article->slug          = \Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = \Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/' . $imageName;
        }

        if ($article->save()) {
            toastr()->success('Başarılı', 'Makale Başarıyla Güncellendi.');
            return redirect()->route('admin.makaleler.index');
        } else {
            toastr()->error('Hata', 'Makale Güncellenirken Bir Hata Oluştu!');
            return redirect()->route('admin.makaleler.index');
        }
    }

    public function switch(Request $request)
    {
        $article = Article::findOrFail($request->id);
        $article->status = $request->status == 'true' ? 1 : 0;
        $article->save();
    }

    public function delete($id)
    {
        Article::find($id)->delete();
        toastr()->success('Makale, silinen makalelere taşındı.');
        return redirect()->route('admin.makaleler.index');
    }

    public function trashed()
    {
        $articles = Article::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('back.articles.trashed', compact('articles'));
    }

    public function recover($id)
    {
        Article::onlyTrashed()->find($id)->restore();
        toastr()->success('Makale Geri Yüklendi.');
        return redirect()->route('admin.makaleler.index');
    }

    public function hardDelete($id)
    {
        $article = Article::onlyTrashed()->find($id);

        \File::exists($article->image) ? \File::delete($article->image) : null;

        $article->forceDelete();

        toastr()->success('Makale Başarıyla Silindi.');
        return redirect()->route('admin.makaleler.index');
    }
}
