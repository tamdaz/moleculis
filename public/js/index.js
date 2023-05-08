window.onload = () => {
    const ctx = document.getElementById('chart')
    const concentration_live = document.getElementById('concentration_live')
    const average_text = document.getElementById('average_text')

    var dates = []
    var concentration = []

    axios.get('/api/all').then((response) => {
        response.data.forEach(element => {
            dates.push(element.stored_at)
            concentration.push(element.concentration)
        })
    }).then(() => {
        Chart.defaults.font.size = 16;
        Chart.defaults.font.family = "Inter";

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    { label: "Concentration (PMS)", borderWidth: 1 }
                ]
            },
            options: {
                // scales: {
                //     y: { min: 0, max: 30000 }
                // },
                layout: {
                    padding: { left: 16, top: 16, right: 16, bottom: 32 }
                },
                maintainAspectRatio: false,
                plugins: {
                    legend: { size: 18 },
                    title: {
                        display: true,
                        fullSize: true,
                        text: "Taux de concentration dans l'air (moyenne pour chaque heure)"
                    }
                },
                animation: false
            }
        })
        
        chart.data.labels = dates
        chart.data.datasets[0].data = concentration
    
        chart.update();

        setTimeout(() => {
            ctx.style.visibility = "visible";
        }, 500);
    })

    axios.get('/api/latest').then((response) => {
        concentration_live.innerText = response.data[0].concentration;
    });

    axios.get('/api/average').then((response) => {
        average_text.innerText = response.data[0].concentration;
    });
}