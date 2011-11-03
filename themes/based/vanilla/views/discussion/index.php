<?
if (!defined('APPLICATION')) exit();
$Session = Gdn::Session();
$DiscussionName = Gdn_Format::Text($this->Discussion->Name);
if($DiscussionName == '') $DiscussionName = '-';
if(!function_exists('WriteComment')) include($this->FetchViewLocation('helper_functions', 'discussion'));

//if (!property_exists($Sender, 'CanEditComments')) $Sender->CanEditComments = $Session->CheckPermission('Vanilla.Comments.Edit', TRUE, 'Category', 'any') && C('Vanilla.AdminCheckboxes.Use');

/*if ($Session->IsValid()) {
   // Bookmark link
   echo Anchor(
      '<span>*</span>',
      '/vanilla/discussion/bookmark/'.$this->Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($this->SelfUrl),
      'Bookmark' . ($this->Discussion->Bookmarked == '1' ? ' Bookmarked' : ''),
      array('title' => T($this->Discussion->Bookmarked == '1' ? 'Unbookmark' : 'Bookmark'))
   );
}*/

$PageClass = $date_class = '';
if($this->Pager->FirstPage()) $PageClass = 'FirstPage';
$date_str = Gdn_DateF($this->Discussion->DateInserted, $date_class);
?>

<div class="DataList">
    <div class="Item">
        <span class="Title"><?=$DiscussionName?></span>
        <div class="Meta">
            <?if($this->Discussion->Announce == '1'){?><span class="label anonce"><i></i>важно</span><?}?>
            <?if($this->Discussion->Closed == '1'){?><span class="label closed"><i></i>закрыта</span><?}?>
            <span class="label pub_info<?=$date_class?>"><?printf('опубликованно %s в: %s', $date_str, Anchor($this->Discussion->Category, '/categories/'.$this->Discussion->CategoryUrlCode))?></span>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?$this->FireEvent('BeforeDiscussion')?>
<ul class="MessageList Discussion <?=$PageClass;?>"><?=$this->FetchView('comments')?></ul>
<?$this->FireEvent('AfterDiscussion');
if($this->Pager->LastPage()){
   $LastCommentID = $this->AddDefinition('LastCommentID');
   if(!$LastCommentID || $this->Data['Discussion']->LastCommentID > $LastCommentID)
      $this->AddDefinition('LastCommentID', (int)$this->Data['Discussion']->LastCommentID);
   $this->AddDefinition('Vanilla_Comments_AutoRefresh', Gdn::Config('Vanilla.Comments.AutoRefresh', 0));
}

echo $this->Pager->ToString('more');

// Write out the comment form
if($Session->IsValid() && $Session->CheckPermission('Vanilla.Comments.Add', TRUE, 'Category', $this->Discussion->PermissionCategoryID)) echo $this->FetchView('comment', 'post');
elseif($Session->IsValid()){?>
   <div class="Foot Closed">
      <div class="Note Closed">Комментарии запрещены в этой теме</div>
      <?=Anchor('&larr; Назад к всем темам', 'discussions', 'TabLink');?>
   </div><?}
else{?>
   <div class="Foot">
      <?php
      echo Anchor('Комментировать', SignInUrl($this->SelfUrl.(strpos($this->SelfUrl, '?') ? '&' : '?').'post#Form_Body'), 'TabLink'.(SignInPopup() ? ' SignInPopup' : ''));
      ?> 
   </div>
<?}
