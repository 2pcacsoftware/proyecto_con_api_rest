const route = "../backend/";

function securityPage() {
    if ((sessionStorage.getItem('startSession') != 'true') || (sessionStorage.getItem('idUser') == '')) {
        window.location.href = "index.html";
    }
    getUser(sessionStorage.getItem('idUser'));
}
function exitSession() {
    sessionStorage.clear();

    window.location.href = "index.html";
}
function setComment(idPost) {
    axios({
        url: '../backend/api/comments.php',
        method: 'post',
        responseType: 'json',
        data: {
            idPost: idPost,
            user: sessionStorage.getItem('name'),
            comment: document.getElementById('comment-post-' + idPost).value
        }
    }).then(res => {
        document.getElementById('comment-' + idPost).innerHTML +=
            `<div>       
                <span class="post-user">${sessionStorage.getItem('name')}</span>
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
    let formData = new FormData();
    formData.append("idPost", "");
    formData.append("idUser", sessionStorage.getItem('idUser'));
    formData.append("contentPost", valuePost);
    formData.append("amountLikes", "");
    // HTML file input user's choice...
    formData.append("image", valueFile.files[0]);
    let request = new XMLHttpRequest();
    request.open("POST", "../backend/api/posts.php");
    request.send(formData);
    $('#nuovo-post').modal('hide');
    showPosts(sessionStorage.getItem('idUser'));
}

function getUser(idUser) {
    axios({
        url: '../backend/api/users.php?idUser=' + idUser,
        method: 'get',
        responseType: 'json'
    }).then(res => {

        sessionStorage.setItem('name', res.data.name);
        sessionStorage.setItem('email', res.data.email);
        sessionStorage.setItem('image', res.data.image);
        sessionStorage.setItem('follow', res.data.follow);

        document.getElementById('user').innerHTML += `
                <img class="img-fluid img-thumbnail rounded-circle img-thumbnail-stories" src="${route + res.data.image}">
                <span >${res.data.name}</span>`

        showPosts(idUser);
        showUserStories(idUser);
    }).catch(error => {
        console.error(error);
    });
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
    }).catch(error => {
        console.error(error);
    });
}

function showUserStories(idUser) {

    axios({
        url: '../backend/api/stories.php?idUser=' + idUser,
        method: 'get',
        responseType: 'json'
    }).then(res => {
        for (let i = 0; i < res.data.length; i++) {
            document.getElementById('showUserStories').innerHTML += `
                <div class="px-1 py-2 story-card pointer" onclick="showStories(${idUser},${res.data[i].idStory});">
                    <div class="fl">
                      <img class="img-fluid img-thumbnail rounded-circle img-thumbnail-stories" src="${route + res.data[i].imageUser}">
                    </div>  
                    <div class="py-1 px-1 fl">
                      <small><b>${res.data[i].user}(${res.data[i].story.length})</b></small><br>
                    </div>
                </div>
            `;

        }
    })
        .catch(error => {
            console.error(error);
        });
}

function showPosts(value) {


    axios({
        url: '../backend/api/posts.php?idUser=' + value,
        method: 'get',
        responseType: 'json'
    }).then(res => {
        sessionStorage.setItem('post', JSON.stringify(res));
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
                    <img class="img-fluid img-thumbnail rounded-circle" src="${route + post.imageAccount}">    
                    <span>${post.name}</span>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="image-post" style="background-image: url(${route + post.image});">

                    </div>
                    <div class="px-3 py-3 post">
                    <span class="pointer" onclick="like(${post.idPost});"><i class="far fa-heart"></i></span>&nbsp;${post.amountLikes.length}Likes<br>
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
    }).catch(error => {
        console.error(error);
    });
}

function showStories(idUser, idStory) {
    axios({
        url: '../backend/api/stories.php?idUser=' + idUser,
        method: 'get',
        responseType: 'json'
    }).then(res => {
        document.getElementById('bodyStory').innerHTML = ''
        for (let i = 0; i < res.data.length; i++) {
            if (idStory == res.data[i].idStory) {
                for (let x = 0; x < res.data[i].story.length; x++) {
                    document.getElementById('bodyStory').innerHTML += `
                        <div class="story">
                            <div class="story-image-post" style="background-image: url(${route + res.data[i].story[x].image})">
                                <div class="story-title">${res.data[i].story[x].title}</div>
                            </div>
                        </div>
                    `;
                }
                document.getElementById('titleNameUserStory').innerHTML = 'Viendo Historias de ' + res.data[i].user;
            }
        }
        $('#show-story').modal('show');
    }).catch(error => {
        console.error(error);
    });
}

function like(idPostvalue) {
    let posts = JSON.parse(sessionStorage.getItem('post'));
    let idPost, idUser, contentPost, image, amountLikes;
    for (let i = 0; i < posts.data.length; i++) {
        if (posts.data[i].idPost == idPostvalue) {
            idPost = posts.data[i].idPost;
            idUser = posts.data[i].idUser;
            contentPost = posts.data[i].contentPost;
            image = posts.data[i].image;
            amountLikes = posts.data[i].amountLikes;
        }
    }
    if (amountLikes.length > 0) {
        for (let i = 0; i < amountLikes.length; i++) {
            let pos = amountLikes.indexOf(sessionStorage.getItem('idUser'));
            if (pos) {
                amountLikes.splice(pos, 1);
            } else {
                amountLikes.push(parseInt(sessionStorage.getItem('idUser')));
            }
        }
    } else {
        amountLikes.push(parseInt(sessionStorage.getItem('idUser')));
    }

    axios({
        url: '../backend/api/posts.php?idPost=' + idPostvalue,
        method: 'put',
        responseType: 'json',
        data: {
            idPost: idPost,
            idUser: idUser,
            contentPost: contentPost,
            image: image,
            amountLikes: amountLikes
        }
    })
        .then(res => {
            showPosts(sessionStorage.getItem('idUser'));

        })

        .catch(error => {
            console.error(error);
        });
}


