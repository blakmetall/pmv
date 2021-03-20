export function initCalendar() {
    var newDate = new Date(),
        date = newDate.getDate(),
        month = newDate.getMonth(),
        year = newDate.getFullYear();

    $("#calendar").fullCalendar({
        header: {
            left: "prev,next today",
            center: "title",
            right: "month,agendaWeek,agendaDay"
        },
        themeSystem: "bootstrap4",
        disableDragging: true,

        eventRender: function(event, element) {
            var status = event.status
                ? "<i class='nav-icon i-Yes font-weight-bold text-success'></i>"
                : "<i class='nav-icon i-Close font-weight-bold text-danger'></i>";
            element
                .find(".fc-title")
                .html(
                    "<div class='status-event'>" +
                        status +
                        "</div>" +
                        " " +
                        event.title
                );
        },

        events: [
            {
                title: "Project name here",
                start: new Date(year, month, 1),
                color: "#ffc107",
                status: true
            },
            {
                title: "Office Hour",
                start: new Date(year, month, 3)
            },
            {
                title: "Work on a Project",
                start: new Date(year, month, 9),
                end: new Date(year, month, 12),
                allDay: !0,
                color: "#d22346",
                status: false
            },
            {
                title: "Work on a Project",
                start: new Date(year, month, 17),
                end: new Date(year, month, 19),
                allDay: !0,
                color: "#d22346",
                status: true
            },
            {
                id: 999,
                title: "Go to Long Drive",
                start: new Date(year, month, date - 1, 15, 0),
                status: true
            },
            {
                id: 999,
                title: "Go to Long Drive",
                start: new Date(year, month, date + 3, 15, 0),
                status: true
            },
            {
                title: "Work on a New Project",
                start: new Date(year, month, date - 3),
                end: new Date(year, month, date - 3),
                allDay: !0,
                color: "#ffc107",
                status: false
            },
            {
                title: "Food ",
                start: new Date(year, month, date + 7, 15, 0),
                color: "#4caf50",
                status: false
            },
            {
                title: "Go to Library",
                start: new Date(year, month, date, 8, 0),
                end: new Date(year, month, date, 14, 0),
                color: "#ffc107",
                status: false
            },
            {
                title: "Go for Walk",
                start: new Date(year, month, 25),
                end: new Date(year, month, 27),
                allDay: !0,
                color: "#ffc107",
                status: false
            },
            {
                title: "Work on a Project",
                start: new Date(year, month, date + 8, 20, 0),
                end: new Date(year, month, date + 8, 22, 0),
                status: true
            }
        ]
    });
}
