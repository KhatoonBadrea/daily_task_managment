@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">تعديل المهمة</h2>
    
    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">العنوان</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $task->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea name="description" class="form-control" id="description" rows="3" required>{{ $task->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label">تاريخ الاستحقاق</label>
            <input type="date" name="due_date" class="form-control" id="due_date" value="{{ $task->due_date }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">الحالة</label>
            <select name="status" class="form-select" required>
                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>قيد الانتظار</option>
                <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>مكتملة</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>
@endsection
