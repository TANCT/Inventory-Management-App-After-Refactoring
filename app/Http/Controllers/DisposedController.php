<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class DisposedController extends ProductController{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('quantity', '>', 0)
            -> where('isDisposed', '=', true)
            ->latest()
            ->paginate(5);

        // Calculate the total price considering the discount and check if it is a clearance sale
        foreach ($products as $product) {
            $this->calculateTotalPrice($product);
            $this->setIsClearance($product);
        }

        return view('disposedproducts.index', compact('products'))
            ->with(request()->input('page'));
    }

    
}
