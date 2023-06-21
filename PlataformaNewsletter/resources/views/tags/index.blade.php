<!DOCTYPE html>
<html>
<head>
    <title>Tags List</title>
</head>
<body>
    <h1>Tags List</h1>
    <ul>
        @foreach($tags as $tag)
            <li>{{ $tag->name }}</li>
        @endforeach
    </ul>
</body>
</html>