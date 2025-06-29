import { createUser } from './api.js';

document.getElementById('registerForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const name = e.target.name.value.trim();
  const email = e.target.email.value.trim();
  const password = e.target.password.value.trim();
  const errorElem = document.getElementById('registerError');
  errorElem.textContent = '';

  try {
    const res = await createUser({ name, email, password });
    if (res.status === 201) {
      alert('Registration successful!');
      window.location.href = 'login.html';
    } else {
      errorElem.textContent = res.error;
    }
  } catch (err) {
    errorElem.textContent = 'Network error';
  }
});

