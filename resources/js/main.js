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
        })
        
        setTimeout(() => {
            window.location=`index.php`
        }, 100);
        $("#greskaLogin").empty();
        return false
    }
    else{
        console.log("dsa");
        
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
    let DKASIPDHASJGDJISF="DASMJNHBGF"
    $.ajax({
        url:"obrada.php",
        type:"GET",
        data:{reset:DKASIPDHASJGDJISF},
        success:function(x){
            console.log(x);
        },
        error:function(y){
            console.log(y);
        }
    })
    
    setTimeout(() => {
        window.location.reload()
    }, 100);
})

$(".checkBox").change(()=>{
    $("#filterForm").submit();
    
})


$("#formUpload").submit(()=>{
    $.ajax({
        url:"upload.php",
        type:"POST",
        data:{upload:$("#up").val(),uploadImage:$("#uploadImage").val()},
        success:function(x){
            $("#greskaUpload").text("Moze");
        },
        error:function(x){
            $("#greskaUpload").text("Jok");
        }
    })
    window.location.reload();
    return false;
})