<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $Items = Item::latest()->get();
        if ($request->ajax()) {
            return datatables()
                ->of($Items)
                ->editColumn('total_item', function ($item) {
                    if ($item->total_item == 0) {
                        return $item->total_item . ' Stock habis';
                    } elseif ($item->total_item <= 10) {
                        return $item->total_item . ' Stock menipis';
                    } else {
                        return $item->total_item . ' Stock tersedia';
                    }
                })
                ->addColumn('color_item', function ($item) {
                    // Menambahkan kolom color_item berdasarkan tipe item
                    switch ($item->type_item) {
                        case 'Berat':
                            return '<span style="color:red;">' . $item->type_item . '</span>';
                        case 'camilan':
                            return '<span style="color:yellow;">' . $item->type_item . '</span>';
                        case 'Minuman':
                            return '<span style="color:blue;">' . $item->type_item . '</span>';
                        default:
                            return $item->type_item;
                    }
                })
                ->rawColumns(['color_item'])
                ->make(true);
        }
        // if ($request->ajax()) {
        //     return datatables()->of($Items)->make(true); di ganti dengan yang di atas
        // }

        return view('Item.index', compact('Items'));
    }

    public function store(Request $request)
    {   
        $validateData = $request->validate([
            'item_name' => 'required|string',
            'type_item' => 'required|string',
            'total_item' => 'required|integer',
        ]);

        $Items = Item::create([
            'item_name'  => $validateData['item_name'],
            'type_item'  => $validateData['type_item'],
            'total_item' => $validateData['total_item'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $Items
        ]);
    }

    public function show($id)
    {
        $Items = Item::find($id);

        return response()->json([
            'succes' => true,
            'massage' => 'Detail Item',
            'data'   => $Items
        ]);
    }

    public function update(Request $request, $id)
    {
        $Items = Item::find($id);

        if (!$Items) {
            return response()->json([
                'succes' => false,
                'message' => 'Item not found!'
            ], 404);
        }

        $validateData = $request->validate([
           'item_name' => 'required|string',
            'type_item' => 'required|string',
            'total_item' => 'required|integer'
        ]);


        $Items->update([
            'item_name'  => $validateData['item_name'],
            'type_item'  => $validateData['type_item'],
            'total_item' => $validateData['total_item'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate!',
            'data' => $Items
        ]);
    }

    public function destroy($id)
    {
        Item::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Item Telah di Hapus!'
        ]);
    }
}
