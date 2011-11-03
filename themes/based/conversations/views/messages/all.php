<?if(!defined('APPLICATION')) exit();?>
<?if($this->ConversationData->NumRows() > 0){?>
<ul class="Condensed DataList Conversations">
   <?
   $ViewLocation = $this->FetchViewLocation('conversations');
   include($ViewLocation);
   ?>
</ul>
<?=$this->Pager->ToString();
}
else
{
   echo '<div class="Empty">',T('You do not have any conversations.'),'</div>';
}
