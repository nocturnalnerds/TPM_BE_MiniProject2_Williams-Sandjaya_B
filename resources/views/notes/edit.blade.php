<!DOCTYPE html>
<html>
<head>
    <title>Edit Note</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1>Edit Note</h1>

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
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="4" required>{{ $note->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            @if ($note->image)
                <img src="{{ Storage::url($note->image->image) }}" alt="Note Image" class="img-fluid mb-3">
            @endif
            <button type="submit" class="btn btn-primary">Update Note</button>
        </form>
    </div>
</body>
</html>
