<!DOCTYPE html>
<html>
<head>
    <title>Edit Tag</title>
</head>
<body>
    <h1>Edit Tag</h1>
    <form action="{{ route('tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Tag Name:</label>
        <input type="text" name="name" id="name" value="{{ $tag->name }}">
        <button type="submit">Update</button>
    </form>
</body>
</html>
