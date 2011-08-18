<?
    $Session = Gdn::Session();
    $login = $Session->IsValid();
    if($this->Menu)
    {
        //$this->Menu->AddLink('Dashboard', T('Dashboard'), '/dashboard/settings', array('Garden.Settings.Manage'));
        //$this->Menu->AddLink('Activity', T('Activity'), '/activity');
        /*if($Session->IsValid())
        {
            $Name = $Session->User->Name;
            $CountNotifications = (int)$Session->User->CountNotifications;
            if($CountNotifications ) $Name .= '<span class="Alert">'.$CountNotifications.'</span>';
            $ProfileSlug = $Session->UserID.'/'.urlencode($Session->User->Name);            
            $this->Menu->AddLink('User', $Name, '/profile/'.$ProfileSlug, array('Garden.SignIn.Allow'), array('class' => 'UserNotifications'));
            $this->Menu->AddLink('SignOut', T('Sign Out'), SignOutUrl(), FALSE, array('class' => 'NonTab SignOut'));
        }
        else
        {
            $Attribs = array();
            if (SignInPopup() && strpos(Gdn::Request()->Url(), 'entry') === FALSE) $Attribs['class'] = 'SignInPopup';                
            $this->Menu->AddLink('Entry', T('Sign In'), SignInUrl(), FALSE, array('class' => 'NonTab'), $Attribs);
        }*/
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><?$this->RenderAsset('Head')?></head>
<body id="<?=$BodyIdentifier?>" class="<?=$this->CssClass?>">
<div id="main_top">
    <div id="main_toper">
        <div class="headbar">
            <div class="fixed1">
                <table class="headbart">
                    <tr>
                        <td class="logo">
                            <h1><a href="/"><?=Gdn_Theme::Logo()?></a></h1>
                        </td>
                        <td class="menu"><?=$this->Menu->ToString()?></td>
                        <td class="search">3</td>
                        <td class="upanel">
                            <?if($login){
                                $CountNotifications = (int)$Session->User->CountNotifications;
                                $avatar = $Session->User->Photo;                    
                                if($avatar) $avatar = '/uploads/'.str_replace('s/', 's/n', $avatar);
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
                                    <a href="/entry/signin" class="SignInPopup">Войти</a> или <a href="<?=RegisterUrl()?>">Зарегестрироваться</a>
                                </span>
                            <?}?> 
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="fixed1">
            <div class="content"><?$this->RenderAsset('Content')?></div>
            <div class="sidepanel"><?$this->RenderAsset('Panel')?></div>
        </div>        
    </div>
</div>
<div id="main_foot">
    <div id="main_footer">
        <div class="fixed1">
          --  
        </div>
    </div>
</div>

<div id="Foot" style="display: none;"><?=$this->RenderAsset('Foot')?></div>
<?$this->FireEvent('AfterBody')?>

</body>
</html>
