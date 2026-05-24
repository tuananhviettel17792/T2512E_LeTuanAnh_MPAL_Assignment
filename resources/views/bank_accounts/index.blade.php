<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Trị - Bank Accounts</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 font-sans text-slate-700 min-h-screen flex">

<aside class="w-64 bg-slate-900 text-slate-300 min-h-screen hidden md:flex flex-col shadow-xl shrink-0">
    <div class="p-5 bg-slate-950 flex items-center gap-3">
        <i class="fa-solid fa-building-columns text-xl text-blue-500"></i>
        <span class="font-bold text-white tracking-wide text-lg">TANKLEE-BANK ADMIN</span>
    </div>
    <nav class="flex-1 p-4 space-y-2 mt-4">
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition">
            <i class="fa-solid fa-chart-pie w-5"></i> Tổng quan
        </a>
        <a href="{{ route('bank-accounts.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium bg-blue-600 text-white shadow-md shadow-blue-600/10">
            <i class="fa-solid fa-users w-5"></i> Quản lý tài khoản
        </a>
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition">
            <i class="fa-solid fa-money-bill-transfer w-5"></i> Lịch sử giao dịch
        </a>
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition">
            <i class="fa-solid fa-gear w-5"></i> Cấu hình hệ thống
        </a>
    </nav>
    <div class="p-4 border-t border-slate-800 text-xs text-slate-500 text-center">
        Phiên bản 1.0.0 &copy; 2026
    </div>
</aside>

<main class="flex-1 min-w-0 flex flex-col">

    <header class="bg-white h-16 border-b border-slate-200 flex items-center justify-between px-8 shadow-sm shrink-0">
        <div class="flex items-center gap-2">
            <span class="text-sm font-medium text-slate-400">Phân hệ</span>
            <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
            <span class="text-sm font-semibold text-slate-700">Danh sách tài khoản ngân hàng</span>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-500 text-white font-bold flex items-center justify-center text-sm shadow-sm">
                AD
            </div>
            <span class="text-sm font-semibold text-slate-700">Administrator</span>
        </div>
    </header>

    <div class="p-8 flex-1 overflow-y-auto">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6">

            <div class="sm:flex sm:items-center sm:justify-between border-b border-slate-100 pb-5 mb-6">
                <div>
                    <h1 class="text-xl font-bold text-slate-900">Danh Sách Tài Khoản Khách Hàng</h1>
                    <p class="mt-1 text-sm text-slate-500">Hệ thống hiển thị, phân trang và bộ lọc nâng cao thời gian thực.</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('bank-accounts.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-xl shadow-sm text-sm transition">
                        <i class="fa-solid fa-plus text-xs"></i> Thêm Tài Khoản
                    </a>
                </div>
            </div>

            <form id="filterForm" action="{{ route('bank-accounts.index') }}" method="GET" class="bg-slate-50 rounded-xl p-5 mb-6 border border-slate-200/60 shadow-inner">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tìm kiếm nhanh</label>
                        <div class="relative">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Tên, email, sđt..."
                                   class="w-full text-sm pl-9 pr-3 py-2 bg-white rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-800">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Số dư tối thiểu (VNĐ)</label>
                        <div class="relative">
                            <i class="fa-solid fa-wallet absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="number" name="min_balance" value="{{ request('min_balance') }}" placeholder="Ví dụ: 10000000"
                                   class="w-full text-sm pl-9 pr-3 py-2 bg-white rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-800">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Từ ngày tạo</label>
                        <input type="date" name="from_date" value="{{ request('from_date') }}"
                               class="w-full text-sm px-3 py-2 bg-white rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-600">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Đến ngày tạo</label>
                        <input type="date" name="to_date" value="{{ request('to_date') }}"
                               class="w-full text-sm px-3 py-2 bg-white rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-slate-600">
                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-4 pt-3 border-t border-slate-200/60">
                    <button type="button" onclick="resetFilters()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold text-xs rounded-lg transition shadow-sm cursor-pointer">
                        <i class="fa-solid fa-arrows-rotate"></i> Reset
                    </button>
                    <button type="submit" class="inline-flex items-center gap-1.5 px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-lg shadow-sm transition cursor-pointer">
                        <i class="fa-solid fa-filter"></i> Áp dụng Lọc
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto rounded-xl border border-slate-200">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs uppercase font-bold border-b border-slate-200">
                        <th class="py-3.5 px-5">STT</th>
                        <th class="py-3.5 px-5">Chủ tài khoản</th>
                        <th class="py-3.5 px-5">Số tài khoản</th>
                        <th class="py-3.5 px-5">Số điện thoại</th>
                        <th class="py-3.5 px-5">Số dư hiện tại</th>
                        <th class="py-3.5 px-5 text-center">Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($accounts as $index => $account)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-4 px-5 font-semibold text-slate-400">
                                {{ ($accounts->currentPage() - 1) * $accounts->perPage() + $index + 1 }}
                            </td>
                            <td class="py-4 px-5">
                                <div class="font-bold text-slate-800">{{ $account->full_name }}</div>
                                <div class="text-xs text-slate-400 font-medium">{{ $account->email }}</div>
                            </td>
                            <td class="py-4 px-5 font-mono text-slate-600">{{ $account->account_number }}</td>
                            <td class="py-4 px-5 text-slate-500 font-medium">{{ $account->phone }}</td>
                            <td class="py-4 px-5 font-bold text-emerald-600">
                                {{ number_format($account->balance, 0, ',', '.') }}đ
                            </td>
                            <td class="py-4 px-5 text-center">
                                @if($account->status == 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Kích hoạt</span>
                                @elseif($account->status == 'inactive')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">Tạm khóa</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">Bị cấm</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400 font-medium">
                                <i class="fa-regular fa-folder-open text-3xl block mb-2 text-slate-300"></i>
                                Không tìm thấy tài khoản ngân hàng nào khớp với bộ lọc.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                {{ $accounts->links() }}
            </div>

        </div>
    </div>
</main>

<script>
    function resetFilters() {
        // Lấy ra form bộ lọc
        const form = document.getElementById('filterForm');

        // Xóa sạch toàn bộ dữ liệu đang nhập trong các ô input
        form.querySelectorAll('input').forEach(input => input.value = '');

        // Tự động submit lại form trống để đưa danh sách về mặc định ban đầu
        form.submit();
    }
</script>

</body>
</html>
