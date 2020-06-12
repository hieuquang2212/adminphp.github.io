<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form enctype="multipart/form-data" action="[targetfile].php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        Upload this file: <input type="file" name="file" />
        <input type="submit" value="Submit File" />
    </form>
</body>
</html>