// ✅ Check if JS is loaded
console.log("JS Loaded");

// ✅ Ask permission when page loads
window.onload = function () {
    if ("Notification" in window) {
        Notification.requestPermission().then(permission => {
            console.log("Permission:", permission);
        });
    } else {
        alert("Browser does not support notifications");
    }
};

// ✅ Test button (manual trigger)
function testNotification() {
    if (Notification.permission === "granted") {
        new Notification("💊 Medicine Reminder", {
            body: "This is a test notification"
        });
    } else {
        alert("Allow notification first!");
    }
}

// ✅ Auto reminder check
setInterval(() => {

    let now = new Date();
    let currentTime = now.toTimeString().slice(0,5);

    let reminders = JSON.parse(localStorage.getItem("reminders")) || [];

    reminders.forEach((r, i) => {

        if (r.time === currentTime && !r.triggered) {

            new Notification("💊 Medicine Reminder", {
                body: "Time to take: " + r.medicine
            });

            r.triggered = true;
        }

    });

    localStorage.setItem("reminders", JSON.stringify(reminders));

}, 1000);
document.querySelector("form").addEventListener("submit", function () {

    let med = document.querySelector("input[name='medicine']").value;
    let time = document.querySelector("input[name='time']").value;

    let reminders = JSON.parse(localStorage.getItem("reminders")) || [];

    reminders.push({
        medicine: med,
        time: time,
        triggered: false
    });

    localStorage.setItem("reminders", JSON.stringify(reminders));
});