function startSession() {
    const valueEmail = document.getElementById('inputEmail').value;
    const valuePass = document.getElementById('inputPassword').value;
    /*let formData = new FormData();
    formData.append("email", valueEmail);
    formData.append("password", valuePass);
    console.log(Array.from(formData));
    let request = new XMLHttpRequest();
    request.open("GET", "../backend/api/users.php");
    request.send(formData);*/

    axios({
        url: '../backend/api/users.php?email='+valueEmail+'&password='+valuePass,
        method: 'get',
        responseType: 'json'
    }).then(res => {
        
            console.log(res);
            if ((res.data['startSession']==true)&& (res.data['idUser']!="")){
                window.location.href = "inizio.html?startSession=true&idUser="+res.data['idUser'];
            }else{
                    document.getElementById('smsAlert').style.visibility = "visible";
            }

        //console.log(res);
    })
    .catch(error => {
        console.error(error);
    });
}
