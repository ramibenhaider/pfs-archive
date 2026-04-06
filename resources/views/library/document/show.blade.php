@foreach ($documents as $document)
<h1>{{ $document->employee->name }}</h1>
<h2>{{ $document->document_type->type }}</h2>
<h3>{{ $document->file_path }}</h3>
<h3>{{ $document->comment }}</h3>
@endforeach
