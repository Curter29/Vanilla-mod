<?php if (!defined('APPLICATION')) exit(); ?>
<div class="Box">
   <h4><?php echo T('In this Conversation'); ?></h4>
   <ul class="PanelInfo">
   <?php
   $Result = $this->Data->Result();
   foreach ($this->Data->Result() as $User){
       $last_activity = Gdn_DateF($User->DateLastActive);
      if($User->Deleted) echo '<li class="Deleted">';
      else echo '<li>';

      echo Wrap(UserAnchor($User, 'UserLink'), 'strong', $User->Deleted ? array('title' => sprintf(T('%s deleted this conversation.'), $User->Name)) : '');
      echo $last_activity ? $last_activity : '&nbsp;';

      echo '</li>';
   }
   ?>
   </ul>
</div>