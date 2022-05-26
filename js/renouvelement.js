const prolongBtn = document.getElementById('prolong')
const renouv =document.getElementById('renouv')

if (prolongBtn){
    prolongBtn.addEventListener('click',()=>{
        renouv.innerHTML=''
        const formRenouv = document.createElement('div')
        formRenouv.innerHTML='<form class="d-flex justify-content-center" method="post">' +

            '<label class="text-center" for="renouvDate"><strong>Indiquer la date d\'expiration</strong></label>'+
            '<input width="" id="renouvDate" class="form-control" type="date" name="renouvDate">'+
            '<button id="validRenouv"  class="btn btn-success w-25 ms-2" type="submit" name="validRenouv">Valider</button>'
        '</form>'
        renouv.appendChild(formRenouv)
        const renouvDate = document.getElementById('renouvDate')
        renouvDate.setAttribute('min',setAtrebutDate)
        const validRenouv = document.getElementById('validRenouv')
        validRenouv.addEventListener('click',(e)=>{
            if (!renouvDate.value){
                headerActivity.innerHTML=''
                e.preventDefault()
                const alert = document.createElement('div')
                alert.className='my-4 container text-center'
                alert.innerHTML='<div class="alert alert-danger">Le champs ne doit pas être vide</div>'
                headerActivity .appendChild(alert)
                alert.scrollIntoView();
            }
        })
    })
}