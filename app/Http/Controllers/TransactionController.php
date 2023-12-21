<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('create', compact('users'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $transaction = [
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'transaction_id' => 'inv_' . uniqid(),
                'status' => $this->status(),
            ];

            $user = User::findorfail($request->user_id);
            $payment = $user->charge($request->amount * 100, $request->payment_method);
            Transaction::create($transaction);
            DB::commit();
            return redirect()->route('transaction.create')->with('status', 'Transaction Successfull');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    private function status()
    {
        return rand(1, 10) <= 8 ? 'success' : 'failure';
    }
}
