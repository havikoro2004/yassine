// Remove resend forms after refresh page script
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
//Refresh page after back
window.addEventListener( "pageshow", function ( event ) {
    var historyTraversal = event.persisted ||
        ( typeof window.performance != "undefined" &&
            window.performance.navigation.type === 2 );
    if ( historyTraversal ) {
        // Handle page restore.
        window.location.reload();
    }
})

$(()=>{
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
})
$(()=>{
    $("#fetchFilter").on("change", function(){
        $("#formFilter").submit();
    })
})

const root = document.getElementById('root')
const valider = document.getElementById('valider')
const annuler = document.getElementById('annuler')
const firstName = document.getElementById('firstName')
const lastName = document.getElementById('lastName')

const homme = document.getElementById('homme')
const femme = document.getElementById('femme')
const cin = document.getElementById('cin')
const tel = document.getElementById('tel')
const adresse = document.getElementById('adresse')
const form = document.getElementById('form')
const badge = document.getElementById('badge')
const selectfilter = document.getElementById('selectfilter')

if (selectfilter){
    selectfilter.addEventListener('change' ,()=>{
        if (selectfilter.value==='Date de naissance'){
            selectfilter.type="date"
            document.getElementById('filter').type='date'
        } else {
            document.getElementById('filter').type='search'
        }

    })
}

function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;"); }

//REGEX
let nameReq = /^[a-zA-Z]/
let badgeReq = /^[a-zA-Z0-9]/
let cinReq = /^[a-zA-Z0-9]{8}$/
let telReq = /[0]{1}[1-9]{1}[0-9]{8}$/

var checkedValue =null;
const checkArray = [homme,femme]

