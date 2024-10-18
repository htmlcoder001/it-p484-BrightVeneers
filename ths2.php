<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  
  <title>Grazie! Il suo ordine è stato accettato.</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="css/ths.css"/>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>


<body>

<main>
  
  <div class="ty-heading">
    <div class="ty-heading__icon">
      <img src="img/icon-check.png" alt="" class="ty-icon__image">
    </div>
    <p class="ty-heading__title">Grazie!</p>
    <p class="ty-heading__subtitle">Il suo ordine è stato accettato</p>
    <p class="ty-heading__text">Un operatore vi contatterà a breve per la conferma dell'ordine</p>
  </div>
  
  <div class="ty-content">
    
    <div class="ty-content__col">
      <div id="entered_data" class="ty-form --entered-data">
        <div class="ty-col__box">
          <p class="ty-content__title">Assicuratevi che i dati forniti siano corretti:</p>

          <div class="ty-form__row">
            <label for="name" class="ty-form__label">
              <span class="ty-label__text">Nome</span>
              <span class="ty-form__input"><?php echo ($data["name"])?></span>
            </label>

            <label for="phone" class="ty-form__label">
              <span class="ty-label__text">Telefono</span>
              <span class="ty-form__input"><?php echo ($data["phone"])?></span>
            </label>

            <button type="button" class="ty-form__edit" id="ty_form_edit">Modifica dati</button>
          </div>
  

        </div>
      </div>

      <form id="form" class="ty-form --form-hidden" geo="it" action="api.php" method="post" 
	onsubmit="return validate_form(this, 'Si prega di inserire un numero di telefono valido');"	>
        
        <div class="ty-col__box">
          <p class="ty-content__title">Assicuratevi che i dati forniti siano corretti:</p>
          
          <div class="ty-form__row">
            <label for="name" class="ty-form__label">
              <span class="ty-label__text">Nome</span>
              <input readonly type="text" id="name" class="ty-form__input" name="name" required="" placeholder=""/>
            </label>
    
            <label for="phone" class="ty-form__label">
              <span class="ty-label__text">Telefono</span>
              <input readonly type="tel" id="phone" class="ty-form__input" name="phone" required="" placeholder=""/>
            </label>

            <button type="submit" class="ty-form__submit">Salva i dati</button>
			
        <input name="subid" type="hidden" value="<?php echo $data['data1']; ?>" />
        <input name="px" type="hidden" value="<?php echo $data['px']; ?>" />
        <input name="bayer" type="hidden" value="<?php echo $data['data2']; ?>" />
			
          </div>
  

        </div>
        
      </form>
    </div>
    
  </div>
  
</main>



<script>
  /* Edit form script */
  let ty_form = document.getElementById('form'),
    ty_button_edit = document.getElementById('ty_form_edit'),
    entered_data = document.getElementById('entered_data');

  ty_button_edit.addEventListener('click', () => {
    ty_form.classList.add('--form-edit');
    ty_form.classList.remove('--form-hidden');
    entered_data.classList.add('--form-hidden');


    ty_form.querySelectorAll('input').forEach((input) => {
      input.removeAttribute('readonly');
    })
  });
</script>

<script>
		var phonePattern = {
			'nn': '+__ _____ ??????????_',
			'au': '+61 _ ____ ___??_',
			'jp': '+81 _ ____ ____?_',
			'uk': '+44 ____ ?______',
			'fr': '+33 _ __ __ __ __',
			'de': '+49 ___ ____ ?__',
			'at': '+43 ____ ____ ?__',
			'ch': '+41 __ ___ __ __ ?__',
			'ru': '+7 (___) ___-__-__',
			'ua': '+38-___-___-__-__',
			'by': '+375 ___ ___ ___',
			'kz': '+7 ___ ___ ____',
			'kg': '+___ ___ __ __ __',
			'md': '0 ___ _____',
			'az': '+___-__-___-__-__',
			'ge': '+995 ___ __ __ __',
			'es': '+34 ___ __ __ __',
			'pe': '+51 ___ ___ _?_',
			'cl': '+56 _ ____ ____',
			'ar': '+54 __ ____ ____',
			'co': '+57 _______??_',
			'mx': '+52 __ ____ ____',
			'it': '+39-___-___-____',
			'esp': '+34 ___ __ __ __',
			'pt': '+351 ___ ___ ___',
			'br': '+55 __ ___?_ ____',
			'prt': '+351 ___ ___ ___',
			'id': '+62 ___ ___ ___',
			'gr': '+30 ___ _______',
			'cy': '+357 __ ______',
			'ro': '+40 ___ ___ ___',
			'bg': '+359 ___ ___ ___',
			'cz': '+420 ___ ___ ___',
			'sk': '+421 ___ ___ ___',
			'si': '+386 _ ___ __ __',
			'pl': '+48 ___ ___ ___',
			'al': '+355 __ ___ ___?_',
			'rs': '+381 __ _____?_',
			'ph': '+63 _ ____ __?_',
			'hu': '+36 _ ___ ____',
			'hr': '+385 _ ____ __?_',
			'ba': '+387 __ ______',
			/* --- */
		}

		const inputs = document.querySelectorAll('form input[name="phone"]')


		//функция на проверку соответствия количества введенных в инпут символов, количеству необходимых в маске
		function validate_form(form, alert_text = "Please enter valid phone number") {
			var input_ln = form.querySelector('input[name="phone"]').value.replace(/ /g, '').length,
				pattern_ln = phonePattern[form.getAttribute('geo')].replace(/\?| /g, '').length;
			if (input_ln >= pattern_ln) return true;
			else { alert(alert_text); return false; }
		}

		//сама маска, срабатывающая от ивентов ввода, фокуса, потери фокуса и нажатия кнопки мыши
		document.addEventListener("DOMContentLoaded", function () {

			var isTimeoutSeted = false;
			var inputInterval;

			function createInterval(input) {
				if (!isTimeoutSeted) {
					isTimeoutSeted = true;

					inputInterval = setInterval(() => {
						input.selectionStart = input.value.length
						input.setSelectionRange(input.value.length, input.value.length);
					}, 15)
				}
			}

			function deleteInterval() {
				clearInterval(inputInterval)
				isTimeoutSeted = false;
			}

			function setSelectionStart(input) {
				input.selectionStart = input.value.length
			}

			function mask(event) {
				var input = event.currentTarget;
				var geo = input.form.getAttribute('geo');
				var matrix = phonePattern[geo];
				var i = 0;
				var def = matrix.replace(/\D/g, "");
				var val = input.value.replace(/\D/g, "");

				if (!event.type == "blur") {
					setSelectionStart(input)
				}

				// Ставим интервал для инпута
				createInterval(input)

				if (event.type == "blur") {
					// Сбрасываем интервал для инпута
					deleteInterval()
					if (input.value.length == 2) {
						input.value = ""
					}
				}

				if (def.length >= val.length) {
					val = def
				};

				input.value = matrix.replace(/./g, function (a) {
					return /[_|?\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
				});


			};

			inputs.forEach(input => {
				input.addEventListener("input", mask, false);
				input.addEventListener("blur", mask, false);
				input.addEventListener("focus", mask, false);
			})
		});

		$(document).ready(function () {
			// Load GDPR
			$(document).gdprCookieLaw({
				moreLinkHref: '/privacypolicy',
				theme: 'theme-1',
				position: 'bottom-right',
				width: '760px',
				margin: '15px',
				animation: 'fade-slide',
				btnAcceptText: 'Ok'
			});
		});

</script>

</body>

</html>