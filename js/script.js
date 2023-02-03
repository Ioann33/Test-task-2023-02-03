let form = document.querySelector('.create-form')
let errorsWindow = document.querySelector('.error-window')
let contentWindow = document.querySelector('.content')
let listItem = ''
form.onsubmit = function (e) {
    let formData = new FormData(form)
    fetch('/api/save', {
        method: 'POST',
        body: formData,
        headers: {

        }
    }).then(res=>{
        if (res.status === 200){
            res.json().then(messages => {
                listItem = ''
                for (let message of messages){
                    listItem+=`<li>${message}</li>`
                }
                contentWindow.innerHTML = `
                    <div class="alert-success  error-window" style="width: 300px; margin: 50px auto 0; padding: 20px">
                        <ul style="list-style: none">
                        ${listItem}
                        </ul>
                    </div>`

            })
        }else if (res.status === 422){
            res.json().then(errors =>{
                listItem = ''
                for (let error of errors){
                    listItem+=`<li>${error}</li>`
                }
                errorsWindow.innerHTML = `
                    <ul>
                        ${listItem}
                    </ul>
                `
                errorsWindow.style.display = 'block'
            })
        }else if (res.status === 500){
            alert(`same problem with request, status: ${res.status}`)
        }
    })
    e.preventDefault()
}