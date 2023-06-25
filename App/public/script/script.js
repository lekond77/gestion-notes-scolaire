feather.replace();

let jq = $.noConflict();
jq(document).ready(function () {

    //Afficher le mot de passe au clic

    jq(".feather-eye").each(function() {
        jq(this).click(function() {
          jq(this).hide();
          jq(this).siblings().show();
          jq(this).parent().siblings().attr("type", "text");
        });
      });

    //Cacher le mot passe

jq(".feather-eye-off").each(function() {
    jq(this).click(function() {
      jq(this).hide();
      jq(this).siblings().show();
      jq(this).parent().siblings().attr("type", "password");
    });
  });
  
 //Texte de chargement du bouton submit
    jq("form").submit(function () {
        jq("input:submit").val("Chargement....");
    });

    //Pop up de déconnection
    jq(".logout").click(function () {
        jq.ajax({
            type: "POST",
            url: "templates/logout.php",
            contentType: "application/x-www-form-urlencoded",
            success: function (response) {
                let div = jq('<div class="popup-box"><p style="font-size: 18px;">' + response + '</p></div>');
                jq("body").append(div);

                jq(".popup-box").css({
                    "position": "fixed", "top": "0", "left": "370px", "background-color": "rgba(245, 135, 10, 0.8)",
                    "border-radius": "10px", "padding": "5px", "width": "fit-content", "height": "35px", "color": "white",
                    "text-align": "center"
                });
                jq(".popup-box").hide().fadeIn(500);

                setTimeout(function () {
                    window.location.href = "../";
                }, 2000); // 2000 ms = 2 secondes de délai avant la redirection
            }
        });
    });

    jq(".icon-user").click(function(){
        jq("#img-profil").show();
    });

    jq("#imageForm span").click(function(){
        
        jq("#img-profil").hide();
    });


  jq("#userImage").change(function(ev){
    let file = ev.target.files[0];
    if(file){
        let reader = new FileReader();
        reader.onload = function(e){
            jq("#icon-user").attr("src", `${e.target.result}`);
            jq("#icon-user").show();
        };
        reader.readAsDataURL(file);
    }else{
       // jq("#icon-user").hide();
        jq("#icon-user").attr("src", "/public/images/user.png");
    }
  })

});

