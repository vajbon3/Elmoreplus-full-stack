// handle post commenting
addCommentingFunctionality();

// handle comment throttling
addCommentThrottleListeners();

// handle post creation
addPostingFunctionality();

function addPostingFunctionality() {
    let createPostForm = document.querySelector("#createPost");
    let createPostButton = createPostForm.querySelector("button");

    createPostButton.onclick = function (e) {
        e.preventDefault();
        let textarea = createPostForm.querySelector("textarea");
        let body = textarea.value;
        textarea.value = "";
        let post = { body: body};

        createPost(post);
    }
}

async function createPost(post) {
    let data = await elmoreFetch("/api/posts", {
        body: post.body,
    });

    post = { body : data.body };
    post.id = data.id;
    post.author = data.author;

    // insert post dynamically
    renderPost(post);

    // add event listeners again
    addCommentingFunctionality();
}

function renderPost(post) {
    let template = document.querySelector(".template-post").cloneNode(true);

    template.querySelector(".author_name").innerText = post.author.name;
    template.querySelector(".post_body").innerText = post.body;
    template.id = post.id;

    template.classList.remove("invisible", "absolute", "template-post");
    document.querySelector("#posts").prepend(template);
}

function renderComment(data,post) {
    // get hidden comment template
    let template = document.querySelector(".template-comment").cloneNode(true);

    // fill the template with values
    template.querySelector(".author-name").innerHTML = data.author.name;
    template.querySelector(".comment-body").innerHTML = data.body;
    template.id = data.id;
    template.classList.remove("invisible","absolute","template-comment");

    // increase comment count
    let commentCount = post.querySelector(".post__activity__comments");
    let number = parseInt(commentCount.innerHTML);
    commentCount.innerHTML = ++number;

    // insert comment template into comment section
    post.querySelector(".post__comments").append(template);
}

// dynamic commenting functionality
function addCommentingFunctionality() {
    // add comment event listeners
    let posts = document.querySelectorAll(".post");

    for(let post of posts) {
        post.querySelector(".write-comment").addEventListener("click",async function(e) {
            // stop the refresh
            e.preventDefault();

            let textarea = e.target.parentElement.querySelector("textarea");
            let data = await elmoreFetch("/api/comments",{
                post_id: post.id,
                comment_body: textarea.value
            });

            // clear textarea
            textarea.value = "";

            console.log(post,post.id);

            // render the comment
            renderComment(data,post);
        });
    }
}

function resetComments(post) {
    // clear out comment section
    post.querySelector(".post__comments").innerHTML = "";

    // reset comment counter
    post.querySelector(".post__activity__comments").innerHTML = "0";
}

// add comment throttling functionality
function addCommentThrottleListeners() {
    let posts  = document.querySelectorAll(".post");

    for(let post of posts) {
        let throttle = post.querySelector(".throttle");
        throttle?.addEventListener("click",async function(e) {
            let data = await elmoreFetch(`/api/posts/${post.id}/comments`);

            // clean comment section
            resetComments(post);
            for(let comment of data)
                renderComment(comment,post);
        });
    }
}



