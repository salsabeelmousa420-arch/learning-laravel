<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Page</title>
</head>
<body>
    <h1>مرحباً بك: {{ $name }}</h1>

    <form method="POST" action="/about">
        @csrf

        <label for="name">الاسم:</label>
        <input type="text" name="name" id="name" placeholder="أدخل اسمك هنا">
        <br><br>

        <label for="department">القسم:</label>
        <select name="department" id="department">
            @foreach($departments as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <br><br>

        <button type="submit">إرسال البيانات</button>
    </form>
</body>
</html>
