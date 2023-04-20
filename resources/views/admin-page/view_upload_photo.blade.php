<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Image</title>
    @include('admin-page.css_section')
</head>
<body onload="window.resizeTo(500 ,400);">
 
    <div class="content-wrapper full-height">
    <form action="upload_photo" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Select Profile Image: <input type="file" name="image" id="profile_image" onchange="display()"></label>&nbsp;
        <button type="submit">Upload</button><br>
    </form><br>
    <img id="image" width="70%;"> 
    </div>

    @include('admin-page.js_section')
</body>
</html>