<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Mengambil orders beserta detailnya dan menghitung total amount
        $orders = Order::with('customer', 'orderDetails')
            ->withSum('orderDetails as total_amount', 'subtotal') // Menghitung total amount dari orderDetails
            ->orderByDesc('order_date')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('admin.orders.create', compact('customers'));
    }

    public function store(Request $request)
{
    
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'order_date' => 'required|date',
        'status' => 'required',
        'phone' => 'nullable|string|max:15', // Menambahkan validasi untuk phone
    ]);

    $customer = Customer::create([
        'name' => $request->customer_name,
        'email' => strtolower(str_replace(' ', '', $request->customer_name)) . '@example.com',
        'phone' => $request->phone, // Menyertakan phone
    ]);

 
    Order::create([
        'customer_id' => $customer->id,
        'order_date' => $request->order_date,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.orders.index')->with('success', 'Order berhasil dibuat.');
}



    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted.');
    }
}
