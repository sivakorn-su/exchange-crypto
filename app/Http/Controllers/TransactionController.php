<?php

namespace App\Http\Controllers;

use App\Http\Enum\BankType;
use App\Http\Enum\TransactionStatus;
use App\Http\Enum\TransactionType;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;


class TransactionController extends Controller
{

    public function depositAndWithdraw(Request $request): JsonResponse
    {
        $data = $request->validate([
            'depositor_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|decimal:2',
            'currency_id' => 'required|exists:currencies,id',
            'type' => ['required', new Enum(TransactionType::class)],
            'bankType' => ['required', new Enum(BankType::class)],
            'to_address' => 'required|string',
        ]);
        try {
            Db::beginTransaction();
            $transaction = new Transaction();
            $transaction->depositor_id = $data['depositor_id'];
            $transaction->amount = $data['amount'];
            $transaction->currency_id = $data['currency_id'];
            $transaction->save();

            $transactionDetail = new TransactionDetail();
            $transactionDetail->transaction_id = $transaction->id;
            $transactionDetail->type = $data['type'];
            $transactionDetail->bankType = $data['bankType'];
            $transactionDetail->to_address = $data['to_address'];
            $transactionDetail->status = TransactionStatus::COMPLETED;
            $transactionDetail->save();

            $wallet = Wallet::where('id', $data['depositor_id'])
                ->where('currency_id', $data['currency_id'])->first();

            $wallet->balance += ($data['type'] === TransactionType::WITHDRAW->value) ? -$data['amount'] : $data['amount'];
            $wallet->save();
            Db::commit();
            return response()->json(['message' => 'Transaction success'], 200);
        } catch (Exception $e) {
            Db::rollBack();
            return response()->json(['message' => 'Transaction failed' . $e], 500);
        }
    }

    public function show(Transaction $transaction): JsonResponse
    {
        $transaction->load('depositor', 'detail');
        return response()->json($transaction, 200);
    }

    public function transfer(Request $request): JsonResponse
    {
        $data = $request->validate([
            'depositor_id' => 'required|exists:wallet,id',
            'recipient_id' => 'required|exists:wallet,id',
            'amount' => 'required|decimal|min:1',
            'currency_id' => 'required|exists:currency,id',
            'type' => ['required', new Enum(TransactionType::class)],
            'bankType' => ['required', new Enum(BankType::class)],
        ]);
        try {
            Db::beginTransaction();
            $transaction = new Transaction();
            $transaction->depositor_id = $data['depositor_id'];
            $transaction->recipient_id = $data['recipient_id'];
            $transaction->amount = $data['amount'];
            $transaction->currency_id = $data['currency_id'];
            $transaction->status = TransactionStatus::COMPLETED;
            $transaction->save();

            $transactionDetail = new TransactionDetail();
            $transactionDetail->transaction_id = $transaction->id;
            $transactionDetail->type = TransactionType::TRANSFER;
            $transactionDetail->bankType = $data['bankType'];
            $transactionDetail->save();

            $walletA = Wallet::where('id', $data['depositor_id'])->where('currency_id', $data['currency_id'])->first();
            $walletA->balance -= $data['amount'];
            $walletB = Wallet::where('id', $data['recipient_id'])->where('currency_id', $data['currency_id'])->first();
            $walletB->balance += $data['amount'];
            $walletA->save();
            Db::commit();
            return response()->json(['message' => 'Transaction success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Transaction failed'], 500);
        }
    }

}
