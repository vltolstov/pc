<!DOCTYPE html>
<html lang="ru">

<head>

    <base href="{{$baseUrl}}">
    <title>{{$title}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    @vite('resources/css/app.css')

    <script src="https://cdn.tiny.cloud/1/pwwklnveu0jc4p1ceg32skwkcquplljar7c0z299id0813yn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<body>

@section('registration')
@show

@section('login')
@show

@section('admin-panel')
@show

@vite('resources/js/app.js')

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'image autolink lists media table',
        toolbar: 'styleselect bold italic alignleft aligncenter alignright a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        language: 'ru',
    });
</script>

</body>
</html>
