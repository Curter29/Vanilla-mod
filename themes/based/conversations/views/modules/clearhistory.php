<?if(!defined('APPLICATION')) exit();
if($this->ConversationID > 0) {?>
    <div class="DropDiscussion">
        или<br>
        <a href="/messages/clear/<?=$this->ConversationID?>" class="danger_action ClearConversation">удалить текущую беседу</a>
    </div>
<?}?>