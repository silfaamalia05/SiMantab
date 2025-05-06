@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-xl font-semibold mb-4 dark:text-white">User Registration Requests</h2>
    <div class="bg-white shadow-md rounded-lg p-4">
        @if ($requests->count() > 0)
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left">Name</th>
                        <th class="py-2 px-4 border-b text-left">Email</th>
                        <th class="py-2 px-4 border-b text-left">Role</th>
                        <th class="py-2 px-4 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr class="border-b">
                            <td class="py-2 px-4 dark:text-white">{{ $request->user->name }}</td>
                            <td class="py-2 px-4 dark:text-white">{{ $request->user->email }}</td>
                            <td class="py-2 px-4 dark:text-white">{{ $request->user->role }}</td>
                            <td class="py-2 px-4 text-center">
                                <form action="{{ route('request_users.approve', $request->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Approve</button>
                                </form>
                                <form action="{{ route('request_users.decline', $request->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Decline</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-gray-500">Data request is empty</p>
        @endif
    </div>
</div>
@endsection
