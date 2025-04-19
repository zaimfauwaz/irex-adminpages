document.getElementById('chat-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(playgroundStoreRoute, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
        .then(response => {
            if (response.status === 440) {
                alert('Session timed out. Please refresh to start a new chat.');
                return;
            }
            return response.json();
        })
        .then(data => {
            if (!data) return;

            // Always update the playground_id input in case session restarted
            if (data.playground_id) {
                document.getElementById('playground_id').value = data.playground_id;
            }

            if (data.inquiries?.length) {
                const latest = data.inquiries[data.inquiries.length - 1];
                document.getElementById('pg-prompt').value = latest.prompt || '';
                document.getElementById('pg-result').value = latest.result || '';
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Something went wrong. Please try again.');
        });
});
