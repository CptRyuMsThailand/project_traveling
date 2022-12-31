<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello World</title>
</head>
<body>
    <img src="./test/test1.php?article=18">
    <div id="content"></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js" defer></script>
<script>
    window.onload = function(){
        document.getElementById('content').innerHTML =
      marked.parse('![imagetest](./test/test1.php?article=18)\n\n# Marked in the browser\n\nRendered by **marked**.');
    }
    
</script>
</html>