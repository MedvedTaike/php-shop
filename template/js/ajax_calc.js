$(document).ready(function(){
               $(".plus").click(function(){
                   var parent = $(this).parent();
                   var plus = parent.find('.dobavit_input').val();
                   plus = ++plus;
                   parent.find('.dobavit_input').val(plus);
                   parent.find('.dobavit_input').css('backgroundColor','#FE980F');
               });
                $(".minus").click(function(){
                   var parent = $(this).parent();
                   var minus = parent.find('.dobavit_input').val();
                   if(minus != 0){
                   minus = --minus;
                   parent.find('.dobavit_input').val(minus);
                   parent.find('.dobavit_input').css('backgroundColor','#FE980F');
                   }
               }); 
                $(".add_on_tovar").click(function(){
                    var parent = $(this).parent().parent();
                    var count = parent.find('div').find('.dobavit_input').val();
                    var id = $(this).attr('id');
                    $.post('/cart/add',{id_tovar:id, count:count},function(data){
                        if(count != 0){
                          parent.find('.dobavit_input').css('backgroundColor','white');        
                        }                                                                                                       
                    });
                    return false;
                });
            });