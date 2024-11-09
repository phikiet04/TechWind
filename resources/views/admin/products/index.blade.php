@extends('admin.inc.app')
@section('title', 'Products List')

@section('content')

<div class="flex flex-col flex-1 w-full">
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <!-- Tạo sản phẩm mới -->
            <h4
                class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-300 dark:border-gray-600 ">
                <div class="px-2 py-4 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 ">
                    <a class="w-full custom-border" href="{{ route('admin.products.create') }}">Tạo sản phẩm mới</a>
                </div>
            </h4>

            <!-- Bảng sản phẩm -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <!-- Sắp xếp theo các trường -->
                                @foreach (['id', 'Tên', 'Danh mục', 'Ảnh', 'Giá', 'Màu', 'Size', 'Số lượng', 'Status', 'Action'] as $header)
                                    <th class="px-4 py-3">
                                        @if (in_array($header, ['id', 'name', 'category_id']))
                                            <a
                                                href="{{ route('admin.products.index', ['sort' => $header, 'direction' => ($sortField === $header && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                                <span>{{ ucfirst($header) }}</span>
                                            </a>
                                        @else
                                            <span>{{ ucfirst($header) }}</span>
                                        @endif
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                @foreach($product->variants as $variant)
                                    <tr class="border">
                                        @if ($loop->first)
                                            <td class="align-middle text-center border" rowspan="{{ $product->variants->count() }}">
                                                {{ $product->id }}
                                            </td>
                                            <td class="align-middle border" rowspan="{{ $product->variants->count() }}">
                                                <a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a>
                                            </td>
                                            <td class="align-middle border" rowspan="{{ $product->variants->count() }}">
                                                {{ $product->category ? $product->category->name : 'N/A' }}
                                            </td>
                                        @endif
                                        <td class="align-middle text-center border">
                                            @if ($variant->image)
                                                <img src="{{ asset('storage/' . $variant->image) }}" alt="Variant Image"
                                                    style="width: 75px; height: auto;">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center border">{{ number_format($variant->price, 2) }}</td>
                                        <td class="align-middle text-center border">{{ $variant->color }}</td>
                                        <td class="align-middle text-center border">{{ $variant->size }}</td>
                                        <td class="align-middle text-center border">{{ $variant->stock }}</td>
                                        <td class="align-middle text-center border">
                                            {{ $variant->stock > 0 ? 'Còn hàng' : 'Hết hàng' }}
                                        </td>
                                        <td class="align-middle text-center border">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <!-- Form xóa cho mỗi variant -->
                                                <form action="{{ route('admin.variants.destroy', $variant->id) }}" method="POST"
                                                    style="display:inline;"
                                                    onclick="return confirm('Bạn muốn xoá biến thể này?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none">
                                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Phân trang -->
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }}
                </span>
                <span class="col-span-2"></span>

                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center">
                            <!-- Previous Button -->
                            <li>
                                <a href="{{ $products->previousPageUrl() }}"
                                    class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                    aria-label="Previous" {{ $products->onFirstPage() ? 'disabled' : '' }}>
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>

                            <!-- Page Numbers -->
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                <li>
                                    <a href="{{ $url }}"
                                        class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple {{ $page == $products->currentPage() ? 'bg-purple-600 text-white' : '' }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach

                            <!-- Next Button -->
                            <li>
                                <a href="{{ $products->nextPageUrl() }}"
                                    class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                    aria-label="Next" {{ $products->hasMorePages() ? '' : 'disabled' }}>
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
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


<script>
    let sortDirection = {
        id: 1,
        name: 1,
    };

    function sortTable(column) {
        const table = document.getElementById('productsTable');
        const tbody = table.getElementsByTagName('tbody')[0];
        const rows = Array.from(tbody.getElementsByTagName('tr'));

        rows.sort((a, b) => {
            let tdA, tdB;

            if (column === 'id') {
                tdA = parseInt(a.getElementsByTagName('td')[0].innerText);
                tdB = parseInt(b.getElementsByTagName('td')[0].innerText);
            } else if (column === 'name') {
                tdA = a.getElementsByTagName('td')[1].innerText;
                tdB = b.getElementsByTagName('td')[1].innerText;
            }

            if (tdA < tdB) return -1 * sortDirection[column];
            if (tdA > tdB) return 1 * sortDirection[column];
            return 0;
        });

        sortDirection[column] *= -1;

        rows.forEach(row => tbody.appendChild(row));
    }
</script>

@endsection