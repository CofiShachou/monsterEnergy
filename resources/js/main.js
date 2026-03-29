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
            type:'GET',
            data:{ussername:ussername,password:password},
            // dataType:"json",
            success:function(x){
                $("#x").text(x)
                console.log(x);
            },
            error:function(y){
                console.log(y);
            }
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
                <p>Ussername must contain only letter and number and be 3-20 characters long!</p>
            `)
        } 
        if(!ussernameRegEx.test(ussername)){
            $("#greskaLogin").append(`
                <p>Ussername must be 3-10 characters long!</p>
            `)
        }
        return false
    }
})
$("#btnRegister").click(()=>{
    window.location="register.php"
})
// $("register").submit(()=>{
//     let ussername=$("#ussername").val()
//     let password=$("#password").val()
//     $.ajax({
//         url:`obrada.php`,
//         type:'GET',
//         data:{ussername:ussername,password:password},
//         // dataType:"json",
//         success:function(x){
//             $("#x").text(x)
//             console.log(x);
//         },
//         error:function(y){
//             console.log(y);
//         }
//     })
//     setTimeout(() => {
//         window.location=`index.php`
//     }, 100);
//     return false
// })


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
        window.location=`index.php`
    }, 100);
})

