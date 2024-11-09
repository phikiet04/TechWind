@extends('admin.inc.app')
@section('title', 'Chỉnh sửa đơn hàng #' . $order->id)

@section('content')
<div class="flex flex-col flex-1 w-full">
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <h3 class="text-lg py-3 px-4 font-semibold text-gray-800 dark:text-gray-200">Chỉnh sửa đơn hàng
                        </h3>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                                <!-- Order Code -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Mã đơn hàng</span>
                                    <input type="text"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Nhập mã đơn hàng" name="code"
                                        value="{{ old('code', $order->code) }}" required />
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </label>

                                <!-- Customer Name -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Tên khách hàng</span>
                                    <input type="text"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Nhập tên khách hàng" name="name"
                                        value="{{ old('name', $order->name) }}" required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </label>

                                <!-- Customer Email -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                                    <input type="email"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Nhập email khách hàng" name="email"
                                        value="{{ old('email', $order->email) }}" required />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </label>

                                <!-- Customer Phone -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Số điện thoại</span>
                                    <input type="text"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Nhập số điện thoại khách hàng" name="phone"
                                        value="{{ old('phone', $order->phone) }}" required />
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </label>

                                <!-- Customer Address -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Địa chỉ</span>
                                    <input type="text"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Nhập địa chỉ khách hàng" name="address"
                                        value="{{ old('address', $order->address) }}" required />
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </label>

                                <!-- Order Items (Products) -->
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Sản phẩm trong
                                    đơn hàng</h4>
                                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                                    <div class="w-full overflow-x-auto">
                                        <table class="w-full table-auto border-collapse">
                                            <thead>
                                                <tr
                                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                                    <th class="px-4 py-2">Sản phẩm</th>
                                                    <th class="px-4 py-2 text-left">Số lượng</th>
                                                    <th class="px-4 py-2 text-left">Giá</th>
                                                    <th class="px-4 py-2 text-left">Tổng</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                                @foreach($order->orderItems as $orderItem)
                                                    <tr class="text-gray-700 dark:text-gray-400">
                                                        <td class="px-4 py-2">{{ $orderItem->product->name }}</td>
                                                        <td class="px-4 py-2">{{ $orderItem->quantity }}</td>
                                                        <td class="px-4 py-2">
                                                            {{ number_format($orderItem->price, 0, ',', '.') }} $</td>
                                                        <td class="px-4 py-2">
                                                            {{ number_format($orderItem->total_price, 0, ',', '.') }} $</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <label class="block text-sm mt-4">
                                    <span class="text-gray-700 dark:text-gray-400">Tổng giá trị đơn hàng</span>
                                    <input type="text"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        value="{{ number_format($total, 0, ',', '.') }} $" disabled />
                                </label>
                                <!-- Order Status -->
                                <label class="block text-sm mb-4 mt-4">
                                    <span class="text-gray-700 dark:text-gray-400">Trạng thái đơn hàng</span>
                                    <select name="status"
                                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử
                                            lý</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Đã
                                            hoàn thành</option>
                                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Đã
                                            hủy</option>
                                    </select>
                                </label>

                                <!-- Submit Button -->
                                <div
                                    class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-300 dark:border-gray-600">
                                    <div
                                        class="px-2 py-4 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 ">
                                        <button type="submit" class="w-full custom-border">
                                            Cập nhật đơn hàng
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection