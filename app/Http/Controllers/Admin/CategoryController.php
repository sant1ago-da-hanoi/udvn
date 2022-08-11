<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Redirector;

class CategoryController extends Controller {
    public function index(): Factory|View|Application {
        $categories = Category::select([
            'categories.id',
            'ct.name',
            'path',
            'created_at',
            'updated_at',
        ])
            ->leftJoin('category_translations AS ct', 'category_id', 'categories.id')
            ->where('lang', $this->lang)
            ->paginate();
        return view('admin.categories.index', compact('categories'));
    }

    public function show($slug): Factory|View|Application {
        $category = Category::where('path', $slug)->first();

        return view('admin.categories.detail', compact('category'));
    }

    public function create(): Factory|View|Application {
        return view('admin.categories.create');
    }

    public function destroy(Request $request): Redirector|Application|RedirectResponse {
        $category_id = $request->input('category_id', 0);
        if ($category_id) {
            Category::destroy($category_id);
            return redirect(route('category.index'))->with('msg', 'Category #{{ $category_id }} successfully deleted');
        } else {
            throw new ModelNotFoundException();
        }
    }
}
