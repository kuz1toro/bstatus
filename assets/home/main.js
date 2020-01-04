var InfoStatusGedungHandler = function() {
    
    var handleClickButton = function() {
      $( "#btn_search" ).click(function() {
          if($('#search_text').val() != "") {
            $( "#search_data" ).submit();
          } else {
              $('#search_text').focus();
          }
      });  
    };
    
    var waitingDialog = waitingDialog || (function ($) {
        'use strict';

            // Creating modal dialog's DOM
            var $dialog = $(
                    '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
                    '<div class="modal-dialog modal-m">' +
                    '<div class="modal-content">' +
                            '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
                            '<div class="modal-body">' +
                                    '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
                            '</div>' +
                    '</div></div></div>');

            return {
                    /**
                    * Opens our dialog
                    * @param message Custom message
                    * @param options Custom options:
                    * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
                    * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
                    */
                    show: function (message, options) {
                            // Assigning defaults
                            if (typeof options === 'undefined') {
                                    options = {};
                            }
                            if (typeof message === 'undefined') {
                                    message = 'Loading';
                            }
                            var settings = $.extend({
                                    dialogSize: 'm',
                                    progressType: '',
                                    onHide: null // This callback runs after the dialog was hidden
                            }, options);

                            // Configuring dialog
                            $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
                            $dialog.find('.progress-bar').attr('class', 'progress-bar');
                            if (settings.progressType) {
                                    $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
                            }
                            $dialog.find('h3').text(message);
                            // Adding callbacks
                            if (typeof settings.onHide === 'function') {
                                    $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                                            settings.onHide.call($dialog);
                                    });
                            }
                            // Opening dialog
                            $dialog.modal();
                    },
                    /**
                    * Closes dialog
                    */
                    hide: function () {
                            $dialog.modal('hide');
                    }
            };

    })(jQuery);
    
    var progressBar = function() {
        $("#result_table").html('<div class="progress progress-striped active" style="margin-top:15px;margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>');
    };
    
    var searchBack = function($search) {
        
        if($search) {
            $('#search_table').show();
        } else {
            $('#result_table').hide();
        }
    };
    
    var handleDataFormSubmit = function() {
        
        $( "#search_data" ).submit(function( event ) {
            
            $('#search_table').hide();
            $('#result_table').show();
            
            // Stop form from submitting normally
            event.preventDefault();
            
            /* Get from elements values */
            var values = $("#search_data").serialize();
            
            /* key search */
            var key_search = $('#search_text').val();
            
            /* Get url */
            var link_url = $('#xurl').val();

             /* Send the data using post and put the results in a div */
            /* I am not aborting previous request because It's an asynchronous request, meaning 
            Once it's sent it's out there. but in case you want to abort it  you can do it by  
            abort(). jQuery Ajax methods return an XMLHttpRequest object, so you can just use abort(). */
            ajaxRequest= $.ajax({
                    url: link_url,
                    type: "post",
                    beforeSend: function(){
                        //waitingDialog.show();
                        progressBar();
                    },
                    dataType: "json",
                    data: values
                });

            /*  request cab be abort by ajaxRequest.abort() */

            ajaxRequest.done(function (response, textStatus, jqXHR){
                
                var oldinfo = "Anda dapat menemukan informasi status keselamatan kebakaran bangunan gedung tinggi dengan memasukkan Nama Gedung atau Alamat Gedung";
                    
                if(response.is_success === true) {
                    
                    // show successfully for submit message
                    
                    $('#infotext').html("Hasil Pencarian dengan kata kunci <strong>' "+ key_search +" '</strong> sebanyak : "+ response.rownum +" <br><br> <button class='btn btn-success btn-xlg' type='button' onclick=\"$('#infotext').html('"+ oldinfo +"');$('#search_text').val('');$('#result_table').hide();$('#search_table').show();\"> Kembali </button> ");
                    $('#result_table').html(response.lists);

                } else {
                    $('#infotext').html("Hasil Pencarian dengan kata kunci <strong>' "+ key_search +" '</strong> tidak ditemukan. <br><br> <button class='btn btn-success btn-xlg' type='button' onclick=\"$('#infotext').html('"+ oldinfo +"');$('#search_text').val('');$('#result_table').hide();$('#search_table').show();\"> Kembali </button> ");
                    $('#result_table').html(response.message);
                }
                
                
                waitingDialog.hide();
            });

            /* On failure of request this function will be called  */
            ajaxRequest.fail(function (){
                // show error
                $("#search_table").html('There is error while submit');
            });

        });
    };
    
    return {
      init: function() {
          handleClickButton();
          handleDataFormSubmit();
          searchBack(false);
          $('#exampleModalLive').modal('show');
          $('#search_text').focus();
          $('[data-toggle="popover"]').popover(); 
      }  
    };
}();

jQuery(document).ready(function() {
  InfoStatusGedungHandler.init();
});