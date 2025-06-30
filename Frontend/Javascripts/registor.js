import { createUser } from './api.js';

const form = document.getElementById('registerForm');
form.addEventListener('submit', async e => {
  e.preventDefault();

  const name     = document.getElementById('name').value.trim();
  const email    = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();

  try {
    const res = await createUser({ name, email, password });
    if (res.status === 201) {
      alert('Registration successful!');
      window.location.href = 'login.html';
    } else {
   
      const { message } = await res.json();
      alert(`Registration failed: ${message}`);
    }
  } catch (err) {
    console.error(err);
    alert('An unexpected error occurred. Please try again.');
  }
});
