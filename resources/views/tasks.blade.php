<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task List Application</title>
    <!-- Fonts & Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/tasks') }}">
                    Task List
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">

            @if (isset($task))
                <!-- نموذج تعديل مهمة موجودة (الجزء الخامس) -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Update Task
                    </div>

                    <div class="panel-body">
                        <form action="{{ url('update') }}" method="POST" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="id" value="{{ $task->id }}">

                            <div class="form-group">
                                <label for="task-name" class="col-sm-3 control-label">Task</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-btn fa-save"></i> Update Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <!-- نموذج إضافة مهمة جديدة -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        New Task
                    </div>

                    <div class="panel-body">
                        <form action="{{ url('create') }}" method="POST" class="form-horizontal">
                            @csrf

                            <div class="form-group">
                                <label for="task-name" class="col-sm-3 control-label">Task</label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="task-name" class="form-control" placeholder="Enter task name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-btn fa-plus"></i> Add Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <!-- جدول عرض المهام مع أزرار التعديل والحذف -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current Tasks
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Task</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $item)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $item->name }}</div>
                                    </td>

                                    <td style="display: flex; gap: 8px;">
                                        <!-- زر التعديل (الجزء الخامس) -->
                                        <form action="/edit/{{ $item->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info">
                                                <i class="fa fa-btn fa-edit"></i> Edit
                                            </button>
                                        </form>

                                        <!-- زر الحذف (الجزء الرابع) -->
                                        <form action="/delete/{{ $item->id }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
