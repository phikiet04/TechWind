<!-- resources/views/admin/orders/index.blade.php -->
@extends('admin.inc.app')

@section('title', 'Danh sách đơn hàng')

@section('content')
<div class="flex flex-col flex-1 w-full">
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-300 dark:border-gray-600">
                Đơn hàng mới
            </h4>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">
                                    <a href="{{ route('admin.orders.index', ['sort' => 'id', 'direction' => ($sortField === 'id' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                        <span>ID</span>
                                    </a>
                                </th>
                                <th class="px-4 py-3">
                                    <a href="{{ route('admin.orders.index', ['sort' => 'user_id', 'direction' => ($sortField === 'user_id' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                        <span>Người dùng</span>
                                    </a>
                                </th>
                                <th class="px-4 py-3">Giá</th>
                                <th class="px-4 py-3">Trạng thái</th>
                                <th class="px-4 py-3">
                                    <a href="{{ route('admin.orders.index', ['sort' => 'created_at', 'direction' => ($sortField === 'created_at' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                        <span>Ngày mua hàng</span>
                                    </a>
                                </th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach($orders as $order)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">{{ $order->id }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('admin.users.show', $order->user->id) }}">
                                            <span class="font-semibold text-sm">{{ $order->user->name }}</span>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        $ {{ number_format($order->orderItems->sum('price'), 2) }}
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        <span class="px-2 py-1 font-semibold leading-tight 
                                            @if($order->status == 'pending') text-green-700 bg-green-100 
                                            @elseif($order->status == 'processing') text-yellow-700 bg-yellow-100
                                            @elseif($order->status == 'canceled') text-red-700 bg-red-100
                                            @elseif($order->status == 'completed') text-blue-700 bg-blue-100
                                            @else text-gray-700 bg-gray-100 
                                            @endif rounded-full dark:bg-gray-700 dark:text-gray-100">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="text-purple-600">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;" onclick="return confirm('Are you sure you want to delete this order?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    Showing {{ $orders->firstItem() }}-{{ $orders->lastItem() }} of {{ $orders->total() }}
                </span>
                <span class="col-span-2"></span>
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center">
                            <!-- Previous Page Link -->
                            <li>
                                <a href="{{ $orders->previousPageUrl() }}" class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous" @if(!$orders->previousPageUrl()) disabled @endif>
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"></path>
                                    </svg>
                                </a>
                            </li>

                            <!-- Next Page Link -->
                            <li>
                                <a href="{{ $orders->nextPageUrl() }}" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next" @if(!$orders->nextPageUrl()) disabled @endif>
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path d="M7.293 5.293a1 1 0 011.414 0L11 8.586l-2.293 2.293a1 1 0 11-1.414-1.414L9.586 9 7.293 6.707a1 1 0 010-1.414z"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </span>
            </div>
        </div>
    </main>
</div>
@endsection
