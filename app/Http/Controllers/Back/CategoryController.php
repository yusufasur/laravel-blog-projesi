<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
//        $isExist = Category::whereName($request->category)->first();
        $isExist = Category::whereSlug(\Str::slug($request->category))->first();
        if ($isExist) {
            toastr()->error($request->category . ' adında bir kategori zaten mevcut!');
            return redirect()->back();
        }

        $category = new Category();

        $category->name = $request->category;
        $category->slug = \Str::slug($request->category);

        if ($category->save()) {
            toastr()->success('Kategori Başarıyla Oluşturuldu');
            return redirect()->back();
        } else {
            toastr()->error('Kategori Oluşturulurken Bir Hata Oluştu!');
            return redirect()->back();
        }
    }


    public function update(Request $request)
    {
        $isSlugExist = Category::whereSlug(\Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isNameExist = Category::whereName(\Str::slug($request->category))->whereNotIn('id', [$request->id])->first();
        if ($isSlugExist or $isNameExist) {
            toastr()->error($request->category . ' adında bir kategori zaten mevcut!');
            return redirect()->back();
        }

        $category = Category::find($request->id);

        $category->name = $request->category;
        $category->slug = \Str::slug($request->slug);

        if ($category->save()) {
            toastr()->success('Kategori Başarıyla Güncellendi');
            return redirect()->back();
        } else {
            toastr()->error('Kategori Güncellenirken Bir Hata Oluştu!');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->id);
        if ($category->id == 1) {
            toastr()->error('Bu kategori silinemez');
            return back();
        }
        $count = $category->articleCount();
        $message = '';
        if ($count > 0) {
            Article::where('category_id', $category->id)->update(['category_id' => 1]);
            $defaultCategory = Category::find(1);
            $message = 'Bu kategoriye ait ' . $count . ' makale ' . $defaultCategory->name . ' kategorisine taşındı.';
        }

        if ($category->delete()) {
            toastr()->success($message, 'Kategori Başarıyla Silindi.');
            return back();
        } else {
            toastr()->error('Kategori Silinemedi!');
            return back();
        }
    }

    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();
    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }
}
