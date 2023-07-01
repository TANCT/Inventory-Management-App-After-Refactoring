<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Validate Request.
     **/
    protected function validateRequest($request)
    {
        return $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'quantity' => 'required|numeric',
            'discount' => 'required|numeric',
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('quantity', '>', 0)
        -> where('isDisposed', '=', false)
            ->latest()
            ->paginate(5);

        // Calculate the total price considering the discount and check if it is a clearance sale
        foreach ($products as $product) {
            $this->calculateTotalPrice($product);
            $this->setIsClearance($product);
        }

        // return response()->json($products->items());

        return view('products.index', compact('products'))
            ->with(request()->input('page'));
    }

    public function calculateTotalPrice($product)
    {
        if ($product->discount > 0) {
            $product->totalPrice = $product->price - ($product->price * $product->discount / 100);
        } else {
            $product->totalPrice = $product->price;
        }
    }

    public function setIsClearance($product)
    {
        $product->isClearance = $product->discount >= 50;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }   

/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, Product $product)
{
    $this->validateRequest($request);

    $product->update($request->all());

    return redirect()->route('products.index')
                    ->with('success', 'Product updated successfully');
}

/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
*/
    public function store(Request $request)
    {
        $this->validateRequest($request);
    
        Product::create($request->all());
    
        return redirect()->route('products.index')
                        ->with('success', 'Product created successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
    // public function destroy($productid)
    // {
    //     try {
    //         $product = Product::findOrFail($productid);
    //         $product->delete();

    //         return response()->json(['message' => 'Product deleted successfully'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Failed to delete the product', 'error' => $e->getMessage()], 500);
    //     }
    // }

     /**
     * Dispose the specified resource
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function dispose(Product $product)
{
    $product->isDisposed = true;
    $product->update(['isDisposed' => true]);

    

    return redirect()->route('products.index')
                    ->with('success', 'Product disposed successfully');
}




// /**
//  * Store a newly created resource in storage.
//  *
//  * @param  \Illuminate\Http\Request  $request
//  * @return \Illuminate\Http\Response
//  */
// public function storeProduct(Request $request)
// {
//     try {
//         $this->validateRequest($request);

//         Product::create($request->all());

//         return response()->json(['message' => 'Successfully created'], 201);
//     } catch (\Exception $e) {
//         return response()->json(['message' => 'Failed to create the product', 'error' => $e->getMessage()], 500);
//     }
// }

public function createProduct(Request $request)
{
    try {
        $this->validateRequest($request);

        $product = Product::create($request->all());

        return response()->json(['message' => 'Product created', 'product' => $product], 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to create the product', 'error' => $e->getMessage()], 500);
    }
}

public function dump($productid)
    {
        try {
            $product = Product::findOrFail($productid);
            $product->delete();

            return response()->json(['message' => 'Product deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete the product', 'error' => $e->getMessage()], 500);
        }
    }
    
}