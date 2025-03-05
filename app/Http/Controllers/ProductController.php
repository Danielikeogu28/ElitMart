<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        
        $product = new Product();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->store('', 'public');
            $filePath = "uploads/" . $fileName;
            $product->image = $filePath;
        };

        $product->name = $request->name;
        $product->price = $request->price;
        $product->about = $request->about;
        $product->sku = $request->sku;
        $product->tag =  $request->tag;
        $product->description = $request->description;
        $product->save();

        if ($request->has('color') && $request->filled('color')) {
            foreach ($request->color as  $color) {
                ProductColor::create([
                    'color' => $color,
                    'product_id' => $product->id
                ]);
            }
        }
        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $fileName = $image->store('', 'public');
                $filePath = "uploads/" . $fileName;
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $filePath,
                ]);
            }
        }


        notyf('Product created Successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with(['colors', 'images'])->findOrFail($id);
        $colors = $product->colors->pluck('color')->toArray();
        return view('admin.product.edit', compact('product', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            File::delete(public_path('storage/' . $product->image));
            $image = $request->file('image');
            $fileName = $image->store('', 'public');
            $filePath = "uploads/" . $fileName;
            $product->image = $filePath;
        };

        $product->name = $request->name;
        $product->price = $request->price;
        $product->about = $request->about;
        $product->sku = $request->sku;
        $product->qty = $request->qty;
        $product->tag =  $request->tag;
        $product->description = $request->description;
        $product->save();

        if ($request->has('color') && $request->filled('color')) {
            foreach ($product->colors as $color) {
                $color->delete();
            }
            foreach ($request->color as  $color) {
                ProductColor::create([
                    'color' => $color,
                    'product_id' => $product->id
                ]);
            }
        }
        if ($request->has('images')) {
            foreach ($product->images as $image) {
                File::delete(public_path($image->path));
            }
            $product->images()->delete();

            foreach ($request->images as $image) {
                $fileName = $image->store('', 'public');
                $filePath = "uploads/" . $fileName;
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $filePath,
                ]);
            }
        }


        notyf('Product Updated Successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->colors()->delete();
        File::delete(public_path('storage/' . $product->image));
        foreach ($product->images as $image){
            File::delete(public_path($product->image));
        }
        $product->images()->delete();
        $product->delete();

        notyf('Product deleted');
        return redirect()->back();
    }
}
