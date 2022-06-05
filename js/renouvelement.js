const prolongBtn = document.getElementById('prolong')
const renouv =document.getElementById('renouv')

if (prolongBtn){
    prolongBtn.addEventListener('click',()=>{
        renouv.innerHTML=''
        const formRenouv = document.createElement('div')
        formRenouv.innerHTML='<form class="d-flex justify-content-center" method="post">' +
            '<table class="table">\n' +
            '  <thead>\n' +
            '    <tr>\n' +
            '      <th scope="col">Total à payer</th>\n' +
            '      <th scope="col">Montant payé</th>\n' +
            '      <th scope="col">Date d\'expiration</th>\n' +
            '    </tr>\n' +
            '  </thead>\n' +
            '  <tbody>\n' +
            '<tr>' +
            '<th><input width="" id="totalPayer" class="form-control" type="number" name="totalPayer" min="0"></th>' +
            '<th><input width="" id="payer" class="form-control" type="number" name="payer" min="0"></th>'+
            '<th><input width="" id="renouvDate" class="form-control" type="date" name="renouvDate"></th>'+
            '<th><button id="validRenouv"  class="btn btn-success  ms-2" type="submit" name="validRenouv">Valider</button></th>'+
            '</tr>'+
            '  </tbody>\n' +
            '</table>'+
        '</form>'
        renouv.appendChild(formRenouv)
        const renouvDate = document.getElementById('renouvDate')
        const totalPayer = document.getElementById('totalPayer')
        const payer = document.getElementById('payer')
        renouvDate.setAttribute('min',setAtrebutDate)
        const validRenouv = document.getElementById('validRenouv')
        validRenouv.addEventListener('click',(e)=>{
            if (!renouvDate.value || !totalPayer.value || !payer.value){
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