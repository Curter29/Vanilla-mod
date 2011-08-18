<?php if (!defined('APPLICATION')) exit();

function WriteDiscussion($Discussion, &$Sender, &$Session, $Alt2) {
   static $Alt = FALSE;
   $CssClass = 'Item';
   $CssClass .= $Discussion->Bookmarked == '1' ? ' Bookmarked' : '';
   $CssClass .= $Alt ? ' Alt ' : '';
   $Alt = !$Alt;
   $CssClass .= $Discussion->Announce == '1' ? ' Announcement' : '';
   $CssClass .= $Discussion->Dismissed == '1' ? ' Dismissed' : '';
   $CssClass .= $Discussion->InsertUserID == $Session->UserID ? ' Mine' : '';
   $CssClass .= ($Discussion->CountUnreadComments > 0 && $Session->IsValid()) ? ' New' : '';
   $DiscussionUrl = '/discussion/'.$Discussion->DiscussionID.'/'.Gdn_Format::Url($Discussion->Name).($Discussion->CountCommentWatch > 0 && C('Vanilla.Comments.AutoOffset') && $Session->UserID > 0 ? '/#Item_'.$Discussion->CountCommentWatch : '');
   $Sender->EventArguments['DiscussionUrl'] = &$DiscussionUrl;
   $Sender->EventArguments['Discussion'] = &$Discussion;
   $Sender->EventArguments['CssClass'] = &$CssClass;
   $First = UserBuilder($Discussion, 'First');
   $Last = UserBuilder($Discussion, 'Last');
   
   $Sender->FireEvent('BeforeDiscussionName');
   
   $DiscussionName = Gdn_Format::Text($Discussion->Name);
   if ($DiscussionName == '')
      $DiscussionName = T('Blank Discussion Topic');
      
   $Sender->EventArguments['DiscussionName'] = &$DiscussionName;

   static $FirstDiscussion = TRUE;
   if (!$FirstDiscussion)
      $Sender->FireEvent('BetweenDiscussion');
   else
      $FirstDiscussion = FALSE;
   
   $login = $Session->IsValid();
?>
<li class="<?=$CssClass?>">
   <?
       $Sender->FireEvent('BeforeDiscussionContent');   
       if(!property_exists($Sender, 'CanEditDiscussions')) $Sender->CanEditDiscussions = GetValue('PermsDiscussionsEdit', CategoryModel::Categories($Discussion->CategoryID)) && C('Vanilla.AdminCheckboxes.Use');;
   ?>
   <div class="ItemContent Discussion">
      <?=Anchor($DiscussionName, $DiscussionUrl, 'Title')?>      
      <?$Sender->FireEvent('AfterDiscussionTitle')?>      
      <div class="Meta">
         <?$Sender->FireEvent('BeforeDiscussionMeta')?>
         <?if($Discussion->Announce == '1'){?><span class="discussions_y"><i></i>важно</span><?}?>
         <?if($Discussion->Closed == '1'){?><span class="discussions_c"><i></i>закрыта</span><?}?>
         <?$Sender->FireEvent('AfterCountMeta')?>
         <span class="discussions_p"><?=sprintf('опубликованно %s, %s в: %s', Gdn_DateF($Discussion->FirstDate), UserAnchor($First), Anchor($Discussion->Category, '/categories/'.$Discussion->CategoryUrlCode, 'Category'))?></span>
         <span class="discussions_p"><?printf(Gdn_Plural($Discussion->CountComments, '%s коментарий', '%s коментария', '%s коментариев'), $Discussion->CountComments)?></span>
         <?if($login){
             if($Discussion->CountUnreadComments){?><span class="discussions_g"><?=$Discussion->CountUnreadComments.' '.Gdn_Plural($Discussion->CountUnreadComments, 'новый', 'новых', 'новых')?></span><?}?>
             <a href="/vanilla/discussion/bookmark/<?=$Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($Sender->SelfUrl)?>" class="discussions_b<?=$Discussion->Bookmarked == '1' ? ' Bookmarked' : ''?>"><i></i>следить за темой</a>
         <?}?>
         
         <?$Sender->FireEvent('DiscussionMeta')?>
      </div>
      <div class="clear"></div>
      <?=WriteOptions($Discussion, $Sender, $Session)?>
   </div>
</li>
<?php
}

