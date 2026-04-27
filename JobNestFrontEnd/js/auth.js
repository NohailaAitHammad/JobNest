import {api} from "./api.js"

/*   Fonction API  */
async function login(data){
    try{
        const response = await api.post('/login', data);
        localStorage.setItem('TOKEN', response.data.token);
        localStorage.setItem('ROLE', response.data.data.role.role);
        localStorage.setItem('USER', JSON.stringify(response.data.data));
        console.log(`Connecter ${localStorage.getItem('TOKEN')}`);
        return response.data;
    }catch (error){
        throw error;
    }
}

async function registerCandidat(data){

    try{
        const response =await  api.post('/register/signUpCondidat', data)
        localStorage.setItem('TOKEN', response.data.token);
        localStorage.setItem('ROLE', response.data.data.user.role.role);
        localStorage.setItem('USER', JSON.stringify(response.data.data.user));
        return response.data
    }catch (error){
        throw error;
    }
}

async function registerRecruteur(data){

    try{
        const response =await  api.post('/register/signUpRecruter', data)
        localStorage.setItem('TOKEN', response.data.token);
        localStorage.setItem('ROLE', response.data.data.user.role.role);
        localStorage.setItem('USER', JSON.stringify(response.data.data.user));
        return response.data;
    }catch (error){
        throw error;
    }
}

async function logout(){
    try{
        const response = await api.post('/logout');
        localStorage.removeItem('TOKEN');
        localStorage.removeItem('ROLE');
        localStorage.removeItem('USER');
        console.log(`Deconnexion de Recruteur :  ${response.data.message}`);
    }catch (error){
        throw error;
    }
}

/*   FONCTION DE CHANGEMENT DE UI*/

function setUpUI(){
    const authDiv = document.getElementById("");
}

/*  GESTION DES EVENEMENT  */

const logoutBtn = document.getElementById('logout');

if(logoutBtn){
    logoutBtn.addEventListener('click', async (event)=> {
        event.preventDefault();
        try{
            await logout();
            window.location.href = 'login.html';
        }catch(error){
            console.log("Erreur deconnexion", error);
        }
    });
}

const formCandidat = document.forms['formCandidat'];

if(formCandidat){
    formCandidat.addEventListener('submit', async (event) => {
        event.preventDefault();
        const form = event.target;
        const  data = {
            "firstName" : form.firstName.value,
            "lastName" : form.lastName.value,
            "email" : form.email.value,
            "password" : form.password.value,
            "password_confirmation" : form.password_confirmation.value
        };
        try {
            const response = await registerCandidat(data);
            window.location.href= '../candidat/dashboard.html'
        }catch (error) {
          console.log('Error de inscription', error);
        }
    });
}

const formRecruteur = document.forms['formRecruteur'];

if(formRecruteur){
    formRecruteur.addEventListener('submit', async (event) => {
        event.preventDefault()
        let form = event.target;

        let data = {
            "firstName" : form.firstName.value,
            "lastName" : form.lastName.value,
            "email" : form.email.value,
            "password" : form.password.value,
            "password_confirmation" : form.password_confirmation.value
        }
        try {
            const response = await registerRecruteur(data);
            console.log('Inscription Recruteur avec success', response.data);
            window.location.href='../recruteur/dashboard.html'
        }catch (error){
            console.log('Erreur de inscription recruteur');
        }
    });
}

const formLogin  = document.forms['formLogin'];

if(formLogin){
    formLogin.addEventListener('submit', async (event)=>{
        event.preventDefault()
        let form = event.target;

        let data = {
            "email" : form.email.value,
            "password" : form.password.value
        }

        try{
            const response = await login(data);
            console.log('Login successfully', response.data);
            const role = localStorage.getItem('ROLE');
            if(role === 'candidat'){
                window.location.href='../candidat/dashboard.html'
            }else if(role === 'recruteur'){
                window.location.href='../recruteur/dashboard.html'
            }else if(role === 'admin'){
                window.location.href='../admin/dashboard.html'
            }else{
                window.location.href='login.html'

            }
        }catch(error){
            console.log("error de login", error.response?.data?.message)
        }
    })
}