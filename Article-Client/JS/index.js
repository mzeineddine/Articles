const base = "http://localhost/Projects/Articles/";
const api_base = "http://localhost/Projects/Articles";
function alert_message(message){
    alert(message);
    return false;
}

function check_missing(data, args){
    let is_checkable = true;
    for(let i=0; i<args.length;i++){
        if(data[i]==''){
            return alert_message(args[i]+" is missing");
        }
    }
    return is_checkable;
}

function reset_fields_by_id(args){
    for(let i = 0; i<args.length;i++){
        document.getElementById(args[i]).value = "";
    }
}

function split_response(response_data){
    const [resultString, messageString] = response_data.split('}{');
    const fixedResultString = resultString + '}';
    const fixedMessageString = '{' + messageString;
    const result = JSON.parse(fixedResultString).result;
    const message = JSON.parse(fixedMessageString).message;
    return [result,message]
}

function load_login(){
    login_form_doc = document.getElementById("login-form");
    login_form_doc.addEventListener('submit', login);
    if(sessionStorage.hasOwnProperty("user_id"))
        window.location.replace(base+'Article-Client/home.html');
    reset_fields_by_id(["email", "pass"]);
}

function load_signup(){
    signup_form_doc = document.getElementById("signup-form");
    signup_form_doc.addEventListener('submit', signup);
    if(sessionStorage.hasOwnProperty("user_id"))
        // window.location.replace(base+'Article-Client/home.html');
    reset_fields_by_id(["user_name","email", "pass"]);
}
async function login(){
    event.preventDefault();
    const email = document.getElementById("email");
    const pass = document.getElementById("pass");
    is_checkable = check_missing([email.value,pass.value],["email","password"]);
    if(is_checkable){
        const email_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!email.value.match(email_regex)){
            is_checkable = alert_message("Invalid email address");
        }
    }
    if(is_checkable){
        const response = await axios.post(api_base+"/Article-Server/api/v1/signup.php", {
            email: email.value,
            pass: pass.value
        });
        console.log(response.data);
        const [result,message] = split_response(response.data);
        console.log(message);
        if(result.hasOwnProperty("id"))
            sessionStorage.setItem("user_id",result['id']);
        else
            alert(message);
        if(sessionStorage.hasOwnProperty("user_id"))
            window.location.replace(base+'Article-Client/home.html');
        reset_fields_by_id(["user_name","email", "pass"]);
    }
}

async function signup(){
    event.preventDefault();
    const user_name = document.getElementById("user_name");
    const email = document.getElementById("email");
    const pass = document.getElementById("pass");
    is_checkable = check_missing([email.value,pass.value,user_name.value],["email","password","user_name"]);
    if(is_checkable){
        const email_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!email.value.match(email_regex)){
            is_checkable = alert_message("Invalid email address");
        }
    }
    if(is_checkable){
        const response = await axios.post(api_base+"/Article-Server/api/v1/signup.php", {
            user_name: user_name.value,
            email: email.value,
            pass: pass.value
        });
        console.log(response.data);
        const [result,message] = split_response(response.data);
        console.log(message);
        if(result == true)
            window.location.replace(base+'Article-Client/index.html');
        reset_fields_by_id(["user_name","email", "pass"]);
    }
}