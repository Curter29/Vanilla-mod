<?php if (!defined('APPLICATION')) exit();
$Session = Gdn::Session();
$ShowOptions = TRUE;
$Alt = '';
$PerPage = C('Vanilla.Comments.PerPage', 50);
foreach($this->DraftData->Result() as $Draft){
    $Offset = GetValue('CountComments', $Draft, 0);
    if($Offset > $PerPage) $Offset -= $PerPage;
    else $Offset = 0;
    $topic = !is_numeric($Draft->DiscussionID) || $Draft->DiscussionID <= 0 ? 1 : 0;    
    $EditUrl = $topic ? '/post/editdiscussion/0/'.$Draft->DraftID : '/discussion/'.$Draft->DiscussionID.'/'.$Offset.'/#Form_Comment';
   ?>
   <li class="Item Draft <?=$topic ? 'Topic' : 'Comment'?>">
      <?=Anchor(T('Draft.Delete', 'Delete'), 'vanilla/drafts/delete/'.$Draft->DraftID.'/'.$Session->TransientKey().'?Target='.urlencode($this->SelfUrl), 'Delete')?>
      <div class="ItemContent">
         <?=Anchor(($topic ? 'Тема: ' : 'Комментарий: ').$Draft->Name, $EditUrl, 'Title DraftLink')?>
         <div class="Excerpt"><?=Anchor(SliceString(Gdn_Format::Text($Draft->Body), 200), $EditUrl)?></div>
      </div>
   </li>
<?}