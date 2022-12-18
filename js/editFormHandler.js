let answerBtn = document.querySelector('.adda')
let formContent = document.querySelector('.edit-form')
let checked
let resObj = {
 text:'',
 published: 0,
 answers: {}
};

let questionId = document.querySelector('.quest-id')
let updateBtn = document.querySelector('.update-btn')

updateBtn.onclick = function (e){
    resObj['id'] = questionId.value
 console.log(resObj)
    fetch('/question/update', {
     method: 'POST',
     body: JSON.stringify(resObj),
     headers: {
      'Content-Type' : 'application/json',
     }
    }).then(res => {
        if (res.status === 200){
            alert('success updating')
            getQuestById()
        }else if (res.status === 422){
            alert(`fields must be not empty! : ${res.status}`)
        }else if (res.status === 500){
            alert(`same problem with request, status: ${res.status}`)
        }
    })
 e.preventDefault()
}

function getQuestById(){
 fetch(`/api/getQuestById/action?quest_id=${questionId.value}`)
     .then(res => res.json())
     .then(res => {
      let cc = Object.keys(res)
      resObj = res[cc[0]]

      if (typeof resObj.answers === 'undefined'){
          resObj['answers'] = {}
      }

      showContent()
     })
}
function changeStatus() {
 let status = document.querySelector('.pub-status')
 if (status.checked){
  resObj.published = 1
 }else{
  resObj.published = 0
 }
}
function del(id){
    let selector3 = 'del'+id
    let answerInput = document.querySelector(`.${selector3}`)
    answerInput.remove()
    resObj.answers[id].update = 2;
}
function editQuestion(){
 let questionInput = document.querySelector('.input-text')
 resObj.text = questionInput.value
}
function editAnswer(id){
   let selector1 = 'answer'+id
   let answer = document.querySelector(`.${selector1}`)
   resObj.answers[id].answer = answer.value
}

function editVoices(id){
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
  update: 0,
 }

showContent()
}


function showContent() {
 checked = ``
 if (resObj.published === 1){
  checked = `checked`
 }
 formContent.innerHTML = `
                <div class="form-check form-switch" style="margin: 10px; float: right">
                    <input class="form-check-input pub-status" type="checkbox" ${checked} onchange="changeStatus()" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
                </div>
                <div class="form-group">
                    <label for="exampleInputText">Text</label>
                    <input type="text" class="form-control input-text" onchange="editQuestion()" value="${resObj.text}" id="exampleInputText" aria-describedby="emailHelp" required>
                </div>
 `
 for (let key in resObj.answers) {
  formContent.innerHTML += `
                <div class="form-group del${key}">
                <div style="display: flex; justify-content: space-between">
                   <label for="exampleInputAnswer">Answer ${key}</label>
                   <label for="exampleInputAnswer">Voices ${key}</label>
                </div>
                    <div style="display: flex; justify-content: space-between">
                       <input type="text" class="form-control w-50 answer${key}" id="exampleInputAnswer${key}" onchange="editAnswer(${key})" value="${resObj.answers[key].answer}" aria-describedby="emailHelp" required>
                       <a href="#" class="btn btn-danger" onclick="del(${key})">Delete</a>
                       <input type="number" class="form-control w-25 voices${key}" id="exampleInputVoice${key}" onchange="editVoices(${key})" value="${resObj.answers[key].voices}"   aria-describedby="emailHelp" required>
                    </div>
                </div>
 `;
 }
}



getQuestById();
