<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all()->sortBy('order');
        return view('back.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('back.pages.create');
    }

    public function post(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $lastOrder = Page::latest('order')->first()->order;

        $page = new Page();

        $page->title = $request->title;
        $page->content = $request->post('content');
        $page->order = $lastOrder + 1;
        $page->slug = \Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = \Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/' . $imageName;
        }

        if ($page->save()) {
            toastr()->success('Sayfa Başarıyla Oluşturuldu.');
            return redirect()->route('admin.page.index');
        } else {
            toastr()->error('Sayfa Oluşturulurken Bir Hata Oluştu!');
            return redirect()->route('admin.page.index');
        }
    }

    public function update($id)
    {
        $page = Page::findOrFail($id);
        return view('back.pages.update', compact('page'));
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $page = Page::findOrFail($id);

        $page->title = $request->title;
        $page->content = $request->post('content');
        $page->slug = \Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = \Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/' . $imageName;
        }

        if ($page->save()) {
            toastr()->success('Sayfa Başarıyla Güncellendi.');
            return redirect()->route('admin.page.index');
        } else {
            toastr()->error('Sayfa Güncellenirken Bir Hata Oluştu!');
            return redirect()->route('admin.page.index');
        }
    }

    public function delete($id)
    {
        $page = Page::find($id);
        if (\File::exists($page->image)) {
            \File::delete(public_path($page->image));
        }
        if ($page->delete()) {
            toastr()->success('Sayfa başarıyla silindi.');
            return redirect()->route('admin.page.index');
        } else {
            toastr()->error('Sayfa silinirken bir hata oluştu!');
            return redirect()->route('admin.page.index');
        }
    }

    public function orders(Request $request)
    {
        foreach ($request->get('page') as $key => $order) {
            Page::where('id', $order)->update(['order' => $key]);
        }
    }

    public function switch(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->status = $request->status == 'true' ? 1 : 0;
        $page->save();
    }
}
