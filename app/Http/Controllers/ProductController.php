<?php
namespace App\Http\Controllers;
use App\Http\Requests\CreateProductRequest;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->toArray();
        return array_reverse($products);
    }

    public function store(CreateProductRequest $request)
    {
        $product = new Product([
                                       'name' => $request->input('name'),
                                       'detail' => $request->input('detail')
                               ]);
        $product->save();

        return response()->json('Product created!');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update($id, CreateProductRequest $request)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['message'=>"Product not found"]);
        }
        $product->update($request->all());

        return response()->json('Product updated!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json('Product deleted!');
    }
}
