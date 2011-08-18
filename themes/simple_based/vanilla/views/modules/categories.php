<?php if (!defined('APPLICATION')) exit();
if($this->Data !== FALSE)
{
    $CountDiscussions = 0;
    $CategoryID = isset($this->_Sender->CategoryID) ? $this->_Sender->CategoryID : '';
    $MaxDepth = C('Vanilla.Categories.MaxDisplayDepth');
    $DoHeadings = C('Vanilla.Categories.DoHeadings');
    $index_active = strtolower($this->_Sender->ControllerName) == 'discussionscontroller' && strtolower($this->_Sender->RequestMethod) == 'index' && !isset($this->_Sender->RequestArgs[0]) ? ' class="Active"' : '';
    foreach($this->Data->Result() as $Category) $CountDiscussions = $CountDiscussions + $Category->CountDiscussions;?>    
<div class="Box BoxCategories">
   <ul class="PanelInfo PanelCategories">
      <li<?=$index_active?>>
        <span><strong>
            <a href="/discussions">Все темы</a></strong>
            <span class="Count"><?=number_format($CountDiscussions)?></span>
        </span>
      </li>
      <?foreach($this->Data->Result() as $Category){
      if($Category->CategoryID < 0 || $MaxDepth > 0 && $Category->Depth > $MaxDepth) continue;
      if ($DoHeadings && $Category->Depth == 1) $CssClass = 'Heading';
      else $CssClass = 'Depth'.$Category->Depth.($CategoryID == $Category->CategoryID ? ' Active' : '');      
      $CssClass .= $Category->Depth > 1 ? ' lelvdown' : '';
      echo '<li class="',$CssClass,'">';
      if($DoHeadings && $Category->Depth == 1) echo Gdn_Format::Text($Category->Name);
      else echo '<span><strong><a href="/categories/',rawurlencode($Category->UrlCode),'">',Gdn_Format::Text($Category->Name),'</a></strong>'.($Category->CountAllDiscussions ? '<span class="Count">'.number_format($Category->CountAllDiscussions).'</span>' : '').'</span>';
      echo '</li>';
   }?>
   </ul>
</div>
<?}