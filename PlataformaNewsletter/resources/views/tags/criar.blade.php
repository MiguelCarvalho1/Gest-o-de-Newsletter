<!DOCTYPE html>
<html>
<head>
    <title>Create Tag</title>
</head>
<body>
    <h1>Create Tag</h1>
    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <label for="name">Tag Name:</label>
        <input type="text" name="name" id="name">
        <button type="submit">Create</button>
    </form>
</body>
</html>
