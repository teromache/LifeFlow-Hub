<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Str;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SpendingTrackerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transactions::select('*')->orderBy('created_at', 'desc');
            return Datatables::of($data)
                ->addColumn('no', function ($row) {
                    static $counter = 0;
                    $counter++;
                    return $counter;
                })
                ->addColumn('date', function ($row) {
                    return $row->date;
                })
                ->addColumn('type', function ($row) {
                    return $row->type;
                })
                ->addColumn('category', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('amount', function ($row) {
                    if ($row->type == 'Pendapatan') {
                        return '<p style="color:green">RM ' . $row->amount . '</p>';
                    } else {
                        return '<p style="color:red">RM ' . $row->amount . '</p>';
                    }
                })
                ->addColumn('note', function ($row) {
                    return $row->note;
                })
                ->addColumn('action', function ($row) {
                    $deleteUrl = route('delete.spending', $row->id);

                    return '<center><a href="#" class="btn btn-sm btn-warning" onclick="openEditModal(\'' .
                        $row->id .
                        '\')"><i class="bx bx-pencil"></i></a>
                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(\'' .
                        $deleteUrl .
                        '\')"><i class="bx bx-trash"></i></button></center>';
                })
                ->rawColumns(['no', 'type', 'category', 'amount', 'date', 'note', 'action'])
                ->make(true);
        }

        $expenses_category = Categories::where('type', '=', 'Perbelanjaan')->get();
        $income_category = Categories::where('type', '=', 'Pendapatan')->get();
        

        return view('spending_tracker')->with([
            'expenses_category' => $expenses_category,
            'income_category' => $income_category,
        ]);
    }

    public function getSpendingDetails($id)
    {
        $transactions = Transactions::find($id);

        if (!$transactions) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        return response()->json([
            'id' => $transactions->id,
            'date' => $transactions->date,
            'type' => $transactions->type,
            'amount' => $transactions->amount,
            'note' => $transactions->note,
        ]);
    }

    public function addSpending(Request $request)
    {
        $date = $request->input('date');
        $type = $request->input('type');
        $category = $request->input('category');
        $amount = $request->input('amount');
        $note = $request->input('note');

        $data = new Transactions();
        $data->id = Str::uuid();
        $data->type = $type;
        $data->category_id = '1ba40f3f-3d7e-4cc7-9d64-5ee00ab140d4';
        $data->date = $date;
        $data->amount = $amount;
        $data->note = $note;
        $data->save();

        if ($data) {
            return redirect('/spending')->with('success', 'Berjaya!');
        }
    }

    public function editSpending(Request $request, $id)
    {
        try {
            $data = Transactions::find($id);

            $data->type = $request->input('type');
            $data->amount = $request->input('amount');
            $data->note = $request->input('note');
            $data->update();

            return response()->json(['message' => 'Kemaskini berjaya!']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteSpending($id)
    {
        try {
            $data = Transactions::find($id);
            $data->deleted_at = Carbon::now();
            $data->update();

            return response()->json(['message' => 'Berjaya padam!.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
