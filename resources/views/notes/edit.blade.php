<!DOCTYPE html>
<html>
<head>
    <title>Notes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Williams Notes</h1>

    <div class="container mt-5">
        <h2>Edit Note</h2>
        <form action="{{ route('notes.update', $note->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $note->title }}" required>
            </div>
            <div class="form-group">
                <label for="images">Images:</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
            </div>
            @if ($note->images)
                <img src="{{ Storage::url($image->image) }}" alt="Note Image" class="img-fluid mb-3">
            @endif
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="4" required>{{ $note->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Note</button>
        </form>
    </div>
</body>

</body>
</html>
