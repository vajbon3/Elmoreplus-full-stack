async function elmoreFetch($url,$data) {
    let response = await fetch($url, {
        headers: {
            "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').content,
            "Content-Type": "application/json",
            "Accept": "application/json",
        },
        method: "post",
        credentials: "same-origin",
        body: JSON.stringify($data)
    });

    return await response.json();
}


class Post {
    constructor(body) {
        this.body = body;
    }
}

class App {
    async createPost(post) {
        let data = await elmoreFetch("/api/posts",{
            body: post.body,
        });

        post = new Post(data.body);
        post.id = data.id;
        post.author = data.author;

        this.render(post);
    }

    render(post) {
        let template = document.querySelector("#post_template").cloneNode(true);

        template.querySelector(".author_name").innerText = post.author.name;
        template.querySelector(".post_body").innerText = post.body;
        template.id = post.id;

        template.classList.remove("hidden");
        document.querySelector("#posts").prepend(template);
    }
}

let createPostForm = document.querySelector("#createPost");
let createPostButton = createPostForm.querySelector("button");

let posts = new App();
createPostButton.onclick = function(e) {
    e.preventDefault();
    let textarea = createPostForm.querySelector("textarea");
    let body = textarea.value;
    textarea.value = "";
    let post = new Post(body);

    posts.createPost(post);
}
