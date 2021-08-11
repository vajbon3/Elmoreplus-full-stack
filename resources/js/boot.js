window.elmoreFetch =
async function ($url,$data) {
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
