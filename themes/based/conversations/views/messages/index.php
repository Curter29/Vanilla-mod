<?if(!defined('APPLICATION')) exit();?>

<div class="DataList HeadConversation">
    <div class="Item">
        <span class="Title"><?=$this->Participants?></span>
    </div>
</div>

<?if($this->Data('Conversation.Subject') && C('Conversations.Subjects.Visible')){?><h2><?=htmlspecialchars($this->Data('Conversation.Subject'))?></h2><?}?>

<?$this->FireEvent('BeforeConversation')?>
<?=$this->Pager->ToString('less')?>

<ul class="MessageList Conversation"><?include($this->FetchViewLocation('messages'))?></ul>

<?=$this->Pager->ToString()?>

<div id="MessageForm">
   <h2><?php echo T('Add Message'); ?></h2>
   <?php
   echo $this->Form->Open(array('action' => Url('/messages/addmessage/')));
   echo Wrap($this->Form->TextBox('Body', array('MultiLine' => TRUE, 'class' => 'MessageBox')), 'div', array('class' => 'TextBoxWrapper'));

   echo '<div class="Buttons">',
      $this->Form->Button('Send Message'),
      '</div>';

   echo $this->Form->Close();
   ?>
</div>
