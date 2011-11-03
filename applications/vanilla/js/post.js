jQuery(document).ready(function($) {
   var c = {};
   
   if ($.autogrow)
      $('textarea.TextBox').livequery(function() {
         $(this).autogrow();
      });
   
   // Hijack comment form button clicks
   $('#CommentForm :submit').click(function() {
      var btn = this;
      var frm = $(btn).parents('form').get(0);
      
      // Handler before submitting
      $(frm).triggerHandler('BeforeCommentSubmit', [frm, btn]);
      
      var textbox = $(frm).find('textarea');
      var inpCommentID = $(frm).find('input:hidden[name$=CommentID]');
      var inpDraftID = $(frm).find('input:hidden[name$=DraftID]');
      var preview = $(btn).attr('name') == $('#Form_Preview').attr('name') ? true : false;
      var draft = $(btn).attr('name') == $('#Form_SaveDraft').attr('name') ? true : false;
      var postValues = $(frm).serialize();
      postValues += '&DeliveryType=VIEW&DeliveryMethod=JSON'; // DELIVERY_TYPE_VIEW
      postValues += '&'+btn.name+'='+btn.value;
      var discussionID = $(frm).find('[name$=DiscussionID]').val();
      var action = $(frm).attr('action') + '/' + discussionID;
      //$(frm).find(':submit:last').after('<span class="Progress">&#160;</span>');
      //var last_submit = $(frm).find(':submit:last');last_submit.addClass('Progress');
      var last_submit = $(btn);last_submit.addClass('Progress');
      $(frm).find(':submit').attr('disabled', 'disabled');
      
      $.ajax({
         type: "POST",
         url: action,
         data: postValues,
         dataType: 'json',
         error: function(XMLHttpRequest, textStatus, errorThrown) {
            // Remove any old popups
            $('div.Popup').remove();
            // Add new popup with error
            $.popup({}, XMLHttpRequest.responseText);
         },
         success: function(json) {
            json = $.postParseJson(json);
            
            // Remove any old popups if not saving as a draft
            if (!draft)
               $('div.Popup').remove();
            
            // Assign the comment id to the form if it was defined
            if (json.CommentID != null && json.CommentID != '') {
               $(inpCommentID).val(json.CommentID);
               gdn.definition('LastCommentID', json.CommentID, true);
            }
               
            if (json.DraftID != null && json.DraftID != '')
               $(inpDraftID).val(json.DraftID);
               
            // Remove any old errors from the form
            $(frm).find('div.Errors').remove();

            if (json.FormSaved == false) {
               $(frm).prepend(json.ErrorMessages);
               json.ErrorMessages = null;
            } else if (preview) {
               // Pop up the new preview.
               $.popup({}, json.Data);
            } else if (!draft && json.DiscussionUrl != null) {
               $(frm).triggerHandler('complete');
               // Redirect to the discussion
               document.location = json.DiscussionUrl;
            }
            gdn.inform(json);
         },
         complete: function(XMLHttpRequest, textStatus) {
            // Remove any spinners, and re-enable buttons.
            //$('span.Progress').remove();
            last_submit.removeClass('Progress');
            $(frm).find(':submit').removeAttr("disabled");
         }
      });
      $(frm).triggerHandler('submit');
      return false;
   });
   
   
   // Hijack discussion form button clicks
   $('#DiscussionForm :submit').click(function() {
      var btn = this, jbtn = $(this);
      var frm = jbtn.parents('form').get(0);
      // Handler before submitting
      $(frm).triggerHandler('BeforeDiscussionSubmit', [frm, btn]);
      var textbox = $(frm).find('textarea');

      //back to edit first
      if(jbtn.hasClass('BacktToEdit'))
      {
         c['ButtonsPreview'].hide();
         c['Buttons'].show();
         $('div.Preview', frm).remove();
         textbox.show();
         return false;
      }      
      
      var inpDiscussionID = $(frm).find(':hidden[name$=DiscussionID]');
      var inpDraftID = $(frm).find(':hidden[name$=DraftID]');
      var preview = jbtn.attr('name') == $('#Form_Preview').attr('name') ? true : false;
      var draft = jbtn.attr('name') == $('#Form_SaveDraft').attr('name') ? true : false;
      var postValues = $(frm).serialize();
      postValues += '&DeliveryType=VIEW&DeliveryMethod=JSON'; // DELIVERY_TYPE_VIEW
      postValues += '&'+btn.name+'='+btn.value;
      // Add a spinner and disable the buttons
      //$(frm).find(':submit:last').after('<span class="Progress">&#160;</span>');
      //var last_submit = $(frm).find(':submit:last');last_submit.addClass('Progress');
      jbtn.addClass('Progress');
      $(frm).find(':submit').attr('disabled', 'disabled');      
      $.ajax({
         type: "POST",
         url: $(frm).attr('action'),
         data: postValues,
         dataType: 'json',
         error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('div.Popup').remove();
            $.popup({}, XMLHttpRequest.responseText);
         },
         success: function(json) {
            json = $.postParseJson(json);
            
            // Remove any old popups if not saving as a draft
            if (!draft)
               $('div.Popup').remove();

            // Assign the discussion id to the form if it was defined
            if (json.DiscussionID != null)
               $(inpDiscussionID).val(json.DiscussionID);
               
            if (json.DraftID != null)
               $(inpDraftID).val(json.DraftID);

            // Remove any old errors from the form
            $(frm).find('div.Errors').remove();

            if (json.FormSaved == false) {
               $(frm).prepend(json.ErrorMessages);
               json.ErrorMessages = null;
            } else if (preview) {
               // Pop up the new preview.
               
               textbox.hide();
               
               c['Buttons'] = $('.Buttons', frm);
               c['ButtonsPreview'] = $('.ButtonsPreview', frm);
               c['Buttons'].hide();
               c['ButtonsPreview'].show();
               
               $(frm).find('#Form_Body').after(json.Data).hide();
               
               //$.popup({}, json.Data);
               //alert(json.Data)
               
            } else if (!draft) {
               if (json.RedirectUrl) {
                  $(frm).triggerHandler('complete');
                  // Redirect to the new discussion
                  document.location = json.RedirectUrl;
               } else {
                  $('#Content').html(json.Data);
               }
            }
            gdn.inform(json);
         },
         complete: function(XMLHttpRequest, textStatus) {
            // Remove any spinners, and re-enable buttons.
            //$('span.Progress').remove();
            jbtn.removeClass('Progress');
            $(frm).find(':submit').removeAttr("disabled");
         }
      });
      $(frm).triggerHandler('submit');
      return false;
   });
   
   // Autosave
   $('#Form_SaveDraft').livequery(function() {
      var btn = this;
      $('#CommentForm textarea').autosave({ button: btn });
      $('#DiscussionForm textarea').autosave({ button: btn });
   });
   
   
});
