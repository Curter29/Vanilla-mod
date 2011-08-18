<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>{asset name='Head'}</head>
<body id="{$BodyID}" class="{$BodyClass}">

<div id="main_top">
    <div id="main_toper">
        <div class="headbar">
            <div class="fixed1">
                <ul>
                    <li class="logo"><a href="/">{logo}</a></li>
                    {discussions_link}
                    {inbox_link}
                    <li>search</li>
                    <li>profile</li>
                </ul>
            </div>
        </div>
        <div class="fixed1">
            <div class="content">{asset name="Content"}</div>
            <div class="sidepanel">asset name="Panel"</div>
        </div>        
    </div>
</div>
<div id="main_foot">
    <div id="main_footer">
        <div class="fixed1">
            футер пупер
        </div>
    </div>
</div>
  
</body>
</html>