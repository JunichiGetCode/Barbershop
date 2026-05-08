async function login() {
    const usernameInput = document.getElementById('username').value;
    const passwordInput = document.getElementById('password').value;
    const msg = document.getElementById('msg');
    
    // Reset pesan error
    msg.innerText = "";

    if(!usernameInput || !passwordInput) {
        msg.innerText = "Harap isi username dan password.";
        return;
    }

    try {
        // Ambil CSRF Token dari meta tag (PENTING untuk Laravel)
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch('/admin/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                username: usernameInput,
                password: passwordInput
            })
        });

        const data = await response.json();

        if (data.success) {
            // Jika sukses, redirect ke dashboard
            window.location.href = data.redirect;
        } else {
            // Jika gagal, tampilkan pesan error
            msg.innerText = data.message || "Login gagal.";
        }

    } catch (error) {
        console.error('Error:', error);
        msg.innerText = "Terjadi kesalahan sistem.";
    }
}