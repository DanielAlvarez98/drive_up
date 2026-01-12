document.querySelectorAll('.calendar').forEach(calendar => {

    const monthYearEl = calendar.querySelector('.monthYear');
    const daysContainer = calendar.querySelector('.calendarDays');

    let alerts = [];
    try {
        alerts = calendar.dataset.events
            ? JSON.parse(calendar.dataset.events)
            : [];
    } catch {
        alerts = [];
    }

    const today = new Date();
    const todayStr = `${today.getFullYear()}-${
        String(today.getMonth() + 1).padStart(2,'0')
    }-${
        String(today.getDate()).padStart(2,'0')
    }`;

    const year = today.getFullYear();
    const month = today.getMonth();

    const firstDay = new Date(year, month, 1).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();

    const monthNames = [
        'Enero','Febrero','Marzo','Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
    ];

    monthYearEl.textContent = `${monthNames[month]} ${year}`;
    daysContainer.innerHTML = '';

    // Espacios vacíos
    for (let i = 0; i < firstDay; i++) {
        daysContainer.innerHTML += `<div></div>`;
    }

    // Días
    for (let day = 1; day <= totalDays; day++) {

        const dateStr = `${year}-${String(month + 1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;

        let className = '';

        alerts.forEach(alert => {
            if (alert.date === dateStr) {
                className = alert.type === 'danger'
                    ? 'bg-danger text-white'
                    : 'bg-warning text-dark';
            }
        });

        if (dateStr === todayStr) {
            className += ' border border-3 border-primary fw-bold';
        }

        daysContainer.innerHTML += `
            <div class="p-2 rounded ${className}">
                ${day}
            </div>
        `;
    }
});
