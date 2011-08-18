<?
if (!defined('APPLICATION')) exit();
$Session = Gdn::Session();
$DiscussionName = Gdn_Format::Text($this->Discussion->Name);
if($DiscussionName == '') $DiscussionName = 'Blank Discussion Topic';
if(!function_exists('WriteComment')) include($this->FetchViewLocation('helper_functions', 'discussion'));

/*if ($Session->IsValid()) {
   // Bookmark link
   echo Anchor(
      '<span>*</span>',
      '/vanilla/discussion/bookmark/'.$this->Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($this->SelfUrl),
      'Bookmark' . ($this->Discussion->Bookmarked == '1' ? ' Bookmarked' : ''),
      array('title' => T($this->Discussion->Bookmarked == '1' ? 'Unbookmark' : 'Bookmark'))
   );
}*/

$PageClass = '';
if($this->Pager->FirstPage()) $PageClass = 'FirstPage'; ?>
<div class="DiscussionHead">
    <span class="Title"><?=$DiscussionName?></span>
    <?if(C('Vanilla.Categories.Use')){?><span class="discussions_p">опубликованно в: <a class="Category" href="/categories/<?=$this->Discussion->CategoryUrlCode?>"><?=$this->Discussion->Category?></a></span><?}?>
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
if($this->Discussion->Closed == '1'){?>
   <div class="Foot Closed">
      <div class="Note Closed"><span class="discussions_c"><i></i>тема закрыта</span></div>
      <div class="clear"></div>
      <div class="arrow_back"><?=Anchor('&larr; Назад к всем темам', 'discussions', 'TabLink')?></div>
   </div><?}
elseif($Session->IsValid() && $Session->CheckPermission('Vanilla.Comments.Add', TRUE, 'Category', $this->Discussion->PermissionCategoryID)) echo $this->FetchView('comment', 'post');
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
