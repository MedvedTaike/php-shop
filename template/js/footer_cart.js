
            $(document).ready(function(){
               $(".add_on_tovar").hide();
               $(".plus").click(function(){
                   var parent = $(this).parent();
                   var forParent = $(this).parent().parent().parent();
                   var plus = parent.find('.dobavit_input').val();
                   plus = ++plus;
                   parent.find('.dobavit_input').val(plus);
                   parent.find('.dobavit_input').css('backgroundColor','#FE980F');
                   forParent.find("td").find(".add_on_tovar").show();
               });
                $(".minus").click(function(){
                   var parent = $(this).parent();
                   var forParent = $(this).parent().parent().parent();
                   var minus = parent.find('.dobavit_input').val();
                   if(minus != 0){
                   minus = --minus;
                   parent.find('.dobavit_input').val(minus);
                   parent.find('.dobavit_input').css('backgroundColor','#FE980F');
                   forParent.find("td").find(".add_on_tovar").show();    
                   }
               }); 
                $(".add_on_tovar").click(function(){
                    var parent = $(this).parent().parent();
                    var count = parent.find('div').find('.dobavit_input').val();
                    var id = $(this).attr('id');
                    $.post('/cart/add',{id_tovar:id, count:count},function(data){         
                         location.reload();                                                                                 
                    });  
                });
            });
        