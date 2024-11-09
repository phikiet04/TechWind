@extends('admin.inc.app')
@section('title', 'Users')

@section('content')

<div class="flex flex-col flex-1 w-full">
    <main class="h-full overflow-y-auto ">
        <div class="container px-6 mx-auto grid">

            <h4
                class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-300 dark:border-gray-600">
                <div class="px-2 py-4 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <a class="w-full custom-border" href="{{ route('admin.users.create') }}">Tạo người dùng mới</a>
                </div>
            </h4>

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto ">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">
                                    <a
                                        href="{{ route('admin.users.index', ['sort' => 'id', 'direction' => ($sortField === 'id' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                        <span>ID</span>
                                    </a>
                                </th>
                                <th class="px-4 py-3">Ảnh</th>
                                <th class="px-4 py-3">
                                    <a
                                        href="{{ route('admin.users.index', ['sort' => 'name', 'direction' => ($sortField === 'name' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                        <span>Tên</span>
                                    </a>
                                </th>
                                <th class="px-4 py-3">
                                    <a
                                        href="{{ route('admin.users.index', ['sort' => 'email', 'direction' => ($sortField === 'email' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                        <span>Email</span>
                                    </a>
                                </th>
                                <th class="px-4 py-3">
                                    <a
                                        href="{{ route('admin.users.index', ['sort' => 'phone', 'direction' => ($sortField === 'phone' && $sortDirection === 'asc') ? 'desc' : 'asc']) }}">
                                        <span>Phone</span>
                                    </a>
                                </th>
                                <th class="px-4 py-3">Địa chỉ</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach($users as $user)
                                                                <tr class="text-gray-700 dark:text-gray-400">
                                                                    <td class="px-4 py-3">
                                                                        <span class="font-semibold text-sm">{{ $user->id }}</span>
                                                                    </td>
                                                                    <td class="px-4 py-3">
                                                                        <img src="{{ asset('storage/' . $user->userMeta->image ?? '') }}" alt="{{ $user->name }}">
                                                                    </td>
                                                                    <td class="px-4 py-3">
                                                                        <a href="{{ route('admin.users.show', $user->id) }}">
                                                                            <span class="font-semibold text-sm">{{ $user->name }}</span>
                                                                        </a>
                                                                    </td>

                                                                    <td class="px-4 py-3 text-sm">
                                                                        <span class="text-xs font-semibold text-secondary">{{ $user->email }}</span>
                                                                    </td>
                                                                    <td class="px-4 py-3 text-sm">
                                                                        <span
                                                                            class="text-xs font-semibold text-secondary">{{ $user->userMeta->phone ?? '' }}</span>
                                                                    </td>
                                                                    <td class="px-4 py-3 text-sm">
                                                                        <span
                                                                            class="text-xs font-semibold text-secondary">{{ $user->userMeta->address ?? '' }}</span>
                                                                    </td>
                                                                    <td class="px-4 py-3 text-sm">
                                                                        <span
                                                                            class="text-xs font-semibold text-secondary">{{ $user->userMeta->role ?? '' }}</span>
                                                                    </td>
                                                                    <td class="px-4 py-3">
                                                                        <div class="flex items-center space-x-4 text-sm">
                                                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none">
                                                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                                                    viewBox="0 0 20 20">
                                                                                    <path
                                                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                                                    </path>
                                                                                </svg>
                                                                            </a>
                                                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                                                style="display:inline;"
                                                                                onclick="return confirm('Bạn muốn xoá người dùng này?');">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none">
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
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    Showing {{ $users->firstItem() }}-{{ $users->lastItem() }} of {{ $users->total() }}
                </span>
                <span class="col-span-2"></span>

                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center">
                            <!-- Previous Button -->
                            <li>
                                <a href="{{ $users->previousPageUrl() }}"
                                    class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                    aria-label="Previous" {{ $users->onFirstPage() ? 'disabled' : '' }}>
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>

                            <!-- Page Numbers -->
                            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                <li>
                                    <a href="{{ $url }}"
                                        class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple {{ $page == $users->currentPage() ? 'bg-purple-600 text-white' : '' }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach

                            <!-- Next Button -->
                            <li>
                                <a href="{{ $users->nextPageUrl() }}"
                                    class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                    aria-label="Next" {{ $users->hasMorePages() ? '' : 'disabled' }}>
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
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
        email: 1,
        phone: 1,
        address: 1,
        role: 1
    };

    function sortTable(column) {
        const table = document.getElementById('usersTable');
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
            } else if (column === 'email') {
                tdA = a.getElementsByTagName('td')[2].innerText;
                tdB = b.getElementsByTagName('td')[2].innerText;
            } else if (column === 'phone') {
                tdA = a.getElementsByTagName('td')[3].innerText;
                tdB = b.getElementsByTagName('td')[3].innerText;
            } else if (column === 'address') {
                tdA = a.getElementsByTagName('td')[4].innerText;
                tdB = b.getElementsByTagName('td')[4].innerText;
            } else if (column === 'role') {
                tdA = a.getElementsByTagName('td')[5].innerText;
                tdB = b.getElementsByTagName('td')[5].innerText;
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