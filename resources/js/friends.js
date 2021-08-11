let notifications = document.querySelectorAll("#notifications > div");
class Friends {
    constructor(notifications) {
        this.notificationsContainers = notifications;

        this.initializeNotifications();
    }

    initializeNotifications() {
        this.notifications = {};

        for(let container of this.notificationsContainers) {
            this.notifications[container.id] = container;
            container.querySelector(".friendship-accept")?.addEventListener("click", () => {
                this.accept(container.id);
            })
            container.querySelector(".friendship-reject").addEventListener("click", () => {
                this.reject(container.id);
            })
        }
    }

    accept(id) {
        elmoreFetch("/api/requests/confirm",{
            id: id,
        });
        this.notifications[id].remove();
    }

    reject(id) {
        elmoreFetch("/api/notifications/delete", {
            id: id,
        });
        this.notifications[id].remove();
    }
}

let friends = new Friends(notifications);


