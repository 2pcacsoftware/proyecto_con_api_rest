function startSession() {
    const valueEmail = document.getElementById('inputEmail').value;
    const valuePass = document.getElementById('inputPassword').value;

    axios({
        url: '../backend/api/users.php?email='+valueEmail+'&password='+valuePass,
        method: 'get',
        responseType: 'json'
    }).then(res => {
        
            console.log(res);
            if ((res.data['startSession']==true)&& (res.data['idUser']!="")){
                sessionStorage.setItem('idUser', res.data['idUser']);
                sessionStorage.setItem('startSession', 'true');
                window.location.href = "inizio.html";
            }else{
                    document.getElementById('smsAlert').style.visibility = "visible";
            }

        //console.log(res);
    })
    .catch(error => {
        console.error(error);
    });
}
