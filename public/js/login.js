(function () {
  'use strict';


  const panels = document.querySelectorAll('.auth-card');

  function showPanel(id) {
    panels.forEach(p => {
      p.classList.remove('active');
      p.style.display = 'none';
    });

    const target = document.getElementById(id);
    if (!target) return;

    target.style.display = 'flex';

    void target.offsetWidth;
    target.classList.add('active');
  }


  panels.forEach(p => {
    if (!p.classList.contains('active')) {
      p.style.display = 'none';
    }
  });


  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-show]');
    if (btn) {
      e.preventDefault();
      showPanel(btn.dataset.show);
    }
  });


  document.querySelectorAll('.eye-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const inputId = this.dataset.target;
      const input   = document.getElementById(inputId);
      if (!input) return;

      const eyeOpen = this.querySelector('.eye-open');
      const eyeShut = this.querySelector('.eye-shut');

      if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.style.display = 'none';
        eyeShut.style.display = '';
      } else {
        input.type = 'password';
        eyeOpen.style.display = '';
        eyeShut.style.display = 'none';
      }
    });
  });


  const regPass      = document.getElementById('regPass');
  const strengthFill = document.getElementById('strengthFill');
  const strengthText = document.getElementById('strengthText');

  if (regPass && strengthFill) {
    regPass.addEventListener('input', evaluateStrength);
  }

  function evaluateStrength() {
    const val = regPass.value;
    let score = 0;

    if (val.length >= 6)                          score++;
    if (val.length >= 10)                         score++;
    if (/[A-Z]/.test(val))                        score++;
    if (/[0-9]/.test(val))                        score++;
    if (/[^A-Za-z0-9]/.test(val))                score++;

    const map = [
      { pct: '0%',   color: 'transparent',          label: '' },
      { pct: '25%',  color: '#E25A4A',              label: 'Muy débil' },
      { pct: '50%',  color: '#E28A2A',              label: 'Débil' },
      { pct: '75%',  color: '#C9A84C',              label: 'Buena' },
      { pct: '90%',  color: '#7EC96E',              label: 'Fuerte' },
      { pct: '100%', color: '#4CAF6E',              label: 'Muy fuerte' },
    ];

    const level = val.length === 0 ? 0 : Math.min(score, 5);
    strengthFill.style.width      = map[level].pct;
    strengthFill.style.background = map[level].color;
    strengthText.textContent      = map[level].label;
    strengthText.style.color      = map[level].color;
  }


  const regConfirm = document.getElementById('regConfirm');
  const matchMsg   = document.getElementById('matchMsg');

  function checkMatch() {
    if (!regPass || !regConfirm || !matchMsg) return;
    if (regConfirm.value === '') {
      matchMsg.textContent = '';
      return;
    }
    if (regPass.value === regConfirm.value) {
      matchMsg.textContent = '✓ Las contraseñas coinciden';
      matchMsg.style.color = '#4CAF6E';
    } else {
      matchMsg.textContent = '✗ Las contraseñas no coinciden';
      matchMsg.style.color = '#E25A4A';
    }
  }

  if (regPass)    regPass.addEventListener('input', checkMatch);
  if (regConfirm) regConfirm.addEventListener('input', checkMatch);

  document.querySelectorAll('.auth-form').forEach(form => {
    form.addEventListener('submit', function () {
      const btn = this.querySelector('.btn-primary');
      if (btn) btn.classList.add('loading');
    });
  });

  document.querySelectorAll('.field-box input').forEach(input => {
    input.addEventListener('focus', function () {
      this.closest('.field-box').style.borderColor = 'rgba(201,168,76,0.5)';
    });
    input.addEventListener('blur', function () {
      this.closest('.field-box').style.borderColor = '';
    });
  });

})();