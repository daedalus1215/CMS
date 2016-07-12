/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    $('.modal_thumbnails').click(function() {
        var user_href;
        var user_href_splitted;
        var userId;
        
        // Make sure the button is now selectable.
        $('#set_user_image').prop('disabled', false);
        
         user_href = $('#user-id').prop('href');
         
         user_href_splitted = user_href.split('=');
         
         userId = user_href_splitted[user_href_splitted.length - 1];
         
         alert(userId);
        
        
        
    });
    
    
    
    
    
    
    
    
    
    
    
    
    tinymce.init({ selector:'textarea' });
});


