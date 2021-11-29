console.log('ola');
$(document).ready(function () { 
    $("#btnInsertar").click(function (e) {
        e.preventDefault();     
        let data = $("#formRegisterUser").serializeArray();
        console.log(data);
        data.push({name:'tag',value:'registerUser'})      
        $.ajax({
         dataType : 'json', 
        url: 'ajaxUsuarios/saludar',
          type: "POST",        
          data: data ,        
        })
        .done(function(resp){
          console.log(resp);
                
        })
        return false;
      });
      $("#btnLogin").click(function (e) {
        e.preventDefault();     
        let data = $("#fromLoginUser").serializeArray();
        /* data.push({name:'tag',value:'loginUser'})   */
          console.log(data);
        return false;     
        $.ajax({
         dataType : 'json', 
        url: 'Controller/Login.php?action=login',
          type: "POST",        
          data: data ,        
        })
        .done(function(resp){
          console.log(resp);
                
        })
        return false;
      });
})