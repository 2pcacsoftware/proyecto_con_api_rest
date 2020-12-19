const route="http://localhost/fashionsolution/backend/";

function setComment(idPost) {
    console.log(`Comentar el post ${idPost} con el comentario ${document.getElementById('comment-post-' + idPost).value}`);
    let selectUser = document.getElementById('users-actual');
    let userActual = selectUser.options[selectUser.selectedIndex].text;
    axios({
        url: '../backend/api/comments.php',
        method: 'post',
        responseType: 'json',
        data: {
            idPost: idPost,
            user: userActual,
            comment: document.getElementById('comment-post-' + idPost).value
        }
    }).then(res => {
        console.log(res);
        document.getElementById('comment-' + idPost).innerHTML +=
            `<div>       
                <span class="post-user">${userActual}</span>
                <span class="post-content">${document.getElementById('comment-post-' + idPost).value}</span>
            </div>
            `;
        document.getElementById('comment-post-' + idPost).value = '';
    }).catch(error => {
        console.error(error);
    });
}

function setNewPost() {
    const valuePost = document.getElementById('content-post').value;
    const valueFile = document.getElementById('image_file_post');
    const selectUser = document.getElementById('users-actual');
    const userActual = selectUser.options[selectUser.selectedIndex].text;   
    let formData = new FormData();
    formData.append("idPost", "");
    formData.append("idUser", userActual);
    formData.append("contentPost", valuePost); 
    formData.append("amountLikes", "");
    // HTML file input user's choice...
    formData.append("image", valueFile.files[0]);
    console.log(Array.from(formData));
    let request = new XMLHttpRequest();
    request.open("POST", "../backend/api/posts.php");
    request.send(formData);
}

function getUsers() {
    axios({
        url: '../backend/api/users.php',
        method: 'get',
        responseType: 'json'
    }).then(res => {
        for (let i = 0; i < res.data.length; i++) {
            document.getElementById('users-actual').innerHTML += `<option value="${res.data[i].idUser}">${res.data[i].name}</option>`

        }
        document.getElementById('users-actual').value = null;
        //console.log(res);
    }).catch(error => {
        console.error(error);
    });
}
getUsers();

function showPosts(value) {


    axios({
        url: '../backend/api/posts.php?idUser=' + value,
        method: 'get',
        responseType: 'json'
    }).then(res => {
        document.getElementById('posts').innerHTML = '';
        for (let i = 0; i < res.data.length; i++) {
            const post = res.data[i];
            let comments = '';
            for (let x = 0; x < post.comments.length; x++) {
                comments += `
                    <div>       
                        <span class="post-user">${post.comments[x].user}</span>
                        <span class="post-content">${post.comments[x].comment}</span>
                    </div>
                `;

            }


            document.getElementById('posts').innerHTML +=
                `<div class="col-lg-12">
                <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <img class="img-fluid img-thumbnail rounded-circle" src="${route+post.imageAccount}">    
                    <span>${post.name}</span>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="image-post" style="background-image: url(${route+post.image});">

                    </div>
                    <div class="px-3 py-3 post">
                    <span class="pointer" onclick="like(1);"><i class="far fa-heart"></i></span>&nbsp;${post.amountLikes}Likes<br>
                    <span class="post-user">${post.name}</span>
                    <span class="post-content">${post.contentPost}</span>
                    <hr>
                    <b>Comments</b><br>
                    <div id ="comment-${post.idPost}">
                        ${comments}
                    </div>
                    <hr>
                    <div class="px-0">
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Comment" id="comment-post-${post.idPost}">
                        <div class="input-group-append">
                            <button type="button" onclick="setComment(${post.idPost});" class="btn btn-outline-danger"><i class="far fa-paper-plane"></i></button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>`;
        }
        console.log(res);
    }).catch(error => {
        console.error(error);
    });
}