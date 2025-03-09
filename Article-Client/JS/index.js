const base = "../";
const api_base = "http://13.38.107.39/Articles/";
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
        window.location.replace(base+'home.html');
    reset_fields_by_id(["email", "pass"]);
}

function load_signup(){
    signup_form_doc = document.getElementById("signup-form");
    signup_form_doc.addEventListener('submit', signup);
    if(sessionStorage.hasOwnProperty("user_id"))
        window.location.replace(base+'home.html');
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
        const response = await axios.post(api_base+"Article-Server/api/v1/login.php", {
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
            window.location.replace(base+'home.html');
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
        const response = await axios.post(api_base+"Article-Server/api/v1/signup.php", {
            user_name: user_name.value,
            email: email.value,
            pass: pass.value
        });
        console.log(response.data);
        const [result,message] = split_response(response.data);
        console.log(message);
        if(result == true)
            window.location.replace(base+'index.html');
        reset_fields_by_id(["user_name","email", "pass"]);
    }
}

function load_home(){
    if(!sessionStorage.hasOwnProperty("user_id")){
        window.location.replace(base+'index.html');
    }
    get_questions();
    const button = document.getElementsByClassName("add_question");
    button[0].addEventListener("click", ()=>{window.location.replace(base+'FAQ.html');})
    const search = document.getElementById('search');
    search.addEventListener("change", get_matches);
}

function add_qa_card(div, question, answer){
    const new_div = document.createElement('div');
    new_div.classList.add('card');
    new_div.innerHTML =  
    `
        <h4 class = "question">${question}</h4>
        <p class = "answer">${answer}</p>
    `;
    div.appendChild(new_div);
}

async function get_questions(){
    const response = await axios.post(api_base+"Article-Server/api/v1/getQuestions.php",{});
    console.log(response.data);
    const [result,message] = split_response(response.data);
    console.log(message);
    console.log(result);
    let container = document.getElementById("container");
    for(let i = 0; i<result.length;i++){
        add_qa_card(container,result[i]["question"],result[i]["answer"]);
    }
}

function get_matches(){
    let str = search.value.trim();
    let match_str = new RegExp(str, "i");
    let elements = document.getElementsByClassName('card');

    for (let i = 0; i < elements.length; i++) {
        let question = elements[i].querySelector(".question");
        let answer = elements[i].querySelector(".answer");
        
        if (match_str.test(answer.innerHTML) || match_str.test(question.innerHTML)) {
            elements[i].classList.remove("hidden");
        } else {
            elements[i].classList.add("hidden");
        }   
    }
}

function load_faq(){
    if(sessionStorage.hasOwnProperty("user_id")){
        faq_form_doc = document.getElementById("faq-form");
        faq_form_doc.addEventListener('submit', add_aq);
    } else{
        window.location.replace(base+'index.html');
    }
}

async function add_aq(){
    const question = document.getElementById("question");
    const answer = document.getElementById("answer");
    is_checkable = check_missing([question.value,answer.value,],["question","answer"]);
    if(is_checkable){
        const response = await axios.post(api_base+"Article-Server/api/v1/addQuestion.php", {
            question: question.value,
            answer: answer.value
        });
        const [result,message] = split_response(response.data);
        console.log(message);
        if(result == true)
            window.location.replace(base+'index.html');
        reset_fields_by_id(["user_name","email", "pass"]);
    }
}
