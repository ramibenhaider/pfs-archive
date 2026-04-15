@extends('layouts.note-layout')

@section('note-title', 'تعديل ملاحظة: '. $note->employee->name)

@section('method')
@method('PUT')
@endsection

@section('action', route('note.update', $note->id))

@section('actionForDelete', route('note.destroy', $note->id))

@section('backTo', route('employee.edit', encodeId($note->employee->id)))

@section('deleteButton')
    <form action="{{ route('note.destroy', $note->id) }}"  method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete-sm" onclick="return confirm('هل أنت متأكد من حذف هذه الملاحظة نهائياً؟');" style="padding: 10px 30px !important; height: 100%; cursor: pointer;">
            حذف الملاحظة
        </button>
    </form>
@endsection