if (valider){
    valider.addEventListener('click',()=>{

        for (let i=0 ; i< checkArray.length ; i++){
            if (checkArray[i].checked){
                checkedValue = checkArray[i].value
            }
        }
        if (escapeHtml(firstName.value) && lastName.value){
            if (!nameReq.test(firstName.value)){
                root.innerHTML=''
                const alert = document.createElement('div')
                alert.className='my-4'
                alert.innerHTML='<div class="alert alert-danger"><h4>Le format de votre nom n\'est pas correct</h4></div>'
                root.appendChild(alert)
                alert.scrollIntoView();
            } else if (!badgeReq.test(badge.value)){
                // Badge form delete space
                badge.addEventListener('keydown',(e)=>{
                    if (e.keyCode==32){
                        e.preventDefault()
                    }
                })
                root.innerHTML=''
                const alert = document.createElement('div')
                alert.className='my-4'
                alert.innerHTML='<div class="alert alert-danger"><h4>Le format du badge n\'est pas correct</h4></div>'
                root.appendChild(alert)
                alert.scrollIntoView();
            } else if (!nameReq.test(lastName.value)) {
                root.innerHTML=''
                const alert = document.createElement('div')
                alert.className='my-4'
                alert.innerHTML='<div class="alert alert-danger"><h4>Le format de votre prénom n\'est pas correct</h4></div>'
                root.appendChild(alert)
                alert.scrollIntoView();
            } else if (tel.value && !telReq.test(tel.value)){
                // Tel form delete space
                tel.addEventListener('keydown',(e)=>{
                    if (e.keyCode==32){
                        e.preventDefault()
                    }
                })
                root.innerHTML=''
                const alert = document.createElement('div')
                alert.className='my-4'
                alert.innerHTML='<div class="alert alert-danger"><h4>Vous devez saisir un numero de tel valide</h4></div>'
                root.appendChild(alert)
                alert.scrollIntoView();
            } else if (cin.value && !cinReq.test(cin.value)){

                // cin form delete space
                cin.addEventListener('keydown',(e)=>{
                    if (e.keyCode==32){
                        e.preventDefault()
                    }
                })
                root.innerHTML=''
                const alert = document.createElement('div')
                alert.className='my-4'
                alert.innerHTML='<div class="alert alert-danger"><h4>Le format C.I.N n\'est pas correct</h4></div>'
                root.appendChild(alert)
                alert.scrollIntoView();
            } else{
                root.innerHTML=''
                const alert = document.createElement('div')
                alert.className='my-4'
                alert.innerHTML='<div class="alert alert-primary"><h2>Vérifier les information avant de sauvegarder</h2></div>'
                root.appendChild(alert)
                alert.scrollIntoView();
                const indexMonths = [
                    {
                        'Janvier':'01',
                        'Février':'02',
                        'Mars':'03',
                        'Avril':'04',
                        'Mai':'05',
                        'Juin':'06',
                        'Juillet':'07',
                        'Aout': '08',
                        'Septembre':'09',
                        'Octobre':'10',
                        'Novembre':'11',
                        'Decembre':'12'
                    }]
                for (let i=0;i<indexMonths.length;i++){
                    if (indexMonths[i]<10){
                        indexMonths[i]='0'+ indexMonths[i]
                    }
                }

                let day = daySelect.value

                if (daySelect.value<10){
                    day ='0'+ daySelect.value
                }

                const ulContainer = document.createElement('div')

                const testValue = value=>{
                    value ? value = value : value = 'n\'est pas fourni'
                    return value
                }

                ulContainer.innerHTML='<ul class="list-group">' +
                    '<li class="list-group-item">Numero de badge : <strong>'+badge.value.toLowerCase()+'</strong></li>'+
                    '<li class="list-group-item">Nom : <strong>'+firstName.value.toLowerCase()+'</strong></li>'+
                    '<li class="list-group-item">Prénom : <strong>'+lastName.value.toLowerCase()+'</strong></li>'+
                    '<li class="list-group-item">Date de naissance : '+yearSelect.value+'-'+indexMonths[0][monthSelect.value]+'-'+day+'</li>'+
                    '<li class="list-group-item">Genre : <strong>'+checkedValue+'</strong></li>'+
                    '<li class="list-group-item">C.I.N <strong>'+testValue(cin.value).toLowerCase()+'</strong></li>'+
                    '<li class="list-group-item">Tel : <strong>'+testValue(tel.value)+'</strong></li>'+
                    '<li class="list-group-item">Adresse : <strong>'+testValue(escapeHtml(adresse.value))+'</strong></li>'+
                    '</ul>'
                root.appendChild(ulContainer)

                const buttonsContainer = document.createElement('div')
                buttonsContainer.className='d-flex text-center justify-content-center'
                root.appendChild(buttonsContainer)


                const save = document.createElement('div')
                save.innerHTML='<form method="post" action="">' +
                    ' <div class="d-none">' +
                    '<input type="text" name="badge" value="'+badge.value.toLowerCase()+'" > '+
                    '<input type="text" name="firstName" value="'+firstName.value.toLowerCase()+'" > '+
                    '<input type="text" name="lastName" value="'+lastName.value.toLowerCase()+'" > '+
                    '<input type="text" name="birth" value="'+yearSelect.value+'-'+indexMonths[0][monthSelect.value]+'-'+day+'" > '+
                    '<input type="text" name="genre" value="'+checkedValue+'" > '+
                    '<input type="text" name="cin" value="'+cin.value.toLowerCase()+'" > '+
                    '<input type="text" name="tel" value="'+tel.value+'" > '+
                    '<input name="adresse" value="'+adresse.value+'">'+
                    '</div>'+
                    '<button name="submit" class="btn btn-success mt-3 me-3" type="submit">Sauvegarder</button>' +
                    '</form>'

                buttonsContainer.appendChild(save)

                const annuler = document.createElement('div')
                annuler.className='btn btn-danger mt-3'
                annuler.id='annuler'
                annuler.innerText='Annuler'
                annuler.type='button'
                buttonsContainer.appendChild(annuler)
                annuler.addEventListener('click',()=>{
                    root.innerHTML=''
                })
            }
        } else {
            root.innerHTML=''
            const alert = document.createElement('div')
            alert.className='my-4'
            alert.innerHTML='<div class="alert alert-danger">Vous devez remplir tous les champs</div>'
            root.appendChild(alert)
            alert.scrollIntoView();
        }

    })
}

const addActivity =document.getElementById('addBtn')
const addValue = document.getElementById('add')
const prix = document.getElementById('prix')
const root3 = document.getElementById('root3')
if (addActivity){
    addActivity.addEventListener('click',(e)=>{
        if (addValue.value && prix.value){
            let add = /^[a-zA-Z0-9]/
            if (!add.test(addValue.value)){
                root3.innerHTML=''
                e.preventDefault()
                const alert = document.createElement('div')
                alert.className='my-4 container text-center'
                alert.innerHTML='<div class="alert alert-danger">Le format de l\'activité n\'est pas correcte</div>'
                root3 .appendChild(alert)
                alert.scrollIntoView();
            }
        } else {
            root3.innerHTML=''
            e.preventDefault()
            const alert = document.createElement('div')
            alert.className='my-4 container text-center'
            alert.innerHTML='<div class="alert alert-danger">Veuillez remplir tous les champs</div>'
            root3 .appendChild(alert)
            alert.scrollIntoView();
        }
    })

}

const root2= document.getElementById('root2')
const abn = document.getElementById('abn')
const total = document.getElementById('total')
const payer =document.getElementById('payer')
if (abn){
    abn.addEventListener('click',()=>{
        root2.style.display="block"
        root2.scrollIntoView();
    })
}
const subAbn = document.getElementById('subAbn')
const selectSport = document.getElementById('selectSport')
const dateDebut = document.getElementById('date_debut')
const dateFin = document.getElementById('date_fin')
const fermerAbn= document.getElementById('closeIcone')


