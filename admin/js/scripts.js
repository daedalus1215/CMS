/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    var user_href;
    var user_href_splitted;
    var userId;
    var image_src;
    var image_href_splitted;
    var image_name;
        
    // Image click listener for the photos that are being displayed.    
    $('.modal_thumbnails').click(function() {
        
        // Make sure the button is now selectable.
        $('#set_user_image').prop('disabled', false);
        
        // from user-id anchor tag on edit_user.php
        user_href = $('#user-id').prop('href'); // looks like http://.../..?id=8         
        user_href_splitted = user_href.split('='); // lets split on that '='        
        userId = user_href_splitted[user_href_splitted.length - 1]; // lets grab that 8.
         
         
        image_src = $(this).prop("src"); //grabbing the images path and name includes/images/image_name.jpg
        image_href_splitted = image_src.split("/");  
        image_name = image_href_splitted[image_href_splitted.length -1]; // grab that image_name.jpg
            
    });
    
    
    // essentially the submit button on the modal.
    $('#set_user_image').click(function() {
        var d = image_name;
        
        $.ajax({
            url: "includes/ajax_responses/ajax_code.php",
            data: {image_name: image_name, user_id: userId}, 
            type: "POST",
            success: function(data) {
                if (!data.error) {
                    $('#user_photo').prop('src', '<?php echo $user->getImage(); ?>');
                    location.reload(true);
                }
            }
        });
    });
    
    
    
 
    
    
    
    
    
    
    
    tinymce.init({ selector:'textarea' });
});


