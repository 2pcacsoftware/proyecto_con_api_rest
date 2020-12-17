function getUsers() {
    axios({
        url:'../backend/api/users.php',
        method: 'get',
        responseType: 'json'
    }).then (res=>{
        for (let i = 0; i < res.data.length; i++) {
            document.getElementById('users-actual').innerHTML +=`<option value="${res.data[i].idUser}">${res.data[i].name}</option>`
            
        }
        document.getElementById('users-actual').value=null;
        //console.log(res);
    }).catch(error=>{
        console.error(error);
    });
}
getUsers();

function mostrarPosts(value) {
    
    
    axios({
        url:'../backend/api/posts.php?idUser='+value,
        method: 'get',
        responseType: 'json'
    }).then (res=>{
        document.getElementById('posts').innerHTML= '';
        for (let i = 0; i < res.data.length; i++) {
            
            const post = res.data[i];
           document.getElementById('posts').innerHTML+= 
            `<div class="col-lg-12">
                <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <img class="img-fluid img-thumbnail rounded-circle" src="#">    
                    <span>Nombre Pendiente</span>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="image-post" style="background-image: url(${post.image});">

                    </div>
                    <div class="px-3 py-3 post">
                    <span class="pointer" onclick="like(1);"><i class="far fa-heart"></i></span>&nbsp;3 Likes<br>
                    <span class="post-user">pendiente</span>
                    <span class="post-content">${post.contentPost}</span>
                    <hr>
                    <b>Comments</b><br>
                    <div>
                        <span class="post-user">Goku</span>
                        <span class="post-content">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat, iusto.</span>
                    </div>
                    <div>
                        <span class="post-user">Bulma</span>
                        <span class="post-content">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat, iusto.</span>
                    </div>
                    <hr>
                    <div class="px-0">
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Comment" id="comentario-post-1">
                        <div class="input-group-append">
                            <button type="button" onclick="comentar(1);" class="btn btn-outline-danger"><i class="far fa-paper-plane"></i></button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>`;
        }
        console.log(res);
    }).catch(error=>{
        console.error(error);
    });
}