function WriteFilterTabs(&$Sender) {
   $Session = Gdn::Session();
   $Title = property_exists($Sender, 'Category') && is_object($Sender->Category) ? $Sender->Category->Name : 'Все темы';
   $CountBookmarks = 0;
   $CountDiscussions = 0;
   $CountDrafts = 0;
   $Breadcrumbs = Gdn::Controller()->Data('Breadcrumbs');   
   $all_active = strtolower($Sender->ControllerName) == 'discussionscontroller' && strtolower($Sender->RequestMethod) == 'index' && !isset($Sender->RequestArgs[0]) ? 'Active' : '';
   if($Session->IsValid())
   {
      $CountBookmarks = (int)$Session->User->CountBookmarks;
      $CountDiscussions = (int)$Session->User->CountDiscussions;
      $CountDrafts = (int)$Session->User->CountDrafts;
   }  
   ?>
<div class="Tabs DiscussionsTabs">
   <ul>
      <?if($Breadcrumbs){foreach($Breadcrumbs as $Breadcrumb){
      echo '<li class="Breadcrumb">',Anchor(Gdn_Format::Text($Breadcrumb['Name']), $Breadcrumb['Url']),(next($Breadcrumbs) !== false ? '<span class="Crumb"></span>' : ''),'</li>';
      }}?>      
      
      <?php $Sender->FireEvent('BeforeDiscussionTabs')?>
      <li class="<?=$all_active?> first_tab"><?=Anchor('Все', 'discussions')?></li>
      <?php $Sender->FireEvent('AfterAllDiscussionsTab')?>

      <?if(C('Vanilla.Categories.ShowTabs')){$CssClass = '';
         if(strtolower($Sender->ControllerName) == 'categoriescontroller' && strtolower($Sender->RequestMethod) == 'all') $CssClass = 'Active';
         echo "<li class=\"$CssClass\">".Anchor(T('Categories'), '/categories/all').'</li>';
      }?>
      
      <?if($CountDiscussions > 0 || $Sender->RequestMethod == 'mine'){?><li<?=$Sender->RequestMethod == 'mine' ? ' class="Active"' : ''?>><?=Anchor('Мои', '/discussions/mine', 'MyDiscussions')?><?=$CountDiscussions ? '<span class="sup">'.$CountDiscussions.'</span>' : ''?></li><?}?>
      
      <?if($CountBookmarks > 0 || $Sender->RequestMethod == 'bookmarked'){?><li<?=$Sender->RequestMethod == 'bookmarked' ? ' class="Active"' : ''?>><?=Anchor('Избранные', '/discussions/bookmarked', 'MyBookmarks')?><?=$CountBookmarks ? '<span class="sup">'.$CountBookmarks.'</span>' : ''?></li>
      <?$Sender->FireEvent('AfterBookmarksTab');}?>
      
      <?if($CountDrafts > 0 || $Sender->ControllerName == 'draftscontroller'){?><li<?=$Sender->ControllerName == 'draftscontroller' ? ' class="Active"' : ''?>><?=Anchor('Черновики', '/drafts', 'MyDrafts')?><?=$CountDrafts ? '<span class="sup">'.$CountDrafts.'</span>' : ''?></li><?}?>
      <?$Sender->FireEvent('AfterDiscussionTabs');?>      
   </ul>
   <?if(!property_exists($Sender, 'CanEditDiscussions')) $Sender->CanEditDiscussions = $Session->CheckPermission('Vanilla.Discussions.Edit', TRUE, 'Category', 'any') && C('Vanilla.AdminCheckboxes.Use');
   if($Sender->CanEditDiscussions){?><span class="AdminCheck"><input type="checkbox" name="Toggle" /></span><?}?>
</div>
<?
}

/**
 * Render options that the user has for this discussion.
 */
