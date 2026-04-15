@extends('layouts.note-layout')

@section('note-title', 'إضافة ملاحظة شخصية')

@section('action', route('myNote.store'))

@section('backTo', route('note.index'))