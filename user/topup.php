<?php
session_start();
include "config.php";
$err="";
if(!isset($_SESSION['loggedin_user'])){
    header("location:signin.php");
}

         custom_fields: [
            {
                display_country: "",
                display_city: "",
                display_id: ""
                 }
         ]
      },
      callback: function(response){
           window.location.replace("top-up-verify.php?ref="+response.reference);
      },
      onClose: function(){
          alert('Top up canceled');
      }
    });
    handler.openIframe();
  }
</script>
    <script>
        $(window).on('load', function(){
            $('.spin-wrapper').fadeOut("slow");
        });
        </script>
</body>
</html>