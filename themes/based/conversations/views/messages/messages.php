<?if(!defined('APPLICATION')) exit();
$Session = Gdn::Session();

$Alt = FALSE;
$CurrentOffset = $this->Offset;
foreach ($this->MessageData->Result() as $Message)
{
   $CurrentOffset++;
   $Alt = $Alt == TRUE ? FALSE : TRUE;
   $Class = 'Item';
   $Class .= $Alt ? ' Alt' : '';
   if($this->Conversation->DateLastViewed < $Message->DateInserted) $Class .= ' New';
   if($Message->InsertUserID == $Session->UserID) $Class .= ' Mine';
   //if($Message->InsertPhoto != '') $Class .= ' HasPhoto';
      
   $Format = empty($Message->Format) ? 'Display' : $Message->Format;
   $Author = UserBuilder($Message, 'Insert');

   $this->EventArguments['Message'] = &$Message;
   $this->EventArguments['Class'] = &$Class;
   $this->FireEvent('BeforeConversationMessageItem');
   $Class = trim($Class);
?>
<li id="Message_<?=$Message->MessageID?>"<?=($Class ? ' class="'.$Class.'"' : '')?>>
    <a name="Item_<?=$CurrentOffset?>"></a>
    <?=Gdn_UserBox($Author, $Message->DateInserted)?>        
    <?$this->FireEvent('BeforeConversationMessageBody')?>
    <div class="Msg">
        <span class="AuthorMsgLink"></span>
        <?=Gdn_Format::To($Message->Body, $Format)?>
    </div>
</li>
<?}