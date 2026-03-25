@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('left-sidebar')
    <ul class="space-y-2">
        <li><a href="/students" class="text-blue-600 hover:underline font-bold">Manage Students</a></li>
        <li><a href="/classes" class="text-blue-600 hover:underline">Manage Classes</a></li>
    </ul>
@endsection

@section('content')
    <h2 class="text-xl font-semibold mb-4">Welcome to the Dashboard</h2>

    <div class="bg-white rounded border overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-3">ID</th>
                <th class="p-3">Name</th>
                <th class="p-3">Grade</th>
                <th class="p-3">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 text-gray-500">#{{ $student['id'] }}</td>
                    <td class="p-3 font-medium">{{ $student['name'] }}</td>
                    <td class="p-3">{{ $student['grade'] }}</td>
                    <td class="p-3">
                        @if ($student['status'] === 'Active')
                            <span class="text-green-600 font-bold">Active</span>
                        @else
                            <span class="text-yellow-600 font-bold">Pending</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('right-sidebar')
    <button class="bg-green-500 text-white px-4 py-2 w-full rounded mb-2">Add New Student</button>
@endsection
