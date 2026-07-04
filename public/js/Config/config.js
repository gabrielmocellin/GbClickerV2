window.addEventListener('DOMContentLoaded', () => {
    const toggleNightMode = document.getElementById('toggle-night-mode');
    const toggleHideFeedback = document.getElementById('toggle-hide-feedback');

    // Load initial states from localStorage
    if (localStorage.getItem('gbclicker_night_mode') === 'true') {
        toggleNightMode.checked = true;
    }

    if (localStorage.getItem('gbclicker_hide_feedback') === 'true') {
        toggleHideFeedback.checked = true;
    }

    // Add event listeners to save settings
    toggleNightMode.addEventListener('change', (e) => {
        const isChecked = e.target.checked;
        localStorage.setItem('gbclicker_night_mode', isChecked);
        
        // Immediately apply or remove the class to reflect changes live
        if (isChecked) {
            document.documentElement.classList.add('dark-mode');
        } else {
            document.documentElement.classList.remove('dark-mode');
        }
    });

    toggleHideFeedback.addEventListener('change', (e) => {
        localStorage.setItem('gbclicker_hide_feedback', e.target.checked);
    });
});
