$(document).ready(function(){
    $('.remove').click(function(){
        let url = $(this).prev('a').attr('href');
        $('#wrapper').css('opacity',0.5);
        $('.modal').css('display','block');
        $('#btnAgree').prev('a').attr('href',url);
    });
    
    $('#closeConfirm').click(function(){
        debugger;
        $('#wrapper').css('opacity',1);
        $('.modal').fadeOut(300);
    });

    $('#btnAgree').click(function(){
        $('#wrapper').css('opacity',1);
        $('.modal').fadeOut(100);
        let url = $(this).prev('a').attr('href');
        document.location.href=url;                
    });
});