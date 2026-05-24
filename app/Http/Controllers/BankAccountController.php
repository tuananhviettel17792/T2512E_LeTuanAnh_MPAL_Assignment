<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BankAccountController extends Controller
{
    public function create()
    {
        return view('bank_accounts.create');
    }


    public function store(Request $request)
    {
        // YÊU CẦU VALIDATION
        $request->validate([
            'full_name'      => 'required|string|max:100',
            'account_number' => 'required|numeric|digits:10|unique:bank_accounts,account_number',
            'email'          => 'required|email|max:100|unique:bank_accounts,email',
            'phone'          => 'required|string|max:10',
            'balance'        => 'nullable|numeric|min:0',
            'status'         => 'required|in:active,inactive,banned',
        ], [

            'required' => ':attribute không được để trống.',
            'numeric'  => ':attribute phải là chữ số.',
            'digits'   => ':attribute phải có độ dài đúng :digits ký tự.',
            'unique'   => ':attribute này đã tồn tại trên hệ thống.',
            'email'    => ':attribute không đúng định dạng.',
            'min'      => ':attribute phải lớn hơn hoặc bằng :min.',
        ], [
            'full_name'      => 'Họ và tên',
            'account_number' => 'Số tài khoản',
            'email'          => 'Địa chỉ email',
            'phone'          => 'Số điện thoại',
            'balance'        => 'Số dư',
            'status'         => 'Trạng thái',
        ]);

        $data = $request->all();
        $data['balance'] = $request->filled('balance') ? $request->balance : 0;

        BankAccount::create($data);

        return redirect()->route('bank-accounts.create')
            ->with('success', 'Thêm mới tài khoản ngân hàng thành công!');
    }
    public function index(Request $request)
    {

        $query = BankAccount::query();
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('full_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', 'LIKE', "%{$keyword}%")
                    ->orWhere('phone', 'LIKE', "%{$keyword}%");
            });
        }

        if ($request->filled('min_balance')) {
            $query->where('balance', '>=', $request->min_balance);
        }

        if ($request->filled('from_date')) {
            $query->where('created_at', '>=', Carbon::parse($request->from_date)->startOfDay());
        }

        if ($request->filled('to_date')) {
            $query->where('created_at', '<=', Carbon::parse($request->to_date)->endOfDay());
        }

        $accounts = $query->latest()->paginate(10)->appends($request->all());

        return view('bank_accounts.index', compact('accounts'));
    }
}
