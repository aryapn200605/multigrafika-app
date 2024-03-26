<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $datas = CustomerModel::all();

        return view('admin.customers.index', compact('datas'));
    }

    public function findAllCustomer()
    {
        $datas = CustomerModel::all();

        return response()->json($datas, 200);
    }

    public function findCustomerByName()
    {
        $datas = CustomerModel::find();

        return response()->json($datas, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $customer = new CustomerModel();
        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->address = $request->input('address');
        $customer->transaction_total = 0;

        $customer->save();

        return redirect()->route('customers')->with('success', 'Customer berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $customer = CustomerModel::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json($customer);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $customer = CustomerModel::findOrFail($id);

        // Update data produk
        $customer->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('customers')->with('success', 'Customer berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $customer = CustomerModel::find($id);

        if ($customer) {
            $customer->delete();
            return redirect()->route('customers')->with('success', 'Customer berhasil dihapus');
        } else {
            return redirect()->route('customers')->with('danger', 'Customer tidak ditemukan');
        }
    }
}
