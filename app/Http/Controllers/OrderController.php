<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Merchandiser;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Validate Request.
     **/
    protected function validateRequest($request)
    {
        return $request->validate([
            'product' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
            'price_per_product' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'merchandiser' => 'required|exists:merchandisers,id',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('product', 'merchandiser')->latest()->paginate(5);

        return view('orders.index', compact('orders'))
            ->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $merchandisers = Merchandiser::all();

        return view('orders.create', compact('products', 'merchandisers'));
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

        Order::create([
            'product_id' => $request->input('product'),
            'quantity' => $request->input('quantity'),
            'price_per_product' => $request->input('price_per_product'),
            'merchandiser_id' => $request->input('merchandiser'),
        ]);

        return redirect()->route('orders.index')
                        ->with('success','Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        $merchandisers = Merchandiser::all();
        return view('orders.edit',compact('order','products', 'merchandisers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $this->validateRequest($request);

        $order->update([
            'product_id' => $request->input('product'),
            'quantity' => $request->input('quantity'),
            'price_per_product' => $request->input('price_per_product'),
            'merchandiser_id' => $request->input('merchandiser'),
        ]);

        return redirect()->route('orders.index')
                        ->with('success','Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
                        ->with('success','Order deleted successfully');
    }
}