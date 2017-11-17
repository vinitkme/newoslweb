(function(a){'use strict';Drupal.behaviors.pathFieldsetSummaries={attach:function(t){a('fieldset.path-form',t).drupalSetSummary(function(t){var i=a('.form-item-path-alias input',t).val(),r=a('.form-item-path-pathauto input',t).attr('checked');if(r){return Drupal.t('Automatic alias')}
else if(i){return Drupal.t('Alias: @alias',{'@alias':i})}
else{return Drupal.t('No alias')}})}}})(jQuery);