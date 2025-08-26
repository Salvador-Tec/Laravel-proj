/* assets/js/datepicker.js
   --------------------------------------------------------------
   Animations + ripple + validation pour les champs .date-input
   -------------------------------------------------------------- */
   document.addEventListener('DOMContentLoaded', () => {

    /*------------------------------------------------------------
      1. Sélection
    ------------------------------------------------------------*/
    const dateInputs = document.querySelectorAll('.date-input');
    const dateGroups = document.querySelectorAll('.group-select .input-group');

    /*------------------------------------------------------------
      2. Focus / blur + icône calendrier
    ------------------------------------------------------------*/
    dateInputs.forEach(input => {

        const group        = input.parentElement;                       // .input-group
        const calendarIcon = group.querySelector('.input-group-addon'); // icône
        group.style.position = 'relative';                              // nécessaire pour le ripple

        /* focus / blur */
        input.addEventListener('focus', () => {
            group.classList.add('focused');
            group.style.transform = 'translateY(-2px)';
        });

        input.addEventListener('blur', () => {
            group.classList.remove('focused');
            group.style.transform = 'translateY(0)';
        });

        /* clic sur icône calendrier */
        if (calendarIcon) {
            calendarIcon.addEventListener('click', () => {
                calendarIcon.style.animation = 'pulse 0.6s ease-in-out';
                setTimeout(() => (calendarIcon.style.animation = ''), 600);
                input.focus();
            });
        }
    });

    /*------------------------------------------------------------
      3. Apparition au scroll
    ------------------------------------------------------------*/
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.opacity   = '1';
                e.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    dateGroups.forEach(g => {
        g.style.opacity    = '0';
        g.style.transform  = 'translateY(20px)';
        g.style.transition = 'opacity .6s ease, transform .6s ease';
        io.observe(g);
    });

    /*------------------------------------------------------------
      4. Ajout / suppression de valeur
    ------------------------------------------------------------*/
    dateInputs.forEach(input => {
        input.addEventListener('input', () => {
            const cls = input.parentElement.classList;
            if (input.value) {
                input.classList.add('has-value');
                cls.add('valid');
            } else {
                input.classList.remove('has-value');
                cls.remove('valid');
            }
        });
    });

    /*------------------------------------------------------------
      5. Hover lift
    ------------------------------------------------------------*/
    dateGroups.forEach(g => {
        g.addEventListener('mouseenter', () => g.style.transform = 'translateY(-3px) scale(1.02)');
        g.addEventListener('mouseleave', () => g.style.transform = 'translateY(0) scale(1)');
    });

    /*------------------------------------------------------------
      6. Animation de chargement (slide-in)
    ------------------------------------------------------------*/
    setTimeout(() => {
        dateInputs.forEach((input, i) => {
            setTimeout(() => {
                input.style.opacity   = '0';
                input.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    input.style.opacity   = '1';
                    input.style.transform = 'translateX(0)';
                }, 200);
            }, i * 100);
        });
    }, 500);

    /*------------------------------------------------------------
      7. Validation format dd-mm-yyyy
    ------------------------------------------------------------*/
    const rex = /^\d{2}-\d{2}-\d{4}$/;
    function validate(el) {
        el.classList.toggle('valid-date', rex.test(el.value));
        el.classList.toggle('invalid-date', el.value && !rex.test(el.value));
    }
    dateInputs.forEach(i => i.addEventListener('blur', () => validate(i)));

    /*------------------------------------------------------------
      8. Effet ripple (sur le groupe, pas dans <input>)
    ------------------------------------------------------------*/
    dateGroups.forEach(group => {
        group.addEventListener('click', e => {
            const rect = group.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const span = document.createElement('span');
            span.className = 'ripple';
            span.style.width  = span.style.height = `${size}px`;
            span.style.left   = `${e.clientX - rect.left - size / 2}px`;
            span.style.top    = `${e.clientY - rect.top  - size / 2}px`;
            group.appendChild(span);
            setTimeout(() => span.remove(), 600);
        });
    });
});

/*--------------------------------------------------------------
  9. Styles injectés
----------------------------------------------------------------*/
const extraStyles = `
.ripple{
    position:absolute;border-radius:50%;background:rgba(0,123,255,.35);
    transform:scale(0);animation:rip .6s linear;pointer-events:none;z-index:1;
}
@keyframes rip{to{transform:scale(4);opacity:0}}
.date-input.valid-date   {border-color:#28a745;background:linear-gradient(135deg,#e8f5e8 0%,#fff 100%)}
.date-input.invalid-date {border-color:#dc3545;background:linear-gradient(135deg,#ffe8e8 0%,#fff 100%)}
.group-select .input-group.valid .input-group-addon{background:linear-gradient(135deg,#28a745 0%,#1e7e34 100%)}
.group-select .input-group.focused{box-shadow:0 0 0 3px rgba(0,123,255,.2)}
`;
document.head.appendChild(Object.assign(document.createElement('style'), { textContent: extraStyles }));