//Disable preview dates:

const curentDate = new Date();

let curentMonth = curentDate.getMonth()+1
let curentDay = curentDate.getDate()
let curentYear = curentDate.getFullYear()

if (curentDay<10){
    curentDay ='0'+ curentDate
}
if (curentMonth<10){
    curentMonth ='0'+curentMonth
}
const setAtrebutDate =curentYear+'-'+curentMonth+'-'+curentDay

if (dateDebut && dateFin){
    dateDebut.setAttribute('min',setAtrebutDate)
    dateFin.setAttribute('min',setAtrebutDate)
}

if (subAbn){

    subAbn.addEventListener('click',(e)=>{

        if (!selectSport.value || !dateDebut.value || !total.value || !payer.value || !dateFin.value || selectSport.value==='Choisir une activité'){
            root.innerHTML=''
            e.preventDefault()
            const alert = document.createElement('div')
            alert.className='my-3 container text-center'
            alert.innerHTML='<div class="alert alert-danger">Vous devez remplir tous les champs</div>'
            root.appendChild(alert)
            alert.scrollIntoView();
        }

        const diff = new Date(dateFin.value).getTime() - new Date(dateDebut.value).getTime()

        if (diff<=0){
            root.innerHTML=''
            e.preventDefault()
            const alert = document.createElement('div')
            alert.className='my-3 container text-center'
            alert.innerHTML='<div class="alert alert-danger">La date de d\'expiration doit être supérieur à la date de début</div>'
            root.appendChild(alert)
            alert.scrollIntoView();
        }

    })
}
if (fermerAbn){
    fermerAbn.addEventListener('click',(e)=>{
            root2.style.display="none"
            fermerAbn.style.display='none'
            root2.scrollIntoView();


        }
    )
}

const user = document.getElementById('loginAdmin')
const oldPwd = document.getElementById('oldPwd')
const pwd = document.getElementById('pwd')
const pwdConf = document.getElementById('pwdConf')
const rootAdmin = document.getElementById('rootAdmin')
const editAdmin = document.getElementById('editAdmin')
let userLogin = /^[a-zA-Z0-9]/
let pwdTest = /^[a-zA-Z0-9]/
if (editAdmin){
    editAdmin.addEventListener('click',(e)=>{
        if (!user.value || !oldPwd.value || !pwd.value || !pwdConf.value) {
            rootAdmin.innerHTML=''
            e.preventDefault()
            const alert = document.createElement('div')
            alert.className='my-3 container text-center px-0'
            alert.innerHTML='<div id="alert" class="alert alert-danger mt-3 container text-center" role="alert">Vous devez remplir tous les champs</div>'
            rootAdmin.appendChild(alert)
            alert.scrollIntoView();
        } else {
            if (!userLogin.test(user.value)) {
                rootAdmin.innerHTML=''
                e.preventDefault()
                const alert = document.createElement('div')
                alert.className='my-3 container text-center px-0'
                alert.innerHTML='<div class="alert alert-danger">Vous devez respecter le format du pseudo</div>'
                rootAdmin.appendChild(alert)
                alert.scrollIntoView();
            }
            if (!pwdTest.test(pwd.value)) {
                rootAdmin.innerHTML=''
                e.preventDefault()
                const alert = document.createElement('div')
                alert.className='my-3 container text-center px-0'
                alert.innerHTML='<div class="alert alert-danger">Vous devez respecter le format du mot de passe</div>'
                rootAdmin.appendChild(alert)
                alert.scrollIntoView();
            }
            if (pwd.value != pwdConf.value) {
                rootAdmin.innerHTML=''
                e.preventDefault()
                const alert = document.createElement('div')
                alert.className='my-3 container text-center px-0'
                alert.innerHTML='<div class="alert alert-danger">les mots de passe ne correspondent pas</div>'
                rootAdmin.appendChild(alert)
                alert.scrollIntoView();
            }
            if (pwd.value.length<8) {
                rootAdmin.innerHTML=''
                e.preventDefault()
                const alert = document.createElement('div')
                alert.className='my-3 container text-center px-0'
                alert.innerHTML='<div class="alert alert-danger">Le mots de passe doit avoir au moins 8 caractaires</div>'
                rootAdmin.appendChild(alert)
                alert.scrollIntoView();
            }
        }

    })
}


if (document.getElementById('selectSport')){
    const selectSport =document.getElementById('selectSport')
    selectSport.addEventListener('change',()=>{
        const xhr = new XMLHttpRequest()
        xhr.open('POST','../include/xhrPrixSport.php',true)
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange= ()=>{
            if (xhr.readyState===4 && xhr.status===200){
                total.value = xhr.responseText
            }
        }
        xhr.send('request='+selectSport.value)
    })
}