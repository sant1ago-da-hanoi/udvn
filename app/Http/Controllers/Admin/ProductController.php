<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Image;
use App\Models\CategoryTranslation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Str;
use Throwable;

class ProductController extends Controller {
    public function index(): Factory|View|Application {
        $products = Product::select([
            'products.id',
            'slug',
            'price',
            'pt.name',
            'ct.name AS category_name',
            'products.category_id',
            'created_at',
            'updated_at',
        ])
            ->leftJoin('product_translations AS pt', 'product_id', 'products.id')
            ->join('category_translations AS ct', 'products.category_id', 'ct.category_id')
            ->where('pt.lang', $this->lang)
            ->orderBy('products.id', 'desc')
            ->paginate();
        return view('admin.product.index');
    }

    public function show($slug) {
        // todo
    }

    public function create(): Factory|View|Application {
        $product = new Product();
        $categories = CategoryTranslation::where('lang', $this->lang)
            ->pluck('name', 'category_id');
        return view('admin.products.create', compact('categories', 'product'));
    }

    public function store(ProductRequest $request): Redirector|Application|RedirectResponse {
        $product_item = $request->except('_token');

        $photo = $request->file('photo');

        $product_item['slug'] = Str::slug($product_item['name']);
        try {
            Product::create($product_item);
        } catch (Throwable $t) {
            throw new ModelNotFoundException();
        }

        return redirect(route('product.index'));
    }

    public function edit(Request $request, $id): Factory|View|Redirector|RedirectResponse|Application {
        $product = Product::find($id);
        if ($product) {
            $categories = CategoryTranslation::where('lang', $this->lang)
                ->pluck('name', 'category_id');
            return view('admin.products.edit', compact('product', 'categories'));
        }

        return redirect(route('product.index'))
            ->with('msg', 'Product is not existing!');
    }

    public function update(ProductRequest $request, $id): Redirector|Application|RedirectResponse {
        $msg = 'Product is not existing!';
        $product = Product::find($id);
        if ($product) {
            $product->name = $request->input('name');
            $product->slug = Str::slug($product->name);
            $product->category_id = $request->input('category_id');
            $product->quantity = $request->input('quantity');
            $product->price = $request->input('price');
            $product->description = $request->input('description');
            $product->save();
            $msg = 'Update product is success!';
        }

        try {
            $photo = $request->file('photo');
            $path = Storage::putFile('images', $photo);

            $image = Image::create(['name' => $path]);
            $product->images()->attach($image->id);
        } catch (Throwable $t) {
            dd($t);
        }

        return redirect(route('product.index'))
            ->with('msg', $msg);
    }

    public function destroy(Request $request): Redirector|Application|RedirectResponse {
        $product_id = $request->input('product_id', 0);
        if ($product_id) {
            Product::destroy($product_id);
            return redirect(route('product.index'))
                ->with('msg', "Delete product $product_id success!");
        } else {
            throw new ModelNotFoundException();
        }
    }
}
