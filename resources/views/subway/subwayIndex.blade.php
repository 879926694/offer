<html>
<style type="text/css">

    #out{
        position:absolute; top:30%;left:50%; margin-top:-100px; margin-left:-200px;
    }

</style>
<body>
<div id="out">
<fieldset style="width:400px;">
    <legend>计算某月或某些工作日内北京地铁消费:</legend>
    <form action="/offer/api/database/subwayPay" method="post" autocomplete="on">
        名字 : <input type="text" name="name" required /><br /><br />
        地铁单程票价 : <input type="number" name="ticket" min="3" max="9" required style="width: 100px;"><br /><br />
        月份 : <input type="month" name="date" required/><br /><br />
        工作日 : <input type="number" name="days" min="1" max="31" style="width: 100px;"><br /><br />
        <textarea name="message" rows="10" cols="30" placeholder="随意填"></textarea><br><br />
        <input type="submit" />
    </form>
</fieldset>
</div>
</body>
