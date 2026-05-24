<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Mới Tài Khoản Ngân Hàng</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">

<div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl text-emerald-800 flex items-center justify-between shadow-sm">
            <span class="font-medium text-sm">🎉 {{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'" class="text-emerald-500 hover:text-emerald-700 font-bold text-lg">&times;</button>
        </div>
    @endif

    <h2 class="text-2xl font-bold text-gray-800 mb-2">Thêm Tài Khoản Mới</h2>
    <p class="text-sm text-gray-500 mb-8">Vui lòng điền đầy đủ thông tin tài khoản dưới đây.</p>

    <form action="{{ route('bank-accounts.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Họ và tên chủ tài khoản <span class="text-red-500">*</span></label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full px-4 py-3 rounded-xl border @error('full_name') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
            @error('full_name') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Số tài khoản (10 số) <span class="text-red-500">*</span></label>
                <input type="text" name="account_number" value="{{ old('account_number') }}" class="w-full px-4 py-3 rounded-xl border @error('account_number') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                @error('account_number') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Số điện thoại <span class="text-red-500">*</span></label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 rounded-xl border @error('phone') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                @error('phone') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Địa chỉ Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-xl border @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
            @error('email') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Số dư ban đầu (VNĐ)</label>
                <input type="number" name="balance" value="{{ old('balance') }}" class="w-full px-4 py-3 rounded-xl border @error('balance') border-red-400 bg-red-50 @else border-gray-200 @enderror focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                @error('balance') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Trạng thái tài khoản</label>
                <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 bg-white">
                    <option value="active">Kích hoạt (Active)</option>
                    <option value="inactive">Tạm khóa (Inactive)</option>
                    <option value="banned">Bị cấm (Banned)</option>
                </select>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 px-4 rounded-xl shadow-md transition duration-200 text-center">
                Xác Nhận Thêm Tài Khoản
            </button>
        </div>
    </form>
</div>

</body>
</html>
