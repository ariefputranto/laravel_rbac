<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $product = [
            [
                "id" => "1",
                "name" => "Chitatos",
                "price" => "5000",
            ],[
                "id" => "2",
                "name" => "Tango Wafer Chocolate",
                "price" => "8000",
            ],[
                "id" => "3",
                "name" => "Taro",
                "price" => "9000",
            ],[
                "id" => "4",
                "name" => "Sari Roti",
                "price" => "4500",
            ],
        ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission');
    }

    public function dashboard()
    {
        $transaction_details = [];
        $total_price = 0;
        $total_product = 0;
        $product_name = [];
        $tmp_product = 0;
        $list_product = $this->product;

        $date = Carbon::today();
        $transactions = Transaction::where('created_at','>=',$date)
            ->get();

        foreach ($list_product as $list) {
            $list_product [$list['id']] = $list;
        }

        foreach ($transactions as $transaction) {
            $transaction_details = TransactionDetail::where('transaction_id', $transaction->id)
            ->get();
            foreach ($transaction_details as $detail) {
                if ($tmp_product != $detail->product_id) {
                    $product_name []= $list_product[$detail->product_id]['id'];
                }
                $total_product += $detail->quantity;
            }

            $total_price += $transaction->total_price;
        }

        $product_name = array_unique($product_name);

        $count_transactions = count($transactions);
        $count_product = count($product_name);
        
        return view('transaction.dashboard',compact(
            'count_transactions',
            'count_product',
            'total_price',
            'total_product'
        ));
    }

    public function index()
    {
        $date = Carbon::today();
        $transactions = Transaction::where('user_id', Auth::user()->id)
            ->where('created_at','>=',$date)
            ->get();
        return view('transaction.index',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->product;
        return view('transaction.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|array|min:1',
            'quantity' => 'required|array|min:1',
            'price' => 'required|array|min:1',
        ]);

        $user_id = Auth::user()->id;

        DB::beginTransaction();
        try{
            $total = 0;
            $transaction = Transaction::create([
                'user_id' => $user_id
            ]);

            for ($key=0; $key < count($request->product_id); $key++) { 
                $TotalPrice = $request->quantity[$key] * $request->price[$key];
                $total += $TotalPrice;
                $TransactionDetail = TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $request->product_id[$key],
                    'quantity' => $request->quantity[$key],
                    'price' => $request->price[$key],
                    'total_price' => $TotalPrice,
                ]);
            }

            $UpdateTransaction = Transaction::find($transaction->id);
            $UpdateTransaction->total_price = $total;
            $UpdateTransaction->save();

            DB::commit();
        }catch(\Exception $ex){
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
        $request->session()->flash('message', 'Successfully saved the transaction!');
        return redirect('/transaction/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        foreach ($this->product as $key => $value) {
            $products [$value['id']]= $value['name'];
        }
        return view('transaction.show', compact('transaction','products'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Transaction $transaction)
    {
        TransactionDetail::where('transaction_id', $transaction->id)->delete();
        $transaction->delete();
        $request->session()->flash('message', 'Successfully deleted the transaction!');
        return redirect('transaction');
    }
}
