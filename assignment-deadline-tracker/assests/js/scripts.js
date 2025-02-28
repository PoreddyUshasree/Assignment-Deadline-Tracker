document.addEventListener('DOMContentLoaded', () => {
    const deadlines = document.querySelectorAll('.deadline');
    deadlines.forEach(deadline => {
        const dueDate = new Date(deadline.dataset.dueDate);
        const countdown = setInterval(() => {
            const now = new Date();
            const timeDiff = dueDate - now;
            if (timeDiff <= 0) {
                clearInterval(countdown);
                deadline.textContent = "Deadline Passed";
            } else {
                const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                deadline.textContent = `${days} days remaining`;
            }
        }, 1000);
    });
});
