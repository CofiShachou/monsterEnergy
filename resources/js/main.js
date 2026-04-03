$("#btnLogin").click(()=>{
    window.location="login.php";
})
$("#sendLogin").click(()=>{
    
    let ussernameRegEx=/^[A-z0-9]{3,20}$/
    let passwordRegEx=/^.{3,10}$/
    let ussername=$("#ussername").val()
    let password=$("#password").val()

    if(passwordRegEx.test(password) && ussernameRegEx.test(ussername)){
        $.ajax({
            url:`obrada.php`,
            type:'POST',
            data:{ussername:ussername,password:password,type:"login"},
            success:function(x){
                if(x=="Seccessfull login!"){
                    window.location=`index.php`
                }
            },
            error:function(x){
                $("#loginGreska").text(x)
            }
        })
        
        setTimeout(() => {
            
        }, 100);
        $("#greskaLogin").empty();
        return false
    }
    else{
        $("#greskaLogin").empty();
        if(!passwordRegEx.test(password)){
            $("#greskaLogin").append(`
                <p>Password must be 3-10 characters long!</p>
            `)
        } 
        if(!ussernameRegEx.test(ussername)){
            $("#greskaLogin").append(`
                <p>Ussername must contain only letter and number and be 3-20 characters long!</p>
            `)
        }
        return false
    }
})
$("#btnRegister").click(()=>{
    window.location="register.php"
})
$("#closeLogin").click(()=>{
    window.location="index.php";
})
$("#closeRegister").click(()=>{
    window.location="index.php";
})
$("#sendRegister").click(()=>{
    
    let ussernameRegEx=/^[A-z0-9]{3,20}$/
    let passwordRegEx=/^.{3,10}$/
    let ussername=$("#registerUssername").val()
    let password=$("#registerPassword").val()
    let email=$("#registerEmail").val()

    if(passwordRegEx.test(password) && ussernameRegEx.test(ussername)){
        $.ajax({
            url:`obrada.php`,
            type:'POST',
            data:{ussername:ussername,password:password,email:email,type:"register"},
            success:function(x){
                console.log(x);
            },
            error:function(x){
                console.log(x);
            },
        })
        setTimeout(() => {
            window.location=`index.php`
        }, 100);
        $("#greskaRegister").empty();
        return false
    }
    else{
        console.log("nu uhh");
        
        $("#greskaRegister").empty();
        if(!passwordRegEx.test(password)){
            $("#greskaRegister").append(`
                <p>Password must be 3-10 characters long!</p>
            `)
        } 
        if(!ussernameRegEx.test(ussername)){
            $("#greskaRegister").append(`
                <p>Ussername must contain only letter and number and be 3-20 characters long!</p>
            `)
        }
        return false
    }
})

$("#signOut").click(()=>{
    let x="text"
    $.ajax({
        url:"obrada.php",
        type:"GET",
        data:{reset:x},
        success:function(x){
            console.log(x);
        },
        error:function(y){
            console.log(y);
        }
    })
    
    setTimeout(() => {
        window.location="index.php";
    }, 100);
})

$(".checkBox").change(()=>{
    $("#filterForm").submit();
    
})


$("#contact").click(()=>{
    let title=$("#title").val();
    let message=$("#message").val();
    let admin_email=$("#admin_email").val();
    
    let titleReg=/^[A-z0-9\s]{1,49}$/;
    let messageReg=/^[A-z0-9\s]{1,240}$/;
    let contact=$("#contact").val()
    if(titleReg.test(title) && messageReg.test(message)){
        $.ajax({
            url:"contact.php",
            type:"POST",
            data:{title:title,message:message,admin_email:admin_email,contact:contact},
            success:function(x){
                $("#greska").text(x);
                $("#title").val("");
                $("#message").val("");
                $("#admin_email").val("");
            },
            error:function(x){
                $("#greska").text(x);
                
            }
        })
    }
    else{
        $("#greska").text("Title and message can only contain letters and numbers!");
    }
    return false;
})



$("#formUpload").submit(function(){
    // let image=$("#uploadImage").val()
    let formData=new FormData(this)
    formData.append("upload", "upload");
    let upload=$("#upload").val()
    $.ajax({
        url:"upload.php",
        type:"POST",
        data:formData,
         contentType:false,
        processData:false,
        success:function(x){
            $("#greskaUpload").text(x);
        },
        error: function(x){
            $("#greskaUpload").text("Nesto");
        }
    })
    return false;
})





if (window.matchMedia("(max-width: 575px)").matches) {
    console.log("HGYUATRY");
    
    $("body").append(`<i class="fa-solid fa-bars" id='meni'></i>`);
}

let x=1;
$(document).on("click","#meni",function(){
    if(x==1){
        $("header").css("width","100vw")
        x=0;
    }
    else if(x==0){
        $("header").css("width","0vw")
        x=1;
    }

    
})