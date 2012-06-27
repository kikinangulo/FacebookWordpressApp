jQuery(document).ready(function($) {
  mf_suggest_labels = function () {

    $('.options_label input[name*=mf_custom_taxonomy]:text').each(function(index,value) {
      rel = $(this).attr('rel');
      label = $('#custom-taxonomy-name').val();
      rel = rel.replace('%s',label);
      $(this).val(rel);
    });
  }

  if( $('#suggest-labels:checked').val() != undefined ) {
      $('#custom-taxonomy-name').change(mf_suggest_labels);
  }

  $('#suggest-labels').click(function() {
    if($('#suggest-labels:checked').val() != undefined) {
      $('#custom-taxonomy-name').change(mf_suggest_labels);
    } else {
      $('#custom-taxonomy-name').unbind('change');
    }
  });

  $('#options_label').click(function(){
    $('.options_label').show();
    $('.options').hide();
    $('.options-tabs li').removeClass('tabs');
    $(this).parent('li').addClass('tabs');
    return false;
  });
  $('#options').click(function(){
    $('.options').show();
    $('.options_label').hide();
    $('.options-tabs li').removeClass('tabs');
    $(this).parent('li').addClass('tabs');
    return false;
  });

});
