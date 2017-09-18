(function(){
  var BASE_URL = "";

  $('body').on('click', '.code', function(){
    var aim = $(this).data('rel');
    $('.code').removeClass('code-current').removeClass('code-current-mobile');

    if($(this).parents('.mobile').length > 0){
        $(this).addClass('code-current-mobile');
    } else {
      $(this).addClass('code-current');
    }

    $('.code-content').removeClass('code-content-current');
    $('#' + aim).addClass('code-content-current');
  })


  $('body').on('click', '.switcher', function(){
    var type = $(this).data('type')||'normal';
    var rel = $(this).data('rel')||'';
    switcher(type, rel, '');

    $(this).addClass('menu-item-current');

  })

  $('body').on('click', '.child-switch', function(){

    var type = $(this).data('type')||'normal';
    var rel = $(this).data('rel')||'';
    switcher(type, rel, 'child-');
    $(this).addClass('menu-item-current');

  })

  function switcher(type, rel , mode){
    $('.' + mode + 'switch').removeClass('menu-item-current');
    $('.' + mode + 'switcher').removeClass('menu-item-current');
    var path = BASE_URL + 'demos/' + rel + '.html'
     $.ajax({
       url: path,
       data: {
         time: new Date().getTime()
       },
       success: function(data){
         $('#mid').html('');
         $('#content').html('');
         if(type == 'iframe'){
           $('#frame').css('display', 'block').html(data);
           $('.child-switch').eq(0).click();
         } else {
           if(mode == ''){
            $('#frame').css('display', 'none').html('');
           }

           $('#' + mode + 'mid').html(data);
           var code = '';
           $('.code').each(function(index){
             var className = 'code-content';
             if(index == 0){
               className += ' code-content-current';
             }
             code += '<div id="' + $(this).data('rel') + '" class="' + className + '"><pre class="code-scroll"><code class="language-markup">'
              + $(this).html().replace(/</g, '&lt;').replace(/</g, '&gt;')
              + '</code></pre></div>';
           })
           $('#' + mode + 'content').html(code);
         }
         Prism.highlightAll();

       }
     })
  }
  $('.switch').eq(13).click();
})()
