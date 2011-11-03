<?
    $Session = Gdn::Session();
    $login = $Session->IsValid();
    $logo_array = Gdn_Logo();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><?$this->RenderAsset('Head')?></head>
<body id="<?=$BodyIdentifier?>" class="<?=$this->CssClass?>">
<div id="main_top">
    <div id="main_toper">
        
        <?if($logo_array['mode'] == 2){//если есть картинка и длинное название?>
        <div class="headbar logobar">
            <table class="fixed1">
                <tr>
                    <td class="logo">
                        <?=$logo_array['title']?>
                    </td>
                </tr>
            </table>
        </div>
        <?}?>        
        <div class="headbar">
            <table class="fixed1">        
                <tr>
                    <?if($logo_array['mode'] == 1){?>
                    <td class="logo">
                        <h1><a href="/"><?=$logo_array['title']?></a></h1>
                    </td>
                    <?}?>
                    <td class="menu"><?=$this->Menu->ToString()?></td>
                    <td class="search"></td>
                    <td class="upanel">
                        <?if($login){
                            $CountNotifications = (int)$Session->User->CountNotifications;
                            if(($avatar = $Session->User->Photo)) $avatar = '/uploads/'.str_replace('s/', 's/n', $avatar);
                            else $avatar = '/uploads/stub-avatar.gif';
                            ?>
                            <a href="/" class="avatar"><div style="background-image: url(<?=$avatar?>);"></div></a>
                            <span class="uinfo">
                                <a href="/profile/<?=$Session->UserID.'/'.urlencode($Session->User->Name)?>"><?=$Session->User->Name?></a>
                                <?=$CountNotifications ? '<span class="Alert">'.$CountNotifications.'</span>' : ''?><br>
                                <a href="<?=SignOutUrl()?>">Выйти</a>
                            </span>
                        <?}else{?>
                            <span class="headsig">
                                <a href="/entry/signin" class="SignIn Popup">Войти</a> или <a href="<?=RegisterUrl()?>">Зарегестрироваться</a>
                            </span>
                        <?}?> 
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="fixed1">
            <noscript>
                <div class="Errors js_turned_off">
                    <h2>В Вашем браузере отключен Javascript.</h2>
                    Пожалуйста, включите JavaScript или обновите свой браузер, чтобы он поддерживал JavaScript для использования форума. 
                </div>
            </noscript>
            <div class="content"><?$this->RenderAsset('Content')?></div>
            <div class="sidebar"><?$this->RenderAsset('Panel')?></div>
        </div>
                
    </div>
</div>
<div id="main_foot">
    <div id="main_footer">
        <div class="fixed1">
            <div class="copyfoot">
                <span class="fmsg1">
                    <a href="http://support.turbof.ru">поддержка</a>
                </span>
                <span class="fmsg1">
                    <a href="http://turbof.ru">создать бесплатный форум</a>
                </span>
                turbof.ru 2008 - 2011 &copy;
            </div>
        </div>
    </div>
</div>

<?=$this->RenderAsset('Foot')?><?$this->FireEvent('AfterBody')?>
</body>
</html>
