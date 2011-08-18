<?
if (!defined('APPLICATION')) exit();
$Target = $this->Target();
$Target = $Target ? '?Target='.urlencode($Target) : '';
?>
<div>
   <?php
   // Make sure to force this form to post to the correct place in case the view is
   // rendered within another view (ie. /dashboard/entry/index/):
   echo $this->Form->Open(array('Action' => $this->Data('FormUrl', Url('/entry/signin')), 'id' => 'Form_User_SignIn'));
   echo $this->Form->Errors();
   ?>
   <ul>
      <li class="pt10">
        <label for="Form_Email" class="dis_inline">Логин</label>
        <?if(strcasecmp(C('Garden.Registration.Method'), 'Connect') != 0){?><a class="gray_cap_sm" href="/entry/register<?=$Target?>">(Зарегестрироваться)</a><br><?}?>
        <input type="text" class="InputBox" value="" name="Form/Email" id="Form_Email">
      </li>
      <li class="pt10">
        <label for="Form_Password" class="dis_inline">Пароль</label> <a class="ForgotPassword gray_cap_sm" href="/entry/passwordrequest">(Вспомнить пароль)</a><br>
        <input type="password" class="InputBox Password" value="" name="Form/Password" id="Form_Password">          
      </li>
      <li class="Buttons">
         <?=$this->Form->CheckBox('RememberMe', T('Keep me signed in'), array('value' => '1', 'id' => 'SignInRememberMe'));?>
         <br class="clear"><b class="button"><i><input type="submit" value="Войти на сайт"></i></b>
      </li>
   </ul>
   <?=$this->Form->Close(),$this->Form->Open(array('Action' => Url('/entry/passwordrequest'), 'id' => 'Form_User_Password', 'style' => 'display: none;'));?>
   <ul>
      <li>
         <?=$this->Form->Label('Enter your email address or username', 'Email'),$this->Form->TextBox('Email');?>
      </li>
      <li class="Buttons">
        <?=$this->Form->Button('Request a new password')?>
        <div class="pt10"><?=Anchor('Я вспомнил пароль', '/entry/signin', 'ForgotPassword')?></div>
      </li>
   </ul>
   <?php echo $this->Form->Close(); ?>
</div>