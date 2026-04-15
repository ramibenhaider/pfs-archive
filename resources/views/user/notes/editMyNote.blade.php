@extends('layouts.note-layout')

@section('note-title', 'تعديل ملاحظة: '. $currentUser->name)

@section('method')
@method('PUT')
@endsection

@section('action', route('myNote.update', $myNote->id))

@section('actionForDelete', route('myNote.destroy', $myNote->id))

@section('backTo', route('note.index'))

@section('deleteButton')
    <form action="{{ route('myNote.destroy', $myNote->id) }}"  method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete-sm" onclick="return confirm('هل أنت متأكد من حذف هذه الملاحظة نهائياً؟');" style="padding: 10px 30px !important; height: 100%; cursor: pointer;">
            حذف الملاحظة
        </button>
    </form>
@endsection
