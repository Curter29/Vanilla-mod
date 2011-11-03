<?php if (!defined('APPLICATION')) exit();
foreach ($this->CommentData->Result() as $Comment) {
    $Permalink = '/discussion/comment/'.$Comment->CommentID.'/#Comment_'.$Comment->CommentID;
    $User = UserBuilder($Comment, 'Insert');
    $this->EventArguments['User'] = $User;
?>
<li class="Item">
    <?php $this->FireEvent('BeforeItemContent'); ?>
    <div class="ItemContent">
        <?php echo Anchor(Gdn_Format::Text($Comment->DiscussionName), $Permalink, 'Title'); ?>
        <div class="Meta">
            <?/*<span class="label pub_info">прокомментировано <?=Gdn_DateF($Comment->DateInserted)?>, <?=UserAnchor($User)?></span>*/?>
            <span class="label pub_info"><?=Gdn_DateF($Comment->DateInserted)?></span>
        </div>
        <div class="clear"></div>
        <div class="Excerpt"><?php
            echo Anchor(SliceString(Gdn_Format::Text($Comment->Body, FALSE), 250), $Permalink);
        ?></div>
    </div>
</li>
<?php
}