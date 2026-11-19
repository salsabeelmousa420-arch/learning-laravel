@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Task List Application</h1>
</div>

@if (isset($task))
    <!-- نموذج تعديل مهمة موجودة -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Update Task</h6>
        </div>

        <div class="card-body">
            <form action="{{ url('update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $task->id }}">

                <div class="form-group">
                    <label for="task-name">Task</label>
                    <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}" required>
                </div>

                <button type="submit" class="btn btn-info">
                    <i class="fas fa-save"></i> Update Task
                </button>
                <a href="{{ url('/tasks') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@else
    <!-- نموذج إضافة مهمة جديدة -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">New Task</h6>
        </div>

        <div class="card-body">
            <form action="{{ url('create') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="task-name">Task</label>
                    <input type="text" name="name" id="task-name" class="form-control" placeholder="Enter task name" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Task
                </button>
            </form>
        </div>
    </div>
@endif

<!-- جدول عرض المهام مع أزرار التعديل والحذف -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Current Tasks</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $item)
                        <tr>
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle" style="display: flex; gap: 8px;">
                                <!-- زر التعديل -->
                                <form action="/edit/{{ $item->id }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </form>

                                <!-- زر الحذف -->
                                <form action="/delete/{{ $item->id }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">لا توجد مهام حالياً</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
