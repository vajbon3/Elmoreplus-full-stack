let buttons = document.querySelectorAll(".add-friend");

for(let button of buttons) {
    button.addEventListener("click",function(e) {
        // don't refresh
        e.preventDefault();

        // tell the API to make a friend request
        let data = elmoreFetch("/api/requests",{
            id: e.target.id,
        });

        console.log(data);
    });
}


