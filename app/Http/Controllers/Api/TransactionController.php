<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function getTransactions(Request $request, $id)
    {
        $product = Transaction::with(['details.product'])->find($id);

        if ($product) {
            return new TransactionResource(true, 'Data transaction berhasil diambil', $product);
        } else {
            return new TransactionResource(false, 'Data transaction tidak ditemukan', 404);
        }
    }

}
