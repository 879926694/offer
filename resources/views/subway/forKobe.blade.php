<html>
<style type="text/css">

</style>
<body background="/img/kobe.jpeg" style=" background-repeat:no-repeat ;
background-size:100% 100%;
background-attachment: fixed;">
<div bgcolor="white">
        <form action="/offer/api/database/forKobe" method="post" autocomplete="on" bgcolor="white">
            <input type="hidden" name="id" value="{{$id}}">
            <textarea name="talk" rows="10" cols="30" placeholder="感谢您点到这里"></textarea><br><br />
            <input type="submit" onclick="alert('感谢您的支持')"/>
        </form>
</div>
</body>
</html>