function WriteOptions($Discussion, &$Sender, &$Session) {
   if ($Session->IsValid() && $Sender->ShowOptions) {
      echo '<div class="Options">';
      $Sender->Options = '';
      
      // Dismiss an announcement
      if (C('Vanilla.Discussions.Dismiss', 1) && $Discussion->Announce == '1' && $Discussion->Dismissed != '1')
         $Sender->Options .= '<li>'.Anchor('Тонущая "важно"', 'vanilla/discussion/dismissannouncement/'.$Discussion->DiscussionID.'/'.$Session->TransientKey(), 'DismissAnnouncement', array('title' => 'Оставляет пометку "важно" но уходит вниз при добавлении комментариев в другие темы')) . '</li>';
      
      // Edit discussion
      if ($Discussion->FirstUserID == $Session->UserID || $Session->CheckPermission('Vanilla.Discussions.Edit', TRUE, 'Category', $Discussion->PermissionCategoryID))
         $Sender->Options .= '<li>'.Anchor('Изменить', 'vanilla/post/editdiscussion/'.$Discussion->DiscussionID, 'EditDiscussion') . '</li>';

      // Announce discussion
      if ($Session->CheckPermission('Vanilla.Discussions.Announce', TRUE, 'Category', $Discussion->PermissionCategoryID))
         $Sender->Options .= '<li>'.Anchor($Discussion->Announce == '1' ? 'Снять пометку "важно"' : 'Пометить важной', 'vanilla/discussion/announce/'.$Discussion->DiscussionID.'/'.$Session->TransientKey(), 'AnnounceDiscussion') . '</li>';

      // Sink discussion
      if ($Session->CheckPermission('Vanilla.Discussions.Sink', TRUE, 'Category', $Discussion->PermissionCategoryID))
         $Sender->Options .= '<li>'.Anchor($Discussion->Sink == '1' ? '"Всплывать"' : '"Утопить"', 'vanilla/discussion/sink/'.$Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($Sender->SelfUrl), 'SinkDiscussion', array('title' => $Discussion->Sink == '1' ? 'Поднимать тему при добавлении новых коментариев' : 'Не поднимать тему при добавлении новых комментариев')) . '</li>';

      // Close discussion
      if ($Session->CheckPermission('Vanilla.Discussions.Close', TRUE, 'Category', $Discussion->PermissionCategoryID))
         $Sender->Options .= '<li>'.Anchor($Discussion->Closed == '1' ? 'Открыть заново' : 'Закрыть', 'vanilla/discussion/close/'.$Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($Sender->SelfUrl), 'CloseDiscussion') . '</li>';
      
      // Delete discussion
      if ($Session->CheckPermission('Vanilla.Discussions.Delete', TRUE, 'Category', $Discussion->PermissionCategoryID))
         $Sender->Options .= '<li>'.Anchor('Удалить', 'vanilla/discussion/delete/'.$Discussion->DiscussionID.'/'.$Session->TransientKey().'?Target='.urlencode($Sender->SelfUrl), 'DeleteDiscussion') . '</li>';
      
      // Allow plugins to add options
      $Sender->FireEvent('DiscussionOptions');
      
      if($Sender->Options != ''){?>
         <div class="ToggleFlyout OptionsMenu">
            <div class="MenuTitle">Редактировать</div>
            <ul class="Flyout MenuItems"><?=$Sender->Options?></ul>
         </div>
      <?}
      // Admin check.
      if($Sender->CanEditDiscussions){
         if (!property_exists($Sender, 'CheckedDiscussions'))
         {
            $Sender->CheckedDiscussions = (array)$Session->GetAttribute('CheckedDiscussions', array());
            if (!is_array($Sender->CheckedDiscussions)) $Sender->CheckedDiscussions = array();
         }
         $ItemSelected = in_array($Discussion->DiscussionID, $Sender->CheckedDiscussions);
         echo '<span class="AdminCheck"><input type="checkbox" name="DiscussionID[]" value="'.$Discussion->DiscussionID.'"'.($ItemSelected?' checked="checked"':'').' /></span>';
      }
      echo '</div>';
   }
}