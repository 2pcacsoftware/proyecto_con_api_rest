function getUsers() {
    axios({
        url:'../backend/api/users.php',
        method: 'get',
        responseType: 'json'
    }).then (res=>{
        for (let i = 0; i < res.data.length; i++) {
            document.getElementById('users-actual').innerHTML +=`<option value="${res.data[i].idUser}">${res.data[i].name}</option>`
            
        }
        //console.log(res);
    }).catch(error=>{
        console.error(error);
    });
}
getUsers();