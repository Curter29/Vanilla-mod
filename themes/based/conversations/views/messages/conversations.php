<?php if (!defined('APPLICATION')) exit();
$Session = Gdn::Session();
$Alt = FALSE;
$SubjectsVisible = C('Conversations.Subjects.Visible');

foreach ($this->ConversationData->Result() as $Conversation) {
   $Alt = $Alt == TRUE ? FALSE : TRUE;
   $LastAuthor = UserBuilder($Conversation, 'LastMessage');
   $LastPhoto = UserPhoto($LastAuthor, 'Photo');
   $CssClass = 'Item';
   $CssClass .= $Alt ? ' Alt' : '';
   $CssClass .= $Conversation->CountNewMessages > 0 ? ' New' : '';
   $CssClass .= $LastPhoto != '' ? ' HasPhoto' : '';
   $JumpToItem = $Conversation->CountMessages - $Conversation->CountNewMessages;
   if($Conversation->Format == 'Text') $Message = (SliceString(Gdn_Format::To($Conversation->LastMessage, $Conversation->Format), 100));
   else $Message = (SliceString(Gdn_Format::Text(Gdn_Format::To($Conversation->LastMessage, $Conversation->Format), FALSE), 100));
   if(StringIsNullOrEmpty(trim($Message))) $Message = T('Blank Message');
   $this->EventArguments['Conversation'] = $Conversation;
   $Names = '';
   $PhotoUser = NULL;
?>
<li class="<?=$CssClass;?>">
   <?foreach ($Conversation->Participants as $User){
      if(GetValue('UserID', $User) == Gdn::Session()->UserID) continue;
      $Names = ConcatSep(', ', $Names, GetValue('Name', $User));
      if(!$PhotoUser && GetValue('Photo', $User)) $PhotoUser = $User;
   }
   $Url = '/messages/'.$Conversation->ConversationID.'/#Item_'.$JumpToItem;
   $avatar = UserPhoto($PhotoUser);
   $avatar = $avatar ? $avatar : '<a href="'.Url('/profile/'.$User['UserID'].'/'.rawurlencode($User['Name'])).'" title="'.htmlspecialchars($User['Name']).'"><img src="/uploads/stub-avatar.gif"></a>';
   $date_class = '';
   $date_str = Gdn_DateF($Conversation->DateLastMessage, $date_class);
   ?>
    <div class="ItemContent Conversation">

        <table class="Author"><tr>
        <td class="avatar"><?=$avatar?></td>
        <td class="profile"><?=Anchor(htmlspecialchars($Names), $Url)?></td>
        <td class="Meta">
             <?$this->FireEvent('BeforeConversationMeta')?>             
             <span class="label pub_info<?=$date_class?>">последнее сообщение <?=$date_str?></span>
             <?if($Conversation->CountMessages){?><span class="label comments_info"><?=$Conversation->CountMessages,' ',Gdn_Plural($Conversation->CountMessages, 'сообщение', 'сообщения', 'сообщений')?></span><?}?>
             <?if($Conversation->CountNewMessages){?><span class="label comments_new"><?=$Conversation->CountNewMessages,' ',Gdn_Plural($Conversation->CountNewMessages, 'новое', 'новых', 'новых')?></span><?}?>
        </td>
        </tr></table>
        <div class="Excerpt"><?php echo Anchor($Message, $Url, 'Message'); ?></div>
   </div>
</li>
<?}