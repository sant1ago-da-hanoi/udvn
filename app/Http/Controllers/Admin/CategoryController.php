<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller {
    public function index(): Factory|View|Application {
        $categories = Category::select(['id', 'name', 'path', 'created_at', 'updated_at'])
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

    public function destroy(Request $request) {
        $category_id = $request->input('category_id', 0);
        if ($category_id) {
            Category::destroy($category_id);
            return redirect('categories.index')->with('msg', 'Category #{{ $category_id }} successfully deleted');
        }
    }
}
