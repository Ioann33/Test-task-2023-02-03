let answerBtn = document.querySelector('.adda')
let formContent = document.querySelector('.questFrom')
let checked
let resObj = {
 text:'',
 state: 0,
 answers: {}
};

let saveBtn = document.querySelector('.save-btn')

saveBtn.onclick = function (e){
 fetch('/question/save', {
  method: 'POST',
  body: JSON.stringify(resObj),
  headers: {
   'Content-Type' : 'application/json',
  }
 }).then(res=>{
  if (res.status === 200){
   alert('success saving')
   resObj = {
    text:'',
    state: 0,
    answers: {}
   };
   showAnswers()
  }else if (res.status === 422){
   alert(`fields must be not empty! : ${res.status}`)
  }else if (res.status === 500){
   alert(`same problem with request, status: ${res.status}`)
  }
 })
 e.preventDefault()
}
function changeStatus() {
 let status = document.querySelector('.pub-status')
 if (status.checked){
  resObj.state = 1
 }else{
  resObj.state = 0
 }
}
function addQuestion(){
 let questionInput = document.querySelector('.input-text')
 resObj.text = questionInput.value
}
function addAnswer(id){
   let selector1 = 'answer'+id
   let answer = document.querySelector(`.${selector1}`)
   resObj.answers[id].answer = answer.value
}

function addVoices(id){
 let selector2 = 'voices'+id
 let voices = document.querySelector(`.${selector2}`)
 resObj.answers[id].voices = voices.value
}
answerBtn.onclick = function (e) {
 let keys = Object.keys(resObj.answers)
 let key =+keys.slice(-1)+1
 resObj.answers[key] = {
  answer: '',
  voices: '',
 }

showAnswers()
}


function showAnswers() {
 checked = ``
 if (resObj.state === 1){
  checked = `checked`
 }
 formContent.innerHTML = `
                <div class="form-check form-switch" style="margin: 10px; float: right">
                    <input class="form-check-input pub-status" type="checkbox" ${checked} onchange="changeStatus()" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
                </div>
                <div class="form-group">
                    <label for="exampleInputText">Text</label>
                    <input type="text" class="form-control input-text" onchange="addQuestion()" value="${resObj.text}" id="exampleInputText" aria-describedby="emailHelp" required>
                </div>
 `
 for (let key in resObj.answers) {
  formContent.innerHTML += `
                <div class="form-group">
                <div style="display: flex; justify-content: space-between">
                   <label for="exampleInputAnswer">Answer ${key}</label>
                   <label for="exampleInputAnswer">Voices ${key}</label>
                </div>
                    <div style="display: flex; justify-content: space-between">
                       <input type="text" class="form-control w-50 answer${key}" id="exampleInputAnswer${key}" onchange="addAnswer(${key})" value="${resObj.answers[key].answer}" aria-describedby="emailHelp" required>
                       <input type="number" class="form-control w-25 voices${key}" id="exampleInputVoice${key}" onchange="addVoices(${key})" value="${resObj.answers[key].voices}"   aria-describedby="emailHelp" required>
                    </div>
                </div>
 `;
 }
}

showAnswers()