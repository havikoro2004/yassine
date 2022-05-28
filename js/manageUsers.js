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

/* Vérifier le formulaire creation utilisateurs */
const subUser = document.getElementById('subUser')
const nomUser = document.getElementById('nom')
const pseudoUser = document.getElementById('pseudoUser')
const role = document.getElementById('role')
const pwdUser = document.getElementById('pwdUser')
const confpwdUser = document.getElementById('confpwdUser')
let regex = /^[a-zA-Z0-9]/

subUser.addEventListener('click',(e)=>{
    if (!nomUser.value || !pseudoUser.value || role.value==='Choisir le rôle' || !pwdUser.value || !confpwdUser.value){
        rootAdmin.innerHTML=''
        e.preventDefault()
        const alert = document.createElement('div')
        alert.className='my-3 container text-center'
        alert.innerHTML='<div class="alert alert-danger">Vous devez remplir tous les champs</div>'
        rootAdmin.appendChild(alert)
        alert.scrollIntoView();
    } else {
        if (!regex.test(nomUser.value)) {
            rootAdmin.innerHTML=''
            e.preventDefault()
            const alert = document.createElement('div')
            alert.className='my-3 container text-center'
            alert.innerHTML='<div class="alert alert-danger">Le nom doit contenir entre 4 et 20 caractaires alphanumérique</div>'
            rootAdmin.appendChild(alert)
            alert.scrollIntoView();
        }
        if (!regex.test(pseudoUser.value) || pseudoUser.value.length<4) {
            rootAdmin.innerHTML=''
            e.preventDefault()
            const alert = document.createElement('div')
            alert.className='my-3 container text-center'
            alert.innerHTML='<div class="alert alert-danger">Le pseudo doit contenir au moins 4 caractaires alphanumérique</div>'
            rootAdmin.appendChild(alert)
            alert.scrollIntoView();
        }
        if (!regex.test(pwdUser.value) || pwdUser.value.length<8) {
            rootAdmin.innerHTML=''
            e.preventDefault()
            const alert = document.createElement('div')
            alert.className='my-3 container text-center'
            alert.innerHTML='<div class="alert alert-danger">Le mot de passe  doit contenir au moins 8 caractaires alphanumérique</div>'
            rootAdmin.appendChild(alert)
            alert.scrollIntoView();
        }
        if (pwdUser.value != confpwdUser.value) {
            rootAdmin.innerHTML=''
            e.preventDefault()
            const alert = document.createElement('div')
            alert.className='my-3 container text-center'
            alert.innerHTML='<div class="alert alert-danger">les mots de passe ne correspondent pas</div>'
            rootAdmin.appendChild(alert)
            alert.scrollIntoView();
        }

    }
})
